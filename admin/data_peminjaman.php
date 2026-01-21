<?php
include '../koneksi.php';
$anggota = mysqli_query($koneksi, "SELECT*FROM anggota");
$buku = mysqli_query($koneksi, "SELECT*FROM buku WHERE status='Tersedia'");

?>
<h4>🛒 Data Peminjaman</h4>
<a href="?halaman=input_peminjaman" class="btn btn-secondary">
    ➕Tambah Data Peminjaman
</a>
<table class="table table-bordere mt-3">
    <tr class="fw-bold">
        <td>No</td>
        <td>NIS</td>
        <td>Nama Anggota</td>
        <td>Judul Buku</td>
        <td>Tanggal Pinjam</td> 
        <td>Kelola</td>
    </tr>
    <?php
    $no = 1;
    include '../koneksi.php';
    $query = "SELECT * FROM transaksi
    WHERE transaksi.status_transaksi='Peminjaman' ORDER BY transaksi.id_transaksi DESC";
    $data = mysqli_query($koneksi, $query);
    while($peminjam = mysqli_fetch_assoc($data)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $peminjam['nis'] ?></td>
            <td><?= $peminjam['nama_anggota'] ?></td>
            <td><?= $peminjam['judul_buku'] ?></td>
            <td>
                
            </td>
        </tr>
    <?php } ?>
</table>