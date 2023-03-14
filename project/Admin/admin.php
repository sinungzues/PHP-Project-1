<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script> alert('Anda harus login')
                  document.location.href = 'login.php';
                  </script>";
  exit;
}
require "../function.php";

if (isset($_POST["cari"])) {
  $gudang = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/admiin.css">
  <title>JASTIP BOX | Admin</title>
</head>

<body>
  <!-- Side Bar -->
  <div class="row no-gutters">
    <div class="col-md-2 pr-3 pt-5" style="background-color: #3d3d3d;">
      <ul class="nav flex-column ml-3 mb-5 pb-5 pt-2 fixed-start">
    <li class="nav-item text-center pb-4 text-white">
      <img src="../Assets/Logo.png" alt="JastipBox" width="70px">
      <p style="font-size: 36px;">ADMIN</p>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" aria-current="page" href="admin.php?halaman=home"><i class="fas fa-th-large mr-2"></i> Dashboard</a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="admin.php?halaman=produk"><i class="fas fa-store mr-2"></i> Produk</a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="admin.php?halaman=user"><i class="fas fa-user mr-2"></i> User</a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="admin.php?halaman=ongkir"><i class="fas fa-truck mr-2"></i> Ongkir</a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="admin.php?halaman=transaksi"><i class="fas fa-shopping-cart mr-2"></i> Transaksi</a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="admin.php?halaman=laporan"><i class="fas fa-file mr-2"></i> Laporan Penjualan</a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
      <hr class="bg-secondary">
    </li>
  </ul>
    </div>
    <!-- End Side bar -->
    <div class="col-md-10"  style="font-family: 'Poppins', sans-serif;">
      <div class="container pt-4">
        <?php
        if (isset($_GET['halaman'])) {
          if ($_GET['halaman'] == 'produk') {
            include 'produk.php';
          } elseif ($_GET['halaman'] == 'transaksi') {
            include 'transaksi.php';
          } elseif ($_GET['halaman'] == 'user') {
            include 'user.php';
          } elseif ($_GET['halaman'] == 'detail') {
            include 'detail.php';
          } elseif ($_GET['halaman'] == 'tambah') {
            include 'tambah.php';
          } elseif ($_GET['halaman'] == 'tambah_ongkir') {
            include 'tambah_ongkir.php';
          } elseif ($_GET['halaman'] == 'ubah') {
            include 'ubah.php';
          } elseif ($_GET['halaman'] == 'hapus') {
            include 'hapus.php';
          } elseif ($_GET['halaman'] == 'pembayaran') {
            include 'pembayaran.php';
          } elseif ($_GET['halaman'] == 'laporan') {
            include 'laporan.php';
          } elseif ($_GET['halaman'] == 'ongkir') {
            include 'ongkir.php';
          } elseif ($_GET['halaman'] == 'logout') {
            include 'logout.php';
          } elseif ($_GET['halaman'] == 'home') {
            include 'home.php';
          }
        } else {
          include 'home.php';
        }
        ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/068aea209a.js" crossorigin="anonymous"></script>
</body>

</html>
