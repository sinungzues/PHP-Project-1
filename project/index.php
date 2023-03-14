<?php
session_start();
require "function.php";

$gudang = query("SELECT * FROM gudang WHERE stok NOT LIKE 0");

if (isset($_POST["cari"])) {
  $gudang = cari($_POST["keyword"]);
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <title>JASTIP BOX</title>
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
  <main>
    <div class="d-flex flex-column">
      <div class="container pt-2">
        <!-- Content -->
        <?php if (isset($_POST['cari'])) : ?>
          <?php if (empty($gudang)) : ?>
            <h1 class="pb-3">Barang "<?= $_POST['keyword'] ?>"" tidak ditemukan</h1>
          <?php else : ?>
            <h1 class="pb-3">Hasil Pencarian</h1>
          <?php endif ?>
        <?php else : ?>
          <h1 class="pb-3">Selamat Datang Di Toko Kami</h1>
          <div class="kategori">
            <ul>
              <li>
                <a class="nav-link" href="index.php?halaman=semua">Semua</a>
              </li>
              <li>
                <a class="nav-link" href="index.php?halaman=pakaian_pria">Pakaian Pria</a>
              </li>
              <li>
                <a class="nav-link" href="index.php?halaman=pakaian_wanita">Pakaian Wanita</a>
              </li>
              <li>
                <a class="nav-link" href="index.php?halaman=jilbab">Jilbab</a>
              </li>
              <li>
                <a class="nav-link" href="index.php?halaman=tas">Tas</a>
              </li>
              <li>
                <a class="nav-link" href="index.php?halaman=sepatu_sandal">Sepatu & Sandal</a>
              </li>
            </ul>
          </div>
        <?php endif ?>
        <div class="row">
          <?php
          if (isset($_GET['halaman'])) {
            if ($_GET['halaman'] == 'semua') {
              include 'home.php';
            } elseif ($_GET['halaman'] == 'pakaian_pria') {
              include 'pakaian_pria.php';
            } elseif ($_GET['halaman'] == 'pakaian_wanita') {
              include 'pakaian_wanita.php';
            } elseif ($_GET['halaman'] == 'jilbab') {
              include 'jilbab.php';
            } elseif ($_GET['halaman'] == 'tas') {
              include 'tas.php';
            } elseif ($_GET['halaman'] == 'sepatu_sandal') {
              include 'sepatusandal.php';
            } elseif ($_GET['halaman'] == 'homesepatu_sandal') {
              include 'home.php';
            }
          } else {
            include 'home.php';
          }
          ?>
        </div>
      </div>
    </div>
    </div>
  </main>
  <a class="wafixed" href="https://wa.me/6285732514711" target="_blank"><span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x text-success"></i>
      <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
    </span></a>
  <!-- End COntent -->
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