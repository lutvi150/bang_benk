<?php $session = \Config\Services::session();?>
<?php foreach ($produk as $key => $value): ?>
    <div>
        <div class="product-item">
            <div class="pi-img-wrapper">
                <?php if (empty($value->foto_produk)) {
    $foto = "uploads/notfoud.jpg";
} else {
    $foto = "uploads/produk/" . $value->foto_produk[0]->foto_produk;
}
?>
                <img src="<?=base_url($foto)?>" class="img-responsive" alt="Berry Lace Dress">
                <div>
                    <a href="<?=base_url($foto)?>" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up"  class="btn btn-default fancybox-fast-view" onclick="show_product(<?=$value->id_produk?>)">View</a>
                </div>
            </div>
            <?php $price = empty($value->harga) ? 0 : $value->harga->harga_jual?>
            <h3><a href="shop-item.html"><?=$value->nama_produk?></a></h3>
            <div class="pi-price">Rp. <?=number_format($price, 0, ',', '.')?></div>
            <?php if ($session->get('id') == null): ?>
                <a href="javascript:;" onclick="notif_login()" <?=$price == 0 ? "disabled" : ""?> class="btn btn-default add2cart">Tambahkan Ke Keranjang</a>
            <?php else: ?>
                <a href="javascript:;" onclick="add_keranjang(<?=$value->id_produk?>)" <?=$price == 0 ? "disabled" : ""?> class="btn btn-default add2cart">Tambahkan Ke Keranjang</a>
            <?php endif;?>
            <?php if ($value->stiker !== 0): ?>
                <div class="sticker sticker-<?=$value->stiker?>"></div>
            <?php endif?>
        </div>
    </div>
<?php endforeach?>