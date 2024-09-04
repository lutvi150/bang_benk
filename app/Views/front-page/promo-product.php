<div class="row margin-bottom-35 ">
  <!-- BEGIN TWO PRODUCTS -->
  <div class="col-md-6 two-items-bottom-items">
    <h2>Produk Promo</h2>
    <div class="owl-carousel owl-carousel2">

      <?= $this->include('front-page/owl') ?>

    </div>
  </div>
  <!-- END TWO PRODUCTS -->
  <!-- BEGIN PROMO -->
  <div class="col-md-6 shop-index-carousel">
    <div class="content-slider">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="item active">
            <img src="<?= base_url() ?>uploads/produk/dunmil.jpg" class="img-responsive" alt="Berry Lace Dress">
          </div>
          <div class="item">
            <img src="<?= base_url() ?>uploads/produk/banana.jpg" class="img-responsive" alt="Berry Lace Dress">
          </div>
          <div class="item">
            <img src="<?= base_url() ?>uploads/produk/coffee.jpg" class="img-responsive" alt="Berry Lace Dress">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END PROMO -->
</div>