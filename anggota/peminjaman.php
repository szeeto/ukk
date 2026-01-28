<?php
include '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");


$id_anggota = $_GET['id'];
$id_buku = $_GET['buku'];
$tgl = date('Y-m-d H:i:s');

// Ambil data anggota
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota='$id_anggota'");
$row_anggota = mysqli_fetch_assoc($anggota);
$nis = $row_anggota ? $row_anggota['nis'] : '';
$nama_anggota = $row_anggota ? $row_anggota['nama_anggota'] : '';

// Ambil data buku
$buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_buku'");
$row_buku = mysqli_fetch_assoc($buku);
$judul_buku = $row_buku ? $row_buku['judul_buku'] : '';

// Simpan ke tabel transaksi
$query = "INSERT INTO transaksi (id_anggota, id_buku, judul_buku, tgl_pinjam, status_transaksi)
          VALUES ('$id_anggota', '$id_buku', '$judul_buku', '$tgl', 'Peminjaman')";
$data = mysqli_query($koneksi, $query);

if ($data) {
    mysqli_query($koneksi, "UPDATE buku SET status = 'Dipinjam' WHERE id_buku = '$id_buku'");
    echo "<script>
            alert('✅ Buku sudah berhasil di pinjam');
            window.location.assign('dashboard.php');
          </script>";
} 