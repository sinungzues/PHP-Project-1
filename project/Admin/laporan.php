<?php
$tgl1 = "-";
$tgl2 = "-";
if (isset($_POST['cari'])) {
    $tgl1 = $_POST['tgl1'];
    $tgl2 = $_POST['tgl2'];
    $laporan = query("SELECT * FROM transaksi JOIN user ON transaksi.id_user = user.id_user
                        WHERE status_pembelian = 'Barang Dikirim' OR status_pembelian = 'Sudah Dibayar' 
                        AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2'");
}
?>

<h2>Laporan Penjualan dari <?= $tgl1; ?> sampai <?= $tgl2; ?></h2>
<hr>

<form action="" method="post">
    <div class="row">
        <div class="col-md-5">
            <label for="tgl1">Tanggal Awal</label>
            <input type="date" id="tgl1" class="form-control" name="tgl1" value="<?= $tgl1; ?>">
        </div>
        <div class="col-md-5">
            <label for="tgl2">Tanggal Akhir</label>
            <input type="date" id="tgl2" class="form-control" name="tgl2" value="<?= $tgl2; ?>">
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" name="cari">Cari</button>
        </div>
    </div>
</form>
<br>

<table class="table table-bordered">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama Pembeli</th>
            <th>Tanggal Pembelian</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <?php $i = 1;
    $total = 0; ?>
    <?php foreach ($laporan as $row) : ?>
        <?php $total += $row['total'] ?>
        <tbody>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['nama_user']; ?></td>
                <td><?= $row['tanggal_transaksi']; ?></td>
                <td>Rp. <?= number_format($row['total']); ?></td>
            </tr>
        </tbody>
        <?php $i++; ?>
    <?php endforeach ?>
    <tfoot>
        <th colspan="3" class="text-right">Total</th>
        <th>Rp. <?= $total ?></th>
    </tfoot>
</table>