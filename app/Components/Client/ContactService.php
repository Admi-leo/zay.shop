<?php

namespace App\Components\Client;

use Delight\Auth\Auth;
use App\Components\Database;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

/**
 * ContactService
 */

class ContactService
{
  protected $auth;
  protected $database;

  public function __construct(Auth $auth, Database $database, Email $email)
  {
    $this->auth = $auth;
    $this->database = $database;
    $this->transport = Transport::fromDsn('smtp://localhost');
    $this->mailer = new Mailer($this->transport);
    $this->email = $email;
  }

  public function sendTalk($post)
  {
    $data = [
      "from" => $this->auth->getEmail(),
      "to" => config("info.email"),
      "subject" => $post['subject'],
      "message" => $post['message']
    ];
    $this->email
      ->from($data['from'])
      ->to($data['to'])
      ->subject($data['subject'])
      ->text($data['message']);
    $this->mailer->send($this->email);
  }



}



?>
