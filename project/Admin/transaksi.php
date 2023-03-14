<?php
$transaksi = query("SELECT * FROM transaksi JOIN user ON transaksi.id_user=user.id_user");

?>
<h2 align="center">Data Transaksi</h2>

<table class="table table-bordered">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Transaksi</th>
            <th>Total</th>
            <th>Status Pembayaran</th>
            <!-- <th>Aksi</th> -->
        </tr>
    </thead>
    <tbody class="text-center">
        <?PHP $i = 1; ?>
        <?php foreach ($transaksi as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $row["nama_user"]; ?></td>
                <td><?= $row["tanggal_transaksi"]; ?></td>
                <td>Rp. <?= number_format($row["total"]); ?></td>
                <td><?= $row["status_pembelian"]; ?></td>
                <td><a class="btn btn-info" href="admin.php?halaman=detail&id=<?= $row['id_transaksi']; ?>">Detail</a>
                    <?php if ($row['status_pembelian'] !== "Menunggu Pembayaran") : ?>
                        <a class="btn btn-success" href="admin.php?halaman=pembayaran&id=<?= $row['id_transaksi']; ?>">Pembayaran</a>
                </td>
            <?php endif ?>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>