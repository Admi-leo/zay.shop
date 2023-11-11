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
          <div class="box-body" style="margin-bottom: 32px;display:flex; justify-content: space-between">
            <div>
              <div class="box-header">
                <h3>Contact</h3>
                <i>Change status to <a class="text-uppercase" href="/admin/support/changestatus/<?= $info['id']; ?>"><?php if($info['status'] == 'open'): ?>closed <?php else: ?>open<?php endif; ?></a></i><br>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div>
                  Username: <?= getItem('users', $info['user_id'])['username']; ?><br>
                  Message: <?= $info['message']; ?><br>
                  ID: <?= $info['id']; ?><br>
                  Date sent: <?= $info['dt_add']; ?><br>
                  Status: <?php if($info['status']=='closed'): ?><span class="text-danger">CLOSED</span><?php else: ?>OPEN<?php endif; ?><br>
                  <a href="/admin/support" style="font-size:130%">back</a>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <div>
              <div class="box-header">
                <h3>Answer</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if ($info['status'] == 'open'): ?>
                  <form action="/admin/sup/info/<?= $info['id']; ?>/answer" method="post">
                    <span class="form-control" disabled style="margin-bottom:3px;width:300px">From: <?= auth()->getEmail(); ?></span>
                    <span class="form-control" disabled style="margin-bottom:3px;width:300px">To: <?= getItem('users', $info['user_id'])['email']; ?></span>
                    <textarea class="form-control" required placeholder="Write answer" name="answer" rows="3" cols="27"></textarea>
                    <input type="submit" style="margin-top:4px" value="Answer" class="btn btn-sm btn-primary">
                  </form>
                <?php elseif($info['status'] == 'closed'): ?>
                  <div>
                    Username: <a href="/admin/user/info/<?= $info['answer_user_id']; ?>"><?= getItem('users', $info['answer_user_id'])['username']; ?></a><br>
                    Email: <?= getItem('users', $info['answer_user_id'])['email']; ?><br>
                    Role: <?= getRole(getItem('users', $info['answer_user_id'])['roles_mask']); ?><br>
                    Message: <?= $info['answer']; ?><br>
                    Date answered: <?= $info['dt_answer']; ?><br>
                  </div>
                <?php endif; ?>
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
