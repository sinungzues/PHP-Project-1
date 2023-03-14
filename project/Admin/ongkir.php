<?php
$ongkir = query("SELECT * FROM ongkir");
?>

<h2 align="center">Data Ongkir</h2>
<a class="btn btn-success" href="admin.php?halaman=tambah_ongkir">Tambah Ongkir</a>
<p></p>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kota</th>
                    <th>Ongkir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?PHP $i = 1; ?>
            <?php foreach ($ongkir as $row) : ?>
                <tbody>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["nama_kota"]; ?></td>
                        <td>Rp. <?= number_format($row["ongkir"]); ?></td>
                        <td><a class="btn btn-danger" href="admin.php?halaman=hapus&id_barang=<?= $row['id_barang']; ?>" onclick="return confirm('Apakah anda ingin menghapus data?')">Hapus</a>
                        </td>
                    </tr>
                </tbody>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="col-md-3"></div>
</div>