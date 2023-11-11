<?php

namespace App\Controllers\Admin;

/**
 * Main
 */

class Main extends Controller
{
  public function index()
  {
    echo $this->view->render('admin/index');
  }

}



?>
