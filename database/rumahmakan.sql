-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Jan 2020 pada 12.48
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumahmakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(15) NOT NULL,
  `kode_kategori_barang` int(2) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_kategori_barang`, `nama_barang`, `harga_jual`, `photo`) VALUES
('BRG001', 1, 'Bakso', 14000, 'bakso.jpg'),
('BRG002', 1, 'Mie Ayam', 14000, 'mie-ayam.jpeg'),
('BRG003', 1, 'Sate', 15000, 'sate.jpg'),
('BRG004', 1, 'Mie Ayam Bakso', 17000, 'mia-ayam-bakso.jpg'),
('BRG005', 2, 'Es Teh', 3000, 'es-teh.jpg'),
('BRG006', 2, 'Es Jeruk', 5000, 'es-jeruk.jpg'),
('BRG007', 2, 'Kopi', 5000, 'kopi.png'),
('BRG008', 2, 'Air Botol Mineral', 5000, 'air-mineral.jpg'),
('BRG009', 2, 'Teh Hangat', 5000, 'teh-hangat.JPG'),
('BRG010', 2, 'Jeruk Hangat', 5000, 'jeruk-hangat.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `kode_detail_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `qty` int(2) NOT NULL,
  `sub_total` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`kode_detail_penjualan`, `kode_penjualan`, `kode_barang`, `qty`, `sub_total`) VALUES
(1, 'P000004', 'BRG002', 1, 20000),
(2, 'P000005', 'BRG002', 1, 20000),
(3, 'P000004', 'BRG003', 1, 15000),
(4, 'P000005', 'BRG002', 2, 40000),
(5, 'P000005', 'BRG004', 2, 10000),
(6, 'P000002', 'BRG002', 1, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `kode_kategori_barang` int(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`kode_kategori_barang`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(15) NOT NULL,
  `kode_user` varchar(5) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_bayar` int(9) NOT NULL,
  `total_harga` int(9) NOT NULL,
  `kembalian` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `kode_user`, `tanggal_penjualan`, `total_bayar`, `total_harga`, `kembalian`) VALUES
('P000001', '6', '2020-01-20', 200000, 190000, 20000),
('P000002', '6', '2020-01-27', 100000, 20000, 80000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `kode_user` int(3) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kode_user`, `nama_user`, `no_hp`, `alamat`, `akses`, `username`, `password`) VALUES
(6, 'Rizkika', '0821123123', 'Jember', 'Kasir', 'kasir', '$2y$10$CUTN1TJXc0eghKs1qqp0oe29uuYvv0hDsbCS/5nutxdmZpC/c5ZAu'),
(7, 'Ma\'arif', '082234523423', 'Lumajang', 'Admin', 'admin', '$2y$10$awWGFBHHlGSNWUAX2XTVpOGVfXb2WJcc6AvbzsE06r6xIgQzGhzy2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`kode_detail_penjualan`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`kode_kategori_barang`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `kode_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `kode_kategori_barang` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
