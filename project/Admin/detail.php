<?php
$transaksi = query("SELECT * FROM transaksi JOIN user ON transaksi.id_user = user.id_user
                        JOIN ongkir ON transaksi.id_ongkir = ongkir.id_ongkir
                        WHERE transaksi.id_transaksi='$_GET[id]'");
$transaksi_produk = query("SELECT * FROM transaksi_produk WHERE id_transaksi='$_GET[id]'");

?>
<a href="admin.php?halaman=transaksi"><button class="btn-danger"><i class="fas fa-arrow-left"></i> Kembali</button></a>
<h1>Detail Transaksi</h1>
<?php foreach ($transaksi as $row) : ?>
    <h5>No. Transaksi : <?= $row["id_transaksi"]; ?></h5>

    <table cellpadding="10" class="table">
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><?= $row["nama_user"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Tanggal Transaksi</td>
            <td>:</td>
            <td><?= $row["tanggal_transaksi"]; ?></td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td>:</td>
            <td><?= $row["no_telp"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Biaya Ongkir</td>
            <td>:</td>
            <td><?= $row["ongkir"]; ?></td>
        </tr>
        <tr>
            <td>Alamat Pengiriman</td>
            <td>:</td>
            <td><?= $row["alamat_penerima"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Total Pembayaran</td>
            <td>:</td>
            <td><?= $row["total"]; ?></td>
        </tr>
    </table>
<?php endforeach; ?>

<br>

<table class="border table-bordered" width="100%" style="text-align: center;">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">No</th>
            <th scope="col" style="text-align: center;">Nama Barang</th>
            <th scope="col" style="text-align: center;">Harga</th>
            <th scope="col" style="text-align: center;">Banyak Barang</th>
            <th scope="col" style="text-align: center;">Subtotal</th>
        </tr>
    </thead>

    <?PHP $i = 1; ?>
    <?php foreach ($transaksi_produk as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td>Rp. <?= number_format($row["harga_barang"]); ?></td>
            <td><?= $row["banyak_barang"]; ?></td>
            <td>Rp. <?= number_format($row["banyak_barang"] * $row["harga_barang"]); ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>