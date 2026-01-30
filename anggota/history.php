
<h4>✅ Riwayat Pengembalian</h4>
<table class="table table-bordered">
    <tr class="fw-bold">
        <td>No</td>
        <td>Judul Buku</td>
        <td>Tanggal Pinjam</td>
        <td>Tanggal Pengembalian</td>
    </tr>
    <?php
    $no = 1;
    $query = "SELECT transaksi.*, buku.judul_buku FROM transaksi 
              LEFT JOIN buku ON buku.id_buku = transaksi.id_buku 
              WHERE transaksi.id_anggota = '{$_SESSION['id_anggota']}'
              AND transaksi.status_transaksi = 'Pengembalian' 
              ORDER BY transaksi.tgl_pinjam DESC";
    $data = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($data) > 0) {
        while ($peminjaman = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td>
            <?php
            $judul = !empty($peminjaman['judul_buku']) ? $peminjaman['judul_buku'] : (isset($peminjaman['judul_buku_transaksi']) ? $peminjaman['judul_buku_transaksi'] : '');
            if (empty($judul) && isset($peminjaman['judul_buku']) && isset($peminjaman['judul_buku_transaksi'])) {
                $judul = $peminjaman['judul_buku'];
            }
            if (!empty($judul)) {
                echo htmlspecialchars($judul);
            } else {
                echo '<span class="text-danger">(Buku tidak ditemukan)</span>';
            }
            ?>
        </td>
        <td><?= date('d-m-Y H:i', strtotime($peminjaman['tgl_pinjam'])); ?></td>
        <td><?= !empty($peminjaman['tgl_kembali']) ? date('d-m-Y H:i', strtotime($peminjaman['tgl_kembali'])) : '-'; ?></td>
    </tr>
    <?php }
    } else { ?>
        <tr><td colspan="4" class="text-center text-muted">Belum ada pengembalian buku.</td></tr>
    <?php } ?>
</table>
<?php include '../footer.php'; ?>