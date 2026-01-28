<?php
$kunci = isset($_POST['kunci']) ?$_POST['kunci']:'';
?>
<form action="?halaman=cari" method="post" class="mb-3">
    <label class="text-muted">Yuk Cari Judul Buku</label>
    <input type="text" name="kunci" class="form-control mb-2" required placeholder="Masukan Judul Buku">
    <button type="submit" class="btn btn-primary  mb-4">🔍 Cari</button>
</form>
<h4>🔍 Pencarian Buku: "<?php echo $kunci ?>"</h4>
<div class="row">
<?php
include '../koneksi.php';
$data_buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul_buku LIKE '%$kunci%'");

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