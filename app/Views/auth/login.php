<?php $this->layout('template'); ?>

<section class="clean-block clean-cart mb-3">
  <div class="container">
      <div class="block-heading">
          <h2 class="text-info">Authorization</h2>
          <p>Log in by your email.</p>
      </div>
      <div class="row no-gutters justify-content-center">
          <div class="col-md-4">
              <div class="p-4 bg-light" style="border-radius:4px">
                <?= flash(); ?>
                <form action="" method="post">
                  <div class="form-group mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group mb-3">
                    <label class="checkbox">
                      <input type="checkbox" name="remember">
                      <small>Remember</small>
                    </label>
                  </div>
                  <div class="form-group mt-1 d-flex justify-content-between">
                    <input type="submit" class="btn btn-danger" value="Log in">
                    <!-- <a href="/" style="text-decoration:none; font-size:15px !important;" class="mt-auto mb-auto">Forgot my password</a> -->
                  </div>
                </form>
              </div>
          </div>
      </div>
  </div>
</section>

</div>

</div>
