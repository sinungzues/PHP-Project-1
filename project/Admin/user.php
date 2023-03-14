<?php
$user = query("SELECT * FROM user");

?>
<h2 align="center">Data User</h2>
<a class="btn btn-success" href="registrasi.php">Tambah Admin</a>

<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Nama User</th>
        <th>No. Telepon</th>
        <th>E-mail</th>
        <th>Aksi</th>
    </tr>
    <?PHP $i = 1; ?>
    <?php foreach ($user as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama_user"]; ?></td>
            <td><?= $row["no_telp"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><a class="btn btn-danger" href="../hapus.php?id=<?= $row['id_user']; ?>" onclick="return confirm('Apakah anda ingin menghapus data?')">Hapus</a></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>