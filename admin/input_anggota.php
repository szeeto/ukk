<h4>👥 Tambah Data Anggota</h4>
<form action="#" method="post" class="mt-3">
    <input type="number" name="nis" class="form-control mb-2" placeholder="Masukan Nis Anggota" required>
    <input type="text" name="nama_anggota" class="form-control mb-2" placeholder="Masukan Nama Anggota" required>
    <input type="text" name="username" class="form-control mb-2" placeholder="Masukan Username" required>
    <input type="text" name="password" class="form-control mb-2" placeholder="Masukan Password" required>
    <input  type="text" name="kelas" class="form-control mb-2" placeholder="Masukan Kelas" required>
    <button type="submit" name="tombol" class="btn btn-primary mt-3">💾 Simpan</button>
</form>
<?php
if(isset($_POST['tombol'])){
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username= $_POST['username'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    include '../koneksi.php';
    $query = "INSERT INTO anggota (nis, nama_anggota, username, password, kelas) VALUES ('$nis','$nama_anggota','$username','$password','$kelas')";
    $data = mysqli_query($koneksi, $query);
    if($data){
        echo "<script>alert('✅ Data Berhasil Disimpan'); window.location.assign('?halaman=data_anggota');</script>";
    }else{
        echo "<script>alert('❌ Data Gagal Disimpan'); window.location.assign('?halaman=input_anggota');</script>";
    }
}
include '../footer.php';