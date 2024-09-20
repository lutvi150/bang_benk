$(document).ready(function () {
    count_keranjang();
});
notif_login = () => {
    $(".alert-heading").text('Hallo');
    $(".alert-text").text('Silahkan login terlebih dahulu untuk dapat berbelanja di diaplikasi');
    $("#modal-alert").modal("show")
}

add_keranjang = (id_produk) => {
    $.ajax({
        type: "POST",
        url: url + "pelanggan/keranjang",
        data: {
            id_produk: id_produk
        },
        dataType: "JSON",
        success: function (response) {
            if (response.status == 'success') {
                $(".alert-heading").text('Berhasil');
                $(".alert-text").text('item berhasil ditambahkan ke keranjang');
                $("#modal-alert").modal("show")
                count_keranjang();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
            });
        }
    });
}
count_keranjang = () => {
    $.ajax({
        type: "GET",
        url: url + "pelanggan/keranjang",
        dataType: "JSON",
        success: function (response) {
            $('.top-cart-info-count').text(response.item_count + " items");
            $('.top-cart-info-value').text("Rp. " + response.total_harga);
            let html = "";
            $.each(response.data, function (indexInArray, valueOfElement) {
                let foto = "";
                if (valueOfElement.foto == null) {
                    foto = base_url + "uploads/notfoud.jpg";
                } else {
                    foto = base_url + "uploads/produk/" + valueOfElement.foto.foto_produk;
                }
                html += `<li>
          <a href="shop-item.html"><img src="${foto}" alt="${valueOfElement.nama_produk}" width="37" height="34"></a>
          <span class="cart-content-count">x ${valueOfElement.qty}</span>
          <strong><a href="#">${valueOfElement.nama_produk}</a></strong>
          <em>Rp ${valueOfElement.total_harga}</em>
          <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
        </li> `;
            });

            $(".show-keranjang").html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
            });
        }
    });
}

function check_out() {
    $.ajax({
        type: "GET",
        url: url + "pelanggan/checkout",
        dataType: "JSON",
        success: function (response) {
            if (response.status == 'success') {
                $(".alert-heading").text('Hallo');
                $(".alert-text").text('Transaksi berhasil, transaksi anda sudah masuk ke admin');
                $("#modal-alert").modal("show");
                count_keranjang();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Something went wrong! ${xhr.status} ${xhr.responseText} ${thrownError}`,
            });
        }
    });
}
show_product = (id_produk) => {

}