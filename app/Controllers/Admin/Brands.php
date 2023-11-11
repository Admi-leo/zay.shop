<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Brands
 */

class Brands extends Controller
{
  public function brands()
  {
    $brands = $this->database->readAll('brands');

    echo $this->view->render('admin/brands/index', ['brands' => $brands]);
  }
  public function add()
  {
    echo $this->view->render('admin/brands/create');
  }
  public function create()
  {
    $validator = v::key('title', v::stringType()->notEmpty());

    $this->validate($validator);

    $image = $this->imageManager->uploadImage($_FILES['image'], 'brands');
    $data = [
      'title' => ucfirst($_POST['title']),
      'link' => $_POST['link'],
      'image' => $image
    ];

    $itemId = $this->database->create('brands', $data);
    flash()->success("Brand $data[title] added successful");
    redirect('/admin/brands');
  }
  public function edit($id)
  {
    $brand = $this->database->readOne('brands', $id);

    echo $this->view->render('admin/brands/edit', ['brand' => $brand]);
  }
  public function update($id)
  {
    $validator = v::key('title', v::stringType()->notEmpty());

    $this->validate($validator);

    $brand = $this->database->readOne('brands', $id);

    $image = $this->imageManager->uploadImage($_FILES['image'], 'brands', $brand['image']);

    $data = [
      'title' => $_POST['title'],
      'link' => $_POST['link'],
      'image' => $image
    ];

    $this->database->update('brands', $data, $id);
    flash()->warning("Категория изменена");
    redirect("/admin/brand/edit/$id");
  }
  public function remove($id)
  {
    $brand = $this->database->readOne('brands', $id);
    $bool = $this->database->delete('brands', $id);
    if($bool) { $this->imageManager->deleteImage($brand['image']);
      flash()->warning("Brand deleted");
    } else {
      flash()->error("Произошла ошибка");
    }
    redirect("/admin/brands");
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
      'title' => 'Enter name'
    ];
  }

}



?>
