<h4>👥Data Anggota</h4>
<a href="?halaman=input_anggota" class="btn btn-secondary">
    ➕ Tambah Data Anggota
</a>
<table class="table table-bordere mt-3">
    <tr class="fw-bold">
        <td>No</td>
        <td>Nis</td>
        <td>Nama Anggota</td>
        <td>Username</td>
        <td>Password</td>
        <td>Kelas</td>
        <td>Kelola</td>
    </tr>
    <?php
    $no = 1;
    include '../koneksi.php';
    $query = "SELECT * FROM anggota ORDER BY id_anggota DESC";
    $data = mysqli_query($koneksi, $query);
    while($anggota = mysqli_fetch_assoc($data)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $anggota['nis'] ?></td>
            <td><?= $anggota['nama_anggota'] ?></td>
            <td><?= $anggota['username'] ?></td>
            <td><?= $anggota['password'] ?></td>
            <td><?= $anggota['kelas'] ?></td>
            <td>
                <a href="?halaman=edit_anggota&id=<?= $anggota['id_anggota'] ?>" class="btn btn-warning">✏️Edit</a>
                <a onclick="return confirm('Yakin Hapus Data')" href="?halaman=hapus_anggota&id=<?= $anggota['id_anggota'] ?>" class="btn btn-danger">🗑️ Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>