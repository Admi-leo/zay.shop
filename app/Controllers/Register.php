<?php

namespace App\Controllers;

use App\Components\Client\RegistrationService;

use Delight\Auth\Status;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Register
 */

class Register extends Controller
{
  protected $reg;
  public function __construct(RegistrationService $reg)
  {
    parent::__construct();
    $this->reg = $reg;
  }
  public function registration()
  {
    $this->checkForAccess();
    $this->isUserBanned();
    echo $this->view->render('auth/signin');
  }
  public function signin()
  {
    $this->checkForAccess();
    $validator = v::key('email', v::stringType()->notEmpty())
      ->key('username', v::stringType()->length(4, 26)->noWhitespace()->notEmpty());
    $this->validate($validator);

    $email = $this->database->readOne("users", $_POST['email'], "email");
    $username = $this->database->readOne("users", $_POST['username'], "username");

    if ($email) {
      flash()->error("The email is use");
      return redirect("/registration");
    }
    if ($username) {
      flash()->error("The username is use");
      return redirect("/registration");
    }

    if (strlen($_POST['password']) < 8) {
      flash()->error('Пароль должен состоять минимум из 8 символов');
      return redirect('/registration');
    } elseif ($_POST['password'] != $_POST['password2']) {
      flash()->error('Пароли не совпадают');
      return redirect('/registration');
    }

    $this->reg->registerNewUser($_POST['email'], $_POST['password'], $_POST['username']);
  }

  public function authorization()
  {
    $this->checkForAccess();
    echo $this->view->render('auth/login');
  }
  public function login()
  {
    $this->checkForAccess();
    if (@$_POST['remember']) {
        // keep logged in for one year
        $rememberDuration = (int) (60 * 60 * 24 * 30);
    }
    else {
        // do not keep logged in after session ends
        $rememberDuration = null;
    }

    $this->reg->loginByUser($_POST['email'], $_POST['password'], $rememberDuration);
    if ($this->auth->isNormal()) {
      return redirect("/");
    } else {
      return redirect("/authorization");
    }
  }

  public function logout()
  {
    if(!$this->auth->isLoggedIn())
    {
      flash()->warning(['Вы не можете выйти, не войдя на сайт.<br>Войдите']);
      return redirect('/authorization');
    }
    $this->auth->logOut();
    return redirect('/');

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
      'email' => 'Введите email',
      'username' => 'Введите имя',
    ];
  }

}



?>
