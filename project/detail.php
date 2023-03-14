<?php
session_start();
require 'function.php';

$id_barang = $_GET['id'];
$gudang = query("SELECT * FROM gudang WHERE id_barang = '$id_barang'");

$komentar = query("SELECT * FROM ulasan JOIN user ON ulasan.id_user = user.id_user WHERE id_barang = '$id_barang'");

if (isset($_POST['submit'])) {
  $id_user = $_SESSION['login']['id_user'];
  $ulasan = $_POST['ulasan'];

  $query = query("INSERT INTO ulasan VALUES('','$id_barang','$id_user','$ulasan')");

  echo "<script> alert('Ulasan Berhasil Ditambahkan')
                    document.location.href = 'detail.php?id=$id_barang';
                    </script>";
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
  <!-- Konten -->
  <div class="d-flex flex-column mb-5">
    <div class="container pb-5">
      <?php foreach ($gudang as $row) : ?>
        <div class="row pt-5">
          <div class="col-md-6 text-center">
            <img src="img/<?= $row["gambar"]; ?>" alt="<?= $row["nama_barang"]; ?>" width="400px">
          </div>
          <div class="col-md-6">
            <h2><?= $row["nama_barang"]; ?></h2>
            <h4>Rp. <?= number_format($row["harga"]); ?></h4>
            <h6>Stok : <?= $row['stok']; ?></h5>
              <p><?= $row["deskripsi"]; ?></p>
              <form action="" method="post">
                <input type="number" min="1" max="<?= $row['stok']; ?>" name="jumlah">
                <button name="beli" class="btn btn-warning"><i class="fas fa-cart-plus"></i> Tambahkan</button>
              </form>
          </div>
        </div>
      <?php endforeach; ?>
      <?php
      if (isset($_POST['beli'])) {
        $jumlah = $_POST['jumlah'];
        $_SESSION['keranjang'][$id_barang] = $jumlah;
        echo "<script> alert('Barang berhasil ditambahkan')
                    document.location.href = 'keranjang.php';
                    </script>";
      }
      ?>
      <hr class="mt-5">
      <strong>Ulasan</strong>
      <br>
      <br>
      <?php foreach ($komentar as $row) : ?>
        <table style="border-bottom: 1px solid black;" width="100%" cellpadding="10">
          <tr>
            <td><strong><?= $row['nama_user']; ?></strong></td>
          </tr>
          <tr>
            <td><?= $row['ulasan']; ?></td>
          </tr>
        </table>
      <?php endforeach ?>
      <br><br>

      <form action="" method="post">
        <label for="ulasan">Tambahkan Ulasan :</label>
        <textarea name="ulasan" id="ulasan" rows="3" class="form-control"></textarea>
        <button class="btn btn-success mt-2 mb-5" name="submit" type="submit">Tambahkan</button>
      </form>
    </div>
  </div>
  <!-- End Konten -->
  <!-- Footer -->
  <div class="row pt-5">
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