<!-- Start Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Brands</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    Lorem ipsum dolor sit amet.
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <!-- <div class="col-1 align-self-center">
                        <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                            <i class="text-light fas fa-chevron-left"></i>
                        </a>
                    </div> -->
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                            <!--Slides-->
                            <!-- <div class="carousel-inner product-links-wap" role="listbox"> -->
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                      <?php foreach (getItemsBy('brands', ['title'], 12) as $brand): ?>
                                        <?php if ($brand['image']): ?>
                                        <div class="col-3 p-md-5">
                                            <a href="<?= $brand['link']; ?>"><img class="img-fluid brand-img" src="<?= getImage($brand['image'], 'brands'); ?>" alt="Brand Logo"></a>
                                        </div>
                                        <?php endif; ?>
                                      <?php endforeach; ?>
                                    </div>
                                </div>
                                <!--End First slide-->
                            </div>
                            <!--End Slides-->
                        <!-- </div> -->
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <!-- <div class="col-1 align-self-center">
                        <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                            <i class="text-light fas fa-chevron-right"></i>
                        </a>
                    </div> -->
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Brands-->
