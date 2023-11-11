<?php

namespace App\Controllers;

use App\Components\Roles;
use App\Components\Admin\LogService;

/**
 * AdCook
 */

class AdCook extends Controller
{
  public function __construct(LogService $logService)
  {
    parent::__construct();
    $this->logService = $logService;
  }
  public function in()
  {
    if ($this->auth->isLoggedIn()) { return redirect('/admin'); }
    echo $this->view->render('admin/in/in');
  }

  public function do()
  {
    if ($this->auth->isLoggedIn()) { return redirect('/admin'); }
    // No client
    $validRole = $this->logService->validOnRole($_POST);
    if (!$validRole) { flash()->warning("The user wasn't wrote to base"); return redirect("/in"); }

    // Login
    $bool = $this->logService->loginBy($_POST);
    if (!$bool) {
      return redirect('/in');
    }
    return redirect('/admin');
  }

}



?>
