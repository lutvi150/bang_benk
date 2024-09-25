<?= $this->extend('layout/admin/template') ?>
<?= $this->section('content') ?>
<style>
    tr td .center-td {
        text-align: center;
    }
</style>
<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Daftar Produk</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <a href="<?= base_url('index.php/administrator/produk/add') ?>">
                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Produk</button></a>
                        <a href="<?= base_url('index.php/administrator/produk/cetak') ?>" target="_blank" type="button" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a></a>
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
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id">No.</th>
                                        <th data-field="name">Registrasi Produk</th>
                                        <th data-field="email">Nama Produk</th>
                                        <th data-field="phone">Harga Jual</th>
                                        <th data-field="complete">Stok</th>
                                        <th data-field="">Terjual</th>
                                        <th data-field="task">Diskon</th>
                                        <th data-field="date">Total Transaksi</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produk as $key => $value): ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $key + 1 ?></td>
                                            <td class="center-td" style="align-items: center;"><?= $value->barcode ?><button class="btn btn-success btn-xs" type="button"><?= $value->nomor_registrasi_produk ?></button></td>
                                            <!-- <td><?= $value->barcode ?></td> -->
                                            <td><?= $value->nama_produk ?></td>
                                            <td>Rp. <?= number_format($value->harga_jual) ?></td>
                                            <td>
                                                <a href="<?= base_url('index.php/administrator/produk/stok/' . $value->id_produk) ?>" class="btn btn-success btn-xs"><?= $value->stok . " " . $value->satuan_produk ?></a>
                                            </td>
                                            <td><?= $value->terjual . " " . $value->satuan_produk ?></td>
                                            <td>0%</td>
                                            <td>Rp.<?= number_format($value->transaksi) ?></td>
                                            <td>
                                                <a href="<?= base_url('index.php/administrator/produk/edit/' . $value->id_produk) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-xs" onclick="deleteConfirm('<?= $value->id_produk ?>')"><i class="fa fa-trash"></i></button>

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
</script>
<?= $this->endSection() ?>