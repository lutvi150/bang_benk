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
                            <h1>Daftar Stok</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <button type="button" onclick="show_modal()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Stok</button>
                        <a href="<?= base_url('administrator/produk') ?>">
                            <button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Kembali</button></a>
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
                                        <th data-field="name">Total Masuk</th>
                                        <th data-field="email">Total Keluar</th>
                                        <th data-field="phone">Harga Modal</th>
                                        <th data-field="complete">Harga Jual</th>
                                        <th data-field="task">Keuntungan</th>
                                        <th data-field="date">Tanggal Masuk</th>
                                        <th data-field="a">Tanggal Produksi</th>
                                        <th data-field="b">Tanggal Kadaluarsa</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stok as $key => $value): ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $key + 1  ?></td>
                                            <td><?= $value->stok_awal ?></td>
                                            <td><?= $value->stok_akhir ?></td>
                                            <td>Rp. <?= $value->harga_modal ?></td>
                                            <td>Rp. <?= $value->harga_jual ?></td>
                                            <td>Rp. <?= $value->keuntungan ?></td>
                                            <td><?= date('d F Y', strtotime($value->created_at)) ?></td>
                                            <td><?= date('d F Y', strtotime($value->tgl_produksi)) ?></td>
                                            <td><?= date('d F Y', strtotime($value->tgl_exp)) ?></td>
                                            <td>
                                                <button class="btn btn-edit btn-xs" onclick="edit('<?= $value->id_stok ?>')"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-xs" onclick="deleteConfirm('<?= $value->id_stok ?>')"><i class="fa fa-trash"></i></button>

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
<!-- modal -->
<div id="modal-stok" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="modal-login-form-inner">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="basic-login-inner modal-basic-inner">
                                <h3>Tambah Stok</h3>
                                <p>Silahkan tambahkan stok produk di bawah ini</p>
                                <form action="#" id="form-stok">
                                    <input type="text" hidden id="type" name="type">
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Stok Masuk</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control" name="stok_awal" placeholder="Stok Masuk" />
                                                <span class="text-error e_stok_awal"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Harga Modal</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control" name="harga_modal" placeholder="Harga Modal" />
                                                <span class="text-error e_harga_modal"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Harga Jual</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control" name="harga_jual" placeholder="Harga Jual" />
                                                <span class="text-error e_harga_jual"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Tanggal Stok</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group data-custon-pick" id="data_2">

                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="date" name="tanggal_stok" class="form-control" value="">
                                                        <span class="text-error e_tanggal_stok"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Tanggal Produksi</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group data-custon-pick" id="data_3">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="date" name="tgl_produksi" class="form-control" onchange="make_exp()" value="">
                                                        <span class="text-error e_tgl_produksi"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Tanggal Kaluarsa</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group data-custon-pick" id="data_4">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="date" name="tgl_exp" readonly class="form-control" value="">
                                                        <span class="text-error e_tgl_exp"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="login-btn-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="login-horizental">
                                                    <button class="btn btn-sm btn-primary login-submit-cs" type="button" data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-sm btn-primary login-submit-cs" onclick="store_stock()" type="button">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    let id_produk = "<?= $id_produk ?>";
    show_modal = () => {
        $("#form-stok")[0].reset();
        $("#type").val('add');
        $("#modal-stok").modal('show');
    }
    edit = (id) => {
        sessionStorage.setItem('id_stok', id);
        $.ajax({
            type: "GET",
            url: url + "administrator/produk/stok/edit/" + id,
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    let data = '2024-12-1';
                    let tgl_exp = new Date(data);
                    let month = String(tgl_exp.getMonth() + 1).padStart(2, '0');
                    console.log(month);

                    $("[name='stok_awal']").val(response.data.stok_awal);
                    $("[name='harga_modal']").val(response.data.harga_modal);
                    $("[name='harga_jual']").val(response.data.harga_jual);
                    $("[name='tanggal_stok']").val(formatDate(response.data.created_at));
                    $("[name='tgl_produksi']").val(formatDate(response.data.tgl_produksi));
                    $("[name='tgl_exp']").val(formatDate(response.data.tgl_exp));
                    $("#type").val('edit');
                    $("#modal-stok").modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something wrong',
                    });
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

    function formatDate(dateStr) {
        let date = new Date(dateStr);
        let day = String(date.getDate()).padStart(2, '0');
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let year = date.getFullYear();
        // return `${day}/${month}/${year}`;
        return `${year}-${month}-${day}`;
    }
    store_stock = () => {
        $(".text-error").text('');
        $("#form-stok").ajaxForm({
            type: "POST",
            url: url + "administrator/produk/stok/" + id_produk,
            data: {
                id_stok: sessionStorage.getItem('id_stok')
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setInterval(() => {
                        window.location.reload();
                    }, 1500);
                } else if (response.status == 'validation_failed') {
                    $.each(response.message, function(i, v) {
                        $(".e_" + i).text(v);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
                });
            }
        }).submit();
    }
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
                    url: "<?= base_url('administrator/produk/stok/delete/') ?>" + id,
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
    make_exp = () => {
        let tgl_produksi = $("[name='tgl_produksi']").val();
        let tgl_exp = new Date(tgl_produksi);
        tgl_exp.setFullYear(tgl_exp.getFullYear() + 1);
        $("[name='tgl_exp']").val(tgl_exp.toISOString().split('T')[0]);
    }
</script>
<?= $this->endSection() ?>