<?php
require '../function.php';

if (isset($_POST["register"])) {
    if (registrasi_admin($_POST) > 0) {
        echo "<script> alert('User berhasil ditambahkan')
                    document.location.href = 'admin.php?halaman=user';
                    </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jastip Box | Tambah Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: yellow">
        <a class="navbar-brand" href="admin.php">
            <img src="../Assets/Logo.png" width="30" height="30" class="d-inline-block align-top" alt="jastipbox">
            <strong>JASTIP BOX</strong>
        </a>
    </nav>
    <!-- End Navbar -->
    <a href="admin.php?halaman=user"><button class="btn-danger">Kembali</button></a>
    <div class="container">
        <div class="img">
            <img src="../Assets/Signup.png">
        </div>
        <div class="login-container">
            <form action="" method="post">
                <img class="logo" src="../Assets/Logo.png" alt="" srcset="">
                <h2>Tambah Admin</h2>
                <div class="input-div username">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <input class="input" type="text" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="input-div username">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div>
                        <input class="input" type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
                    </div>
                </div>
                <div class="input-div password">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>

                        <input class="input" type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="input-div password">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>

                        <input class="input" type="password" name="password2" placeholder="Confirm Password" required>
                    </div>
                </div>
                <input class="btn" type="submit" value="Tambah" name="register">
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <ul>
            <li><a href="https://www.instagram.com/jastip_box/" style="text-decoration: none; color: #EAEAEA" target="_blank"><i class="fab fa-instagram"></i> jastip_box</a></li>
            <li>|</li>
            <li><a href="http://" style="text-decoration: none; color: #EAEAEA" target="_blank"><i class="fab fa-whatsapp"></i> 081234567890</a></li>
            <p>copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script>, JASTIP BOX</p>
        </ul>
    </div>
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/068aea209a.js" crossorigin="anonymous"></script>
</body>

</html>