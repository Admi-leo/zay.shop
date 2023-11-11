<?php

namespace App\Components\Client;

use Delight\Auth\Auth;
use App\Components\Roles;
use App\Components\Database;

/**
 * RegistrationService
 */

class RegistrationService
{
  protected $auth;
  protected $database;

  public function __construct(Auth $auth, Database $database)
  {
    $this->auth = $auth;
    $this->database = $database;
  }

  public function registerNewUser($email, $password, $username)
  {
    try {
        $userId = $this->auth->register($email, $password, $username, function ($selector, $token) {
          $this->auth->confirmEmail($selector, $token);
        });
        $data = ['roles_mask' => Roles::USER];
        $this->database->update('users', $data, $userId);
        flash()->success("Вы успешно зарегестрировались");
        return redirect('/authorization');
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        flash()->error('Invalid email address');
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        flash()->error('Invalid password');
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
        flash()->error('User already exists');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        flash()->error('Too many requests');
    }
    return redirect('/registration');
  }

  public function loginByUser($email, $password, $rememberDuration)
  {
    try {
        $this->auth->login($email, $password, $rememberDuration);
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        flash()->error('Не верный почтовый адрес');
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        flash()->error('Не верный пароль');
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
        flash()->error('Эл. почта не подтверждена');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        flash()->error('Слишком много попыток. Попробуйте поезже..');
    }
  }



}



?>
