<?php
// Koneksi ke database //

error_reporting(0);
include "../konfig.php";
include "fungsi_indotgl.php";

$tanggal =tgl_indo(date('Y-m-d'));
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
$jam= date('h:i:s a'); // menampilkan jam sekarang
//$jam=date("H:i:s");

$tglawal = $_POST['tgl_awal'];
$tglakhir = $_POST['tgl_akhir'];

// sesuai kan root file mPDF anda
define('_MPDF_PATH','config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

?>

<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->
<table border='0' align='LEFT'>
<tr>
<th>
<img src="../images/larva.png"  alt="" width="200"/>
</th>
<th width="900px">
<h1> <br> Laporan Penjualan Cafe Larva</h1> </br>
</th>
</tr>
</table>
<hr style="height:3px;" />

  <p style="text-align:left; font-size:12px;"> Periode (Tanggal <?php echo tgl_indo($tglawal)?> S/D  <?php echo tgl_indo($tglakhir) ?>) 
  <br> Printed on <?php echo $tanggal.' | '.$jam ?></p>
<table cellspacing="5" cellpadding="5" border="1" style="border-collapse: collapse;">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Penjualan</th>
                            <th>Kode Pesanan</th>
                            <th>Menu</th>
                            <th>Satuan</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $counter = 0;
                          $total_penjualan = 0;
                          $query = mysql_query("select h.kode_pesanan, 
                                                    d.harga as harga_satuan,
                                                    (d.qty*d.harga) as total_harga,
                                                    b.nama_menu,
                                                    b.satuan,
                                                    d.qty,
                                                    h.keterangan,
                                                    h.tanggal_pesanan,
                                                    (select count(kode_pesanan) from tb_pembayaran where kode_pesanan = h.kode_pesanan) as ispaid
                                                from tb_pesanan_header h 
                                                    inner join tb_pesanan_detail d on d.kode_pesanan = h.kode_pesanan
                                                    inner join tb_menu b on d.kode_menu = b.kode_menu
                                                where h.kode_pesanan <> '' 
                                                      and h.kode_pesanan in (select kode_pesanan from tb_pembayaran where kode_pembayaran <> '')
                                                      and h.tanggal_pesanan between '$tglawal' and '$tglakhir'
                                                order by h.kode_pesanan desc
                                              ");
                          while($row=mysql_fetch_array($query)){
                            $counter = $counter+1;
                            $total_penjualan = $total_penjualan + $row['total_harga'];
                          ?>
                          <tr>
                            <td><?php echo $counter ?></td>
                            <td><?php echo tgl_indo($row["tanggal_pesanan"])?></td>
                            <td><?php echo $row["kode_pesanan"]; ?></td>
                            <td><?php echo $row["nama_menu"]; ?></td>
                            <td><?php echo $row["satuan"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td align="right">Rp.<?php echo number_format($row['harga_satuan']) ?>,-</td>
                            <td align="right">Rp.<?php echo number_format($row['total_harga']) ?>,-</td>
                          </tr>
                          <?php } ?>


                          <tr>
                            <td colspan="7" align="center"><b>Total</b></td>
                            <td align="right"><b>Rp.<?php echo number_format($total_penjualan) ?>,-</b></td>
                          </tr>

                        </tbody>
                      </table>
                      <br> <br>
                      
                     <table cellspacing="5" cellpadding="5" border="0" width="40%" align="right">
                          <tr>
                              <td align="center">Tangerang, <?php echo "$tanggal"?><br><br><br><br><br>(_________________)<br>Owner</td>
                          </tr>

                      </table>

<?php
//Batas file sampe sini
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//$stylesheet = file_get_contents('css/zebra.css');
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML($html,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>