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
            <h2 class="box-title">Добавить товар</h2>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="col-md-8">
                <?= flash(); ?>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div style="display: flex;">
                      <div class="form-group" style="margin-right:2px;">
                        <label for="name">Name</label> <small><i>(must)</i></small>
                        <input type="text" class="form-control" required name="name" id="name" placeholder="example: coffee">
                      </div>
                      <div class="form-group" style="margin-right:2px;">
                        <label for="price_tm">Price TMT</label> <small><i>(not need)</i></small>
                        <input type="float" class="form-control" name="price_tm" id="price_tm" placeholder="ex: <?= config("wallet.tmt"); ?>">
                      </div>
                      <div class="form-group">
                        <label for="price_usd">Price USD</label> <small><i>(not need)</i></small>
                        <input type="float" class="form-control" name="price_usd" id="price_usd" placeholder="ex: 1.00">
                      </div>
                    </div>
                    <div style="display: flex;">
                      <div class="form-group" style="margin-right:2px;">
                        <div class="select">
                          <label for="brand_id">Brand</label> <small><i>(select brand)</i></small>
                          <select name="brand_id" class="form-control">
                            <?php foreach (getItemsBy('brands', ['title']) as $brand): ?>
                              <option value="<?= $brand['id'] ?>"><?= $brand['title'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group" style="margin-right:2px;">
                        <label for="quantity">Quantity</label> <small><i>(not need)</i></small>
                        <input type="number" class="form-control" name="quantity" id="quantity">
                      </div>
                      <div class="form-group">
                        <label for="color">Colors</label> <small><i>(not need)</i></small>
                        <input type="text" class="form-control" name="color" id="color" placeholder="ex: red, ...">
                      </div>
                    </div>

                    <div style="display: flex;">
                      <div class="form-group" style="margin-right:2px;">
                        <label for="description">Description</label> <small><i>(must)</i></small>
                        <textarea name="description" id="description" required class="form-control" rows="2"></textarea>
                      </div>

                      <div class="form-group" style="margin-right:4px;">
                        <label for="category_id">Category</label> <small><i>(select category)</i></small>
                        <div class="select">
                          <select name="category_id" class="form-control">
                            <?php foreach (getItemsBy('categories', ['title']) as $category): ?>
                              <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Pictures</label> <small><i>(max size 16 MB, not need)</i></small>
                      <div style="display: flex; margin-bottom:8px">
                        <input type="file" name="image_1" accept="image/*">
                        <input type="file" name="image_2" accept="image/*">
                      </div>
                      <div style="display: flex">
                        <input type="file" name="image_3" accept="image/*">
                        <input type="file" name="image_4" accept="image/*">
                      </div>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-success" type="submit">Add</button>
                    </div>
                  </form>
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
