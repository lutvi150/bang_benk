<?= $this->extend('layout/admin/template') ?>
<?= $this->section('content') ?>
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>All Form Element</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="#" id="form-produk">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right-pro">Nama Produk</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="nama_produk" value="<?= $produk->nama_produk ?>" class="form-control" />
                                                        <span class="text-error e_nama_produk"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2  pull-right-pro">Detail Produk</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <textarea name="detail_produk" style="height: 200px;" class="form-control" id=""><?= $produk->detail_produk ?></textarea>
                                                        <span class="text-error e_detail_produk"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mr-5">
                                                <button class="btn btn-sm btn-success mr-5" type="button" onclick="add_gambar()"><i class="fa fa-plus"></i> Tambah Gambar</button>
                                            </div>
                                            <div class="col-md-12 mb-3">

                                                <table class="table table-bordered">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Gambar</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="table-gambar">
                                                        <tr hidden>
                                                            <td style="with: 10px;"></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Priview Gambar</button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger" onclick="delete_gambar('')" type="button"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                <a href="<?= base_url('administrator/produk') ?>">
                                                                    <button class="btn btn-white" type="button">Kembali</button>
                                                                </a>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" onclick="store_produk()" type="button">Simpan</button>
                                                            </div>
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
    </div>
</div>
<!-- modal gambar -->
<div id="modal-gambar" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
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
                                <h3>Upload Gambar</h3>
                                <form action="#" id="form-gambar" enctype="multipart/form-data">
                                    <input type="text" hidden id="type" name="type">
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label class="login2">Upload Gambar</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="file" class="form-control" name="foto_produk" placeholder="Stok Masuk" />
                                                <span class="text-error e_gambar"></span>
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
                                                    <button class="btn btn-sm btn-primary login-submit-cs" onclick="store_gambar()" type="button">Simpan</button>
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
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    let id_produk = "<?= $id_produk ?>";
    $(document).ready(function() {
        priview_gambar();
    });
    add_gambar = () => {
        $("#modal-gambar").modal("show");
    }
    store_gambar = () => {
        $("#form-gambar").ajaxForm({
            type: "POST",
            url: url + "administrator/produk/gambar/upload",
            data: {
                id_produk: id_produk
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
                    $("#modal-gambar").modal("hide");
                    $("#form-gambar").trigger("reset");
                    priview_gambar();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Terjadi Kendala dengan sistem',
                    })
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

    delete_gambar = (id) => {
        Swal.fire({
            title: 'Anda yakin?',
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
                    type: "POST",
                    url: url + "administrator/produk/gambar/delete",
                    data: {
                        id_gambar: id
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
                            priview_gambar();
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
                })
            }
        })
    }

    priview_gambar = () => {
        let html = ``;
        $.ajax({
            type: "GET",
            url: url + "administrator/produk/gambar/" + id_produk,
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    $.each(response.data, function(indexInArray, valueOfElement) {
                        html += ` <tr>
                                                            <td style="with: 10px;">${1 + indexInArray}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-success" onclick="show_gambar('${valueOfElement.id_foto_produk}')"><i class="fa fa-eye"></i> Priview Gambar</button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger" onclick="delete_gambar('${valueOfElement.id_foto_produk}')" type="button"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>`
                    });
                    $("#table-gambar").html(html);
                    $("#modal-gambar").modal("hide");
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

    function show_gambar(id) {
        $.ajax({
            type: "GET",
            url: url + "administrator/produk/gambar/priview/" + id,
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'Gambar',
                        imageUrl: base_url + "uploads/produk/" + response.data.foto_produk,
                        imageWidth: 400,
                        imageHeight: 400,
                        imageAlt: 'Gambar Produk',
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

    store_produk = () => {
        $(".text-error").text("");
        $("#form-produk").ajaxForm({
            type: "POST",
            url: url + "administrator/produk/add",
            data: {
                id_produk: "<?= $id_produk ?>",
                type: "<?= $type ?>",
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
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
                });
            }
        }).submit();
    }
</script>
<?= $this->endSection() ?>