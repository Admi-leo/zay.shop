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
              <h2 class="box-title">Все пользователи</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if (getRole(1)): ?>
                <a href="/admin/user/add?url=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-success btn-lg">Добавить</a> <br> <br>
              <?php endif; ?>
              <?= flash(); ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Аватар</th>
                    <th>Статус</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($users as $user): ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= getRole($user['roles_mask']); ?></td>
                    <td>
                      <img width="80px" src="<?= getImage($user['image'], 'users'); ?>" alt="">
                    </td>
                    <td>
                      <a href="/admin/user/chstatus/<?= $user['id'] ?>" class="btn
                      <?php if($user['status'] == 0) { echo 'btn-success'; } elseif($user['status'] == 2) { echo 'btn-danger'; } ?>">

                      <?php if($user['status'] == 0) { echo "Активный"; } elseif($user['status'] == 2) { echo "Забанен"; } ?></a>
                    </td>
                    <td>
                      <a href="/admin/user/info/<?= $user['id']; ?>?url=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="/admin/user/edit/<?= $user['id']; ?>?url=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                      </a>
                      <?php if(auth()->getUserId() != $user['id']): ?>
                      <a href="/admin/user/delete/<?= $user['id']; ?>?url=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">
                        <i>Delete</i>
                      </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php $i++; endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Аватар</th>
                    <th>Статус</th>
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
