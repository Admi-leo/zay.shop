<?php foreach ($products as $product): ?>
  <?php if ($product['public'] == "public"): ?>
  <?php if ($product['quantity'] > 0): ?>
  <div class="col-md-4">
      <div class="card mb-4 product-wap rounded-0" <?php if($product['quantity'] <= 0): ?>style="background: #FFCED7;"<?php endif; ?>>
          <div class="card rounded-0">
              <img class="card-img rounded-0 img-fluid" src="<?= getImage($product['image_1'], 'products'); ?>">
              <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                  <ul class="list-unstyled">
                    <?php if (auth()->isLoggedIn()): ?>
                    <li>
                      <a class="btn btn-danger text-white" href="/shop/product/<?= $product['id']; ?>/like">
                      <i class="<?= likeBool($product['id']); ?>"></i></a>
                    </li>
                    <?php endif; ?>

                    <li><a class="btn btn-primary text-white mt-2" href="/shop/product/<?= $product['id']; ?>"><i class="far fa-eye"></i></a></li>
                    <?php if ($product['quantity'] != 0 && auth()->isLoggedIn()): ?>
                      <li><a class="btn btn-success text-white mt-2" href="/shop/actions/<?= $product['id']; ?>?action=addtocart"><i class="fas fa-cart-plus"></i></a></li>
                    <?php endif; ?>
                  </ul>
              </div>
          </div>

          <div class="card-body">
              <ul class="list-unstyled p-1 d-flex justify-content-between">
                <li><a href="/shop/product/<?= $product['id']; ?>" class="h3 text-decoration-none"><?= $product['name']; ?></a></li>
                <li class="text-muted"><i class="fa fa-fw fa-cart-arrow-down"></i> <?= cpoc($product['id']); ?></li>
              </ul>

              <ul class="w-100 list-unstyled justify-content-between mb-0">
                <li style="font-size:14px !important;">Remain: <?= $product['quantity']; ?></li>
                <li class="mb-2" style="font-size:14px !important; color:#5F5F5F;"><?= $product['description']; ?></li>
                <li class="mb-2" style="font-size:14px !important;"><?= getItem('categories', $product['category_id'])['title']; ?></li>
                <li><?= getItem("brands", $product['brand_id'])['title']; ?></li>
                <li class="pt-2">
                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                </li>
              </ul>
              <ul class="list-unstyled d-flex justify-content-center mb-1">
                  <li>
                    <i class="<?= ($product['rating'] < 1) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 2) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 3) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 4) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 5) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                  </li>
              </ul>
              <p class="d-flex justify-content-between mb-0">
                <span>$<?= $product['price_usd']; ?></span>
                <span>TMT <?= $product['price_tm']; ?></span>
              </p>
          </div>
      </div>
  </div>
  <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>

<?php foreach ($products as $product): ?>
  <?php if ($product['public'] == "public"): ?>
  <?php if ($product['quantity'] <= 0): ?>
  <div class="col-md-4">
      <div class="card mb-4 product-wap rounded-0" <?php if($product['quantity'] <= 0): ?>style="background: #FFCED7;"<?php endif; ?>>
          <div class="card rounded-0">
              <img class="card-img rounded-0 img-fluid" src="<?= getImage($product['image_1'], 'products'); ?>">
              <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                  <ul class="list-unstyled">
                      <?php if (auth()->isLoggedIn()): ?>
                        <li>
                          <a class="btn btn-danger text-white" href="/shop/product/<?= $product['id']; ?>/like">
                          <i class="<?= likeBool($product['id']); ?>"></i></a>
                        </li>
                      <?php endif; ?>
                      <li><a class="btn btn-primary text-white mt-2" href="/shop/product/<?= $product['id']; ?>"><i class="far fa-eye"></i></a></li>
                      <?php if ($product['quantity'] != 0): ?>
                        <li><a class="btn btn-success text-white mt-2" href="/shop/actions/<?= $product['id']; ?>?ac=addtocart"><i class="fas fa-cart-plus"></i></a></li>
                      <?php endif; ?>
                  </ul>
              </div>
          </div>

          <div class="card-body">
              <ul class="list-unstyled p-1 d-flex justify-content-between">
                <li><a href="/shop/product/<?= $product['id']; ?>" class="h3 text-decoration-none"><?= $product['name']; ?></a></li>
                <li class="text-muted"><i class="fa fa-fw fa-cart-arrow-down"></i> <?= cpoc($product['id']); ?></li>
              </ul>

              <ul class="w-100 list-unstyled justify-content-between mb-0">
                <li style="font-size:14px !important;">Remain: <?= $product['quantity']; ?></li>
                <li class="mb-2" style="font-size:14px !important;"><?= getItem('categories', $product['category_id'])['title']; ?></li>
                <li class="mb-2" style="font-size:14px !important; color:#5F5F5F;"><?= $product['description']; ?></li>
                <li><?= getItem("brands", $product['brand_id'])['title']; ?></li>
                <li class="pt-2">
                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                </li>
              </ul>
              <ul class="list-unstyled d-flex justify-content-center mb-1">
                  <li>
                    <i class="<?= ($product['rating'] < 1) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 2) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 3) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 4) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                    <i class="<?= ($product['rating'] < 5) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                  </li>
              </ul>
              <p class="d-flex justify-content-between mb-0">
                <span>$<?= $product['price_usd']; ?></span>
                <span>TMT <?= $product['price_tm']; ?></span>
              </p>
          </div>
      </div>
  </div>
  <?php endif; ?>
  <?php endif; ?>
<?php endforeach; ?>
