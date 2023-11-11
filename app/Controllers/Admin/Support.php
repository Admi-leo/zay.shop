<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Support
 */

class Support extends Controller
{
  public function support()
  {
    $support = $this->database->readAll('support');

    echo $this->view->render('admin/support/index', ['support' => $support]);
  }

  public function changestatus($id)
  {
    $support = $this->database->readOne('support', $id);
    $status = ($support['status'] == 'open') ? 'closed' : 'open';
    $data = ['status' => $status];
    $this->database->update('support', $data, $id);
    flash()->success("Status of ID($id) is ".strtoupper($status));
    return back();
  }

  public function info($id)
  {
    $support = $this->database->readOne('support', $id);

    echo $this->view->render('admin/support/info', ['info' => $support]);
  }
  public function answer($id)
  {
    if (empty($_POST['answer']) && !$_POST['answer']) {
      flash()->error("Write answer");
      return back();
    }
    $userId = $this->auth->getUserId();
    $now = date("Y-m-d", time());
    $data = [
      'id' => $id,
      'answer' => $_POST['answer'],
      'dt_answer' => $now,
      'status' => 'closed',
      'answer_user_id' => $userId
    ];
    $this->database->update('support', $data, $id);
    flash()->success("Answered");
    return back();
  }



}



?>
