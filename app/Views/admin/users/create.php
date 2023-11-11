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
              <h2 class="box-title">Добавить пользователя</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-6">
                  <?= flash(); ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="email">Email</label> <i><small>(Обязательно для входа на сайт)</small></i>
                        <input type="email" class="form-control" id="email" name="email">
                      </div>

                      <div class="form-group">
                        <label for="password">Пароль</label> <i><small>(Обязательно)</small></i>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                      <div class="form-group">
                        <label for="password2">Подтвердите пароль</label> <i><small>(Обязательно)</small></i>
                        <input type="password" class="form-control" id="password" name="password2">
                      </div>
                      <div class="form-group">
                        <label for="username">Имя пользователя</label> <i><small>(Придумайте. Обязательно)</small></i>
                        <input type="text" class="form-control" id="username" name="username">
                      </div>
                      <div class="form-group">
                        <label>Роль</label> <i><small>(Выбор прав для пользователя)</small></i>
                        <select name="roles_mask" class="form-control select2" style="width: 100%;">
                          <?php foreach ($roles as $role): ?>
                          <option value="<?= $role['id'] ?>"><?= $role['title'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="image">Аватар</label>
                        <input type="file" id="image" name="image" accept="image/*">
                      </div>

                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="status">
                            Бан <i><small>(Статус)</small></i>
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <button class="btn btn-success">Добавить</button>
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
