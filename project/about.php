<?php
session_start();
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
                <li class="nav-item ">
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
                <li class="nav-item active">
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
        <section class="jumbotron text-center" style="background: none;">
            <img src="Assets/foto2.jpg" alt="Sinung Zuestri Pradana" width="200" class="rounded-circle img-thumbnail">
            <h1 class="display-4">Sinung Zuestri Pradana</h1>
            <p class="lead">L200190080</p>
        </section>
        <div class="row text-center mb-3">
            <div class="col">
                <h2>About Me</h2>
            </div>
        </div>
        <div class="row justify-content-center fs-5 text-center">
            <div class="col-md-4 mb-3">Hai, Saya Sinung Zuestri Pradana, dengan NIM L200190080. Tugas ini bertujuan untuk memenuhi salah satu tugas dari mata kuliah Pemrograman Web Dinamis</div>
            <div class="col-md-4 mb-4">Sebenarnya ini ada penjelasan lagi, tapi karena saya sudah tidak tau mau menulis apa jadi ya begini deh. Biar keliatan banyak aja, terima kasih telah meluangkan waktu untuk membacanya :).</div>
        </div>
        <div class="row text-center mb-3 mt-5">
            <div class="col">
                <h2>Social Media</h2>
            </div>
        </div>
        <div class="row justify-content-center fs-5 text-center" style="font-size: 50px;">
            <div class="col-md-2 mb-3"><a href="https://www.instagram.com/sinungzuestri/" style="color: rgb(97, 97, 97);" target="_blank"><i class="fab fa-instagram mr-1"></i></a></div>
            <div class="col-md-2 mb-3"><a href="https://web.facebook.com/sinungzuestri/" style="color: rgb(97, 97, 97);" target="_blank"><i class="fab fa-facebook-square"></i></a></div>
        </div>
    </div>
    <!-- Akhir Konten -->
    <!-- Footer -->
    <div class="row mt-5">
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