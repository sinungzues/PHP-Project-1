<?php
$gudang = query("SELECT * FROM gudang");
?>
<h2 align="center">Data Barang</h2>
<a class="btn btn-success" href="admin.php?halaman=tambah">Tambah Barang</a>
<p></p>
<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?PHP $i = 1; ?>
    <?php foreach ($gudang as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama_barang"]; ?></td>
            <td><?= $row["deskripsi"]; ?></td>
            <td>Rp. <?= number_format($row["harga"]); ?></td>
            <td><?= $row["kategori"]; ?></td>
            <td><?= $row["stok"]; ?></td>
            <td><img src="../img/<?= $row["gambar"]; ?>" width="50"></td>
            <td><a class="btn btn-warning" href="admin.php?halaman=ubah&id_barang=<?= $row['id_barang']; ?>">Edit</a>
                <a class="btn btn-danger" href="admin.php?halaman=hapus&id_barang=<?= $row['id_barang']; ?>" onclick="return confirm('Apakah anda ingin menghapus data?')">Hapus</a>
            </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>