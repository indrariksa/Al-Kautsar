-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 05:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alkautsar`
--

-- --------------------------------------------------------

--
-- Table structure for table `domba`
--

CREATE TABLE `domba` (
  `domba_id` varchar(11) NOT NULL,
  `domba_kelas` varchar(30) NOT NULL,
  `domba_deskripsi` varchar(30) NOT NULL,
  `domba_status` int(5) NOT NULL COMMENT '1=Aktif, 0=Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domba`
--

INSERT INTO `domba` (`domba_id`, `domba_kelas`, `domba_deskripsi`, `domba_status`) VALUES
('D001', 'A', 'Domba kelas A', 1),
('D002', 'B', 'Domba kelas B', 1),
('D003', 'C', 'Domba kelas C', 1),
('D004', 'D', 'Domba kelas D', 1),
('D005', 'Istimewa', 'Domba kelas Istimewa', 1),
('D006', 'Super', 'Domba kelas Super', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hewan`
--

CREATE TABLE `hewan` (
  `hewan_id` varchar(11) NOT NULL,
  `hewan_kelas` varchar(30) NOT NULL,
  `hewan_deskripsi` varchar(30) NOT NULL,
  `hewan_jenis` enum('sapi','domba') NOT NULL,
  `hewan_harga` int(11) NOT NULL,
  `hewan_status` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hewan`
--

INSERT INTO `hewan` (`hewan_id`, `hewan_kelas`, `hewan_deskripsi`, `hewan_jenis`, `hewan_harga`, `hewan_status`) VALUES
('D001', 'A', 'Domba kelas A', 'domba', 2600000, 1),
('D002', 'B', 'Domba kelas B', 'domba', 2400000, 1),
('D003', 'C', 'Domba kelas C', 'domba', 2200000, 1),
('D004', 'D', 'Domba kelas D', 'domba', 2000000, 1),
('D005', 'Istimewa', 'Domba kelas Istimewa', 'domba', 3000000, 1),
('D006', 'Super', 'Domba kelas Super', 'domba', 3300000, 1),
('S001', 'A', 'Sapi kelas A', 'sapi', 28000000, 1),
('S002', 'B', 'Sapi kelas B', 'sapi', 26000000, 1),
('S003', 'C', 'Sapi kelas C', 'sapi', 24000000, 1),
('S004', 'D', 'Sapi kelas D', 'sapi', 22500000, 1),
('S005', 'Istimewa', 'Sapi kelas Istimewa', 'sapi', 30500000, 1),
('S006', 'Super', 'Sapi kelas Super', 'sapi', 34000000, 1),
('S100', 'Gile', 'Sapi kelas gile', 'sapi', 50000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_detail`
--

CREATE TABLE `pembayaran_detail` (
  `pembayaran_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `id_user_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran_detail`
--

INSERT INTO `pembayaran_detail` (`pembayaran_id`, `no_faktur`, `dibayar`, `tgl_pembayaran`, `id_user_bayar`) VALUES
(1, 'AK-0220RQUU', 12000000, '2020-02-18 09:37:11', 1),
(2, 'AK-0220RQUU', 5000000, '2020-02-18 09:38:18', 1),
(3, 'AK-0220RQUU', 15000000, '2020-02-18 11:11:05', 1),
(8, 'AK-02206SP9', 3000000, '2020-02-19 10:32:08', 2),
(9, 'AK-02206SP9', 1800000, '2020-02-19 10:32:30', 2),
(10, 'AK-0220ZP7W', 30600000, '2020-02-19 10:40:58', 2),
(11, 'AK-RPYPV190220', 20000000, '2020-02-19 14:53:55', 4),
(12, 'AK-PJX3E190220', 20000000, '2020-02-19 15:13:38', 4),
(13, 'AK-H0N4C190220', 1500000, '2020-02-19 15:28:22', 4),
(14, 'AK-RPYPV190220', 10600000, '2020-02-19 15:32:42', 4),
(15, 'AK-JK0TX080720', 600000, '2020-07-08 22:04:11', 3),
(16, 'AK-LA2FW080720', 600000, '2020-07-08 22:14:39', 3),
(17, 'AK-LA2FW080720', 2000000, '2020-07-08 22:53:13', 3),
(19, 'AK-H83BI080720', 2000000, '2020-07-08 23:38:06', 3),
(20, 'AK-R69X3090720', 2000000, '2020-07-09 00:17:01', 3),
(21, 'AK-JK0TX080720', 2000000, '2020-07-09 00:30:29', 3),
(22, 'AK-ATWPF090720', 2000000, '2020-07-09 00:51:31', 3),
(23, 'AK-YUODT090720', 2000000, '2020-07-09 00:52:32', 3),
(24, 'AK-PJX3E190220', 6600000, '2020-07-09 00:53:43', 3),
(25, 'AK-H0N4C190220', 700000, '2020-07-09 00:53:53', 3),
(26, 'AK-4XLGQ090720', 2000000, '2020-07-09 12:55:45', 3),
(28, 'AK-0AJS8090720', 400000, '2020-07-09 13:01:15', 3),
(29, 'AK-645F4090720', 600000, '2020-07-09 13:22:11', 3),
(30, 'AK-OGROP090720', 600000, '2020-07-09 13:36:09', 3),
(31, 'AK-RQGMF090720', 2000000, '2020-07-09 18:05:34', 3),
(32, 'AK-NH7OI100720', 2000000, '2020-07-10 12:01:22', 3),
(33, 'AK-OGROP090720', 2000000, '2020-07-16 10:33:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `telp_pemesan` varchar(13) NOT NULL,
  `alamat_pemesan` varchar(150) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `tgl_pelunasan` date NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `type_pemesanan` int(12) NOT NULL,
  `keterangan` enum('dikirim','ambil','p2hq') NOT NULL,
  `total` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `status_kirim` enum('sudah','belum') NOT NULL DEFAULT 'belum',
  `id_user_pesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_id`, `no_faktur`, `nama_pemesan`, `telp_pemesan`, `alamat_pemesan`, `tgl_pemesanan`, `tgl_pelunasan`, `tgl_pengiriman`, `type_pemesanan`, `keterangan`, `total`, `jml_bayar`, `sisa`, `status_kirim`, `id_user_pesan`) VALUES
(1, 'AK-0220RQUU', 'Budi Setiawan', '08122221000', 'Jl. Parasut Jatuh No.19', '2020-02-18 09:37:11', '2020-02-20', '2020-02-20', 2, 'dikirim', 32000000, 32000000, 0, 'sudah', 1),
(4, 'AK-02206SP9', 'Jaenudin', '087821800743', 'Jl. Soleh Ningrat No.18', '2020-02-19 10:32:08', '2020-02-26', '2020-02-26', 1, 'dikirim', 4800000, 4800000, 0, 'sudah', 2),
(5, 'AK-0220ZP7W', 'Fahmy Bintang', '087822755404', 'Gg. Cijerokaso Timur No.4', '2020-02-19 10:40:58', '2020-03-03', '2020-03-03', 2, 'dikirim', 30600000, 30600000, 0, 'sudah', 1),
(6, 'AK-RPYPV190220', 'Ganjar Pranowo', '08122221700', 'Perumahan Bunga Teratai  Blok A4 No. 9, Cileunyi', '2020-02-19 14:53:55', '2020-03-05', '2020-03-05', 3, 'dikirim', 30600000, 30600000, 0, 'sudah', 4),
(7, 'AK-PJX3E190220', 'Ahmad Dzikri', '089922155441', 'Komp. Batununggal Blok L2 No. 3', '2020-02-19 15:13:38', '2020-02-27', '2020-02-27', 1, 'dikirim', 26600000, 26600000, 0, 'sudah', 4),
(8, 'AK-H0N4C190220', 'Ari Kurnia', '081220544974', 'Jl. Teratai Hijau No.88, Cigending', '2020-02-19 15:28:22', '2020-02-26', '2020-02-26', 2, 'dikirim', 2200000, 2200000, 0, 'belum', 4),
(9, 'AK-JK0TX080720', 'fadiul', '9328492384902', 'jdksjfksdnfjlkdsjflsdjflk', '2020-07-08 22:04:11', '2020-07-30', '2020-07-31', 1, 'p2hq', 2600000, 2600000, 0, 'belum', 3),
(10, 'AK-LA2FW080720', 'ucok', '432748932947', 'fksdhfksdf fnkdsfnsjkd 23432', '2020-07-08 22:14:39', '2020-07-30', '2020-07-31', 1, 'p2hq', 2600000, 2600000, 0, 'sudah', 3),
(12, 'AK-H83BI080720', 'fahri', '243243245', 'fsdfdsfdsf', '2020-07-08 23:38:06', '2020-07-30', '2020-07-31', 2, 'ambil', 2600000, 2000000, 600000, 'belum', 3),
(13, 'AK-R69X3090720', 'fadil', '089609038966', 'jl tegalega barat', '2020-07-09 00:17:01', '2020-07-30', '2020-07-31', 1, 'dikirim', 2600000, 2000000, 600000, 'belum', 3),
(14, 'AK-ATWPF090720', 'AHMAD', '234324324', 'fdgfdgfdgdfg', '2020-07-09 00:51:31', '2020-07-30', '2020-07-31', 2, 'ambil', 2600000, 2000000, 600000, 'belum', 3),
(15, 'AK-YUODT090720', 'asep', '2123432432', 'fdsfsdfsdsfs  dsf', '2020-07-09 00:52:32', '2020-07-30', '2020-07-31', 3, 'dikirim', 2600000, 2000000, 600000, 'belum', 3),
(16, 'AK-4XLGQ090720', 'asep', '489327493274', 'fddff dsf ew 324', '2020-07-09 12:55:45', '2020-07-30', '2020-07-31', 1, 'dikirim', 2600000, 2000000, 600000, 'belum', 3),
(18, 'AK-0AJS8090720', 'tes p2hq', '0988287827', 'mfdsjkfjksdfk', '2020-07-09 13:01:15', '2020-07-30', '2020-07-31', 3, 'p2hq', 2400000, 400000, 2000000, 'belum', 3),
(19, 'AK-645F4090720', 'riksa', '498329084092', 'gjkdsnksnfkjsdf', '2020-07-09 13:22:11', '2020-07-30', '2020-07-31', 2, 'p2hq', 2600000, 600000, 2000000, 'belum', 3),
(20, 'AK-OGROP090720', 'nurdin', '234234', 'fdsfsdfsdf', '2020-07-09 13:36:09', '2020-07-30', '2020-07-31', 1, 'ambil', 2600000, 2600000, 0, 'belum', 3),
(21, 'AK-RQGMF090720', 'test p2hq baru', '348932489238', 'jfkldsjlfsjdf', '2020-07-09 18:05:34', '2020-07-30', '2020-07-31', 2, 'p2hq', 2600000, 2000000, 600000, 'belum', 3),
(22, 'AK-NH7OI100720', 'asep balon', '098382042', 'fjdskfhksdjflsdkkfj jfksd', '2020-07-10 12:01:22', '2020-07-30', '2020-07-31', 1, 'dikirim', 2600000, 2000000, 600000, 'belum', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `p_detail_id` int(11) NOT NULL,
  `no_faktur_d` varchar(20) NOT NULL,
  `hewan_id_d` varchar(11) NOT NULL,
  `hewan_no_reg` varchar(20) NOT NULL,
  `hewan_harga_d` int(11) NOT NULL,
  `hewan_jumlah` int(11) NOT NULL,
  `hewan_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`p_detail_id`, `no_faktur_d`, `hewan_id_d`, `hewan_no_reg`, `hewan_harga_d`, `hewan_jumlah`, `hewan_total`) VALUES
(1, 'AK-0220RQUU', 'S001', '15', 28000000, 1, 28000000),
(2, 'AK-0220RQUU', 'D004', '144,145', 2000000, 2, 4000000),
(6, 'AK-02206SP9', 'D003', '13', 2200000, 1, 2200000),
(7, 'AK-02206SP9', 'D001', '55', 2600000, 1, 2600000),
(8, 'AK-0220ZP7W', 'D001', '61', 2600000, 1, 2600000),
(9, 'AK-0220ZP7W', 'S001', '27', 28000000, 1, 28000000),
(10, 'AK-RPYPV190220', 'D001', '19', 2600000, 1, 2600000),
(11, 'AK-RPYPV190220', 'D004', '53', 2000000, 1, 2000000),
(12, 'AK-RPYPV190220', 'S002', '103', 26000000, 1, 26000000),
(13, 'AK-PJX3E190220', 'S003', '151', 24000000, 1, 24000000),
(14, 'AK-PJX3E190220', 'D001', '74', 2600000, 1, 2600000),
(15, 'AK-H0N4C190220', 'D003', '39', 2200000, 1, 2200000),
(16, 'AK-JK0TX080720', 'D001', '222', 2600000, 1, 2600000),
(17, 'AK-LA2FW080720', 'D001', '11111', 2600000, 1, 2600000),
(19, 'AK-H83BI080720', 'D001', '323', 2600000, 1, 2600000),
(20, 'AK-R69X3090720', 'D001', '23', 2600000, 1, 2600000),
(21, 'AK-ATWPF090720', 'D001', '11111', 2600000, 1, 2600000),
(22, 'AK-YUODT090720', 'D001', '454435', 2600000, 1, 2600000),
(23, 'AK-4XLGQ090720', 'D001', '2323', 2600000, 1, 2600000),
(25, 'AK-0AJS8090720', 'D002', '878', 2400000, 1, 2400000),
(26, 'AK-645F4090720', 'D001', '1324324', 2600000, 1, 2600000),
(27, 'AK-OGROP090720', 'D001', '2333', 2600000, 1, 2600000),
(28, 'AK-RQGMF090720', 'D001', '2324324', 2600000, 1, 2600000),
(29, 'AK-NH7OI100720', 'D001', '2322', 2600000, 1, 2600000);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `pengiriman_id` int(11) NOT NULL,
  `no_faktur_k` varchar(20) NOT NULL,
  `nama_penerima` varchar(20) NOT NULL,
  `telp_penerima` varchar(13) NOT NULL,
  `alamat_penerima` varchar(150) NOT NULL,
  `keterangan_pengiriman` varchar(150) NOT NULL,
  `tgl_input_pengiriman` datetime NOT NULL,
  `tempatLatitude` varchar(255) NOT NULL,
  `tempatLongitude` varchar(255) NOT NULL,
  `id_user_kirim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`pengiriman_id`, `no_faktur_k`, `nama_penerima`, `telp_penerima`, `alamat_penerima`, `keterangan_pengiriman`, `tgl_input_pengiriman`, `tempatLatitude`, `tempatLongitude`, `id_user_kirim`) VALUES
(1, 'AK-0220RQUU', 'Budi Setiawan', '08122221000', 'Jl. Parasut Jatuh No.19', 'Mandikan bos', '2020-07-08 05:11:05', '', '', 1),
(3, 'AK-02206SP9', 'Jaenudin', '087821800743', 'Jl. Soleh Ningrat No.18', 'Dombanya jangan dibakar dulu mang ', '2020-07-08 04:15:15', '', '', 2),
(4, 'AK-0220ZP7W', 'Daus Kucay', '0878217550812', 'Jl. Goa Berhantu No. 30', 'Hmmmmmmmmmmmmmmmmmm', '2020-07-06 07:09:04', '', '', 1),
(5, 'AK-RPYPV190220', 'Ganjar Pranowo', '08122221700', 'Perumahan Bunga Teratai  Blok A4 No. 9, Cileunyi', 'Be Careful', '2020-07-14 07:24:09', '', '', 4),
(6, 'AK-PJX3E190220', 'fadil', '089609038966', 'jl tegalega', 'mandikan sebelum dikirim', '2020-07-14 11:16:07', '', '', 3),
(7, 'AK-LA2FW080720', 'al kautsar', '9029849324023', 'darwati', 'p2hq', '2020-07-16 06:12:11', '', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sapi`
--

CREATE TABLE `sapi` (
  `sapi_id` varchar(11) NOT NULL,
  `sapi_kelas` varchar(30) NOT NULL,
  `sapi_deskripsi` varchar(30) NOT NULL,
  `sapi_status` int(5) NOT NULL COMMENT '1=Aktif, 0=Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sapi`
--

INSERT INTO `sapi` (`sapi_id`, `sapi_kelas`, `sapi_deskripsi`, `sapi_status`) VALUES
('S001', 'A', 'Sapi kelas A', 1),
('S002', 'B', 'Sapi kelas B', 1),
('S003', 'C', 'Sapi kelas C', 1),
('S004', 'D', 'Sapi kelas D', 1),
('S005', 'Istimewa', 'Sapi kelas Istimewa', 1),
('S006', 'Super', 'Sapi kelas Super', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_pemesanan`
--

CREATE TABLE `type_pemesanan` (
  `id_type_pemesanan` int(12) NOT NULL,
  `nama_type` varchar(25) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_pemesanan`
--

INSERT INTO `type_pemesanan` (`id_type_pemesanan`, `nama_type`, `deskripsi`) VALUES
(1, 'Type A', 'Membeli hewan qurban'),
(2, 'Type B', 'Membeli hewan dan dipotong, lalu meminta bagian'),
(3, 'Type C', 'Disalurkan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `telp_user` varchar(13) NOT NULL,
  `level_id` int(11) NOT NULL,
  `status_user` int(5) NOT NULL COMMENT '1=Aktif, 0=Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `email_user`, `telp_user`, `level_id`, `status_user`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Indra Riksa', 'indra@riksa.com', '081212124264', 1, 1),
(2, 'asep', 'dc855efb0dc7476760afaa1b281665f1', 'Asep Pamungkas', 'ujang@kasep.com', '081213444900', 2, 1),
(3, 'fadilfrds', '8d90d3b4702c9df2567603dfb1c26978', 'Fadillah Firdaus', 'fadilfrds@gmail.com', '089609038966', 1, 1),
(4, 'salah', '2a07e3ff3df21b226d0cd044d4a7cc83', 'Salah Benerudin', 'salah.b@gmail.com', '081222188976', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int(11) NOT NULL,
  `nama_level` varchar(20) NOT NULL,
  `deskripsi_level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `nama_level`, `deskripsi_level`) VALUES
(1, 'Admin', 'Super Admin'),
(2, 'CS', 'Customer Service'),
(3, 'ADM', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domba`
--
ALTER TABLE `domba`
  ADD PRIMARY KEY (`domba_id`);

--
-- Indexes for table `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`hewan_id`);

--
-- Indexes for table `pembayaran_detail`
--
ALTER TABLE `pembayaran_detail`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `no_faktur` (`no_faktur`) USING BTREE;

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `no_faktur` (`no_faktur`),
  ADD KEY `nama_pemesan` (`nama_pemesan`);

--
-- Indexes for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD PRIMARY KEY (`p_detail_id`),
  ADD KEY `tbl_detail_jual_hewan_1` (`no_faktur_d`),
  ADD KEY `hewan_id_d` (`hewan_id_d`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`pengiriman_id`),
  ADD KEY `no_faktur` (`no_faktur_k`);

--
-- Indexes for table `sapi`
--
ALTER TABLE `sapi`
  ADD PRIMARY KEY (`sapi_id`);

--
-- Indexes for table `type_pemesanan`
--
ALTER TABLE `type_pemesanan`
  ADD PRIMARY KEY (`id_type_pemesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_user_1` (`level_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran_detail`
--
ALTER TABLE `pembayaran_detail`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  MODIFY `p_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `pengiriman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `type_pemesanan`
--
ALTER TABLE `type_pemesanan`
  MODIFY `id_type_pemesanan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran_detail`
--
ALTER TABLE `pembayaran_detail`
  ADD CONSTRAINT `fk_faktur` FOREIGN KEY (`no_faktur`) REFERENCES `pemesanan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD CONSTRAINT `tbl_detail_hewan_1` FOREIGN KEY (`hewan_id_d`) REFERENCES `hewan` (`hewan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_jual_hewan_1` FOREIGN KEY (`no_faktur_d`) REFERENCES `pemesanan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_pemesanan` FOREIGN KEY (`no_faktur_k`) REFERENCES `pemesanan_detail` (`no_faktur_d`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_1` FOREIGN KEY (`level_id`) REFERENCES `user_level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
