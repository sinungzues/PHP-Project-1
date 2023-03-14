<?php
if (isset($_POST["submit"])) {
    if (tambah_ongkir($_POST) > 0) {
        echo "<script>
                alert('Data ongkir berhasil ditambahkan');
                document.location.href = 'admin.php?halaman=ongkir';
            </script>";
    } else {
        echo "<script>
                alert('Data ongkir gagal ditambahkan');
                document.location.href = 'admin.php?halaman=ongkir';
            </script><br />";
        echo mysqli_error($conn);
    }
}
?>
<h2>Tambah Ongkir</h2>

<div class="row">
    <form action="" method="post">
        <div class="md-4">
            <label for="nama_kota">Nama Kota</label>
            <input type="text" name="nama_kota" id="nama_kota" class="form-control">
        </div>
        <div class="md-4">
            <label for="ongkir">Tarif</label>
            <input type="text" name="ongkir" id="ongkir" class="form-control">
        </div>
        <button class="btn btn-success mt-3" name="submit">Tambah</button>
    </form>
</div>