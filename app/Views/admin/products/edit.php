<?php $this->layout('admin/template') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Админ-панель</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="">
            <div class="box-header">
              <h2 class="box-title">Изменить данные о картинке</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-7">
                  <?= flash(); ?>
                    <form action="/admin/product/edit/<?= $product['id']; ?>" method="post" enctype="multipart/form-data">
                      <div style="display: flex;">
                        <div class="form-group" style="margin-right:2px;">
                          <label for="name">Название</label>
                          <input type="text" class="form-control" required name="name" id="name" value="<?= $product['name'] ?>">
                        </div>
                        <div class="form-group" style="margin-right:2px;">
                          <label for="price_tm">Цена TMT</label>
                          <input type="float" class="form-control" name="price_tm" id="price_tm" value="<?= $product['price_tm'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="price_usd">Цена USD</label>
                          <input type="float" class="form-control" name="price_usd" id="price_usd" value="<?= $product['price_usd'] ?>">
                        </div>
                      </div>
                      <div style="display: flex;">
                        <div class="form-group" style="margin-right:2px;">
                          <div class="select">
                            <label for="brand_id">Brand</label> <small><i>(select brand)</i></small>
                            <select name="brand_id" class="form-control">
                              <?php foreach (getItemsBy('brands', ['title']) as $brand): ?>
                                <option
                                <?php if($product['brand_id'] == $brand['id']): ?>selected <?php endif; ?>
                                  value="<?= $brand['id'] ?>"><?= $brand['title'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group" style="margin-right:2px;">
                          <label for="quantity">Quantity</label>
                          <input type="number" class="form-control" name="quantity" id="quantity" value="<?= $product['quantity'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="color">Colors</label>
                          <input type="text" class="form-control" name="color" id="color" value="<?= $product['color'] ?>">
                        </div>
                      </div>

                      <div style="display: flex;">
                        <div class="form-group" style="margin-right:2px;">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" required class="form-control" rows="2"><?= $product['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Категория</label>
                          <select class="form-control" name="category_id" style="width: 100%;">
                            <?php foreach (getItemsBy('categories', ['title']) as $category): ?>
                              <option
                              <?php if($product['category_id'] == $category['id']): ?>selected <?php endif; ?>
                               value="<?= $category['id']; ?>"><?= $category['title']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Изображение</label>
                        <div style="display:flex">
                          <div class="">
                            <input type="file" name="image_1" accept="image/*">
                            <input type="file" name="image_2" accept="image/*">
                          </div>
                          <div class="">
                            <input type="file" name="image_3" accept="image/*">
                            <input type="file" name="image_4" accept="image/*">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-success" type="submit">Изменить</button>
                      </div>
                      <a href="/admin/categories">back</a>
                    </form>
                  </div>
                  <div class="col-md-6" style="display:flex">
                    <div>
                      <?php if ($product['image_1']): ?>
                        <img src="<?= getImage($product['image_1'], 'products'); ?>" width="200px" style="margin: 0 0 4px 4px;border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                      <?php endif; ?>
                      <?php if ($product['image_2']): ?>
                        <img src="<?= getImage($product['image_2'], 'products'); ?>" width="200px" style="margin: 0 0 4px 4px;border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                      <?php endif; ?>
                    </div>
                    <div>
                    <?php if ($product['image_3']): ?>
                      <img src="<?= getImage($product['image_3'], 'products'); ?>" width="200px" style="margin: 0 0 4px 4px;border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                    <?php endif; ?>
                    <?php if ($product['image_4']): ?>
                      <img src="<?= getImage($product['image_4'], 'products'); ?>" width="200px" style="margin: 0 0 4px 4px;border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                    <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            По вопросам к главному администратору.
          </div>
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
