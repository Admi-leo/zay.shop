<?php

namespace App\Controllers;

use App\Components\Client\ShopService;

/**
 * MustLogin
 */

class MustLogin extends Controller
{
  protected $shop;

  public function __construct(ShopService $shop)
  {
    parent::__construct();
    $this->shop = $shop;

    $this->isNotLoggedIn();
  }

  public function like($id)
  {
    $bool = $this->shop->setlike($id, $this->auth->getUserId());

    $url = ($_GET['url']) ? $_GET['url'] : "/shop";
    return redirect($url);
  }

  public function actions($id)
  {
    $userId = $this->auth->getUserId();
    $product = $this->database->readOne('products', $id);

    $data = [
      'product' => $product['name'],
      'quantity' => isset($_GET['product-quanity']) ? $_GET['product-quanity'] : 1,
      'user_id' => $userId,
      'product_id' => $id
    ];

    if ($_GET['action'] == 'buy') {
      // code..
    } elseif ($_GET['action'] == 'addtocart') {
      $this->database->addToCart($userId, $id, $data);
    }
    $url = ($_GET['url']) ? $_GET['url'] : "/shop";
    return redirect($url);
  }
}
?>
