<h1>Data Pembayaran</h1>

<?php
$id_transaksi = $_GET['id'];

$query = query("SELECT * FROM pembayaran WHERE id_transaksi = '$id_transaksi'");

if (isset($_POST['proses'])) {
    $resi = $_POST['no_resi'];
    $status = $_POST['status'];

    $update = query("UPDATE transaksi SET no_resi = '$resi', status_pembelian = '$status'
                        WHERE id_transaksi = '$id_transaksi'");
    echo "<script>alert('Data telah diperbaharui')
                        document.location.href = 'admin.php?halaman=transaksi'</script>";
}

foreach ($query as $row) :
?>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td><?= $row['nama_user'] ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?= $row['jumlah'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= $row['tanggal_pembayaran'] ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <img src="../bukti/<?= $row['bukti'] ?>" alt="Bukti Pembayaran" class="img-fluid">
        </div>
    </div>
<?php endforeach ?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <div class="form-group">
                <label for="resi">No Resi Pengiriman</label>
                <input type="text" name="no_resi" id="resi" class="form-control">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="">--Pilih Status--</option>
                    <option value="Barang Dikirim">Barang Dikirim</option>
                    <option value="Transaksi Dibatalkan">Transaksi Dibatalkan</option>
                </select>
            </div>
            <button class="btn btn-primary" name="proses">Proses</button>
        </form>
    </div>
</div>