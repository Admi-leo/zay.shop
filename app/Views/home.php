<?php $this->layout('template'); ?>

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <?php $i=0; foreach ($banners as $banner): ?>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="<?= $i; ?>" class="<?= ($i==0) ? "active" : ''; ?>"></li>
      <?php $i++; endforeach; ?>
    </ol>
    <div class="carousel-inner">

      <?php $i=1; foreach ($banners as $banner): ?>
        <div class="carousel-item <?= ($i==1) ? "active" : ''; ?>">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="<?= getImage($banner['image'], 'banners'); ?>" style="max-height: 380px;"  alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><?= $banner['title']; ?></h1>
                            <p>
                                <?= $banner['description']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php $i++; endforeach; ?>


    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">News of The Month</h1>
            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    <div class="row">
      <?php foreach (getItemsBy('categories', ['title'], 3) as $category): ?>
        <?php if ($category['image']): ?>
        <div class="col-12 col-md-4 p-5 mt-3">
            <img src="<?= getImage($category['image'], 'categories'); ?>" class="img-fluid border">
            <h5 class="text-center mt-3 mb-3 text-capitalize"><?= $category['title']; ?></h5>
            <p class="text-center"><a href="/shop?&category=<?= $category['id']; ?>" class="btn btn-success">Go Shop</a></p>
        </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">The Viewest Products</h1>
                <p>
                    Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident.
                </p>
            </div>
        </div>
        <div class="row">

          <?php foreach ($viewest as $view): ?>
            <?php if ($view['public'] == "public"): ?>
            <div class="col-md-4">
                <div class="card mb-4 product-wap rounded-0" <?php if($view['quantity'] == 0): ?>style="background: #FFCED7;"<?php endif; ?>>
                    <div class="card rounded-0">
                        <img class="card-img rounded-0 img-fluid" src="<?= getImage($view['image_1'], 'products'); ?>">
                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                          <ul class="list-unstyled">
                              <?php if (auth()->isLoggedIn()): ?>
                                <li>
                                  <a class="btn btn-success text-white" href="/shop/product/<?= $view['id']; ?>/like">
                                  <i class="<?= likeBool($view['id']); ?>"></i></a>
                                </li>
                              <?php endif; ?>
                              <li><a class="btn btn-success text-white mt-2" href="/shop/product/<?= $view['id']; ?>"><i class="far fa-eye"></i></a></li>
                              <?php if ($view['quantity'] != 0): ?>
                                <li><a class="btn btn-success text-white mt-2" href="/shop/actions/<?= $view['id']; ?>?action=addtocart&url=<?= $_SERVER['REQUEST_URI']; ?>"><i class="fas fa-cart-plus"></i></a></li>
                              <?php endif; ?>
                          </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled p-1 d-flex justify-content-between">
                          <li><a href="/shop/product/<?= $view['id']; ?>" class="h3 text-decoration-none"><?= $view['name']; ?></a></li>
                          <li class="text-muted"><i class="fa fa-fw fa-cart-arrow-down"></i> <?= cpoc($view['id']); ?></li>
                        </ul>

                        <ul class="w-100 list-unstyled justify-content-between mb-0">
                          <li style="font-size:14px !important;">Remain: <?= $view['quantity']; ?></li>
                          <li class="mb-2" style="font-size:14px !important; color:#5F5F5F;"><?= $view['description']; ?></li>
                          <li><?= getItem("brands", $view['brand_id'])['title']; ?></li>
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
                              <i class="<?= ($view['rating'] < 1) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                              <i class="<?= ($view['rating'] < 2) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                              <i class="<?= ($view['rating'] < 3) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                              <i class="<?= ($view['rating'] < 4) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                              <i class="<?= ($view['rating'] < 5) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                            </li>
                        </ul>
                        <p class="d-flex justify-content-between mb-0">
                          <span>$<?= $view['price_usd']; ?></span>
                          <span>TMT <?= $view['price_tm']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- End Featured Product -->
