<?php $this->layout('template'); ?>

<section class="clean-block clean-cart">
  <div class="container">
      <div class="block-heading">
          <h2 class="text-info">Registration</h2>
          <p>Create a new account for yourself.</p>
      </div>
      <div class="row no-gutters justify-content-center">
          <div class="col-md-4">
              <div class="bg-light p-4" style="border-radius:4px">
                <?= flash(); ?>
                <form action="" method="post">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="username" name="username" class="form-control mb-2" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password2" class="form-control mb-2" placeholder="Confirm">
                  </div>
                  <div class="d-flex justify-content-between form-group mt-1">
                    <input type="submit" class="btn btn-danger" value="Sign in">
                    <a href="/authorization" style="text-decoration:none" class="mt-auto mb-auto">I've got an account</a>
                  </div>
                </form>
              </div>
          </div>
      </div>
  </div>
</section>

</div>

</div>
