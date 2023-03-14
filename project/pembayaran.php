<?php
session_start();
require 'function.php';

$id_transaksi = $_GET['id'];
$transaksi = query("SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <title>JASTIP BOX | Pembayaran</title>
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
        <li class="nav-item">
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
  <!-- Konten -->
  <div class="container">
    <h2>Konfirmasi Pembayaran</h2>
    <p>Silahkan kirim bukti pembayaran Anda</p>
    <?php foreach ($transaksi as $row) : ?>

      <div class="alert alert-info">
        Total tagihan Anda <strong>Rp. <?= number_format($row['total']); ?></strong>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        <table>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama"></td>
          </tr>
          <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td><input type="text" name="jumlah" id=""></td>
          </tr>
          <tr>
            <td>Bukti</td>
            <td>:</td>
            <td><input type="file" name="bukti"></td>
          </tr>
          <tr>
            <td><button class="btn btn-primary" name="kirim">Kirim</button></td>
          </tr>
        </table>
      <?php endforeach ?>
      <?php
      if (isset($_POST['kirim'])) {
        $nama = $_POST['nama'];
        $jumlah = $_POST['jumlah'];
        $tanggal = date('Y-m-d');
        $bukti = upload_pembayaran();

        $query = "INSERT INTO pembayaran VALUES('','$id_transaksi','$nama','$jumlah','$tanggal','$bukti')";
        $pembayaran = mysqli_query($conn, $query);

        $query_update = "UPDATE transaksi SET status_pembelian = 'Sudah Dibayar'
                                            WHERE id_transaksi = '$id_transaksi'";
        $update = mysqli_query($conn, $query_update);

        echo "<script>alert('Terima Kasih Telah Mengirimkan Bukti Transaksi, Silahkan tunggu barang Anda')
                                document.location.href = 'riwayat.php';</script>";
      }
      ?>
      </form>
  </div>
  <!-- Akhir konten -->
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