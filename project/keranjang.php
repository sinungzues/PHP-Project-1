<?php
error_reporting(E_ALL ^ E_WARNING || E_NOTICE);
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script> alert('Anda harus login')
                    document.location.href = 'login.php';
                    </script>";
  exit;
}
$conn = mysqli_connect("localhost", "root", "", "jastipbox");
$id_barang = $_GET['id_barang'];

if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
  echo "<script>alert('Keranjang kosong, silahkan belanja dulu')
            document.location.href = 'index.php?halaman=semua';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <title>JASTIP BOX | Keranjang</title>
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
        <li class="nav-item active">
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
    <h1>Keranjang Belanja</h1>
    <table class="table table-bordered">
      <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>SubTotal</th>
        <th></th>
      </tr>

      <?PHP $i = 1; ?>
      <?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) : ?>
        <?php $gudang = "SELECT * FROM gudang WHERE id_barang = $id_barang";
        $result = mysqli_query($conn, $gudang);
        $pecah = $result->fetch_assoc(); ?>
        <tr>
          <td><?= $i; ?></td>
          <td><?= $pecah["nama_barang"]; ?></td>
          <td>Rp. <?= number_format($pecah["harga"]); ?></td>
          <td><?= $jumlah; ?></td>
          <td>Rp. <?= number_format($pecah["harga"] * $jumlah); ?></td>
          <td><a href="hapuskeranjang.php?id=<?= $id_barang; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
        </tr>

        <?php $i++; ?>

      <?php endforeach; ?>
    </table>
    <a href="index.php" class="btn btn-success">Lanjutkan Belanja</a>
    <a href="checkout.php" class="btn btn-danger">Checkout</a>
  </div>
  <!-- End Konten -->
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