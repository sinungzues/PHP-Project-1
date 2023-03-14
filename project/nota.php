<?php
require 'function.php';
$transaksi = query("SELECT * FROM transaksi JOIN user ON transaksi.id_user = user.id_user
                        JOIN ongkir ON transaksi.id_ongkir = ongkir.id_ongkir
                        WHERE transaksi.id_transaksi='$_GET[id]'");
$transaksi_produk = query("SELECT * FROM transaksi_produk WHERE id_transaksi='$_GET[id]'");

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <title>JASTIP BOX | Nota</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: yellow">
    <a class="navbar-brand" href="index.php?halaman=semua">
      <img src="Assets/Logo.png" width="30" height="30" class="d-inline-block align-top" alt="jastipbox">
      <strong>JASTIP BOX</strong>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <form class="form-inline my-2 my-lg-0 ml-auto" method="post">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off" id="keyword" size="40">
        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="cari" id="tombolcari"><i class="fas fa-search"></i></button>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php?halaman=semua">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="keranjang.php">Keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php">Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="riwayat.php">Riwayat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <?php if (isset($_SESSION["login"])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
  <!-- konten -->
  <div class="container">
    <h1 align="center">Nota Pembayaran</h1>
    <?php foreach ($transaksi as $row) : ?>
      <h5 align="center">No. Pembelian : <?= $row["id_transaksi"]; ?></h5>

      <a href="riwayat.php?id=<?= $row['id_user']; ?>" class="btn btn-info">Riwayat</a>

      <table cellpadding="10" width='100%'>
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
    <div class="row">
      <div class="col-md-7">
        <div class="alert alert-info">
          <p>
            Silahkan melakukan pembayaran Rp. <?= number_format($row["total"]); ?> ke <br>
            <strong>BANK BNI 123456789 A.N Jastip Box</strong>
          </p>
        </div>
      </div>
    </div>

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
    <br>
    <a href="pembayaran.php?id=<?= $row['id_transaksi']; ?>" class="btn btn-success">Pembayaran</a>
  </div>
  <!-- akhir konten -->
  <!-- Footer -->
  <div class="row">
    <div class="col-md-12">
      <div class="footer text-center" style="color: rgb(97, 97, 97);">
        <a href="https://www.instagram.com/jastip_box/" style="text-decoration: none;" target="_blank" class="mr-2"><i class="fab fa-instagram mr-1"></i> jastip_box</a>
        |
        <a href="http://" style="text-decoration: none;" target="_blank" class="ml-2"><i class="fab fa-whatsapp mr-1"></i> 081234567890</a>
        <br>
        <hr width="90%">
        copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script>, JASTIP BOX
      </div>
    </div>
  </div>
  <!-- End Footer -->


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/068aea209a.js" crossorigin="anonymous"></script>
</body>

</html>