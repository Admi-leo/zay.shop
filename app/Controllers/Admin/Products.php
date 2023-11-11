<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use Keboola\Csv\CsvReader;

/**
 * Products
 */

class Products extends Controller
{
  public function addDataFile()
  {
    if ($_FILES['file']['type'] != "text/csv") {
      return back();
    } else {
      $csv = $_FILES['file'];
    }


    $csvFile = new CsvReader($csv['tmp_name']);
    $data = [];
    $i = 0;
    foreach($csvFile as $row) {
      $data = array_merge($data, [
          $i => [
        	'name' => $row[0],
        	'price_tm' => $row[1].'.00',
        	'price_usd' => $row[2].'.00',
        	'quantity' => $row[3],
        	'totalQuantity' => $row[3],
        	'description' => $row[4],
        	'color' => $row[5],
          'user_id' => $this->auth->getUserId()
        ]
      ]);
      $i++;
    }
    $success = 0;
    $error = 0;
    foreach ($data as $val) {
      ($this->database->create('products', $val)) ? $success++ : $error++;
    }
    flash()->success("Добавлено $success товаров. Ошибка $error");

    return back();
  }

  public function products()
  {
    $products = $this->database->readAll('products');

    echo $this->view->render('admin/products/index', ['products' => $products]);
  }

  public function updateCategory($id)
  {
    if (!$_POST['category_id']) {
      flash()->warning("Need select category");
      return back();
    }
    $data = ['category_id' => $_POST['category_id']];
    $bool = $this->database->update('products', $data, $id);
    $product = $this->database->readOne('products', $id);
    if ($bool) {
      flash()->success("$product[name]'s category was update on ". getItem('categories', $product['category_id'])['title']);
    } else {
      flash()->danger("Error changing product's category $product[name]");
    }
    return back();
  }
  public function updateBrand($id)
  {
    if (!$_POST['brand_id']) {
      flash()->warning("Need select brand");
      return back();
    }
    $data = ['brand_id' => $_POST['brand_id']];
    $bool = $this->database->update('products', $data, $id);
    $product = $this->database->readOne('products', $id);
    if ($bool) {
      flash()->success("$product[name]'s brand was update on ". getItem('brands', $product['brand_id'])['title']);
    } else {
      flash()->danger("Error changing product's brand $product[name]");
    }
    return back();
  }
  public function updateImage($id)
  {
    $product = $this->database->readOne('products', $id);

    if (!$_FILES['image']) {
      flash()->warning("Need add image");
      return back();
    }
    $image = $this->imageManager->uploadImage($_FILES['image'], 'products', $product['image_1']);
    $data = ['image_1' => $image];
    $bool = $this->database->update('products', $data, $id);
    if ($bool) {
      flash()->success("A $product[name]'s picture was update");
    } else {
      flash()->danger("Error changing product's picture $product[name]");
    }
    return back();
  }

  public function public($id)
  {
    $product = $this->database->readOne('products', $id);

    $publicVal = ($product['public'] == "private") ? "public" : "private";

    $dataValid = [
      'name' => $product['name'],
      'image_1' => $product['image_1'],
      'description' => $product['description'],
      'brand_id' => $product['brand_id'],
      'category_id' => $product['category_id']
    ];

    $err = 0;
    foreach ($dataValid as $val) {
      if (!$val) {
        $err++;
      }
    }
    if ($err > 0) {
      $publicVal = "private";
    }
    $data = ['public' => $publicVal];
    $bool = $this->database->update('products', $data, $id);

    if($bool) {
      flash()->warning("Product $product[name] is $publicVal. ID($id)");
      if ($err) {
        flash()->warning("Не заполненые поля $err");
      }
      return back();
    }
  }
  public function add()
  {
    echo $this->view->render('admin/products/create');
  }
  public function create()
  {
    $validator = v::key('name', v::stringType()->notEmpty())
      ->key('price_tm', v::decimal(2))
      ->key('price_usd', v::decimal(2))
      ->keyNested('image_1.tmp_name', v::image())
      ->key('quantity', v::intVal())
      ->key('description', v::stringType()->notEmpty())
      ->key('color', v::stringType())
      ->key('brand_id', v::intVal())
      ->key('category_id', v::intVal());

    $this->validate($validator);

    $image1 = $this->imageManager->uploadImage($_FILES['image_1'], 'products');
    $image2 = $this->imageManager->uploadImage($_FILES['image_2'], 'products');
    $image3 = $this->imageManager->uploadImage($_FILES['image_3'], 'products');
    $image4 = $this->imageManager->uploadImage($_FILES['image_4'], 'products');

    $data = [
      'name' => $_POST['name'],
      'price_tm' => $_POST['price_tm'],
      'price_usd' => $_POST['price_usd'],
      'quantity' => $_POST['quantity'],
      'totalQuantity' => $_POST['quantity'],
      'description' => $_POST['description'],
      'image_1' => $image1,
      'image_2' => $image2,
      'image_3' => $image3,
      'image_4' => $image4,
      'color' => $_POST['color'],
      'brand_id' => $_POST['brand_id'],
      'category_id' => $_POST['category_id'],
      'user_id' => $this->auth->getUserId()
    ];

    $itemId = $this->database->create('products', $data);

    if ($itemId) {
      flash()->success("Товар $data[name] внесен в базу данных");
    } else {
      flash()->error("Произошла ошибка");
    }
    redirect('/admin/product/add');
  }

  public function info($id)
  {
    $product = $this->database->readOne('products', $id);
    echo $this->view->render('admin/products/info', ['product' => $product]);
  }


  public function edit($id)
  {
    $product = $this->database->readOne('products', $id);

    echo $this->view->render('admin/products/edit', ['product' => $product]);
  }
  public function update($id)
  {
    $validator = v::key('name', v::stringType()->notEmpty())
      ->key('price_tm', v::decimal(2))
      ->key('price_usd', v::decimal(2))
      ->key('quantity', v::intVal())
      ->key('description', v::stringType()->notEmpty())
      ->key('color', v::stringType())
      ->key('brand_id', v::intVal())
      ->key('category_id', v::intVal());

    $this->validate($validator);

    $product = $this->database->readOne('products', $id);


    $image1 = $this->imageManager->uploadImage($_FILES['image_1'], 'products', $product['image_1']);
    $image2 = $this->imageManager->uploadImage($_FILES['image_2'], 'products', $product['image_2']);
    $image3 = $this->imageManager->uploadImage($_FILES['image_3'], 'products', $product['image_3']);
    $image4 = $this->imageManager->uploadImage($_FILES['image_4'], 'products', $product['image_4']);

    $data = [
      'name' => $_POST['name'],
      'price_tm' => $_POST['price_tm'],
      'price_usd' => $_POST['price_usd'],
      'quantity' => $_POST['quantity'],
      'description' => $_POST['description'],
      'image_1' => $image1,
      'image_2' => $image2,
      'image_3' => $image3,
      'image_4' => $image4,
      'color' => $_POST['color'],
      'brand_id' => $_POST['brand_id'],
      'category_id' => $_POST['category_id'],
    ];

    $bool = $this->database->update('products', $data, $id);


    if ($bool) {
      flash()->success("Товар $product[name] теперь имеет изменения");
    } else {
      flash()->error("Произошла ошибка");
    }
    redirect("/admin/product/edit/$id");
  }
  public function remove($id)
  {
    $product = $this->database->readOne('products', $id);


    $bool = $this->database->delete('products', $id);
    if($bool) {
      $this->imageManager->deleteImage($product['image_1']);
      $this->imageManager->deleteImage($product['image_2']);
      $this->imageManager->deleteImage($product['image_3']);
      $this->imageManager->deleteImage($product['image_4']);
    }

    flash()->warning("Товар $product[name] удален");
    redirect("/admin/products");
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
      'name' => 'Введите имя товара',
      'price_tm' => 'цену в манатах',
      'price_usd' => 'цену в доларах',
      'description' => 'описание',
      'image' => 'Загрузите картинки'
    ];
  }


}



?>
