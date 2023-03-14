<?php
   session_start();
   if(!isset($_SESSION["login"])){
    echo "<script> alert('Anda harus login')
                document.location.href = 'login.php';
                </script>";
    exit;
    }
   $id_barang = $_GET['id'];


    if(isset($_SESSION['keranjang'][$id_barang]))
    {
        $_SESSION['keranjang'][$id_barang]+=1;
    }
    else
    {
        $_SESSION['keranjang'][$id_barang] = 1;
    }

    echo "<script> alert('Barang berhasil ditambahkan')
    document.location.href = 'keranjang.php';
    </script>";
