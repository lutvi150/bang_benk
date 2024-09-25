<?=$this->extend('front-page')?>
<?=$this->section('content')?>
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1>Keranjang Belanja</h1>
                <div class="goods-page">
                    <div class="goods-data clearfix">
                        <div class="table-wrapper-responsive">
                            <table summary="Shopping cart">
                                <tr>
                                    <th class="goods-page-image">Foto Produk</th>
                                    <th class="goods-page-description">Nama & Detail</th>
                                    <th class="goods-page-quantity">Jumlah</th>
                                    <th class="goods-page-price">Harga Satuan</th>
                                    <th class="goods-page-total" colspan="2">Total</th>
                                </tr>
                                <?php foreach ($data as $key => $value): ?>
                                    <?php if (empty($value->foto)) {
    $foto = "uploads/notfoud.jpg";
} else {
    $foto = "uploads/produk/" . $value->foto->foto_produk;
}
?>
                                <tr>
                                    <td class="goods-page-image">
                                        <a href="javascript:;"><img src="<?=base_url($foto)?>" alt="<?=$value->nama_produk?>"></a>
                                    </td>
                                    <td class="goods-page-description">
                                        <h3><a href="javascript:;"><?=$value->nama_produk?></a></h3>
                                        <p><?=$value->detail_produk?></p>
                                        <!-- <em>More info is here</em> -->
                                    </td>
                                    <td class="goods-page-quantity">
                                        <div class="product-quantity">
                                            <input id="product-quantity" type="text" value="<?=$value->qty?>" readonly class="form-control input-sm">
                                        </div>
                                    </td>
                                    <td class="goods-page-price">
                                        <strong><span>Rp </span><?=number_format($value->harga)?></strong>
                                    </td>
                                    <td class="goods-page-total">
                                        <strong><span>Rp </span><?=number_format($value->total_harga)?></strong>
                                    </td>
                                    <td class="del-goods-col">
                                        <a class="del-goods" href="javascript:;">&nbsp;</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>

                            </table>
                        </div>

                        <div class="shopping-total">
                            <ul>
                                <li class="shopping-total-price">
                                    <em>Total</em>
                                    <strong class="price"><span>Rp </span> <?=$total_harga?></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></button>
                    <button class="btn btn-primary" type="submit">Checkout <i class="fa fa-check"></i></button>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>

<?=$this->endSection()?>
<?=$this->section('script')?>
<script>
    show_keranjang = () => {
        $.ajax({
            type: "GET",
            url: url + "pelanggan/keranjang",
            dataType: "JSON",
            success: function(response) {


            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
                });
            }
        });
    }
</script>
<?=$this->endSection()?>