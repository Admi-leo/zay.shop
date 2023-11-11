<div class="user-panel">
  <div class="pull-left image" style="height:42px;">
    <img style="height: 100%" src="<?= getImage(database()->readOne('users', auth()->getUserId())['image'], 'users'); ?>" class="img-circle" alt="User Image">
  </div>
  <div class="pull-left info" style="display:block">
    <p><?= auth()->getEmail(); ?></p>
    <!-- Status -->
    <a><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>
