<?php $this->layout('admin/tempIn') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Panel</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <div class="box-body">
              <form action="" method="post" class="col-md-3">
                <?= flash(); ?>
                <div class="form-group">
                  <input type="text" required name="login" placeholder="Login" class="form-control">
                </div>
                <div class="form-group">
                  <input type="email" required name="mail" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" required name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                  <label id="checkbox">
                    <input type="checkbox" name="remember">
                    <small>Remember</small>
                  </label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Button" class="form-control btn btn-primary">
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            For FAQ to head administrator.
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
