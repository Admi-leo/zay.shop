<?php $this->layout('template'); ?>

<section class="clean-block clean-cart dark">
  <div class="container">
    <div class="block-heading">
        <h2 class="text-info">Your Cart</h2>
        <p>Add new product in your cart for will buying</p>
    </div>
    <div class="content">
      <form action="/profile/cart/checkout" method="post">
        <div class="row no-gutters">
          <div class="col-md-12 col-lg-8">
              <div class="items">
                <?= flash(); ?>
                <?php if ($cart): ?>
                <?php foreach ($cart as $val): ?>
                  <div class="product">
                      <div class="row justify-content-center align-items-center">
                          <div class="col-md-3">
                              <div class="product-image"><img class="img-fluid d-block mx-auto image" src="<?= getImage(getProduct($val['product_id'])['image_1'], 'products') ?>"></div>
                          </div>
                          <div class="col-md-5 product-info"><a class="product-name" style="text-decoration:none" href="/shop/product/<?= $val['product_id']; ?>"><?= $val['product']; ?></a>
                              <div class="product-specs">
                                  <div><span><?= getProduct($val['product_id'])['description']; ?></span></div>
                              </div>
                          </div>
                          <div class="col-6 col-md-2 quantity">
                            <label class="d-none d-md-block" for="quantity">Quantity</label>
                            <input type="number" id="number" class="form-control quantity-input" min="0" name="<?= $val['id'];?>" value="<?= $val['quantity']; ?>">
                          </div>
                          <div class="col-6 col-md-2 price">
                            <span>$<?= getProduct($val['product_id'])['price_usd']; ?> TMT<?= getProduct($val['product_id'])['price_tm']; ?></span>
                            <span><a href="/profile/cart/rm/<?= $val['id']."&".$val['user_id']; ?>" style="text-decoration: none; color:#500;">Remove</a></span>
                          </div>
                      </div>
                  </div>
                <?php endforeach; ?>
                <?php else: ?>
                  <div class="text-center text-info">
                    <h3><i>Cart is empty</i></h3>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-12 col-lg-4">
              <div class="summary">
                <h3>Summary</h3>
                <h4><span class="text">MonthShopping</span><span class="price">$360</span></h4>
                <h4><span class="text">TotalQuantity</span><span class="price"><?= (isset($summary['totalQuantity'])) ? $summary['totalQuantity'] : 0; ?></span></h4>
                <h4><span class="text">Products</span><span class="price"><?= (isset($summary['totalProducts'])) ? $summary['totalProducts'] : 0; ?></span></h4>
                <h4><span class="text text-primary">Total USD</span><span class="price text-primary"><?= (isset($summary['total_usd'])) ? $summary['total_usd'] : 0; ?></span></h4>
                <h4><span class="text text-primary">Total TMT</span><span class="price"><?= (isset($summary['total_tm'])) ? $summary['total_tm'] : 0; ?></span></h4>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Checkout</button>
              </div>
            </div>
        </div>
      </form>
    </div>
  </div>
</section>

</div>

</div>
