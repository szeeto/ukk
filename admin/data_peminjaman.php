<?php
include '../koneksi.php';
$anggota = mysqli_query($koneksi, "SELECT*FROM anggota");
$buku = mysqli_query($koneksi, "SELECT*FROM buku WHERE status='Tersedia'");

?>
<h4>🛒 Data Peminjaman</h4>
<a href="?halaman=input_peminjaman" class="btn btn-secondary">
    ➕Tambah Data Peminjaman
</a>
<table class="table table-bordered mt-3">
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
    $query = "SELECT transaksi.*, anggota.nis, anggota.nama_anggota, buku.judul_buku
    FROM transaksi
    LEFT JOIN anggota ON anggota.id_anggota = transaksi.id_anggota
    LEFT JOIN buku ON buku.id_buku = transaksi.id_buku
    WHERE transaksi.status_transaksi='Peminjaman' ORDER BY transaksi.id_transaksi DESC";
    $data = mysqli_query($koneksi, $query);
    while($peminjam = mysqli_fetch_assoc($data)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $peminjam['nis'] ?></td>
            <td><?= $peminjam['nama_anggota'] ?></td>
            <td><?= !empty($peminjam['judul_buku']) ? $peminjam['judul_buku'] : '<span class="text-danger">(Buku tidak ditemukan)</span>' ?></td>
            <td><?= $peminjam['tgl_pinjam'] ?></td>
            <td>
                <?php
                    $pesan ="✅ Pengembalian buku oleh $peminjam[nama_anggota], $peminjam[judul_buku]";
                    $isi = "'$pesan','$peminjam[id_transaksi]','$peminjam[id_buku]'";
                ?>
                <a onclick="pengembalian(<?php echo $isi ?>)" class="btn btn-success" href="javascript:void(0)">✅ Pengembalian</a>
                <?php
                    $pesan ="🗑️ Anda yakin ingin menghapus peminjaman buku $peminjam[nama_anggota], $peminjam[judul_buku]";
                    $isi = "'$pesan','$peminjam[id_transaksi]','$peminjam[id_buku]'";
                ?>
                <a onclick="hapus(<?php echo $isi ?>)" class="btn btn-danger" href="javascript:void(0)">🗑️ Hapus</a>
        </tr>
    <?php } ?>
</table>

<h4>✅ Data Pengembalian</h4>

<table class="table table-bordered mt-3">
    <tr class="fw-bold">
        <td>No</td>
        <td>NIS</td>
        <td>Nama Anggota</td>
        <td>Judul Buku</td>
        <td>Tanggal Pinjam</td>
        <td>Tanggal Pengembalian</td> 
        <td>Kelola</td>
    </tr>
    <?php
    $no = 1;
    include '../koneksi.php';
    $query = "SELECT transaksi.*, anggota.nis, anggota.nama_anggota, buku.judul_buku
    FROM transaksi
    LEFT JOIN anggota ON anggota.id_anggota = transaksi.id_anggota
    LEFT JOIN buku ON buku.id_buku = transaksi.id_buku
    WHERE transaksi.status_transaksi='Pengembalian' ORDER BY transaksi.id_transaksi DESC";
    $data = mysqli_query($koneksi, $query);
    while($peminjam = mysqli_fetch_assoc($data)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $peminjam['nis'] ?></td>
            <td><?= $peminjam['nama_anggota'] ?></td>
            <td><?= !empty($peminjam['judul_buku']) ? $peminjam['judul_buku'] : '<span class="text-danger">(Buku tidak ditemukan)</span>' ?></td>
            <td><?= $peminjam['tgl_pinjam'] ?></td>
            <td><?= $peminjam['tgl_kembali'] ?></td>
            <td>
               
                <?php
                    $pesan ="🗑️ Anda yakin ingin menghapus peminjaman buku $peminjam[nama_anggota], $peminjam[judul_buku]";
                    $isi = "'$pesan','$peminjam[id_transaksi]','$peminjam[id_buku]'";
                ?>
                <a onclick="hapus(<?php echo $isi ?>)" class="btn btn-danger" href="javascript:void(0)">🗑️ Hapus</a>
        </tr>
    <?php } ?>
</table>
<script>
    function pengembalian (pesan, id_transaksi, id_buku){
        if(confirm(pesan)){
            window.location.href = '?halaman=proses_pengembalian&id=' + id_transaksi + '&buku=' + id_buku;
        }
    }
    function hapus (pesan, id_transaksi, id_buku){
        if(confirm(pesan)){
            window.location.href = '?halaman=hapus&id=' + id_transaksi + '&buku=' + id_buku;
        }
    }
</script>
<?php include '../footer.php'; ?>