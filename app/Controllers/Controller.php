<?php

namespace App\Controllers;

// Composer
use League\Plates\Engine;
use Delight\Auth\Auth;
// My defaults
use App\Components\Database;
use App\Components\Roles;

/**
 * Controller
 */
class Controller
{
  protected $view;
  protected $auth;
  protected $database;

  function __construct()
  {
    $this->view = components(Engine::class);
    $this->auth = components(Auth::class);
    $this->database = components(Database::class);
    $this->isUserBanned();
  }
  public function checkForAccess()
  {
    if($this->auth->hasRole(Roles::USER)) { return redirect('/'); }
  }
  public function isNotLoggedIn()
  {
    if(!$this->auth->isLoggedIn()) { flash()->warning("Log in"); return redirect('/authorization'); }
  }

  public function isUserBanned()
  {
    if ($this->auth->isBanned()) {
        $this->auth->logout();
        flash()->warning("This user is banned");
    }
  }

}



?>
