<?php

namespace App\Controllers\Admin;

use App\Components\Roles;
use App\Components\Sex;
use App\Components\ImageManager;
use Delight\Auth\Status;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Users
 */

class Users extends Controller
{
  public function users()
  {
    $users = $this->database->readAll('users');

    echo $this->view->render('admin/users/index', ['users' => $users]);
  }
  public function add()
  {
    $this->noManager(@$_GET['url']);
    $roles = Roles::getRoles();
    echo $this->view->render('admin/users/create', ['roles' => $roles]);
  }
  public function create()
  {
    $this->noManager(isset($_GET['url']));
    $validator = v::key('email', v::stringType()->notEmpty())
      ->key('username', v::stringType()->notEmpty());

    if ($this->isNotPasswordAllowed($_POST['password'], $_POST['password2'])) {
      flash()->error("Проблема в пароле");
      return redirect('/admin/user/add');
    }

    $this->validate($validator);

    try {
        $userId = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
        $user = $this->database->readOne('users', $userId);

        $data = [
          'status' => isset($_POST['status']) ? Status::BANNED : Status::NORMAL,
          'roles_mask' => $_POST['roles_mask'],
        ];

        $data['image'] = $this->imageManager->uploadImage($_FILES['image'], $user['image']);

        $this->database->update('users', $data, $userId);
        flash()->success("User <i>$_POST[username]</i> have created.");
        return redirect('/admin/user/add');
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      flash()->error('No correct email');
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      flash()->error('No correct password');
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
      flash()->error('The user was created');
    }
    return redirect('/admin/user/add');
  }

  public function info($id)
  {
    $user = $this->database->readOne('users', $id);
    echo $this->view->render('admin/users/info', ['user' => $user]);
  }

  public function edit($id)
  {
    $user = $this->database->readOne('users', $id);
     
    $this->ifAdmin($id);

    $roles = Roles::getRoles();
    $sex = Sex::getSex();
    echo $this->view->render('admin/users/edit', ['user' => $user, 'roles' => $roles, 'sex' => $sex]);
  }
  public function update($id)
  {
    $user = $this->database->readOne('users', $id);

    $this->ifAdmin($id);

    $validator = v::key('email', v::stringType()->notEmpty())
      ->key('username', v::stringType()->notEmpty())
      ->key('sex', v::intVal())
      ->key('roles_mask', v::intVal());

    $this->validate($validator);


    $user = $this->database->readOne('users', $id);
    $image = $this->imageManager->uploadImage($_FILES['image'], 'users', $user['image']);

    $data = [
      'email' => $_POST['email'],
      'username' => $_POST['username'],
      'year' => $_POST['year'],
      'sex' => $_POST['sex'],
      'image' => $image,
      'status' => isset($_POST['status']) ? Status::BANNED : Status::NORMAL,
      'roles_mask' => $_POST['roles_mask']
    ];

    $update = $this->database->queryFactory->newUpdate();
    $update
      ->table('users')
      ->cols($data)
      ->where('id=:id')
      ->bindValue('id', $id);
    $sth = $this->database->pdo->prepare($update->getStatement());
    $sth->execute($update->getBindValues());


    flash()->success(['Инфо. о пользователе <i>' . $user['username'] . '</i> обновлена']);
    return redirect("/admin/user/edit/$id");
  }
  public function chstatus($id)
  {
    $user = $this->database->readOne('users', $id);
    if ($user['email'] == config("info.email")) {
      flash()->error("Не удалось изменить статус разработчика");
      return redirect('/admin/users');
    } elseif ($this->auth->getUserId() == $user['id']) {
      flash()->error("Не удалось изменить свой статус");
      return redirect('/admin/users');
    }

    $status = ($user['status'] == 0) ? 2 : 0;

    $bool = $this->database->update('users', ['status' => $status], $id);
    if ($bool) {
      return redirect('/admin/users');
    } else {
      flash()->warning("Не удалось изменить сататус пользователя $user[username]");
      return redirect('/admin/users');
    }
  }
  public function remove($id)
  {
    $user = $this->database->readOne('users', $id);
    if (config("info")['email'] == $user['email']) {
      flash()->error("He is admin");
      return redirect('/admin/users');
    } elseif ($this->auth->getUserId() == $id) {
      flash()->error("Your don't remove yourself");
      return redirect('/admin/users');
    }

    $user = $this->database->readOne('users', $id);

    try {
        $this->auth->admin()->deleteUserById($id);

        $this->imageManager->deleteImage($user['image']);

        flash()->warning("Пользователь под именем <i>$user[username]</i> удален");
        return redirect('/admin/users');
    }
    catch (\Delight\Auth\UnknownIdException $e) {
        flash()->error('Неизвестный пользователь');
    }
    return redirect('/admin/users');
  }


  private function validate($validator)
  {
    try {
      $validator->assert(array_merge($_POST, $_FILES));
    } catch (ValidationException $exception) {
      $exception->updateParams($this->getMessages());
      flash()->error($exception->getParams());

      return back();
    }
  }
  private function getMessages()
  {
    return [
      'email' => 'Введите email',
      'username' => 'Введите имя',
      'roles_mask' => 'Установите права пользователю',
      'image' => 'Не верный формат картинки'
    ];
  }

}



?>
