<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <table>
        <tr>
        <td>Nama Produk</td>
        <td>Nomor Registrasi</td>
        <td>Barcode</td></tr>

        <?php foreach ($produk as $key => $value): ?>
        <tr>
        <td><?=$value->nama_produk?></td>
        <td><?=$value->nomor_registrasi_produk?></td>
        <td><img src="<?=base_url('uploads/barcode/barcode_' . $value->id_produk . '.png')?>" alt=""></td></tr>
        <?php endforeach?>
    </table>
</body>
</html>
