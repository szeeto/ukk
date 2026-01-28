<?php
include '../koneksi.php';
session_start();

if (empty($_SESSION['id_anggota'])) {
    header("Location:../login-anggota.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota - Aplikasi Perpustakaan Sekolah Digital</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-3 mb-4">
    <h4>Halaman Anggota - Aplikasi Perpustakaan Sekolah Digital</h4>

    <!-- MENU -->
    <a href="dashboard.php" class="btn btn-success text-white">Dashboard</a>
    <a href="?halaman=history" class="btn btn-success text-white">History Peminjaman</a>
    <a href="logout.php" class="btn btn-danger text-white">Logout</a>

    <div class="card p-4 mt-3">

<?php
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : '';

if (file_exists($halaman . ".php")) {
    include $halaman . ".php";
} else {
?>

<h4>Selamat Datang <?= $_SESSION['nama_anggota']; ?> 👋</h4>
<br>
<form action="?halaman=cari" method="post" class="mb-3">
    <label class="text-muted">Yuk Cari Judul Buku</label>
    <input type="text" name="kunci" class="form-control mb-2" required placeholder="Masukan Judul Buku">
    <button type="submit" class="btn btn-primary  mb-4">🔍 Cari</button>
</form>

<hr>

<h4>📚 Daftar buku yang dipinjam :</h4>
<table class="table table-bordered">
    <tr class="fw-bold">
        <td>No</td>
        <td>Judul Buku</td>
        <td>Tanggal Pinjam</td>
        <td>Pengembalian</td>
    </tr>
    <?php
    $no = 1;
    $query = "SELECT transaksi.*, buku.judul_buku FROM transaksi 
              LEFT JOIN buku ON buku.id_buku = transaksi.id_buku 
              WHERE transaksi.id_anggota = '{$_SESSION['id_anggota']}'
              AND transaksi.status_transaksi = 'Peminjaman' 
              ORDER BY transaksi.tgl_pinjam DESC";
    $data = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($data) > 0) {
        while ($peminjaman = mysqli_fetch_assoc($data)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>
                <?php
                // Ambil judul dari transaksi jika ada, jika tidak ada di tabel buku
                $judul = !empty($peminjaman['judul_buku']) ? $peminjaman['judul_buku'] : (isset($peminjaman['judul_buku_transaksi']) ? $peminjaman['judul_buku_transaksi'] : '');
                if (empty($judul) && isset($peminjaman['judul_buku']) && isset($peminjaman['judul_buku_transaksi'])) {
                    $judul = $peminjaman['judul_buku']; // fallback lama
                }
                if (!empty($judul)) {
                    echo htmlspecialchars($judul);
                } else {
                    echo '<span class="text-danger">(Buku tidak ditemukan)</span>';
                }
                ?>
            </td>
            <td><?= date('d-m-Y H:i', strtotime($peminjaman['tgl_pinjam'])); ?></td>
            <td>
                <a class="btn btn-success"
                   href="pengembalian.php?id=<?= $peminjaman['id_transaksi']; ?>&buku=<?= $peminjaman['id_buku']; ?>"
                   onclick="return confirm('Pengembalian Buku <?= !empty($judul) ? htmlspecialchars($judul) : 'Buku tidak ditemukan'; ?> ?')">
                   ✅ Pengembalian
                </a>
            </td>
        </tr>
    <?php }
    } else { ?>
        <tr><td colspan="4" class="text-center text-muted">Belum ada buku yang dipinjam.</td></tr>
    <?php } ?>
</table>

<hr>
<h4>📚 Daftar Buku :</h4>

<div class="row">

<?php
$data_buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");

while ($buku = mysqli_fetch_assoc($data_buku)) {
?>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm p-3 d-flex h-100">
            <h5><?= $buku['judul_buku']; ?></h5>
            <p><strong>Pengarang :</strong> <?= $buku['pengarang']; ?></p>
            <p><strong>Penerbit :</strong> <?= $buku['penerbit']; ?></p>
            <p><strong>Diterbitkan tahun :</strong> <?= $buku['tahun_terbit']; ?></p>
            <p><strong>Status :</strong> <?= $buku['status']; ?></p>
            <?php
                $status = strtolower($buku['status']);
                if ($status == 'tersedia') {
                    echo '<span class="badge bg-success mb-1">✅ Tersedia</span>';
                } else {
                    echo '<span class="badge bg-danger mb-1">❌ Tidak Tersedia</span>';
                }
            ?>

            <?php if ($status == "tersedia") { ?>
                     <a href="peminjaman.php?id=<?= $_SESSION['id_anggota']; ?>&buku=<?= $buku['id_buku']; ?>"
                         class="btn btn-primary text-white mt-auto"
                         onclick="return confirm('Peminjaman Buku <?= htmlspecialchars($buku['judul_buku']); ?> ?')">
                         📖 Pinjam Buku
                     </a>
            <?php } else { ?>
                <a href="#" class="btn btn-primary text-white disabled mt-auto">
                    📖 Pinjam Buku
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>

<script>
    function pinjam(pesan,id_buku){
        if(confirm(pesan)){
            window.location.href="?halaman=peminjaman&id="+id_buku;
        }
    }
    function pengembalian(pesan,id_buku){
        if(confirm(pesan)){
            window.location.href="?halaman=pengembalian&id="+id_transaksi+"&buku="+id_buku;
        }
    }
</script>

<?php } ?>
    </div>
</div>

</body>
</html>

<script>
    function pinjam(pesan,id_buku){
        if(confirm(pesan)){
            window.location.href="?halaman=peminjaman&id="+id_buku;
        }
    }
    function pengembalian(pesan,id_buku){
        if(confirm(pesan)){
            window.location.href="?halaman=pengembalian&id="+id_transaksi+"&buku="+id_buku;
        }
    }
</script>

</body>
</html>
