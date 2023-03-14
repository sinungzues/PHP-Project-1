<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script> alert('Anda harus login')
                    document.location.href = 'login.php';
                    </script>";
  exit;
}
require 'function.php';


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <title>Checkout</title>
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
        <li class="nav-item active">
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
      </tr>

      <?PHP $i = 1; ?>
      <?php $total = 0; ?>
      <?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) : ?>
        <?php $gudang = "SELECT * FROM gudang WHERE id_barang = $id_barang";
        $result = mysqli_query($conn, $gudang);
        $pecah = $result->fetch_assoc();
        $total_harga = $pecah["harga"] * $jumlah; ?>
        <tr>
          <td><?= $i; ?></td>
          <td><?= $pecah["nama_barang"]; ?></td>
          <td>Rp. <?= number_format($pecah["harga"]); ?></td>
          <td><?= $jumlah; ?></td>
          <td>Rp. <?= number_format($total_harga); ?></td>
        </tr>
        <?php $i++; ?>
        <?php $total += $total_harga ?>
      <?php endforeach; ?>
      <tfoot>
        <tr>
          <th colspan="4" class="text-right">Total Belanja</th>
          <th>Rp. <?= number_format($total) ?></th>
        </tr>
      </tfoot>
    </table>
    <form action="" method="post">
      <table>
        <tr>
          <td>Nama Penerima</td>
          <td>:</td>
          <td><input type="text" name="nama_user" value="<?php echo $_SESSION['login']['nama_user'] ?>" readonly></td>
        </tr>
        <tr>
          <td>No. Telepon</td>
          <td>:</td>
          <td><input type="text" name="no_telp" value="<?php echo $_SESSION['login']['no_telp'] ?>"></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td><input type="text" readonly name="tanggal_transaksi" value="<?= date('Y-m-d') ?>"></td>
        </tr>
        <tr>
          <td>Alamat Pengiriman</td>
          <td>:</td>
          <td><textarea name="alamat" cols="25" rows="5"></textarea></td>
        </tr>
        <tr>
          <td>Biaya Ongkir</td>
          <td>:</td>
          <td><select name="id_ongkir" id="">
              <option value="">Pilih Ongkos Kirim</option>
              <?php $ongkir = "SELECT * FROM ongkir";
              $result = mysqli_query($conn, $ongkir);
              while ($pecah = $result->fetch_assoc()) { ?>
                <option value="<?= $pecah['id_ongkir'] ?>"><?= $pecah['nama_kota']; ?> -
                  Rp. <?= number_format($pecah['ongkir']); ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
      </table>
      <button class="btn btn-danger" type="submit" name="checkout">Checkout</button>
    </form>
    <?php
    if (isset($_POST["checkout"])) {
      $id_user = $_SESSION['login']['id_user'];
      $id_ongkir = $_POST['id_ongkir'];
      $tanggal_pembelian = date("Y-m-d");
      $alamat = $_POST['alamat'];

      $query = "SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'";
      $ongkir = mysqli_query($conn, $query);
      $result = $ongkir->fetch_assoc();
      $tarif = $result['ongkir'];
      $total_harga = $total + $tarif;
      $query = query("INSERT INTO transaksi(id_user, id_ongkir, tanggal_transaksi, total, alamat_penerima, tarif_ongkir) 
                            VALUES ('$id_user','$id_ongkir','$tanggal_pembelian','$total_harga','$alamat','$tarif')");

      $id_pembelian_barusan = $conn->insert_id;
      foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) {
        $query = "SELECT * FROM gudang WHERE id_barang = '$id_barang'";
        $gudang = mysqli_query($conn, $query);
        $produk = $gudang->fetch_assoc();

        $nama = $produk['nama_barang'];
        $harga = $produk['harga'];
        $total = $produk['harga'] * $jumlah;
        $result = query("INSERT INTO transaksi_produk(id_transaksi, id_barang, banyak_barang, nama, harga_barang,
                                total_harga) VALUES('$id_pembelian_barusan','$id_barang', '$jumlah', '$nama', '$harga', '$total')");

        // Update Stok
        $stok = "UPDATE gudang SET stok = stok-$jumlah WHERE id_barang = '$id_barang'";
        $update = mysqli_query($conn, $stok);
      }

      unset($_SESSION['keranjang']);

      echo "<script> alert('Pembelian sukses!')
                    document.location.href = 'nota.php?id=$id_pembelian_barusan';
                    </script>";
    }
    ?>
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