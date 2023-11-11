<?php

namespace App\Controllers\Admin;

// Composer
use League\Plates\Engine;
use Delight\Auth\Auth;
use Delight\Auth\Role;
// My defaults
use App\Components\Database;
use App\Components\ImageManager;
use App\Components\Roles;

/**
 * Controller
 */
class Controller
{
  protected $view;
  protected $auth;
  protected $database;
  protected $imageManager;

  function __construct()
  {
    $this->view = components(Engine::class);
    $this->auth = components(Auth::class);
    $this->database = components(Database::class);
    $this->imageManager = components(ImageManager::class);

    $this->checkForAccess();
  }
  public function checkForAccess()
  {
    if(!$this->auth->isLoggedIn()) { return redirect('/'); }
    if($this->auth->hasRole(Roles::USER)) { return redirect('/'); }
  }
  public function noManager($url)
  {
    $url = (!$url) ? "/admin" : $url;
    if (!$this->auth->hasRole(Roles::ADMIN)) {
      if ($this->auth->hasRole(Roles::MANAGER)) {
        flash()->message("No privileges");
        return redirect($url);
      }
    }
  }
  public function ifAdmin($id)
  {
    $user = $this->database->readOne('users', $id);
    if ($user['email'] == config("info.email")) {
      flash()->error("No privileges");
      return redirect('/admin/users');
    }
  }
  function isNotPasswordAllowed($password, $password2) {
      if (strlen($password) < 8) {
          return true;
      }

      $blacklist = ['password1', '12345678', 'qwerty', '87654321', $password];

      // if (in_array($password, $blacklist)) {
      //     return true;
      // }

      if ($password != $password2) {
          return true;
      }

      return false;
  }


}



?>
