-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 16. Agustus 2021 jam 01:19
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cafelarva`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE IF NOT EXISTS `tb_menu` (
  `kode_menu` varchar(8) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga` int(10) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  PRIMARY KEY (`kode_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`kode_menu`, `nama_menu`, `satuan`, `harga`, `keterangan`) VALUES
('LV0001', 'Larva Lemon Tea Original Small', 'Cup Small', 11000, '-'),
('LV0002', 'Larva Coffe Chocolate Large', 'Cup Large', 15000, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tb_pembayaran` (
  `kode_pembayaran` varchar(8) NOT NULL,
  `kode_pesanan` varchar(8) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_uang` int(10) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_pembayaran`),
  KEY `kode_pesanan` (`kode_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`kode_pembayaran`, `kode_pesanan`, `tanggal_pembayaran`, `jumlah_uang`, `keterangan`, `username`) VALUES
('B00001', 'P00001', '2021-07-24', 70000, '-', 'superadmin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan_detail`
--

CREATE TABLE IF NOT EXISTS `tb_pesanan_detail` (
  `id_detail_pesanan` int(5) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(8) NOT NULL,
  `kode_menu` varchar(8) NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` int(10) NOT NULL,
  PRIMARY KEY (`id_detail_pesanan`),
  KEY `kode_pesanan` (`kode_pesanan`),
  KEY `kode_menu` (`kode_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tb_pesanan_detail`
--

INSERT INTO `tb_pesanan_detail` (`id_detail_pesanan`, `kode_pesanan`, `kode_menu`, `qty`, `harga`) VALUES
(3, 'P00001', 'LV0002', 2, 15000),
(4, 'P00001', 'LV0001', 3, 11000),
(5, 'P00002', 'LV0002', 2, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan_header`
--

CREATE TABLE IF NOT EXISTS `tb_pesanan_header` (
  `kode_pesanan` varchar(8) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pesanan_header`
--

INSERT INTO `tb_pesanan_header` (`kode_pesanan`, `tanggal_pesanan`, `keterangan`, `username`) VALUES
('P00001', '2021-07-24', '-', 'superadmin'),
('P00002', '2021-08-08', 'Yakult', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `level`) VALUES
('admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin'),
('aris.yunanto', '827ccb0eea8a706c4c34a16891f84e7b', 'Pelayan'),
('kasir', '827ccb0eea8a706c4c34a16891f84e7b', 'Kasir'),
('koki', '827ccb0eea8a706c4c34a16891f84e7b', 'Koki'),
('owner', '827ccb0eea8a706c4c34a16891f84e7b', 'Owner');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`kode_pesanan`) REFERENCES `tb_pesanan_header` (`kode_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pesanan_detail`
--
ALTER TABLE `tb_pesanan_detail`
  ADD CONSTRAINT `tb_pesanan_detail_ibfk_1` FOREIGN KEY (`kode_menu`) REFERENCES `tb_menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pesanan_detail_ibfk_2` FOREIGN KEY (`kode_pesanan`) REFERENCES `tb_pesanan_header` (`kode_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
