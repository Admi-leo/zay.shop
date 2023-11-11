<?php

namespace App\Controllers;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use App\Components\Sex;
use App\Components\Roles;
use App\Components\ImageManager;
use App\Components\Client\ShopService;

// use Symfony\Component\Mime\Email;
// use App\Components\Mail;

/**
 * Profile
 */

class Profile extends Controller
{
  protected $imageManager;
  protected $shop;

  public function __construct(ImageManager $imageManager, ShopService $shop)
  {
    parent::__construct();
    $this->imageManager = $imageManager;
    $this->shop = $shop;
    $this->isNotLoggedIn();
  }
  public function profile()
  {
    $user = $this->database->readOne('users', $this->auth->getUserId());
    $sex = Sex::getSex();

    echo $this->view->render('profile/index', ['user' => $user, 'sex' => $sex]);
  }
  public function saveSettings()
  {
    $userId = $this->auth->getUserId();
    $data = [
      'username' => $_POST['username'],
      // 'email' => $_POST['email'],
      'year' => (empty($_POST['year'])) ? null : $_POST['year'],
      'sex' => $_POST['sex']
    ];

    $user = $this->database->readOne("users", $data['username'], "username");
    $currentUser = $this->database->readOne('users', $this->auth->getUserId());

    $validator = v::key('username', v::stringType()->length(4, 26)->noWhitespace()->notEmpty());
    // ->key('email', v::stringType()->notEmpty())
    $this->validate($validator);

    if ($user) {
      unset($data['username']);
      $bool = $this->database->update('users', $data, $userId);
      flash()->message("Success without username");
    } elseif (!$user) {
      $bool = $this->database->update('users', $data, $userId);
      flash()->success('Success');
    } else {
      flash()->error("Error updating");
    }
    return redirect("/profile");

    // try {
    //     $this->auth->changeEmail($_POST['email'], function ($selector, $token) {
    //         $email = (new Email())
    //             ->from('hello@example.com')
    //             ->to('you@example.com')
    //             //->cc('cc@example.com')
    //             //->bcc('bcc@example.com')
    //             //->replyTo('fabien@example.com')
    //             //->priority(Email::PRIORITY_HIGH)
    //             ->subject('Time for Symfony Mailer!')
    //             ->text('Sending emails is fun again!')
    //             ->html('<p>See Twig integration for better HTML integration!</p>');
    //
    //         $mailer->send($email);
    //         echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email to the *new* address)';
    //     });
    //
    // }
    // catch (\Delight\Auth\InvalidEmailException $e) {
    //     die('Invalid email address');
    // }
    // catch (\Delight\Auth\UserAlreadyExistsException $e) {
    //     die('Email address already exists');
    // }
    // catch (\Delight\Auth\EmailNotVerifiedException $e) {
    //     die('Account not verified');
    // }
    // catch (\Delight\Auth\NotLoggedInException $e) {
    //     die('Not logged in');
    // }
    // catch (\Delight\Auth\TooManyRequestsException $e) {
    //     die('Too many requests');
    // }

  }
  public function saveAva()
  {
    $userId = $this->auth->getUserId();
    $user = $this->database->readOne('users', $userId);
    $image = $this->imageManager->uploadImage($_FILES['image'], 'users', $user['image']);

    $data = ['image' => $image];
    $bool = $this->database->update('users', $data, $userId);
    if (!$bool) {
      flash()->error('Error change avatar');
    }
    return back();
  }


  public function cart($username)
  {
    abisNotLoggedIn('/');

    if ($this->auth->hasRole(Roles::USER)) {
      $username = $this->auth->getUsername();
    }
    $users = $this->database->whereAll('users', $username, 'username');
    if (boolval($users) == true) {
      $userId = $this->database->readOne('users', $username, 'username');
      $cart = $this->database->whereAll('cart', $userId['id'], 'user_id');

      $totalQuantity = 0;
      $totalProducts = 0;
      $total_usd = 0;
      $total_tm = 0;

      foreach ($cart as $val) {
        $product = $this->database->readOne('products', $val['product_id']);
        $totalQuantity += $val['quantity'];
        $totalProducts++;
        $total_usd += $product['price_usd'] * $val['quantity'];
        $total_tm += $product['price_tm'] * $val['quantity'];
      }

      $summary = [
        'totalQuantity' => $totalQuantity,
        'totalProducts' => $totalProducts,
        'total_usd' => $total_usd,
        'total_tm' => $total_tm
      ];
    } else {
      $cart = $summary = [];
    }


    echo $this->view->render('profile/cart', [
      'cart' => $cart,
      'summary' => $summary
    ]);
  }
  public function rmproduct($id, $userId)
  {
    $cart = $this->database->readOne('cart', $id);
    if ($this->auth->hasRole(Roles::USER)) {
      $userId = $this->auth->getUserId();
    }

    $delete = $this->database->queryFactory->newDelete();
    $delete
      ->from('cart')
      ->where("id = :id")
      ->where("user_id = :uid")
      ->bindValues(['id' => $id, 'uid' => $userId]);
    $sth = $this->database->pdo->prepare($delete->getStatement());
    $bool = $sth->execute($delete->getBindValues());

    if ($bool) {
      $this->shop->abortQuantity($cart);
      flash()->success("A product has been deleted");
    } else {
      flash()->warning("The product has not been deleted");
    }
    return back();
  }
  public function checkout()
  {
    $this->shop->cartCheckout($_POST);
    return back();
  }

  private function validate($validator)
  {
    try {
      $validator->assert(array_merge($_POST, $_FILES));
    } catch (ValidationException $exception) {
      $exception->updateParams($this->getMessages());
      flash()->error($exception->getParams());

      return back();
    }
  }
  private function getMessages()
  {
    return [
      'username' => 'Не коректное имя пользователя',
      // 'email' => 'Не коректный email',
    ];
  }
}



?>
