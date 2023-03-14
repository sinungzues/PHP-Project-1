<?php
$tgl = date('Y-m-d');
$transaksi_diterima = "SELECT count(id_transaksi) AS jumlah FROM transaksi WHERE tanggal_transaksi = '$tgl'";
$result = mysqli_query($conn, $transaksi_diterima);
$jml_transaksi = mysqli_fetch_array($result);

$user = "SELECT count(id_user) AS jumlah FROM user";
$result = mysqli_query($conn, $user);
$jml_user = mysqli_fetch_array($result);

$transaksi = "SELECT count(id_transaksi) AS jumlah FROM transaksi WHERE status_pembelian = 'Sudah Dibayar' OR status_pembelian = 'Barang Dikirim'";
$result = mysqli_query($conn, $transaksi);
$jml_dijual = mysqli_fetch_array($result);
?>
<h2>Selamat Datang Administrator</h2>
<div class="row mt-5">
    <div class="col-md-3 mr-5">
        <div class="card" style="width: 15rem;">
            <div class="bg-info" style="font-size: 100px;">
                <i class="fas fa-cart-plus ml-2"></i> <?= $jml_transaksi['jumlah'] ?>
            </div>
            <div class="card-body text-center">
                <h4>Pesanan Baru</h4>
                <a href="?halaman=transaksi" class="btn btn-info">Detail</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 ml-5 mr-5">
        <div class="card" style="width: 15rem;">
            <div class="bg-primary" style="font-size: 100px;">
                <i class="fas fa-users ml-2"></i> <?= $jml_user['jumlah'] ?>
            </div>
            <div class="card-body text-center">
                <h4>Jumlah User</h4>
                <a href="?halaman=user" class="btn btn-info">Detail</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 ml-5 mr-5">
        <div class="card" style="width: 15rem;">
            <div class="bg-success" style="font-size: 100px;">
                <i class="fas fa-coins ml-2"></i> <?= $jml_dijual['jumlah'] ?>
            </div>
            <div class="card-body text-center">
                <h4>Transaksi</h4>
                <a href="?halaman=laporan" class="btn btn-info">Detail</a>
            </div>
        </div>
    </div>
</div>