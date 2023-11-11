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
              <h2 class="box-title">Изменить категорию</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-6">
                  <?= flash(); ?>
                  <form action="/admin/category/edit/<?= $category['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="title">Name</label>
                      <input type="text" class="form-control" required name="title" id="title" value="<?= $category['title'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="image">Picture</label>
                      <input type="file" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-warning" type="submit">Изменить</button>
                    </div>
                  </form>
                  <a href="/admin/categories">back</a>
                </div>
                <div class="col-md-6">
                  <img src="<?= getImage($category['image'], 'categories') ?>" style="width:400px">
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
