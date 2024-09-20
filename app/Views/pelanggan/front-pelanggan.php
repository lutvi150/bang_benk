<?= $this->extend('front-page') ?>
<?= $this->section('content') ?>
<!-- BEGIN SLIDER -->
<?= $this->include('front-page/slider') ?>
<!-- END SLIDER -->
<div class="main">
    <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <?= $this->include('front-page/new-product') ?>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SIDEBAR & CONTENT -->
        <?= $this->include('front-page/sidebar-product') ?>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN TWO PRODUCTS & PROMO -->
        <?= $this->include('front-page/promo-product') ?>
        <!-- END TWO PRODUCTS & PROMO -->
    </div>
</div>
<?= $this->endSection() ?>