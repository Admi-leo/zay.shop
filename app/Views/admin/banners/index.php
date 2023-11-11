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
              <h2 class="box-title">All banners</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="banner/add" class="btn btn-success btn-lg">Добавить</a> <br> <br>
              <?= flash(); ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Picture</th>
                    <th>Status</th>
                    <th>Date added</th>
                    <th>Date update</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($banners as $banner): ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $banner['title']; ?></td>
                    <td><?= $banner['description']; ?></td>
                    <td><img src="<?= getImage($banner['image'], 'banners'); ?>" style="width:150px" alt=""></td>
                    <td>
                      <a href="/admin/banner/public/<?= $banner['id'] ?>"
                        class="btn <?php if($banner['public'] == "private"): ?>btn-danger<?php else: ?>btn-primary<?php endif; ?>">
                        <i><?php if($banner['public'] == "private"): ?>Private<?php else: ?>Public<?php endif; ?></i>
                      </a>
                    </td>
                    <td><?= $banner['dt_add']; ?></td>
                    <td><?= $banner['dt_update']; ?></td>
                    <td>
                      <a href="/admin/banner/edit/<?= $banner['id'] ?>" class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="/admin/banner/remove/<?= $banner['id'] ?>" class="btn btn-danger" style="margin-top:4px;" onclick="return confirm('Вы уверены?');">
                        <i>Delete</i>
                      </a>
                    </td>
                  </tr>
                  <?php $i++; endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Picture</th>
                    <th>Status</th>
                    <th>Date added</th>
                    <th>Date update</th>
                    <th>Действия</th>
                  </tr>
                </tfoot>
              </table>
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
