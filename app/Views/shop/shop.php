<?php $this->layout('template'); ?>
<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
          <?=$this->insert('sort/filter')?>
        </div>

        <div class="col-lg-9">

            <div class="row">

              <?= flash(); ?>
              <?php if ($products): ?>
                <?=$this->insert('shop/blocks/products', ['products' => $products])?>
              <?php else: ?>
                <h4 class="text-center">The block is empty</h4>
              <?php endif; ?>

            </div>
            <?= paginator($paginator); ?>
        </div>

    </div>
</div>
<!-- End Content -->

<?=$this->insert('blocks/ourbrands')?>
