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
            <div>
            <div class="box-header">
              <h2 class="box-title"><?= $product['name']; ?></h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-10">
                <div style="display:flex; justify-content: space-between;">
                  <div>
                    Price TMT: <?= $product['price_tm']; ?><br>
                    Price USD: <?= $product['price_usd']; ?><br>
                    Category: <?= (!(getItem('categories', $product['category_id']))) ? "Not set" : getItem('categories', $product['category_id'])['title']; ?><br>
                    Brand: <?= (!(getItem('categories', $product['brand_id']))) ? "Not set" : getItem('categories', $product['brand_id'])['title']; ?><br>
                    Quantity: <?= $product['quantity']; ?><br>
                    Description: <?= $product['description']; ?><br>
                    Reviews: <?= $product['reviews']; ?><br>
                    Rating: <?= $product['rating']; ?><br>
                    Likes: <?= $product['likes']; ?><br>
                    Color: <?= $product['color']; ?><br>
                    Sold: <?= $product['sold']; ?><br>
                    Status: <span style="color:green"><?= ucfirst($product['public']); ?></span><br>
                    <span style="color:red">Added by: <?= getItem('users', $product['user_id'])['username']; ?></span><br>
                    <span style="color:green">Date added: <?= $product['dt_add']; ?></span><br>
                    <span style="color:orange">Date updated: <?= $product['dt_update']; ?></span><br>
                  </div>
                  <div class="col-md-6" style="display:flex">
                    <div style="margin-right: 12px">
                      <?php if ($product['image_1']): ?>
                        <img src="<?= getImage($product['image_1'], 'products'); ?>" width="200px" style="margin-bottom: 12px;border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                      <?php endif; ?>
                      <?php if ($product['image_2']): ?>
                        <img src="<?= getImage($product['image_2'], 'products'); ?>" width="200px" style="border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                      <?php endif; ?>
                    </div>
                    <div>
                      <?php if ($product['image_3']): ?>
                        <img src="<?= getImage($product['image_3'], 'products'); ?>" width="200px" style="margin-bottom: 12px;border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                      <?php endif; ?>
                      <?php if ($product['image_4']): ?>
                        <img src="<?= getImage($product['image_4'], 'products'); ?>" width="200px" style="border: solid #00A8A6 1px; border-radius: 3px" alt=""><br>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <a href="/admin/products" style="font-size:130%">back</a>
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
