<!-- Head Start -->
<?= $this->include('front-page/head') ?>
<!-- Head END -->

<!-- Body BEGIN -->

<body class="ecommerce">
  <!-- BEGIN STYLE CUSTOMIZER -->
  <?= $this->include('front-page/begin-style') ?>
  <!-- END BEGIN STYLE CUSTOMIZER -->

  <!-- BEGIN TOP BAR -->
  <?= $this->include('front-page/top-bar') ?>
  <!-- END TOP BAR -->

  <!-- BEGIN HEADER -->
  <div class="header">
    <div class="container">
      <a class="site-logo" href="shop-index.html"><img width="124px" height="32px" src="<?= base_url() ?>logo/logo_app.png" alt=""></a>

      <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

      <?php if (session('login')): ?>
        <!-- BEGIN CART -->
        <?= $this->include('front-page/chart') ?>
        <!--END CART -->
      <?php endif;  ?>
      <!-- BEGIN NAVIGATION -->
      <?= $this->include('front-page/navigation') ?>
      <!-- END NAVIGATION -->
    </div>
  </div>
  <!-- Header END -->

  <?= $this->renderSection('content') ?>
  <!-- BEGIN BRANDS -->
  <?= $this->include('front-page/brands') ?>
  <!-- END BRANDS -->

  <!-- BEGIN STEPS -->
  <?= $this->include('front-page/steps') ?>
  <!-- END STEPS -->

  <!-- BEGIN PRE-FOOTER -->
  <?= $this->include('front-page/pre-footer') ?>
  <!-- END PRE-FOOTER -->

  <!-- BEGIN FOOTER -->
  <?= $this->include('front-page/footer') ?>
  <!-- END FOOTER -->

  <!-- BEGIN fast view of a product -->
  <?= $this->include('front-page/fast-view') ?>
  <!-- END fast view of a product -->

  <?= $this->include('front-page/script') ?>
  <!-- END PAGE LEVEL JAVASCRIPTS -->
  <?= $this->renderSection('script') ?>
</body>
<!-- END BODY -->

</html>