<!-- Start Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
    <div class="container text-light">
        <div class="w-100 d-flex justify-content-between">
            <div>
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:<?= config("info.email"); ?>"><?= config("info.email"); ?></a>
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="tel:<?= config("info.phone"); ?>"><?= config("info.phone"); ?></a>
            </div>
            <div>
                <?php foreach (config("info.apps") as $val): ?>
                <a class="text-light text-decoration-none" target="_blank" href="<?= $val['name']; ?>"><i class="<?= $val['class']; ?> fa-sm fa-fw me-2"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>
<!-- Close Top Nav -->


<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="/">
            <?= config("info.web_name");?>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <?php if (auth()->isLoggedIn()): ?>
                <a class="nav-icon position-relative text-decoration-none" href="/profile/cart/<?= auth()->getUsername(); ?>">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?= countProductsCart() ; ?></span>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="/profile">
                    <i class="fa fa-fw fa-user text-dark mr-3"></i>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="/logout">
                    <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
                </a>
                <?php else:; ?>
                <a class="btn btn-sm btn-primary text-decoration-none text-white mr-1" style="font-size: 15px !important;margin-right:6px" href="/registration">
                  Sign in
                </a>
                <a class="btn btn-sm btn-success text-decoration-none text-white" style="font-size: 15px !important;" href="/authorization">
                  Log in
                </a>
                <?php endif; ?>

            </div>
        </div>

    </div>
</nav>
<!-- Close Header -->
