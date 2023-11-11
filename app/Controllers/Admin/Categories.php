<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Categories
 */

class Categories extends Controller
{
  public function categories()
  {
    $categories = $this->database->readAll('categories');

    echo $this->view->render('admin/categories/index', ['categories' => $categories]);
  }
  public function add()
  {
    echo $this->view->render('admin/categories/create');
  }
  public function create()
  {
    $validator = v::key('title', v::stringType()->notEmpty());

    $this->validate($validator);

    $image = $this->imageManager->uploadImage($_FILES['image'], 'categories');
    $data = [
      'title' => ucfirst($_POST['title']),
      'image' => $image
    ];

    $itemId = $this->database->create('categories', $data);
    flash()->success("Категория $data[title] создана успешно");
    redirect('/admin/categories');
  }
  public function edit($id)
  {
    $category = $this->database->readOne('categories', $id);

    echo $this->view->render('admin/categories/edit', ['category' => $category]);
  }
  public function update($id)
  {

    $validator = v::key('title', v::stringType()->notEmpty());
    $this->validate($validator);
    $category = $this->database->readOne('categories', $id);

    $image = $this->imageManager->uploadImage($_FILES['image'], 'categories', $category['image']);
    $data = [
      'title' => $_POST['title'],
      'image' => $image
    ];

    $this->database->update('categories', $data, $id);
    flash()->warning("Категория изменена");
    redirect("/admin/category/edit/$id");
  }
  public function remove($id)
  {
    $category = $this->database->readOne('categories', $id);
    $bool = $this->database->delete('categories', $id);
    if($bool) { $this->imageManager->deleteImage($category['image']);
      flash()->warning("Категория удалена");
    } else {
      flash()->error("Произошла ошибка");
    }
    redirect("/admin/categories");
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
      'image' => 'Load picture',
    ];
  }

}



?>
