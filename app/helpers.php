<?php

use Illuminate\Support\Arr;
use App\Components\Roles;
use App\Components\Sex;
use App\Components\Database;
use Delight\Auth\Auth;
use JasonGrimes\Paginator;


function pd($data)
{
  echo "<pre>";
  var_dump($data). "</pre>";die;
}

function config($field)
{
  $config = require '../app/config.php';
  return arr::get($config, $field);
}

function components($name)
{
  global $container;
  return $container->get($name);
}

function back()
{
  header("Location: ". $_SERVER['HTTP_REFERER']);
  exit;
}

function redirect($path)
{
  header("Location: $path");
  exit;
}

function abort($type)
{
  $view = components(League\Plates\Engine::class);
  switch ($type) {
    case 404:
      echo $view->render('errors/404');exit;
      break;
    case 405:
      echo $view->render('errors/405');exit;
      break;
  }
}

function getRole($key)
{
  return Roles::getRole($key);
}

function uploadedDate($timestamp)
{
  return date('d.m.Y', "$timestamp");
}

// Show size a file
function getFileSize($file)
{
  if(!file_exists($file)) return "Файл не найден";
  $filesize = filesize($file);
  if ($filesize > 1024) {
    $filesize /= 1024;
    if ($filesize > 1024) {
      $filesize /= 1024;
      if ($filesize > 1024) {
        $filesize /= 1024;
        return round($filesize, 1)." GB";
      } else {
        return round($filesize, 1)." MB";
      }
    } else {
      return round($filesize, 1)." KB";
    }
  } else {
    return round($filesize, 1)." bytes";
  }
}

function getItem($table, $key, $row = 'id')
{
  global $container;
  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $pdo = $container->get('PDO');
  $database = new Database($pdo, $queryFactory);
  return $database->readOne($table, $key, $row);
}

function getItemsBy($table, $by = ['null'], $limit = null)
{
  global $container;
  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $pdo = $container->get('PDO');

  $select = $queryFactory->newSelect();
  $select
  ->cols(['*'])
  ->from($table)
  ->orderBy($by)
  ->limit($limit);

  $sth = $pdo->prepare($select->getStatement());

  $sth->execute($select->getBindValues());

  return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function getImage($image, $pers)
{
  return (new \App\Components\ImageManager())->getImage($image, $pers);
}

function auth()
{
  global $container;
  return $container->get(Auth::class);
}
function database()
{
  global $container;
  return $container->get(Database::class);
}

function getSex($sex)
{
  return Sex::getSexItem($sex);
}


function abisLoggedIn($path)
{
  if(auth()->isLoggedIn()) { redirect($path); }
}
function abisNotLoggedIn($path)
{
  if(!auth()->isLoggedIn()) { redirect($path); }
}

function getProduct($id)
{
  return database()->readOne('products', $id);
}

function countProductsCart()
{
  global $container;
  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $pdo = $container->get('PDO');
  $database = new Database($pdo, $queryFactory);

  $userId = auth()->getUserId();
  $select = $database->queryFactory->newSelect();
  $select
    ->cols(['*'])
    ->from('cart')
    ->where("user_id = :user_id")
    ->bindValues([
      ':user_id' => $userId,
    ]);
  $sth = $pdo->prepare($select->getStatement());
  $sth->execute($select->getBindValues());

  $all = $sth->fetchAll(PDO::FETCH_ASSOC);
  $res = 0;
  foreach ($all as $val) {
    $res += $val['quantity'];
  }
  return $res;
}

function cpoc($product_id)
{
  $userId = auth()->getUserId();
  global $container;
  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $pdo = $container->get('PDO');
  $database = new Database($pdo, $queryFactory);

  $userId = auth()->getUserId();
  $select = $database->queryFactory->newSelect();
  $select
    ->cols(['*'])
    ->from('cart')
    ->where("user_id = :user_id")
    ->where("product_id = :product_id")
    ->bindValues([
      ':user_id' => $userId,
      ':product_id' => $product_id,
    ]);
  $sth = $pdo->prepare($select->getStatement());
  $sth->execute($select->getBindValues());
  $bool = $sth->fetch(PDO::FETCH_ASSOC);

  if ($bool) {
    return $bool['quantity'];
  }
  return 0;
}

function likeBool($id)
{
  global $container;
  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $pdo = $container->get('PDO');
  $database = new Database($pdo, $queryFactory);

  $userId = auth()->getUserId();
  $select = $database->queryFactory->newSelect();
  $select
    ->cols(['*'])
    ->from('likes')
    ->where("user_id = :user_id")
    ->where("product_id = :product_id")
    ->bindValues([
      ':user_id' => $userId,
      ':product_id' => $id,
    ]);
  $sth = $pdo->prepare($select->getStatement());
  $sth->execute($select->getBindValues());
  $bool = $sth->fetch(PDO::FETCH_ASSOC);

  if ($bool) {
    return "fa fa-heart";
  }
  return "far fa-heart";
}


function paginate($count, $page, $perPage, $url)
{
  $totalItems = $count;
  $itemsPerPage = $perPage;
  $currentPage = $page;
  $urlPattern = $url;

  $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
  return $paginator;
}

function paginator($paginator)
{
  include config('views_path') . 'blocks/pagination.php';
}

function getPixel($image)
{
  $prepare_slider = imagecreatefromjpeg(config("uploadFolder").$image);
  $pixel = imagecolorat($prepare_slider, 1, 1);
  $r = ($pixel >> 16) & 0xFF;
  $g = ($pixel >> 8) & 0xFF;
  $b = $pixel & 0xFF;
  $rgb = "$r, $g, $b";
  return $rgb;
}




?>
