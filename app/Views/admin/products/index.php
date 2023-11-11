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
            <h3 class="box-title">Admin-panel</h3>

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
              <h2 class="box-title">All products</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/admin/product/add" class="btn btn-success btn-lg">Add</a> <br> <br>
              <?= flash(); ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Pictures</th>
                    <th>Added by</th>
                    <th>Actions</th>
                    <th>ID</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($products as $product): ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $product['name']; ?></td>

                    <td>
                      <form action="/admin/product/updateCategory/<?=$product['id']; ?>" method="post">
                        <select class="form-control" name="category_id">
                          <?php if (!getItem('categories', $product['category_id'])): ?>
                            <option selected disabled>Not set</option>
                          <?php endif; ?>
                          <?php foreach (getItemsBy('categories', ['title']) as $category): ?>
                          <option <?php if($product['category_id'] == $category['id']): ?>selected <?php endif; ?>
                           value="<?= $category['id']; ?>"><?= $category['title']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <input type="submit" class="btn btn-sm" value="Save">
                      </form>
                    </td>

                    <td>
                      <form action="/admin/product/updateBrand/<?=$product['id']; ?>" method="post">
                        <select class="form-control" name="brand_id">
                          <?php if (!getItem('brands', $product['brand_id'])): ?>
                            <option selected disabled>Not set</option>
                          <?php endif; ?>
                          <?php foreach (getItemsBy('brands', ['title']) as $category): ?>
                          <option <?php if($product['brand_id'] == $category['id']): ?>selected <?php endif; ?>
                           value="<?= $category['id']; ?>"><?= $category['title']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <input type="submit" class="btn btn-sm" value="Save">
                      </form>
                    </td>

                    <td>
                      <label for="image_<?= $product['id'];?>" style="cursor:pointer;"><img src="<?= getImage($product['image_1'], 'products'); ?>" width="100"></label>
                      <form action="/admin/product/updateImage/<?= $product['id']; ?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="image_<?= $product['id'];?>" accept="image/*" name="image" style="display:none">
                        <input type="submit" value="update" class="btn btn-sm">
                      </form>
                    </td>

                    <td><?= getItem('users', $product['user_id'])['username']; ?></td>
                    <td>
                      <a href="/admin/product/public/<?= $product['id'] ?>"
                        class="btn <?php if($product['public'] == "private"): ?>btn-danger<?php else: ?>btn-primary<?php endif; ?>">
                        <i><?php if($product['public'] == "private"): ?>Private<?php else: ?>Public<?php endif; ?></i>
                      </a>
                      <a href="/admin/product/info/<?= $product['id'] ?>" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="/admin/product/edit/<?= $product['id'] ?>" class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="/admin/product/remove/<?= $product['id'] ?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">
                        <i>Delete</i>
                      </a>
                    </td>
                    <td><?= $product['id']; ?></td>
                  </tr>
                  <?php $i++; endforeach; ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Pictures</th>
                    <th>Added by</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            For FAQs to the head administrator
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
