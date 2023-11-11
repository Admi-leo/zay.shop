<?php

namespace App\Controllers;

use PDO;
use App\Components\Client\ContactService;

/**
 * Home
 */

class Home extends Controller
{
  public function __construct(ContactService $contact)
  {
    parent::__construct();
    $this->contact = $contact;
  }
  public function home()
  {
    $select = $this->database->queryFactory->newSelect();
    $select
    ->cols(['*'])
    ->from('banners')
    ->limit(3);
    $sth = $this->database->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    $banners = $sth->fetchAll(PDO::FETCH_ASSOC);

    $select = $this->database->queryFactory->newSelect();
    $select
    ->cols(['*'])
    ->from('products')
    ->orderBy(['reviews DESC'])
    ->limit(3);
    $sth = $this->database->pdo->prepare($select->getStatement());

    $sth->execute($select->getBindValues());

    $viewest = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo $this->view->render('home', ['banners' => $banners, 'viewest' => $viewest]);
  }

  public function about()
  {
    echo $this->view->render('about');
  }
  public function contact()
  {
    echo $this->view->render('contact');
  }
  public function letstalk()
  {
    // $this->contact->sendTalk($_POST);
    if (!empty($_POST['message'])) {
      $data = [
        'message' => $_POST['message'],
        'user_id' => $this->auth->getUserId()
      ];
    }
    if ($data) {$this->database->create('support', $data);}
    return redirect("/contact");
  }

}



?>
