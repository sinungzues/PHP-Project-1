<?php
    session_start();
    $id_barang = $_GET['id'];

    unset($_SESSION["keranjang"][$id_barang]);
    echo "<script>alert('Barang berhasil dihapus dari keranjang')
            document.location.href = 'keranjang.php';
            </script>";
