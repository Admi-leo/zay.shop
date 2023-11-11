<?php

namespace App\Controllers;

use App\Components\Client\ShopService;

/**
 * Shop
 */

class Shop extends Controller
{
  protected $shop;

  public function __construct(ShopService $shop)
  {
    parent::__construct();
    $this->shop = $shop;
  }

  // show products
  public function shop()
  {
    // setting pages
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    // items on a page
    $perPage = 12;
    // get products by filter and paginate
    $products = $this->database->getAllPaginatedFromFilter('products', $_GET, $page, $perPage);
    // taking values: count all products, set page, set items on a page and by GET method getting page
    $paginator = paginate(
      count($products),
      $page,
      $perPage,
      '?page=(:num)'
    );

    // show on shop/shop.php all products and setting paginator
    echo $this->view->render('shop/shop', [
      'products' => $products,
      'paginator' => $paginator
    ]);
  }

  // show a product
  public function info($id)
  {
    // get product by id
    $product = $this->database->readOne('products', $id);

    // show only public product
    if(!$this->database->readOne('products', $id)) {
      return redirect("/shop");
    } elseif ($product['public'] == 'private') {
      return redirect("/shop");
    }

    // get current user id
    $userId = $this->auth->getUserId();

    // IF logged in DO to add a review to the product
    if ($this->auth->isLoggedIn()) {
      $this->shop->setProductReview($userId, $id);
    }

    // count comments for the product from comments table
    $sumcom = count($this->database->whereAll('comments', $id, 'product_id'));

    // get related products from products table
    $related = $this->database->whereAll('products', $product['category_id'], 'category_id');

    // get commets of the product from comments table
    $comments = $this->database->whereAll('comments', $product['id'], 'product_id');

    // show shop/info.php
    echo $this->view->render('shop/info', [
      'product' => $product,
      'sumcom' => $sumcom,

      'related' => $related,
      'comments' => $comments
    ]);
  }

  // add comment to a product
  public function comment()
  {
    // get user data by current user id
    $user = $this->database->readOne('users', $this->auth->getUserId());
    // get product by product id from post method
    $product = $this->database->readOne('products', $_POST['id']);
    // IF product not found or product is private DO redirect back page
    if (!$product || $product['public'] == 'private') {
      return back();
    }
    // prepare data of comment(message), user id, product id
    $data = [
      'comment' => $_POST['comment'],
      'user_id' => $user['id'],
      'product_id' => $product['id']
    ];
    // IF data(message) is empty DO send error and redirect back page
    if (empty($data['comment'])) {
      flash()->error("Put comment");
      return back();
    }
    // IF comment have been created DO send success
    if($this->database->create('comments', $data)) {
      flash()->success("Added new comment for $product[name] product by $user[username].");
    }
    // redirect back page
    return back();
  }
}
?>
