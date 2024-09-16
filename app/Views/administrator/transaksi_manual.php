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
                        <div class="alert alert-danger alert-error" hidden role="alert">
                            <strong>Informasi</strong>
                            <p class="error-message"></p>
                        </div>
                        <input type="text" autofocus class="form-control p-2" oninput="search_produk()" name="search" id="search" placeholder="Scan Produk">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <!-- tes -->
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th data-field="id" style="width: 1%;">No.</th>
                                        <th data-field="name">Nama Produk</th>
                                        <th data-field="name">Harga</th>
                                        <th data-field="email" style="width: 10%;">Jumlah</th>
                                        <th>Total Harga</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="show-keranjang">
                                    <tr hidden class="row-keranjang-">
                                        <td>1</td>
                                        <td>Barang</td>
                                        <td>1000000</td>
                                        <td><input type="number" class="form-control" name="qty" value="" id=""></td>
                                        <td class="total-row-">200000</td>
                                        <td><button class="btn btn-sm btn-danger" onclick="remove()"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td class="total_harga"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total Bayar</td>
                                        <td> <input type="number" class="form-control" id="total_bayar" oninput="count_kembalian()" value="" name="total_bayar"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Kembalian</td>
                                        <td class="kembalian"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <a href="<?= base_url('index.php/administrator/transaksi') ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-reply"></i> Kembali</button></a>
                            <button type="button" class="btn btn-success btn-sm" onclick="reset()"><i class="fa fa-refresh"></i> Reset</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="proses_transaksi()"><i class="fa fa-check"></i> Proses Transaksi</button>
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
    $(document).ready(function() {
        keranjang();
    });
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
    search_produk = () => {
        $.ajax({
            type: "POST",
            url: url + "administrator/produk/search",
            data: {
                id_produk: $("#search").val(),
            },
            dataType: "JSON",
            success: function(response) {
                $("#search").val("");
                if (response.status == 'failed') {
                    $(".error-message").text(response.message);
                    $(".alert-error").removeAttr('hidden');
                    setTimeout(() => {
                        $(".alert-error").attr('hidden', true);
                    }, 2000);
                } else if (response.status == 'success') {
                    keranjang();
                }
            }
        });
    }
    keranjang = () => {
        $.ajax({
            type: "GET",
            url: url + "administrator/keranjang",
            dataType: "JSON",
            success: function(response) {
                let html = "";
                $.each(response.data, function(indexInArray, valueOfElement) {
                    let harga = new Intl.NumberFormat('en-DE').format(valueOfElement.harga_jual);
                    let total = new Intl.NumberFormat('en-DE').format(valueOfElement.total_harga);
                    html += ` <tr  class="row-keranjang-${valueOfElement.id_keranjang}">
                                        <td>${indexInArray+1}</td>
                                        <td>${valueOfElement.nama_produk}</td>
                                        <td>Rp. ${harga}</td>
                                        <td><input type="number" class="form-control" " onchange="update_qty(${valueOfElement.id_keranjang},${valueOfElement.harga_jual})" name="qty_${valueOfElement.id_keranjang}" value="${valueOfElement.qty}" id=""></td>
                                        <td class="total-row-${valueOfElement.id_keranjang}">Rp. ${total}</td>
                                        <td><button class="btn btn-sm btn-danger" onclick="remove(${valueOfElement.id_keranjang})"><i class="fa fa-trash"></i></button></td>
                                    </tr>`;
                });
                $(".show-keranjang").html(html);
                $(".total_harga").text("Rp. " + new Intl.NumberFormat('en-DE').format(response.total_harga));
                sessionStorage.setItem('total_harga', response.total_harga);
            }
        });
    }
    update_qty = (id_keranjang, harga_jual) => {
        let qty = $("[name='qty_" + id_keranjang + "']").val();
        if (qty < 0) {
            $(".error-message").text('Jumlah barang tidak boleh negatif!');
            $(".alert-error").removeAttr('hidden');
            setTimeout(() => {
                $(".alert-error").attr('hidden', true);
            }, 2000);
            $("[name='qty_" + id_keranjang + "']").val(0);
        }
        let total = parseInt(qty) * parseInt(harga_jual);
        $(".total-row-" + id_keranjang).text("Rp. " + new Intl.NumberFormat('en-DE').format(total));
        $.ajax({
            type: "POST",
            url: url + "administrator/keranjang/update",
            data: {
                id_keranjang: id_keranjang,
                qty: qty,
                total_harga: total,
            },
            dataType: "JSON",
            success: function(response) {
                sessionStorage.setItem('total_harga', response.total_harga);
                $(".total_harga").text("Rp. " + new Intl.NumberFormat('en-DE').format(response.total_harga));
            }
        });
    }
    reset = () => {
        $.ajax({
            type: "GET",
            url: url + "administrator/keranjang/reset",
            dataType: "JSON",
            success: function(response) {
                keranjang();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.status + " " + xhr.responseText + " " + errorThrown);
            }
        });
    }
    remove = (id_keranjang) => {
        $.ajax({
            type: "GET",
            url: url + "administrator/keranjang/delete/" + id_keranjang,
            dataType: "JSON",
            success: function(response) {
                keranjang();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.status + " " + xhr.responseText + " " + errorThrown);
            }
        });
    }
    proses_transaksi = () => {
        $.ajax({
            type: "GET",
            url: url + "administrator/transaksi/proses_transaksi",
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'transaksi berhasil diproses',
                        icon: 'success'
                    }).then((result) => {
                        keranjang();
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.status + " " + xhr.responseText + " " + errorThrown);
            }
        });
    }
    count_kembalian = () => {
        let total_bayar = $("#total_bayar").val();
        let total_harga = sessionStorage.getItem('total_harga');
        let kembalian = parseInt(total_bayar) - parseInt(total_harga);
        $(".kembalian").text("Rp. " + new Intl.NumberFormat('en-DE').format(kembalian));
    }
</script>
<?= $this->endSection() ?>