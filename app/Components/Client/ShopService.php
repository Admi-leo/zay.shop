<?php

namespace App\Components\Client;

use PDO;
use Delight\Auth\Auth;
use App\Components\Database;

/**
 * ShopService
 */

class ShopService
{
  protected $auth;
  protected $database;

  public function __construct(Auth $auth, Database $database)
  {
    $this->auth = $auth;
    $this->database = $database;
  }
  public function setlike($productId, $userId)
  {
    $product = $this->database->readOne('products', $productId);

    $select = $this->database->queryFactory->newSelect();
    $select
      ->cols(['*'])
      ->from('likes')
      ->where("user_id = :uid")
      ->where("product_id = :pid")
      ->bindValue(":uid", $userId)
      ->bindValue(":pid", $productId);
    $sth = $this->database->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    if ($product) {
      $bool = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    if (!$bool) {
      $data = [
        'user_id' => $userId,
        'product_id' => $productId
      ];
      $like = $this->database->readOne('products', $productId)['likes'] + 1;
      $likeId = $this->database->create('likes', $data);
      $this->database->update('products', ['likes' => $like], $productId);
      if (!$likeId) {
        flash()->error("Error setting like");
      }
    } else {
      $delete = $this->database->queryFactory->newDelete();
      $delete
        ->from('likes')
        ->where("user_id = :uid")
        ->where("product_id = :pid")
        ->bindValue(":uid", $userId)
        ->bindValue(":pid", $productId);
      $sth = $this->database->pdo->prepare($delete->getStatement());
      $boolDel = $sth->execute($delete->getBindValues());
      if ($boolDel) {
        $like = $this->database->readOne('products', $productId)['likes'] - 1;
        $like = ($like > 0) ? $like : 0;
        $this->database->update('products', ['likes' => $like], $productId);
      } else {
        flash()->error("Error deleting like");
      }
    }
  }

  public function abortQuantity($cart)
  {
    $product = $this->database->readOne('products', $cart['product_id']);
    $data = [
      "quantity" => $product['quantity'] + $cart['quantity']
    ];
    return $this->database->update('products', $data, $product['id']);
  }
  public function cartCheckout($post)
  {
    foreach ($post as $key => $value) {
      settype($value, "integer");

      $userId = $this->database->readOne('cart', $key)['user_id'];

      $select = $this->database->queryFactory->newSelect();
      $select
        ->cols(['*'])
        ->from('cart')
        ->where("id = :id")
        ->where("user_id = :uid")
        ->bindValue(":id", $key)
        ->bindValue(":uid", $userId);
      $sth = $this->database->pdo->prepare($select->getStatement());
      $sth->execute($select->getBindValues());

      $cart = $sth->fetch(PDO::FETCH_ASSOC);

      $select = $this->database->queryFactory->newSelect();
      $select
        ->cols(['*'])
        ->from('products')
        ->where("id = :pid")
        ->bindValue(":pid", $cart['product_id']);
      $sth = $this->database->pdo->prepare($select->getStatement());
      $sth->execute($select->getBindValues());

      $product = $sth->fetch(PDO::FETCH_ASSOC);



      if (is_int($value) && $cart && $product) {
        if ($value > $cart['quantity']) {
          $pre = $value - $cart['quantity'];
          $cartQuantity = $cart['quantity'] + $pre;
          $remain = $product['quantity'] - $pre;
          if ($remain >= 0) {
            $this->database->update('cart', ['quantity' => $cartQuantity], $key);
            $this->database->update('products', ['quantity' => $remain], $product['id']);
            flash()->success("Success: $product[name]. Inserted $pre products");
          } else {
            flash()->error("Remain: $product[quantity] of $product[name]. You tried add $pre");
          }
        } elseif ($value < $cart['quantity']) {
          $pre = $cart['quantity'] - $value;
          $cartQuantity = $cart['quantity'] - $pre;
          $remain = $product['quantity'] + $pre;
          if ($remain >= 0) {
            $this->database->update('cart', ['quantity' => $cartQuantity], $key);
            $this->database->update('products', ['quantity' => $remain], $product['id']);
            flash()->success("Success: $product[name]. Removed $pre products");
          } else {
            flash()->error("Remain: $product[quantity] of $product[name]. You tried add $pre");
          }
        }
      }
    }
  }
  public function setProductReview($userId, $productId)
  {
    $product = $this->database->readOne('products', $productId);
    $bool = $this->database->ifReviewOnProduct($userId, $productId);
    $product['reviews']++;
    if (!$bool) {
      $data = [
        'user_id' => $userId,
        'product_id' => $productId
      ];
      try {
        $this->database->create('reviews', $data);
        $this->database->update('products', ['reviews' => $product['reviews']], $productId);
      } catch (\Exception $e) {}
    }
  }
}



?>
