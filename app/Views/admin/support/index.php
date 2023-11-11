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
              <h2 class="box-title">All supports</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?= flash(); ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Date added</th>
                    <th>Date answered</th>
                    <th>By answered</th>
                    <th>Действия</th>
                    <th>ID</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($support as $sup): ?>
                    <?php if ($sup['status']): ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= getItem('users', $sup['user_id'])['username']; ?></td>
                      <td>
                        <a href="/admin/support/changestatus/<?= $sup['id']; ?>">
                          <span class="btn btn-sm <?php if($sup['status']=='open'): ?>btn-info<?php elseif($sup['status']=='closed'): ?>btn-danger<?php endif; ?> text-uppercase"><?= $sup['status']; ?></span></td>
                        </a>
                      <td><?= $sup['dt_add']; ?></td>
                      <td>
                        <?php if($sup['dt_answer']): ?>
                          <?= $sup['dt_answer']; ?>
                        <?php else: ?>
                          No date
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($sup['answer_user_id']): ?>
                          User: <?= getItem('users', $sup['answer_user_id'])['username']; ?><br>
                          Email: <?= getItem('users', $sup['answer_user_id'])['email']; ?><br>
                          Role: <?= getRole(getItem('users', $sup['answer_user_id'])['roles_mask']); ?>
                        <?php else: ?>
                          No answer<br>
                        <?php endif; ?>
                      </td>
                      <td>
                        <a href="/admin/sup/info/<?= $sup['id'] ?>" class="btn btn-warning">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="/admin/sup/remove/<?= $sup['id'] ?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">
                          <i class="fa fa-remove-format"></i>
                        </a>
                      </td>
                      <td><?= $sup['id']; ?></td>
                    </tr>
                  <?php endif; ?>
                <?php $i++; endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Date added</th>
                    <th>Date answered</th>
                    <th>By answered</th>
                    <th>Действия</th>
                    <th>ID</th>
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
