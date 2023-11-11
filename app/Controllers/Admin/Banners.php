<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Banners
 */

class Banners extends Controller
{
  public function banners()
  {
    $banners = $this->database->readAll('banners');

    echo $this->view->render('admin/banners/index', ['banners' => $banners]);
  }

  public function public($id)
  {
    $banner = $this->database->readOne('banners', $id);
    $publicVal = ($banner['public'] == "private") ? "public" : "private";
    $data = ['public' => $publicVal];
    $bool = $this->database->update('banners', $data, $id);

    if($bool) {
      flash()->warning("Product $banner[title] is $publicVal. ID($id)");
      if ($err) {
        flash()->warning("Не заполненые поля $err");
      }
      return back();
    }
  }

  public function add()
  {
    echo $this->view->render('admin/banners/create');
  }
  public function create()
  {
    $validator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty())
        ->keyNested('image.tmp_name', v::image());

    $this->validate($validator);

    $image = $this->imageManager->uploadImage($_FILES['image'], 'banners');
    $data = [
      'title' => ucfirst($_POST['title']),
      'description' => $_POST['description'],
      'image' => $image,
      'public' => 'public'
    ];

    $itemId = $this->database->create('banners', $data);
    // pd($itemId);
    flash()->success("Banner $data[title] added successful");
    redirect('/admin/banners');
  }
  public function edit($id)
  {
    $banner = $this->database->readOne('banners', $id);

    echo $this->view->render('admin/banners/edit', ['banner' => $banner]);
  }
  public function update($id)
  {
    $validator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty())
        ->keyNested('image.tmp_name', v::image()->nullable());

    $this->validate($validator);

    $banner = $this->database->readOne('banners', $id);

    $image = $this->imageManager->uploadImage($_FILES['image'], 'banners', $banner['image']);

    $data = [
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'image' => $image
    ];

    $this->database->update('banners', $data, $id);
    flash()->warning("Категория изменена");
    redirect("/admin/banner/edit/$id");
  }
  public function remove($id)
  {
    $banner = $this->database->readOne('banners', $id);
    $bool = $this->database->delete('banners', $id);
    if($bool) { $this->imageManager->deleteImage($banner['image']);
      flash()->warning("Banner deleted");
    } else {
      flash()->error("Произошла ошибка");
    }
    redirect("/admin/banners");
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
      'title' => 'Enter name',
      'description' => 'Enter description',
      'image' => 'Select image'
    ];
  }

}



?>
