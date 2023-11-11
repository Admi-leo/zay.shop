<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="/admin" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Administration</b></span>
  </a>

  <!-- Header Navbar -->
  <a href="/admin/support" style="color:#fff; margin: 4px 12px;">Support</a>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <?php include 'status.php'; ?>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Навигация</li><?= flash(); ?>
      <!-- Optionally, you can add icons to the links -->

      <li><a class="label-sidebar"><span>Products</span></a></li>
      <li><a href="/admin/products"><i class="fa fa-image"></i> <span>All</span></a></li>
      <li>
        <a>
          <div style="display:flex; justify-content:space-between;">
            <label style="margin:auto 0">
              <i class="fa fa-file"></i>
              <label style="font-weight: normal;margin-left:10px; padding: 2px 6px; cursor:pointer" class="btn btn-danger" for="file">CSV</label>
            </label>
            <form action="/admin/products/addDataFile" method="post" enctype="multipart/form-data">
              <input type="file" name="file" accept="text/csv" id="file" required style="display:none">
              <input type="submit" id="add" value="Add" class="btn btn-danger" style="padding:2px 6px;">
            </form>
          </div>
        </a>
      </li>
      <hr style="margin: 12px 0">
      <li><a href="/admin/categories"><i class="fa fa-list"></i> <span>Categories</span></a></li>
      <li><a href="/admin/brands"><i class="fa fa-list"></i> <span>Brands</span></a></li>
      <li><a href="/admin/banners"><i class="fa fa-banners"></i> <span>Banners</span></a></li>
      <li><a href="/admin/users"><i class="fa fa-users"></i> <span>Users</span></a></li>
      <hr style="margin: 12px 0">
      <li><a href="/"><i class="fa fa-home"></i> <span>Site</span></a></li>
      <li><a href="/logout"><i class="fa fa-sign"></i> <span>Log out</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
