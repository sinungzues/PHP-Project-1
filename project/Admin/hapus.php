<?php
    $id_barang = $_GET["id_barang"];
    $hapus = mysqli_query($conn, "DELETE FROM gudang WHERE id_barang = $id_barang");

    if($hapus > 0){
        echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'admin.php?halaman=produk';
            </script>";
        }
    else{
        echo "<script>
                alert('Data gagal dihapus');
                document.location.href = 'admin.php?halaman=produk';
            </script><br />";
        echo mysqli_error($conn);
    }
