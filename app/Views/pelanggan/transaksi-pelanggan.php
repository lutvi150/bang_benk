<?= $this->extend('front-page') ?>
<?= $this->section('content') ?>
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1>Daftar Transaksi</h1>
                <div class="goods-page">
                    <div class="goods-data clearfix">
                        <div class="table-wrapper-responsive">
                            <div class="alert alert-danger" role="alert">
                                <strong>Info</strong>
                                <ul>
                                    <li>Pesanan akan diproses setelah anda melakukan pembayaran.</li>
                                    <li>Pembayaran di lakukan ke Qris <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#qris" type="button">KLIK UNTUK QRIS</button></li>
                                    <li>Jika anda tidak melakukan pembayaran dalam 24 jam, pesanan akan dibatalkan.</li>
                                    <li>Jika anda sudah melakukan pembayaran, mohon tunggu konfirmasi dari kami.</li>
                                    <li>Silahkan upload bukti bayar di menu di bawah untuk dilakukan konfirmasi oleh admin</li>
                                    <li>Jika bukti bayar di tolak admin, silahkan klik status tolak untuk melihat alasan penolakan, kemudian silahkan upload bukti bayar </li>
                                </ul>
                            </div>
                            <div class="alert alert-success show-alert-success" role="alert" hidden>
                                <strong>Berhasil</strong>
                                <p class="text-aler"></p>
                            </div>
                            <table summary="Shopping cart">
                                <tr>
                                    <th class="goods-page-image">No.</th>
                                    <th class="goods-page-description">No. Transaksi</th>
                                    <th class="goods-page-ref-no">Tanggal Transaksi</th>
                                    <th class="goods-page-quantity">Total</th>
                                    <th class="goods-page-price">Status</th>
                                    <th class="goods-page-total" colspan="2">Acction</th>
                                </tr>
                                <?php foreach ($transaksi as $key => $value) : ?>
                                    <tr>
                                        <td class="goods-page-image"><?= $key + 1 ?></td>
                                        </td>
                                        <td class="goods-page-description">
                                            <?= $value->nomor_transaksi ?>
                                        </td>
                                        <td class="goods-page-ref-no"><?= date('d F Y', strtotime($value->created_at)) ?>
                                        </td>
                                        <td class="goods-page-quantity">
                                            <?= number_format($value->total_harga, 0, ',', '.') ?>
                                        </td>
                                        <td class="goods-page-price">
                                            <?php if ($value->status_transaksi == 'menunggu_pembayaran'): ?>
                                                <label for="" class="label label-danger">Belum Bayar</label>
                                            <?php elseif ($value->status_transaksi == 'verifikasi_pembayaran'): ?>
                                                <label for="" class="label label-warning">verifikasi Pembayaran</label>
                                            <?php elseif ($value->status_transaksi == 'finish'): ?>
                                                <label for="" class="label label-success"><i class="fa fa-check"></i>Selesai</label>
                                            <?php elseif ($value->status_transaksi == 'tolak'): ?>
                                                <label onclick="reason(<?= $value->id_transaksi ?>)" for="" class="label label-danger">Pembayaran di Tolak</label>
                                            <?php endif; ?>
                                        </td>
                                        <td class="del-goods-col">
                                            <?php if ($value->status_transaksi == 'menunggu_pembayaran' || $value->status_transaksi == 'tolak'): ?>
                                                <button type="button" class="btn btn-danger" onclick="upload_bukti_bayar('<?= $value->id_transaksi ?>')"><i class="fa fa-upload"></i></button>
                                            <?php elseif ($value->status_transaksi == 'verifikasi_pembayaran'): ?>
                                                <button type="button" class="btn btn-warning" onclick="priview_bukti_bayar('<?= $value->id_transaksi ?>')"><i class="fa fa-eye"></i></button>
                                            <?php elseif ($value->status_transaksi == 'finish'): ?>
                                                <a href="<?= base_url('index.php/pelanggan/faktur/' . $value->id_transaksi) ?>" target="blank">
                                                    <button type="button" class="btn btn-success"><i class="fa fa-print"></i> Bukti Pembelian</button></a>
                                            <?php endif; ?>
                                            <?php if ($value->status_transaksi == 'tolak'): ?>
                                                <button class="btn btn-danger" type="button" onclick="reason(<?= $value->id_transaksi ?>)"><i class="fa fa-ban"></i>Alasan</button>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <a class="btn btn-default" href="<?= base_url('/') ?>" type="submit">Lanjut Belanja <i class="fa fa-shopping-cart"></i></a>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
        <!-- END SIMILAR PRODUCTS -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="bukti-bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Bukti Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="upload-image" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="">Upload Bukti Bayar</label>
                        <input type="file" name="bukti_bayar" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted text-error e-upload-bukti-bayar">File yang di izinkan adalah, JPG, PNG, JPEG, dan PDF. Maksimal ukuran file 2MB.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="store_bukti_bayar()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- bukti bayar -->
<div class="modal fade" id="priview-bukti-bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body priview-bukti-bayar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- reason reject -->
<div class="modal fade" id="reason-reject-transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="alert alert-danger" role="alert">
                    <strong>Alasan Penolakan Pembayaran</strong>
                    <p class="reason-reject-transaction"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
    Launch
</button>

<!-- Modal -->
<div class="modal fade" id="qris" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QRIS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('logo/qris.jpg') ?>" width="100%" alt="" srcset="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    upload_bukti_bayar = (id_transaksi) => {
        $('#bukti-bayar').modal('show');
        sessionStorage.setItem('id_transaksi', id_transaksi);
    }
    store_bukti_bayar = () => {
        $("e-upload-bukti-bayar").text(`File yang di izinkan adalah, JPG, PNG, JPEG, dan PDF. Maksimal ukuran file 2MB.`)
        let id_transaksi = sessionStorage.getItem('id_transaksi');
        $("#upload-image").ajaxForm({
            type: "POST",
            url: url + "pelanggan/bukti-pembayaran",
            data: {
                id_transaksi: id_transaksi
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    $("#bukti-bayar").modal('hide');
                    $(".show-alert-success").removeAttr('hidden');
                    $(".text-aler").text(`Upload bukti bayar berhasil`);
                    setTimeout(() => {
                        $(".show-alert-success").attr('hidden', true);
                        window.location.reload();
                    }, 2000);
                } else {
                    $(".e-upload-bukti-bayar").text(response.message);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
                });
            }
        }).submit();
    }
    // use for priview bukti bayar
    priview_bukti_bayar = (id_transaksi) => {
        $.ajax({
            type: "GET",
            url: url + "pelanggan/bukti-pembayaran/" + id_transaksi,
            dataType: "JSON",
            success: function(response) {
                $(".priview-bukti-bayar").html(` <img  src="${base_url}uploads/bukti_bayar/${response.data.bukti_bayar}" width="100%" alt="" id="priview-image">`);
                $("#priview-bukti-bayar").modal('show');
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
    // reason reject traction
    reason = (id_transaksi) => {
        $.ajax({
            type: "GET",
            url: url + "pelanggan/bukti-pembayaran/" + id_transaksi,
            dataType: "JSON",
            success: function(response) {
                $(".reason-reject-transaction").html(`${response.data.keterangan}`);
                $("#reason-reject-transaction").modal('show');
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
<?= $this->endSection() ?>