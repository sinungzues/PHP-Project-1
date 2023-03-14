<?php
$gudang = query("SELECT * FROM gudang WHERE kategori = 'Pakaian Pria' AND stok NOT LIKE 0");
?>
<?php foreach ($gudang as $row) : ?>
  <div class="col-md-3 pb-3">
    <div class="card" style="width: 17rem;">
      <img src="img/<?= $row["gambar"]; ?>" alt="<?= $row["nama_barang"]; ?>" class="card-img-top img-thumbnail img-fluid">
      <div class="card-body">
        <h4><?= $row["nama_barang"]; ?></h4>
        <h5>Rp. <?= number_format($row["harga"]); ?></h5>
        <a href="beli.php?id=<?= $row["id_barang"]; ?>" class="btn btn-warning" style="font-size: 14px;"><i class="fas fa-cart-plus"></i> Tambahkan</a>
        <a href="detail.php?id=<?= $row["id_barang"]; ?>" class="btn btn-primary" style="font-size: 14px;">Detail</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>