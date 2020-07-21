-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2020 pada 13.24
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backup_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `activity_type` varchar(64) NOT NULL,
  `activity_data` text DEFAULT NULL,
  `activity_time` datetime NOT NULL,
  `activity_ip_address` varchar(15) DEFAULT NULL,
  `activity_device` varchar(32) DEFAULT NULL,
  `activity_os` varchar(16) DEFAULT NULL,
  `activity_browser` varchar(16) DEFAULT NULL,
  `activity_location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemeriksaan_1`
--

CREATE TABLE `detail_pemeriksaan_1` (
  `id_detail` int(9) NOT NULL,
  `id_pemeriksaan` int(9) NOT NULL,
  `body_function_and_body_structure` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Body function and body structure';

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemeriksaan_2`
--

CREATE TABLE `detail_pemeriksaan_2` (
  `id_detail` int(9) NOT NULL,
  `id_pemeriksaan` int(9) NOT NULL,
  `activities` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Activities (activity limitation)';

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemeriksaan_3`
--

CREATE TABLE `detail_pemeriksaan_3` (
  `id_detail` int(9) NOT NULL,
  `id_pemeriksaan` int(9) NOT NULL,
  `participation_restriction` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Participation restriction';

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemeriksaan_4`
--

CREATE TABLE `detail_pemeriksaan_4` (
  `id_detail` int(9) NOT NULL,
  `id_pemeriksaan` int(9) NOT NULL,
  `diagnosa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Diagnosa/ Condition';

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi_pemeriksaan`
--

CREATE TABLE `dokumentasi_pemeriksaan` (
  `id_dokumentasi` int(9) NOT NULL,
  `id_pemeriksaan` int(9) NOT NULL,
  `nama_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fisioterapi`
--

CREATE TABLE `fisioterapi` (
  `id_fisioterapi` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `nama` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` text DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(9) NOT NULL,
  `nomor_pasien` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `jenis_kelamin` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nama_wali` text DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `id_pasien` int(9) NOT NULL,
  `enviromental_factors` text DEFAULT NULL,
  `personal_factors` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_by` int(9) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(9) UNSIGNED NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `fullname` text NOT NULL,
  `photo` text DEFAULT NULL,
  `total_login` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `login_attempts` int(9) UNSIGNED DEFAULT 0,
  `last_login_attempt` datetime DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `verification_token` varchar(128) DEFAULT NULL,
  `recovery_token` varchar(128) DEFAULT NULL,
  `unlock_token` varchar(128) DEFAULT NULL,
  `created_by` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(9) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `fullname`, `photo`, `total_login`, `last_login`, `last_activity`, `login_attempts`, `last_login_attempt`, `remember_time`, `remember_exp`, `ip_address`, `is_active`, `verification_token`, `recovery_token`, `unlock_token`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, 'admin', '1', 'Admin', NULL, 41, '2020-06-16 20:34:12', '2020-06-16 20:34:12', 42, '2020-06-16 20:34:12', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-07 22:15:17', NULL, NULL, NULL, NULL, 0),
(1, 'adm', '1', 'Administrator', NULL, 31, '2020-06-13 22:23:35', '2020-06-13 22:23:35', 31, '2020-06-13 22:23:35', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-08 23:32:46', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_id` int(9) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `definition` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `route` varchar(32) DEFAULT NULL,
  `created_by` int(9) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(9) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `company_id`, `name`, `definition`, `description`, `route`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, NULL, 'Super Admin', 'Super Administrator', NULL, 'admin_side/beranda', 0, '2018-10-27 17:52:08', NULL, NULL, NULL, NULL, 0),
(1, NULL, 'Admin', 'Administrator (Owner)', NULL, 'admin_side/beranda', 0, '2017-03-06 01:19:26', 2, '2018-10-27 18:55:37', NULL, NULL, 0),
(2, NULL, 'Fisioterapi', 'Fisioterapi', 'Karyawan', 'employee_side/beranda', 0, '2020-06-04 00:37:02', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_to_role`
--

CREATE TABLE `user_to_role` (
  `user_id` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `role_id` int(9) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_to_role`
--

INSERT INTO `user_to_role` (`user_id`, `role_id`) VALUES
(0, 0),
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indeks untuk tabel `detail_pemeriksaan_1`
--
ALTER TABLE `detail_pemeriksaan_1`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indeks untuk tabel `detail_pemeriksaan_2`
--
ALTER TABLE `detail_pemeriksaan_2`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indeks untuk tabel `detail_pemeriksaan_3`
--
ALTER TABLE `detail_pemeriksaan_3`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indeks untuk tabel `detail_pemeriksaan_4`
--
ALTER TABLE `detail_pemeriksaan_4`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indeks untuk tabel `dokumentasi_pemeriksaan`
--
ALTER TABLE `dokumentasi_pemeriksaan`
  ADD PRIMARY KEY (`id_dokumentasi`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indeks untuk tabel `fisioterapi`
--
ALTER TABLE `fisioterapi`
  ADD PRIMARY KEY (`id_fisioterapi`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_fisioterapi` (`user_id`),
  ADD KEY `user_id` (`created_by`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_index` (`username`),
  ADD KEY `is_active_index` (`is_active`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name_index` (`name`),
  ADD KEY `company_id_index` (`company_id`) USING BTREE;

--
-- Indeks untuk tabel `user_to_role`
--
ALTER TABLE `user_to_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id_index` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pemeriksaan_1`
--
ALTER TABLE `detail_pemeriksaan_1`
  MODIFY `id_detail` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pemeriksaan_2`
--
ALTER TABLE `detail_pemeriksaan_2`
  MODIFY `id_detail` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pemeriksaan_3`
--
ALTER TABLE `detail_pemeriksaan_3`
  MODIFY `id_detail` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pemeriksaan_4`
--
ALTER TABLE `detail_pemeriksaan_4`
  MODIFY `id_detail` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi_pemeriksaan`
--
ALTER TABLE `dokumentasi_pemeriksaan`
  MODIFY `id_dokumentasi` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fisioterapi`
--
ALTER TABLE `fisioterapi`
  MODIFY `id_fisioterapi` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
