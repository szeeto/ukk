<?php
include '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");


$id_transaksi = $_GET['id'];
$id_buku = $_GET['buku'];

$tgl = date('Y-m-d H:i:s');


$query = "UPDATE transaksi 
          SET tgl_kembali = '$tgl', status_transaksi = 'Pengembalian' 
          WHERE id_transaksi = '$id_transaksi'";

$data = mysqli_query($koneksi, $query);


if ($data) {
  mysqli_query($koneksi, "UPDATE buku SET status = 'Tersedia' WHERE id_buku = '$id_buku'");

    echo "<script>
            alert('✅ Buku sudah dikembalikan');
            window.location.assign('dashboard.php');
          </script>";
}
?>
