<?php

namespace App\Components;

use PDO;
use Delight\Auth\Auth;
use App\Components\Database;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

/**
 * Mail
 */

class Mail
{
  protected $auth;
  protected $database;

  public function __construct(Auth $auth, Database $database)
  {
    $this->auth = $auth;
    $this->database = $database;
  }



}



?>
