<?php

namespace App\Components\Admin;

use Delight\Auth\Auth;
use App\Components\Roles;
use App\Components\Database;

/**
 * LogService
 */

class LogService
{
  protected $auth;
  protected $database;

  public function __construct(Auth $auth, Database $database)
  {
    $this->auth = $auth;
    $this->database = $database;

  }
  public function validOnRole($post)
  {
    $post = ['username' => $post['login'], 'email' => $post['mail']];
    $userRole = $this->database->getItemByWheres(
      ['roles_mask'],
       'users',
       'username',
       'email',
       $post['username'],
       $post['email']
    )['roles_mask'];
    if ($userRole == Roles::USER) {}
    return ($userRole == Roles::USER) ? false : true;
  }

  public function loginBy($post)
  {
    $user = ['email' => $post['mail'], 'password' => $post['password']];
    if ($post['remember'] == 'on') {
        // keep logged in for two days
        $rememberDuration = (int) (60 * 60 * 24 * 2);
    } else {
        // do not keep logged in after session ends
        $rememberDuration = null;
    }
    $username = $this->database->getItemByWheres(
      ['username'],
       'users',
       'username',
       'email',
       $post['login'],
       $user['email']
    )['username'];
    if ($username != $post['login']) { flash()->error("No correct login"); return false; }
    
    try {
        $this->auth->login($user['email'], $user['password'], $rememberDuration);
        flash()->message('Success');
        return true;
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        flash()->error('No valid email');
        return false;
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        flash()->error('No correct password');
        return false;
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
        flash()->error('Email was not varify');
        return false;
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        flash()->error('Слишком много попыток. Попробуйте поезже..');
        return false;
    }
  }



}



?>
