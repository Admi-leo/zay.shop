<?php $this->layout('template'); ?>
<div class="container mt-5 mb-5">
  <h4>Profile</h4>
  <div class="row text-white">
    <div class="col-md-5 bg-dark" style="border: 1px solid #cdcdcd; border-radius:8px; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15) !important;">
      <div style="border-bottom: 1px solid #cdcdcd;">
        <h5 style="margin: 12px 0;">User settings</h5>
      </div>
        <form action="" class="mt-1 mb-4" method="post">
          <?= flash(); ?>
          <div class="d-flex">
            <div class="form-group" style="margin-right:12px">
              <label style="font-size:14px !important;" for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" value="<?= $user['username']; ?>">
            </div>
            <!-- <div class="form-group">
              <label style="font-size:14px !important;" for="email">Email address</label>
              <input type="text" class="form-control" name="email" disabled id="email">
            </div> -->
            <div class="form-group">
              <label style="font-size:14px !important;" for="sex">Gender</label>
              <select name="sex" class="form-control">
                <?php foreach ($sex as $s): ?>
                  <option
                  <?php if($user['sex'] == $s['id']): ?>selected <?php endif; ?>
                  value="<?= $s['id'] ?>"><?= $s['title'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="d-flex">
            <div class="form-group w-50" style="margin-right:12px">
              <label style="font-size:14px !important;" for="year">Year</label>
              <input style="width:170px;" type="date" class="form-control" name="year" id="year" value="<?= $user['year']; ?>">
            </div>
          </div>
          <div class="form-group mt-2">
            <input type="submit" style="font-size:15px !important" class="btn btn-sm btn-primary" value="Save settings">
          </div>
        </form>
      </div>
        <div class="w-50 text-center">
          <label for="ava">
            <img class="w-50 bg-dark rounded-circle" src="<?= getImage($user['image'], 'users'); ?>" style="cursor:pointer; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15) !important; border: 4px solid #cdcdcd" alt="">
          </label>
          <form action="/profile/saveAva" method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" id="ava" hidden>
            <input type="submit" class="btn btn-sm btn-success mt-3" value="Change">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
