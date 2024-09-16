<?= $this->extend('layout/admin/template') ?>
<?= $this->section('content') ?>

<!-- Static Table Start -->

<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Daftar Transaksi</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <a href="<?= base_url('administrator/transaksi/manual') ?>">
                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Transaksi Manual</button></a>
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb">
                                    <option value="">Export Basic</option>
                                    <option value="all">Export All</option>
                                    <option value="selected">Export Selected</option>
                                </select>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-checkbox="true"></th>
                                        <th data-field="id">No.</th>
                                        <th data-field="name">Nama</th>
                                        <th data-field="name">Email</th>
                                        <th data-field="email">Tanggal Transaksi</th>
                                        <th>Jumlah Transaksi</th>
                                        <th data-field="phone">Status Transaksi</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $key => $value): ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $key + 1  ?></td>
                                            <td><?= $value->nama_user ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= date('d F Y', strtotime($value->created_at)) ?></td>
                                            <td>Rp. <?= number_format($value->total_harga) ?></td>
                                            <td>
                                                <?php if ($value->status_transaksi == 'verifikasi_pembayaran'): ?>
                                                    <label for="" class="label label-warning">Verifikasi Pembayaran</label>
                                                <?php elseif ($value->status_transaksi == 'tolak'): ?>
                                                    <label for="" class="label label-danger">Tolak</label>
                                                <?php elseif ($value->status_transaksi == 'finish'): ?>
                                                    <label for="" class="label label-success">Selesai</label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($value->status_transaksi == 'verifikasi_pembayaran'): ?>
                                                    <button class="btn btn-primary" type="button" onclick="priview_bukti_bayar(<?= $value->id_transaksi ?>)"><i class="fa fa-eye"></i> Verifikasi</button>
                                                <?php elseif ($value->status_transaksi == 'finish'): ?>
                                                    <a href="<?= base_url('index.php/pelanggan/faktur/' . $value->id_transaksi) ?>" target="blank">
                                                        <button type="button" class="btn btn-success"><i class="fa fa-print"></i> Faktur</button></a>
                                                <?php endif; ?>
                                                <?php if ($value->status_transaksi == 'tolak'): ?>
                                                    <button class="btn btn-danger" type="button" onclick="reason(<?= $value->id_transaksi ?>)"><i class="fa fa-ban"></i> Alasan</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
            <div class="modal-body ">
                <div class="priview-bukti-bayar"></div>
                <div class="card">
                    <div class="alert alert-danger" role="alert">
                        <strong>Pemberitahuan</strong>
                        <p>
                        <ul>
                            <li>Jika dilakukan penolak untuk bukti bayar, wajib menuliskan alasan penolakan pada kolom keterangan.</li>
                        </ul>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Alasan Penolakan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted text-error e-keterangan"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="verifikasi_pembayaran(1)">Verifikasi Pembayaran</button>
                <button type="button" class="btn btn-danger" onclick="verifikasi_pembayaran(0)">Tolak Pembayaran</button>
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
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    deleteConfirm = (id) => {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('administrator/produk/delete/') ?>" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                title: 'Berhasil',
                                text: data.message,
                                icon: 'success'
                            }).then((result) => {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: data.message,
                                icon: 'error'
                            })
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
                        });
                    }
                });
            }
        })
    }
    // verifikasi pembayaran
    priview_bukti_bayar = (id_transaksi) => {
        sessionStorage.setItem("id_transaksi", id_transaksi);
        $.ajax({
            type: "GET",
            url: url + "administrator/bukti-pembayaran/" + id_transaksi,
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
            url: url + "administrator/bukti-pembayaran/" + id_transaksi,
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
    verifikasi_pembayaran = (status) => {
        $(".text-error").text("");
        $.ajax({
            type: "POST",
            url: url + "administrator/verifikasi-pembayaran",
            data: {
                id_transaksi: sessionStorage.getItem("id_transaksi"),
                status: status,
                keterangan: $("#keterangan").val(),
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.message,
                        icon: 'success'
                    }).then((result) => {
                        location.reload();
                    })
                } else {
                    $(".e-keterangan").text(response.message);
                }
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