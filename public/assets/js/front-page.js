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
    $.ajax({
    type: "GET",
    url: url+"detail-produks/"+id_produk,
    dataType: "JSON",
    success: function (response) {
       if (response.status=='success') {
        let foto_produk="";
        let show_foto="";
        if (response.data.foto_produk.length > 0) {
            foto_produk=`${base_url}uploads/produk/${response.data.foto_produk[0].foto_produk}`;
          
            $.each(response.data.foto_produk, function (indexInArray, valueOfElement) { 
                                 show_foto+=`<a href="javascript:;" class="active"><img alt="${response.data.nama_produk}" src="${base_url}uploads/produk/${valueOfElement.foto_produk}"></a>`;
            });
        }else{
            $foto_produk=`${base_url}uploads/notfoud.jpg`;
            for (let index = 0; index < 2; index++) {
                show_foto+=`<a href="javascript:;" class="active"><img alt="${response.data.nama_produk}" src="${foto_produk}"></a>`;
            }
        }
        let price=change_format(response.data.stok_detail.harga_jual);
        $(".fast-nama-produk").text(response.data.nama_produk);
        $(".price-label").html(`<span>Rp</span> ${price}`);
        $(".fast-stok").text(`${response.data.stok} ${response.data.satuan_produk}`);
        $(".fast-foto-produk").html(`<img src="${foto_produk}" alt="Cool green dress with red bell" class="img-responsive">`);
        $(".fast-show-produk-image").html(show_foto);
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
change_format=(amount)=>{
    const formattedAmount = amount.toLocaleString('de-DE');
    return formattedAmount;
}