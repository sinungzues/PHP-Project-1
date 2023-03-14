<?php
if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'admin.php?halaman=produk';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'admin.php?halaman=produk';
            </script><br />";
        echo mysqli_error($conn);
    }
}
?>
<h2 align="center" style="padding-bottom: 10px;">Tambah Barang</h2>
<form method="post" enctype="multipart/form-data" class="form">
    <div class="row ml-auto">
        <div class="md-col-3">
            <div class="mb-3">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" required class="form-control form-control-sm">
            </div>
            <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" required class="form-control form-control-sm"></textarea>
            </div>
            <div class="mb-3">
                <label for="harga">Harga (Rp)</label>
                <input type="text" name="harga" id="harga" required class="form-control form-control-sm">
            </div>
            <div class="mb-3">
                <label for="kategori">Kategori</label>
                <select name="kategori" required class="form-control form-control-sm">
                    <option value="Pakaian Pria">Pakaian Pria</option>
                    <option value="Pakaian Wanita">Pakaian Wanita</option>
                    <option value="Jilbab">Jilbab</option>
                    <option value="Tas">Tas</option>
                    <option value="Sepatu Dan Sandal">Sepatu Dan Sandal</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" min="1" required class="form-control form-control-sm">
            </div>
            <div class="mb-3">
                <label for="formFile">Gambar</label>
                <input type="file" name="gambar" id="formFile" required class="form-control">
            </div>
            <p><input class="btn btn-primary" type="submit" value="Tambah" name="submit"></p>
        </div>
    </div>
</form>