<form action="" method="get">
  <h1 class="h2 pb-4">Filter</h1>
  <li class="list-unstyled pb-3">
    <a class="collapsed d-flex text-dark justify-content-between h3 text-decoration-none" href="/shop">
      All products
    </a>
  </li>
<!-- SEARCHING -->
  <div class="form-group d-flex">
    <input type="search" name="search" class="form-control" value="<?= @$_GET['search']; ?>" placeholder="search">
    <input type="submit" value="Find" style="margin-left:4px" class="btn btn-sm btn-primary">
  </div><br>

  <ul class="list-unstyled templatemo-accordion">
    <li class="pb-3">
        <select class="form-control w-75" name="category">
            <option value="null" disabled <?php if(!@$_GET['category']): ?>selected<?php endif; ?>>Categories</option>
            <?php foreach (getItemsBy('categories', ['title']) as $category): ?>
              <option value="<?= $category['id']; ?>" <?php if(@$_GET['category'] == $category['id']): ?>selected<?php endif; ?>><?= $category['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </li>
    <li class="pb-3">
        <select class="form-control w-75" name="brand">
            <option value="null" disabled <?php if(!@$_GET['brand']): ?>selected<?php endif; ?>>Brands</option>
            <?php foreach (getItemsBy('brands', ['title']) as $brand): ?>
              <option value="<?= $brand['id']; ?>" <?php if(@$_GET['brand'] == $brand['id']): ?>selected<?php endif; ?>><?= $brand['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </li>
    <li class="pb-3">
      <select class="form-control w-75" name="sort">
          <option value="null" disabled <?php if(!@$_GET['price']): ?>selected<?php endif; ?>>Sort by</option>
          <option value="toup" <?php if(@$_GET['sort'] == "toup"): ?>selected<?php endif; ?>>Cheap to Expensive</option>
          <option value="todown" <?php if(@$_GET['sort'] == "todown"): ?>selected<?php endif; ?>>Expensive to Cheap</option>
          <option value="popular" <?php if(@$_GET['sort'] == "popular"): ?>selected<?php endif; ?>>Popular</option>
      </select>
    </li>
    <input type="submit" value="Sort" class="btn btn-secondary">
  </ul>
</form>
