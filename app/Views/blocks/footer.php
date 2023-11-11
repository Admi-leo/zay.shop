<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo"><?= config("info.web_name");?> Shop</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        <?= config("info.gps");?>
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:<?= config("info.phone");?>"><?= config("info.phone");?></a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:<?= config("info.email");?>"><?= config("info.email");?></a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                <ul class="list-unstyled text-light footer-link-list">
                  <?php foreach (getItemsBy('categories', ['title']) as $category): ?>
                    <li><a class="text-decoration-none text-capitalize" href="/shop?category=<?= $category['id']; ?>"><?= $category['title']; ?></a></li>
                  <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="/">Home</a></li>
                    <li><a class="text-decoration-none" href="/about">About Us</a></li>
                    <li><a class="text-decoration-none" href="/shop">Shop Locations</a></li>
                    <li><a class="text-decoration-none" href="/faqs">FAQs</a></li>
                    <li><a class="text-decoration-none" href="/contact">Contact</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                  <?php foreach (config("info.apps") as $val): ?>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="<?= $val['name']; ?>"><i class="<?= $val['class']; ?> fa-lg fa-fw"></i></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-auto">
                <label class="sr-only" for="subscribeEmail">Email address</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                    <div class="input-group-text btn-success text-light">Subscribe</div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; <?= date('Y',time()); ?> Company <?= config("info.company");?>
                        | Designed by <a rel="sponsored" href="<?= config("info.developer.cv");?>" target="_blank">Devel</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->

<!-- Start Script -->
<script src="/static/js/jquery-1.11.0.min.js"></script>
<script src="/static/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/static/js/bootstrap.bundle.min.js"></script>
<script src="/static/js/templatemo.js"></script>
<script src="/static/js/custom.js"></script>
<!-- End Script -->
