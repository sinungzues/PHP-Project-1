<?php
    $conn = mysqli_connect("localhost", "root", "", "jastipbox");

    error_reporting(E_ALL ^ E_WARNING || E_NOTICE);
    
    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data){
        global $conn;
        $nama_barang = htmlspecialchars($data["nama_barang"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $harga = htmlspecialchars($data["harga"]);
        $gambar = upload();
        $kategori = htmlspecialchars($data["kategori"]);
        $stok = htmlspecialchars($data["stok"]);

        if(!$gambar){
            return false;
        }

        $query = "INSERT INTO gudang VALUES ('','$nama_barang','$deskripsi','$harga','$gambar','$kategori','$stok')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function tambah_ongkir($data){
        global $conn;
        $nama_kota = htmlspecialchars($data["nama_kota"]);
        $ongkir = htmlspecialchars($data["ongkir"]);

        $query = "INSERT INTO ongkir VALUES ('','$nama_kota','$ongkir')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function upload(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if ($error ===4){
            echo "<script>
                    alert('Gambar belum diupload')
                </script>";
                return false;
        }

        $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                    alert('Ekstensi gambar yang dibolehkan adalah jpeg, jpg dan png')
                </script>";
                return false;
        }

        if($ukuranFile > 5000000){
            echo "<script>
                    alert('Gambar melebihi ukuran yang diperbolehkan')
                </script>";
                return false;
        }
        
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

        return $namaFileBaru;
    }

    function upload_pembayaran(){
        $namaFile = $_FILES['bukti']['name'];
        $ukuranFile = $_FILES['bukti']['size'];
        $error = $_FILES['bukti']['error'];
        $tmpName = $_FILES['bukti']['tmp_name'];

        if ($error ===4){
            echo "<script>
                    alert('Gambar belum diupload')
                </script>";
                return false;
        }

        $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                    alert('Ekstensi gambar yang dibolehkan adalah jpeg, jpg dan png')
                </script>";
                return false;
        }

        if($ukuranFile > 5000000){
            echo "<script>
                    alert('Gambar melebihi ukuran yang diperbolehkan')
                </script>";
                return false;
        }
        
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'bukti/'. $namaFileBaru);

        return $namaFileBaru;
    }

    function edit($data){
        global $conn;
        $id_barang = $data["id_barang"];
        $nama_barang = htmlspecialchars($data["nama_barang"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $harga = htmlspecialchars($data["harga"]);
        $kategori = htmlspecialchars($data["kategori"]);
        $stok = htmlspecialchars($data["stok"]);
        $gambarLama = htmlspecialchars($data["gambarLama"]);

        if($_FILES['gambar']['error'] === 4){
            $gambar = $gambarLama;
        }
        else{
            $gambar = upload();
        }

        $query = "UPDATE gudang SET nama_barang = '$nama_barang', deskripsi = '$deskripsi', harga = '$harga', gambar = '$gambar', kategori = '$kategori', 
                    stok = '$stok' WHERE id_barang = $id_barang";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function registrasi_user($data){
        global $conn;

        $username = htmlspecialchars($data["nama_user"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $no_telp = $_POST['no_telp'];
        $email = strtolower($data["email"]);

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username, email FROM user WHERE username = '$username' OR email = '$email'");

        if(mysqli_fetch_assoc($result)){
            echo "<script>alert('Username/Email sudah terdaftar')</script>";
            return false;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<script>alert('Alamat email tidak sesuai')</script>";
            return false;
        }
        
        // cek konfirmasi password
        if($password !== $password2){
            echo "<script>alert('konfirmasi password tidak sesuai')</script>";
            return false;
        }
        

        // enskripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan user baru ke DB
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$email','$password','$no_telp')");
        return mysqli_affected_rows($conn);
    }
    function registrasi_admin($data){
        global $conn;

        $username = strtolower($data["username"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $nama_lengkap = htmlspecialchars($data['nama_lengkap']);

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

        if(mysqli_fetch_assoc($result)){
            echo "<script>alert('Username sudah terdaftar')</script>";
            return false;
        }
        
        // cek konfirmasi password
        if($password !== $password2){
            echo "<script>alert('konfirmasi password tidak sesuai')</script>";
            return false;
        }
        

        // enskripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan user baru ke DB
        mysqli_query($conn, "INSERT INTO admin VALUES('', '$username','$password','$nama_lengkap')");
        return mysqli_affected_rows($conn);
    }
    function cari($keyword){
        $query = "SELECT * FROM gudang WHERE 
                    nama_barang LIKE '%$keyword%' OR
                    kategori LIKE '%$keyword%'";
        return query($query);
    }
