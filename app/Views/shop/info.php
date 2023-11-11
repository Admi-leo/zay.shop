<?php $this->layout('template'); ?>

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="<?= getImage($product['image_1'], 'products'); ?>" alt="Product's image is not loaded. Contact with our email" id="product-detail">
                </div>
                <div class="row">
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                          <?php if ($product['image_2']): ?>
                                            <img class="card-img img-fluid" src="<?= getImage($product['image_2'], 'products'); ?>" alt="Product Image 1">
                                          <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                          <?php if ($product['image_3']): ?>
                                            <img class="card-img img-fluid" src="<?= getImage($product['image_3'], 'products'); ?>" alt="Product Image 2">
                                          <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                          <?php if ($product['image_4']): ?>
                                            <img class="card-img img-fluid" src="<?= getImage($product['image_4'], 'products'); ?>" alt="Product Image 3">
                                          <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.First slide-->

                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                      <?= flash(); ?>
                        <h1 class="h2"><?= $product['name']; ?><small></h1> <?= flash(); ?></small>Remain: <?= $product['quantity']; ?>
                        <p class="h3 py-2">
                          <span style="margin-right: 32px;">$<?= $product['price_usd']; ?></span>
                          <span>TMT <?= $product['price_tm']; ?></span>
                        </p>
                        <p class="py-2">
                          <i class="<?= ($product['rating'] < 1) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                          <i class="<?= ($product['rating'] < 2) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                          <i class="<?= ($product['rating'] < 3) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                          <i class="<?= ($product['rating'] < 4) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                          <i class="<?= ($product['rating'] < 5) ? "text-muted" : "text-warning"?> fa fa-star"></i>
                          <span class="list-inline-item text-dark">Rating <?= $product['rating']; ?> | <?= $sumcom; ?> comments</span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-danger"><strong><?= getItem("brands", $product['brand_id'])['title']; ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?= $product['description']; ?></p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Avaliable Color :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-primary text-capitalize"><strong><?= $product['color']; ?></strong></p>
                            </li>
                        </ul>

                        <h6>
                          <a class="btn btn-danger text-white" href="/shop/product/<?= $product['id']; ?>/like?url=<?= $_SERVER['REQUEST_URI']; ?>">
                          <i class="<?= likeBool($product['id']); ?>"></i></a>
                          <?= $product['likes']; ?></h6>
                        <h6><a class="btn btn-primary text-white mt-2 pt-2 pb-2"><i class="far fa-eye"></i></a> <?= $product['reviews']; ?></h6>

                        <form action="/shop/actions/<?= $product['id']; ?>" method="GET">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="product-quanity" min="1" id="product-quanity" value="1">
                                            <input type="hidden" name="url" value="/shop/product/<?= $product['id']; ?>">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-sm btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-sm btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="action" value="buy">Buy</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="action" value="addtocart">Add To Cart</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->

<!-- Start Article -->
<section class="py-5">
    <div class="container">
        <div class="text-left p-2 pb-3">
            <h4>Related Products</h4>
        </div>
        <!--Start Carousel Wrapper-->
        <div id="carousel-related-product" class="row d-flex justify-content-start">
            <?php foreach ($related as $val): ?>
              <?php if ($val['public'] == 'public'): ?>
              <?php if ($val['id'] != $product['id']): ?>
              <div class="col-md-4">
                <div class="p-2 pb-3">
                  <div class="product-wap card rounded-0"<?php if($val['quantity'] == 0): ?>style="background: #FFCED7;"<?php endif; ?>>
                      <div class="card rounded-0">
                          <img class="card-img rounded-0 img-fluid" src="<?= getImage($val['image_1'], 'products'); ?>">
                          <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <?php if (auth()->isLoggedIn()): ?>
                                  <li>
                                    <a class="btn btn-danger text-white" href="/shop/product/<?= $val['id']; ?>/like?url=<?= $_SERVER['REQUEST_URI']; ?>">
                                    <i class="<?= likeBool($val['id']); ?>"></i></a>
                                  </li>
                                <?php endif; ?>
                                <li><a class="btn btn-primary text-white mt-2" href="/shop/product/<?= $val['id']; ?>"><i class="far fa-eye"></i></a></li>
                                <?php if ($val['quantity'] != 0): ?>
                                  <li><a class="btn btn-success text-white mt-2" href="/shop/actions/<?= $val['id']; ?>?action=addtocart&url=<?= $_SERVER['REQUEST_URI']; ?>"><i class="fas fa-cart-plus"></i></a></li>
                                <?php endif; ?>
                            </ul>
                          </div>
                      </div>
                      <div class="card-body">
                          <a href="/shop/info/<?= $val['id']; ?>" class="h3 text-decoration-none"><?= $val['name']; ?></a>
                          <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                              <li><?= getItem('brands', $val['brand_id'])['title']; ?></li>
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
              </div>
              <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php if (auth()->isLoggedIn()): ?>
        <div class="container mt-5">
          <form action="/shop/product/comment" method="post">
            <div class="form-group col-md-6">
              <label for="comment"><h3>Comments</h3></label>
              <input type="hidden" name="id" value="<?= $product['id']; ?>">
              <textarea type="text" class="form-control" required id="comment" maxlength="300" name="comment" placeholder="Something" rows="3"></textarea>
              <input type="submit" class="btn btn-info mt-2" value="Send">
            </div>
          </form>
        </div>
        <?php endif; ?>
        <div class="container mt-3">
          <?php foreach ($comments as $comment): ?>
          <div class="comment-block bg-dark col-md-6 mt-2" <?php if ($comment['user_id'] == auth()->getUserId()): ?>style="border: 2px solid #0DCAF0"<?php endif; ?>>
            <div class="col-md-6">
              <h6 class="text-white"><?= getItem('users', $comment['user_id'])['username']; ?></h6>
              <p class="text-light" style="margin-bottom:0"><?= $comment['comment']; ?></p>
            </div>
            <div class="d-flex justify-content-end">
              <time class="text-secondary" style="font-size:12px"><?= $comment['dt_add']; ?></time>
              <time class="text-secondary" style="font-size:12px"><?= $comment['dt_update']; ?></time>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End Article -->
