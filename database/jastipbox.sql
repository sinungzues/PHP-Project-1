-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2023 pada 13.12
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jastipbox`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$nxg9mJK.qt2ycC73flNzO.iUxh9RFsDu5vMoYErVcQgI8jIr0jtsm', 'Admin1'),
(2, 'sinungzues', '$2y$10$92uLb3JwVOxH2R4F3mWuoOUNWSiGINCJVbmYY1i.uyLnfy3iVMmEy', 'Admin2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id_barang`, `nama_barang`, `deskripsi`, `harga`, `gambar`, `kategori`, `stok`) VALUES
(1, 'EAZYDRY TESS', 'Bismillah, OPEN JASTIP EAZYDRY BASIC TESS @preppstudio | KAMIS, 30/12/21 JAM 20.00', 139000, '61c91a27e8ad7.jpg', 'Pakaian Pria', 5),
(2, 'DEANA DRESS', 'bismillah, OPEN JASTIP DEANA DRESS @gonegani | Jumat, 31/12/21 jam 15.00', 149000, '61ca5e516c851.jpg', 'Pakaian Wanita', 5),
(3, 'ODELLA BAG', 'Bismillah, OPEN JASTIP ODELLA BAG @heylocal.id | Kamis, 30/12/21 jam 10.00', 295000, '61ca5fc8e8b92.jpg', 'Tas', 5),
(4, 'ULTIMATE FLANNEL', 'Bismillah, OPEN JASTIP ULTIMATE FLANNEL @preppstudio | Rabu, 29/12/21 jam 20.00', 210000, '61ca608c669fa.jpg', 'Pakaian Pria', 5),
(5, 'DONA BLOUSE', 'OPEN JASTIP DONA BLOUSE @dianarestu | Rabu, 29/12/21 jam 09.00', 177000, '61ca6141c40a3.jpg', 'Pakaian Wanita', 5),
(6, 'HAZEL MONOGRAM', 'Bismillah, OPEN JASTIP HAZEL MONOGRAM @heaven_lights\r\n\r\n| Senin, 27/12/21\r\njam 09.00', 230000, '61ca61b3525e8.jpg', 'Jilbab', 5),
(7, 'LONDON BAG', 'Bismillah, OPEN JASTIP LONDON BAG @heylocal.id | Selasa, 28/12/21 jam 10.00', 315000, '61ca6219b769c.jpg', 'Tas', 5),
(8, 'LAFS SCARF', 'Bismillah, OPEN JASTIP LAFS SCARF @heylocal.id | Senin, 03/01/22 jam 10.00', 189000, '61ca63f6ed783.jpg', 'Jilbab', 5),
(9, 'POLO SHIRT', 'Bismillah, OPEN JASTIP POLO SHIRT @heaven_lightsmen\n\n| Jumat, 31/12/21\njam 10.00', 140000, '61ca85143cf7c.jpg', 'Pakaian Pria', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `ongkir`) VALUES
(1, 'Boyolali', 15000),
(2, 'Solo', 20000),
(3, 'Semarang', 25000),
(4, 'JABODETABEK', 45000),
(5, 'Salatiga', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` int(11) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `tarif_ongkir` int(11) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Menunggu Pembayaran',
  `no_resi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id_transaksi_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `banyak_barang` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_komen` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ulasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id_transaksi_produk`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_komen`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id_transaksi_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
