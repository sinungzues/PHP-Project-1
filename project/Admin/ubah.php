<?php
// error_reporting(E_ALL ^ E_WARNING || E_NOTICE);

$id = $_GET["id_barang"];

$gudang = query("SELECT * FROM gudang WHERE id_barang = $id")[0];

if (isset($_POST["submit"])) {
    if (edit($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah');
                document.location.href = 'admin.php?halaman=produk';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah');
                document.location.href = 'admin.php?halaman=produk';
            </script><br />";
        echo mysqli_error($conn);
    }
}
?>
<a href="admin.php?halaman=produk"><button class="btn-danger"><i class="fas fa-arrow-left"></i> Batal</button></a>
<h1>Edit Data Barang</h1>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_barang" value="<?= $gudang['id_barang']; ?>">
    <input type="hidden" name="gambarLama" value="<?= $gudang['gambar']; ?>">
    <table cellpadding="10px">
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_barang" id="nama_barang" required value="<?= $gudang['nama_barang']; ?>" /></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td><input type="text" name="deskripsi" required value="<?= $gudang['deskripsi']; ?>"></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><input type="text" name="harga" id="harga" required value="<?= $gudang['harga']; ?>" /></td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>
                <select name="kategori" required class="form-control form-control-sm" value="<?= $gudang['kategori'] ?>">
                    <option value="Pakaian Pria">Pakaian Pria</option>
                    <option value="Pakaian Wanita">Pakaian Wanita</option>
                    <option value="Jilbab">Jilbab</option>
                    <option value="Tas">Tas</option>
                    <option value="Sepatu Dan Sandal">Sepatu Dan Sandal</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>stok</td>
            <td>:</td>
            <td><input type="text" name="stok" id="stok" required value="<?= $gudang['stok']; ?>" /></td>
        </tr>
        <tr>
            <td>Gambar</td>
            <td>:</td>
            <td><img src="../img/<?= $gudang['gambar']; ?>" width="40">
                <input type="file" name="gambar" id="gambar">
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="submit" name="submit" value="Ubah Data"></td>
        </tr>
    </table>
</form>