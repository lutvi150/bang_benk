<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keranjang;
use App\Models\Transaksi;
use CodeIgniter\HTTP\ResponseInterface;

class Report extends BaseController
{
    public function index()
    {
        //
    }
    function faktur($id_transaksi)
    {

        $transaksi = new Transaksi();
        $keranjang = new Keranjang();
        $transaksi = $transaksi->join('table_user', 'table_transaksi.id_user = table_user.id')->select('table_transaksi.*, table_user.nama_user,table_user.email')->where('id_transaksi', $id_transaksi)->first();
        $keranjang = $keranjang->join('table_produk', 'table_keranjang.id_produk = table_produk.id_produk')->select('table_keranjang.*, table_produk.nama_produk,nomor_registrasi_produk')->where('table_keranjang.id_transaksi', $id_transaksi)->findAll();
        // $response = [
        //     'status' => 'success',
        //     'transaksi' => $transaksi,
        //     'keranjang' => $keranjang,
        // ];
        // return $this->respond($response, 200);
        // exit;
        $page = '';
        foreach ($keranjang as $key => $value) {
            $page .= '<tr>
<td align="center">' . $value->nomor_registrasi_produk . '</td>
<td>' . $value->nama_produk . '</td>
<td class="cost">' . number_format($value->harga) . '</td>
<td class="cost">' . $value->qty . 'pcs</td>
<td class="cost">' . number_format($value->total_harga) . '</td>
</tr>';
        }
        $html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%">
<tr>
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 10pt;">Bang Benk Bacco<br />Kute Lintang, Kec. Pegasing, Kabupaten Aceh Tengah, Aceh 24561 </br>
Kontak: 082217252373
</br>
Email: info@bangbenkbacco.com<br /></td>
<td width="50%" style="text-align: right;"> No. Faktur<br /><span style="font-weight: bold; font-size: 12pt;">' . $transaksi->nomor_transaksi . '</span></td>
</tr></table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="text-align: right">Tanggal Faktur:' . date('d F Y', strtotime($transaksi->created_at)) . ' </div>

<table width="100%" style="font-family: serif;" cellpadding="10"><tr>
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">KEPADA:</span><br /><br />' . $transaksi->nama_user . '<br />' . $transaksi->email . '</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">DARI:</span><br /><br />Bang Benk Bacco<br />Kute Lintang, Kec. Pegasing, Kabupaten Aceh Tengah, Aceh 24561 </br>
Kontak: 082217252373
</br>
Email: info@bangbenkbacco.com<br /></td>
</tr></table>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="15%">No.Produk</td>
<td width="45%">Nama Produk</td>
<td width="10%">Harga Satuan</td>
<td width="15%">Jumlah</td>
<td width="15%">Total</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
' . $page . '
<!-- END ITEMS HERE -->
<tr>
<td class="blanktotal" colspan="3" rowspan="6"></td>
<td class="totals">Total: </td>
<td class="totals cost">' . number_format($transaksi->total_harga) . '</td>
</tr>
</tbody>
</table>

</body>
</html>
';

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Bang Benk. - Invoice");
        $mpdf->SetAuthor("Bang Benk");
        $mpdf->SetWatermarkText("LUNAS");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output();
        exit;
    }
}
