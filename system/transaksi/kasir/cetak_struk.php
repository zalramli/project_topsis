<?php 
include "../../../koneksi/koneksi.php";
include "../../../koneksi/function.php";
$html = '
<div style="text-align:center">
<h3>Warung Barokah</h3>
<h5>Jln pemuda ngabang, Landak</h5>
<hr width="35%">
<table align="center" width="35%" cellspacing="0">
                        <tbody>';
                        $grand_total = 0;
                        $bayar = 0;
                        $kembalian = 0;
                        $id = $_GET['cetak'];
                        $query = mysqli_query($koneksi, "SELECT * FROM detail_penjualan JOIN barang using(kode_barang) WHERE kode_penjualan='$id'");
                        $query2 = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE kode_penjualan='$id'");
                        foreach ($query2 as $data2) {
                            $bayar = $data2['total_bayar'];
                            $kembalian = $data2['kembalian'];
                        }

                        foreach ($query as $data) :
                            $grand_total += $data['sub_total'];
                        $html.='
							<tr>
                                <td width="40%">'.$data['nama_barang'].'</td>
                                <td width="20%" style="text-align:right">'. rupiah($data['harga_jual']) .'</td>
                                <td width="10%" style="text-align:right">'.$data['qty'].'x</td>
                                <td width="30%" style="text-align:right">'.rupiah($data['sub_total']).'</td>
							</tr>';
                        endforeach;
                        $html.='
                        </tbody>
                    </table>
                    <hr width="35%">
                    <table align="center" width="35%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="text-align:right" width="70%">Total</td>
                            <td width="30%" style="text-align:right">'. rupiah($grand_total) .'</td>
                        </tr>
                        <tr>
                            <td style="text-align:right" width="70%">Bayar</td>
                            <td width="30%" style="text-align:right">'. rupiah($bayar) .'</td>
                        </tr>
                        <tr>
                            <td style="text-align:right" width="70%">Kembalian</td>
                            <td width="30%" style="text-align:right">'. rupiah($kembalian) .'</td>
                        </tr>
                    </tbody>
                </table>
                <h6 style="text-align:center">Terima Kasih Atas Kunjungan anda</h6>
                    
                    </div>';
$filename = "Struk";

// include autoloader
require_once '../../../assets/library/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename,array("Attachment"=>0));
?>