<?php

namespace App\Components;

use PDO;
use Aura\SqlQuery\QueryFactory;

/**
 * Database
 */

class Database
{
  public $pdo;
  public $queryFactory;

  public function __construct(PDO $pdo, QueryFactory $queryFactory)
  {
    $this->pdo = $pdo;
    $this->queryFactory = $queryFactory;
  }
  public function create($table, $data)
  {
    $insert = $this->queryFactory->newInsert();
    $insert
      ->into($table)
      ->cols($data);
    $sth = $this->pdo->prepare($insert->getStatement());
    $sth->execute($insert->getBindValues());

    $name = $insert->getLastInsertIdName('id');
    return $this->pdo->lastInsertId($name);
  }
  public function readAll($table, $limit = null)
  {
    $select = $this->queryFactory->newSelect();
    $select
    ->cols(['*'])
    ->from($table)
    ->limit($limit);

    $sth = $this->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  public function readOne($table, $key, $row = 'id')
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from($table)
      ->where("$row=:id")
      ->bindValue('id', $key);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetch(PDO::FETCH_ASSOC);
  }
  public function whereAll($table, $id, $row = 'id', $orderBy = ['null'], $limit = null)
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from($table)
      ->orderBy($orderBy)
      ->limit($limit)
      ->where("$row = :id")
      ->bindValues([":id" => $id]);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  public function update($table, $data, $key, $row = 'id')
  {
    $update = $this->queryFactory->newUpdate();
    $update
      ->table($table)
      ->cols($data)
      ->where("$row=:id")
      ->bindValue('id', $key);
    $sth = $this->pdo->prepare($update->getStatement());
    return $sth->execute($update->getBindValues());
  }
  public function delete($table, $key, $row = 'id')
  {
    $delete = $this->queryFactory->newDelete();
    $delete
      ->from($table)
      ->where("$row=:id")
      ->bindValue('id', $key);
    $sth = $this->pdo->prepare($delete->getStatement());
    return $sth->execute($delete->getBindValues());
  }

  public function getCount($table, $row, $val)
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from($table)
      ->where("$row = :$row")
      ->bindValue($row, $val);

    $sth = $this->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    return count($sth->fetchAll(PDO::FETCH_ASSOC));
  }

  public function getPaginatedFrom($table, $id, $row, $page = 1, $rows = 1)
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from($table)
      ->where("$row = :row")
      ->bindValues([":row" => $id])
      ->page($page)
      ->setPaging($rows);
    $sth = $this->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getAllPaginatedFrom($table, $page = 1, $rows = 1, $orderBy = ['sold'])
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from($table)
      ->orderBy($orderBy)
      ->page($page)
      ->setPaging($rows);
    $sth = $this->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAllPaginatedFromOrderBy($table, $row, $id, $page = 1, $rows = 1, $orderBy = [null])
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from($table)
      ->where("$row = :row")
      ->bindValues([":row" => $id])
      ->page($page)
      ->orderBy($orderBy)
      ->setPaging($rows);
    $sth = $this->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAllPaginatedFromFilter($table, $filter, $orderBy = [null])
  {
    $search = (isset($filter['search'])) ? "$filter[search]%" : null;

    if (isset($filter['category'])) {
      $category = $this->readOne('categories', $filter['category']);
    }
    $category = (isset($category)) ? $category['id'] : null;
    if (isset($filter['brand'])) {
      $brand = $this->readOne('brands', $filter['brand']);
    }
    $brand = (isset($brand)) ? $brand['id'] : null;

    $where = [];
    if (!empty($filter['search'])) {
      array_push($where, "`name` LIKE :search");
    }
    if ($category) {
      array_push($where, "`category_id` = :category");
    }
    if ($brand) {
      array_push($where, "`brand_id` = :brand");
    }

    if (!empty($filter['search']) || $category || $brand) {
      $where = "WHERE " . implode(" AND ", $where);
    } else {
      $where = '';
    }

    if (@$filter['sort'] == "toup") {
      $sortBy = "ORDER BY price_usd";
    } elseif (@$filter['sort'] == "todown") {
      $sortBy = "ORDER BY price_usd DESC";
    } elseif (@$filter['sort'] == "popular") {
      $sortBy = "ORDER BY reviews ASC";
    } else {
      $sortBy = null;
    }

    $sql = "SELECT * FROM `products` $where $sortBy";
    $sql = rtrim($sql);
    $sth = $this->pdo->prepare($sql);
    if (!empty($filter['search'])) {
      $sth->bindValue(':search', $search, PDO::PARAM_STR);
    }
    if ($category) {
      $sth->bindValue(':category', $category, PDO::PARAM_INT);
    }
    if ($brand) {
      $sth->bindValue(':brand', $brand, PDO::PARAM_INT);
    }
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }


  public function addToCart($userId, $productId, $data)
  {
    $product = $this->readOne('products', $productId);
    if (!$product) {
      return flash()->error("Error addtion a product");
    }
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from('cart')
      ->where("user_id = :uid")
      ->where("product_id = :pid")
      ->bindValues([":uid" => $userId, ':pid' => $productId]);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());

    $cart = $sth->fetch(PDO::FETCH_ASSOC);
    $remain = $product['quantity'] - $data['quantity'];

    if ($remain >= 0) {
      $data['quantity'] = $cart['quantity'] + $data['quantity'];
      if (!$cart) {
        $this->create('cart', $data);
      } else {
        $this->update('cart', $data, $cart['id']);
      }
      $this->update('products', ['quantity' => $remain], $productId);
      flash()->success("Success: Addition $data[quantity] for $product[name]");
    } else {
      flash()->error("Error: Remain $product[quantity] of $product[name]");
    }
  }

  public function ifReviewOnProduct($userId, $id)
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from('reviews')
      ->where("user_id = :uid")
      ->where("product_id = :pid")
      ->bindValue(":uid", $userId)
      ->bindValue(":pid", $id);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetch(\PDO::FETCH_ASSOC);
  }
  public function getItemByWheres($data = ['*'], $table, $row, $row2, $key, $key2)
  {
    $select = $this->queryFactory->newSelect();
    $select
      ->cols($data)
      ->from($table)
      ->where("$row = :row")
      ->where("$row2 = :row2")
      ->bindValue(":row", $key)
      ->bindValue(":row2", $key2);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetch(PDO::FETCH_ASSOC);

  }
}

?>
