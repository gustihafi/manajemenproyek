-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2020 pada 15.26
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_proyek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_instansi`
--

CREATE TABLE `tbl_instansi` (
  `id_instansi` int(11) NOT NULL,
  `nm_instansi` varchar(150) NOT NULL,
  `alamat_ins` text NOT NULL,
  `telp_ins` varchar(15) NOT NULL,
  `email_ins` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `nm_instansi`, `alamat_ins`, `telp_ins`, `email_ins`) VALUES
(5, 'Pemerintah Kabupaten Banjar', 'Jl. Mitrakusumo', '08977861044', 'pemkab.banjar@banjar.com'),
(6, 'Dinas Komunikasi dan Informasi', 'Jl. Ir. Habibi', '0878123455', 'diskominfo@indo.com'),
(7, 'CV. VAO', 'Jl. mana', '0878123455', 'vao@vao.com'),
(10, 'Pemerintah Kabupaten Banjar', 'mm', '0878123455', 'pemkab.banjar@banjar.com'),
(12, 'CV. VAO', 'mm', '0878123455', 'kkk@kkk.co'),
(13, 'Pemerintah Kabupaten Banjar', 'd', '0878123455', 'pemkab.banjar@banjar.com'),
(14, 'Pemerintah Kabupaten Tanah Laut', 'mk', '08575848005', 'diskominfo@indo.com'),
(15, 'Pemerintah Kabupaten Tanah Laut', 'nm', '0878123455', 'pemkab.banjar@banjar.com'),
(16, 'nnn', 'ds', '123', 'diskominfo@indo.com'),
(17, 'CV. KreatifOz', 'Jl. Mentaos', '08977861044', 'kreatifoz@kreatifoz.com'),
(18, 'CV. BBLACK', 'jnnj', '08999999', 'nnn@mm.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nm_kar` varchar(150) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `foto` text NOT NULL,
  `telp_kar` varchar(15) NOT NULL,
  `alamat_kar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_karyawan`, `nm_kar`, `jk`, `foto`, `telp_kar`, `alamat_kar`) VALUES
(1, 'Gusti Ahmad Hafi', 'Laki-Laki', '.jpg', '0859580678', 'Jl. Mufaka 2, Desa Ujung'),
(3, 'Muhammad Abdul Wahid', 'Perempuan', 'Muhammad_Abdul_Wahid.jpg', '08977861044', 'Jl. Martapura'),
(4, 'Hendri', 'Laki-Laki', 'Hendri.jpg', '08977861044', 'Jl. Pelaihari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log_progres`
--

CREATE TABLE `tbl_log_progres` (
  `id_log_progres` int(11) NOT NULL,
  `id_progres` int(11) NOT NULL,
  `kd_proyek` varchar(5) NOT NULL,
  `persentase` varchar(50) NOT NULL,
  `status_progres` varchar(50) NOT NULL,
  `tgl_meet` date NOT NULL,
  `ket` text NOT NULL,
  `aksi` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_log_progres`
--

INSERT INTO `tbl_log_progres` (`id_log_progres`, `id_progres`, `kd_proyek`, `persentase`, `status_progres`, `tgl_meet`, `ket`, `aksi`, `tanggal`) VALUES
(1, 4, 'P001', '45.00', 'Pengumpulan Data', '2020-01-09', 'Tahap wawancara', 'INSERT', '2020-01-09 10:23:52'),
(2, 5, 'P005', '20.00', 'Pengumpulan Data', '2020-01-09', 'Tahap pengumpulan data dengan wawancara', 'INSERT', '2020-01-09 15:13:47'),
(3, 4, 'P001', '50.00', 'Desain Interface', '2020-01-09', 'Tahap desain tampilan web atau aplikasi', 'UPDATE', '2020-01-09 15:16:02'),
(10, 6, 'P002', '20.00', 'Pengumpulan Data', '2020-01-11', 'persentase', 'INSERT', '2020-01-11 17:21:35'),
(14, 5, 'P005', '70.00', 'Masalah Bug', '2020-01-11', 'hhh', 'UPDATE', '2020-01-11 17:30:15'),
(16, 6, 'P002', '54', 'Masalah Bug', '2020-01-11', 'kjjxm', 'UPDATE', '2020-01-11 17:34:38'),
(17, 4, 'P001', '100', 'Testing', '2020-01-11', 'Selesei', 'UPDATE', '2020-01-11 18:43:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log_proyek`
--

CREATE TABLE `tbl_log_proyek` (
  `id` int(11) NOT NULL,
  `kd_proyek` varchar(5) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `nm_cp` varchar(100) NOT NULL,
  `telp_cp` varchar(15) NOT NULL,
  `status_proyek` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `nominal` int(25) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `aksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_log_proyek`
--

INSERT INTO `tbl_log_proyek` (`id`, `kd_proyek`, `judul`, `id_instansi`, `nm_cp`, `telp_cp`, `status_proyek`, `ket`, `nominal`, `tgl_mulai`, `tgl_akhir`, `status`, `id_karyawan`, `tanggal`, `aksi`) VALUES
(37, 'P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Penawaran', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-05 13:00:29', 'INSERT'),
(38, 'P002', 'Aplikasi LOLA', 6, 'Bolang', '08977861044', 'Disetujui', 'Tahap pengerjaan aplikasi', 2000000, '2020-01-01', '2020-01-01', '2020-02-08', 1, '2020-01-05 14:47:16', 'INSERT'),
(39, 'P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Penawaran', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 10:53:02', 'UPDATE'),
(40, 'P002', 'Aplikasi LOLA', 6, 'Bolang', '08977861044', 'Disetujui', 'Tahap pengerjaan aplikasi', 2000000, '2020-01-01', '2020-01-01', '2020-02-08', 1, '2020-01-06 10:53:02', 'UPDATE'),
(41, 'P004', 'Monato', 7, 'Manana', '08977861044', 'Ditolak', 'Kemahalan', 25000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 14:54:48', 'INSERT'),
(42, 'P004', 'Monato', 7, 'Manana', '08977861044', 'Ditolak', 'Kemahalan', 25000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:03:16', 'UPDATE'),
(43, 'p0', 'APLIKASI BAMACA', 10, 'aad', '088089998', 'Ditolak', 'm', 1000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:08:11', 'INSERT'),
(44, 'P001', 'Aplikasi Bemo', 0, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:25:04', 'UPDATE'),
(45, 'P001', 'Aplikasi Bemo', 7, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:26:08', 'UPDATE'),
(46, 'P001', 'Aplikasi Bemo', 0, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:52:51', 'UPDATE'),
(47, 'P001', 'Aplikasi Bemo', 0, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:53:11', 'UPDATE'),
(48, 'P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:54:21', 'UPDATE'),
(49, 'P001', 'Aplikasi Bemo', 0, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:54:32', 'UPDATE'),
(50, 'P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:54:57', 'UPDATE'),
(51, 'P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Follow Up', 'Tahap Penawaran', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 15:56:46', 'UPDATE'),
(52, 'P1', 'Maraca', 12, 'Vovo', '08977861044', 'Penawaran', 'M', 1000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-06 16:01:38', 'INSERT'),
(53, 'P006', 'APLIKASI BAMACA', 13, 'aad', '08977861044', 'Follow Up', 'h', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', 0, '2020-01-07 11:15:24', 'INSERT'),
(54, 'P003', 'Kola', 14, 'Agus', '08977861044', 'Disetujui', 'mkb', 25000000, '0000-00-00', '0000-00-00', '0000-00-00', 2, '2020-01-07 15:08:36', 'INSERT'),
(55, 'P003', 'Kola', 15, 'Vovo', '088089998', 'Disetujui', 'bbh', 25000000, '0000-00-00', '0000-00-00', '0000-00-00', 2, '2020-01-07 15:13:16', 'INSERT'),
(56, 'P005', 'mk', 16, 'Gusti', '088089998', 'Disetujui', 'sd', 2000000, '0000-00-00', '0000-00-00', '0000-00-00', 1, '2020-01-07 21:26:00', 'INSERT'),
(57, 'P006', 'APLIKASI BAMACA', 13, 'aad', '08977861044', 'Follow Up', 'h', 10000000, '0000-00-00', '0000-00-00', '0000-00-00', NULL, '2020-01-09 09:07:15', 'UPDATE'),
(58, 'P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Disetujui', 'Lanjut membuat project ke progres', 10000000, '2020-01-01', '2020-01-01', '2020-01-31', 1, '2020-01-09 10:21:46', 'UPDATE'),
(59, 'P005', 'APRO', 17, 'Gusti', '08977861044', 'Disetujui', 'Pengerjaan Project', 25000000, '0000-00-00', '0000-00-00', '0000-00-00', 1, '2020-01-09 14:00:52', 'INSERT'),
(60, 'P002', 'Lola', 18, 'dsd', '2324', 'Disetujui', 'cxjcnj', 12132333, '0000-00-00', '0000-00-00', '0000-00-00', 1, '2020-01-11 17:19:32', 'INSERT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_progres`
--

CREATE TABLE `tbl_progres` (
  `id_progres` int(11) NOT NULL,
  `kd_proyek` varchar(5) NOT NULL,
  `tgl_meet` date NOT NULL,
  `status_progres` enum('Pengumpulan Data','Desain Interface','Implementasi','Testing','Masalah Bug') NOT NULL,
  `persentase` varchar(50) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_progres`
--

INSERT INTO `tbl_progres` (`id_progres`, `kd_proyek`, `tgl_meet`, `status_progres`, `persentase`, `ket`) VALUES
(4, 'P001', '2020-01-11', 'Testing', '100', 'Selesei'),
(5, 'P005', '2020-01-11', 'Masalah Bug', '70.00', 'hhh');

--
-- Trigger `tbl_progres`
--
DELIMITER $$
CREATE TRIGGER `log_insert_progres` AFTER INSERT ON `tbl_progres` FOR EACH ROW INSERT INTO tbl_log_progres VALUES (NULL,NEW.id_progres,NEW.kd_proyek,NEW.persentase,NEW.status_progres,NEW.tgl_meet,NEW.ket,'INSERT',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_progres` AFTER UPDATE ON `tbl_progres` FOR EACH ROW INSERT INTO tbl_log_progres VALUES (NULL,NEW.id_progres,NEW.kd_proyek,NEW.persentase,NEW.status_progres,NEW.tgl_meet,NEW.ket,'UPDATE',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_proyek`
--

CREATE TABLE `tbl_proyek` (
  `kd_proyek` varchar(5) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `nm_cp` varchar(100) NOT NULL,
  `telp_cp` varchar(15) NOT NULL,
  `status_proyek` enum('Penawaran','Follow Up','Disetujui','Ditolak') NOT NULL,
  `ket` text NOT NULL,
  `nominal` int(25) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `status` enum('Open','Close') DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `create_by` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_proyek`
--

INSERT INTO `tbl_proyek` (`kd_proyek`, `judul`, `id_instansi`, `nm_cp`, `telp_cp`, `status_proyek`, `ket`, `nominal`, `tgl_mulai`, `tgl_akhir`, `status`, `id_karyawan`, `create_by`) VALUES
('p0', 'APLIKASI BAMACA', 10, 'aad', '088089998', 'Ditolak', 'm', 1000000, '0000-00-00', '0000-00-00', '', 0, '2020-01-06'),
('P001', 'Aplikasi Bemo', 5, 'Agus', '08786637373', 'Disetujui', 'Lanjut membuat project ke progres', 10000000, '2020-01-01', '2020-01-31', 'Open', 3, '2020-01-06'),
('P002', 'Lola', 18, 'dsd', '2324', 'Disetujui', 'cxjcnj', 12132333, '0000-00-00', '0000-00-00', 'Open', 1, '2020-01-11'),
('P003', 'Kola', 15, 'Vovo', '088089998', 'Disetujui', 'bbh', 25000000, '0000-00-00', '0000-00-00', 'Close', 1, '2020-01-07'),
('P004', 'Monato', 7, 'Manana', '08977861044', 'Ditolak', 'Kemahalan', 25000000, '0000-00-00', '0000-00-00', '', 0, '2020-01-06'),
('P005', 'APRO', 17, 'Gusti', '08977861044', 'Disetujui', 'Pengerjaan Project', 25000000, '0000-00-00', '0000-00-00', 'Open', 3, '2020-01-09'),
('P006', 'APLIKASI BAMACA', 13, 'aad', '08977861044', 'Follow Up', 'h', 10000000, '0000-00-00', '0000-00-00', NULL, 0, '2020-01-07');

--
-- Trigger `tbl_proyek`
--
DELIMITER $$
CREATE TRIGGER `log_insert` AFTER INSERT ON `tbl_proyek` FOR EACH ROW INSERT INTO tbl_log_proyek VALUES (NULL,NEW.kd_proyek,NEW.judul,NEW.id_instansi,NEW.nm_cp,NEW.telp_cp,NEW.status_proyek,NEW.ket,NEW.nominal,NEW.tgl_mulai,NEW.tgl_mulai,NEW.tgl_akhir,NEW.status,NOW(),'INSERT')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update` AFTER UPDATE ON `tbl_proyek` FOR EACH ROW INSERT INTO tbl_log_proyek VALUES (NULL,NEW.kd_proyek,NEW.judul,NEW.id_instansi,NEW.nm_cp,NEW.telp_cp,NEW.status_proyek,NEW.ket,NEW.nominal,NEW.tgl_mulai,NEW.tgl_mulai,NEW.tgl_akhir,NEW.status,NOW(),'UPDATE')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('Admin','Owner','Karyawan') NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_karyawan`, `fullname`, `email`, `level`, `password`) VALUES
(2, NULL, 'Muhammad Wahid', 'admin@admin.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, NULL, 'Rifqie Rusyadi', 'owner@owner.com', 'Owner', '72122ce96bfec66e2396d2e25225d70a'),
(4, 1, 'Gusti Ahmad Hafi', 'gustihafi@gmail.com', 'Karyawan', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `tbl_log_progres`
--
ALTER TABLE `tbl_log_progres`
  ADD PRIMARY KEY (`id_log_progres`);

--
-- Indeks untuk tabel `tbl_log_proyek`
--
ALTER TABLE `tbl_log_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_progres`
--
ALTER TABLE `tbl_progres`
  ADD PRIMARY KEY (`id_progres`),
  ADD KEY `fk_proyek` (`kd_proyek`);

--
-- Indeks untuk tabel `tbl_proyek`
--
ALTER TABLE `tbl_proyek`
  ADD PRIMARY KEY (`kd_proyek`),
  ADD KEY `fk_instansi` (`id_instansi`),
  ADD KEY `fk_kar` (`id_karyawan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_log_progres`
--
ALTER TABLE `tbl_log_progres`
  MODIFY `id_log_progres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_log_proyek`
--
ALTER TABLE `tbl_log_proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `tbl_progres`
--
ALTER TABLE `tbl_progres`
  MODIFY `id_progres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
