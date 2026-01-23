<?php
$id = $_GET['id'];
$buku = $_GET['buku'];
include '../koneksi.php';
$data = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id'");
if ($data) {
    mysqli_query($koneksi, "UPDATE buku SET status='Tersedia' WHERE id_buku='$buku'");
    echo "<script>alert('✅ Data peminjaman berhasil dihapus'); window.location.assign('?halaman=data_peminjaman');</script>";
}
?>