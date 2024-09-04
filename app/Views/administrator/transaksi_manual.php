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
                            <h1>Transaksi Manual</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <input type="text" autofocus class="form-control p-2" name="search" id="search" placeholder="Scan Produk">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th data-checkbox="true"></th>
                                        <th data-field="id">No.</th>
                                        <th data-field="name">Nama Produk</th>
                                        <th data-field="name">Harga</th>
                                        <th data-field="email">Jumlah</th>
                                        <th>Total Harga</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                            <a href=""><button type="button" class="btn btn-success btn-sm"><i class="fa fa-reply"></i> Kembali</button></a>
                            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Reset</button>
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