<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span><?=getenv('phone')?></span></li>
                    <!-- BEGIN CURRENCIES -->
                    <li class="shop-currencies">
                        <a href="javascript:void(0);">€</a>
                        <a href="javascript:void(0);">$</a>
                        <a href="javascript:void(0);" class="current">IDR</a>
                    </li>
                    <!-- END CURRENCIES -->
                    <!-- BEGIN LANGS -->
                    <li class="langs-block">
                        <a href="javascript:void(0);" class="current">Indonesia </a>
                        <div class="langs-block-others-wrapper">
                            <div class="langs-block-others">
                                <a href="javascript:void(0);">French</a>
                                <a href="javascript:void(0);">Germany</a>
                                <a href="javascript:void(0);">English</a>
                            </div>
                        </div>
                    </li>
                    <!-- END LANGS -->
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    <li><a href="<?=base_url('index.php/shop-account')?>">Akun Saya</a></li>
                    <li><a href="<?=base_url('index.php/shop-wishlist')?>">My Wishlist</a></li>
                    <li><a href="<?=base_url('index.php/shop-checkout')?>">Checkout</a></li>
                    <?php $session = \Config\Services::session();?>
                    <?php if ($session->get('login') == true): ?>
                        <li><a href="#">Hello <?=$session->get('nama_user')?></a></li>
                        <li><a href="<?=base_url('index.php')?>">Transaksi</a></li>
                        <li><a href="<?=base_url('index.php/logout')?>">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?=base_url('index.php/shop-login')?>">Log In</a></li>
                    <?php endif;?>

                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>