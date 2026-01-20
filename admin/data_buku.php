<h4>📚Data Buku</h4>
<a href="?halaman=input_buku" class="btn btn-secondary">
    ➕Tambah Data Buku
</a>
<table class="table table-bordere mt-3">
    <tr class="fw-bold">
        <td>No</td>
        <td>Judul Buku</td>
        <td>Pengarang</td>
        <td>Penerbit</td>
        <td>Tahun Terbit</td> 
        <td>Status</td>
        <td>Kelola</td>
    </tr>
    <?php
    $no = 1;
    include '../koneksi.php';
    $query = "SELECT * FROM buku ORDER BY id_buku DESC";
    $data = mysqli_query($koneksi, $query);
    while($buku = mysqli_fetch_assoc($data)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $buku['judul_buku'] ?></td>
            <td><?= $buku['pengarang'] ?></td>
            <td><?= $buku['penerbit'] ?></td>
            <td><?= $buku['tahun_terbit'] ?></td>
            <td><?= $buku['status'] ?></td>
            <td>
                <a href="?halaman=edit_buku&id=<?= $buku['id_buku'] ?>" class="btn btn-warning">✏️Edit</a>
                <a onclick="return confirm('Yakin Hapus Data')" href="?halaman=hapus_buku&id=<?= $buku['id_buku'] ?>" class="btn btn-danger">🗑️ Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>