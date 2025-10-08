-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2025 at 09:12 AM
-- Server version: 10.6.23-MariaDB-cll-lve
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demotoko_tracer_umaha`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_admin`, `created_at`) VALUES
(1, 'admin', '$2y$10$zmunf9nOZ6dSzPMl8xqtDO7yE/35znyqQZqIbMiJ1rPu7sSdlk1/i', 'Administrator', '2025-06-29 07:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `program_studi` varchar(100) DEFAULT NULL,
  `jenjang` varchar(10) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `tahun_lulus` int(11) DEFAULT NULL,
  `fakultas` varchar(255) DEFAULT NULL,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `nim`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `program_studi`, `jenjang`, `tahun_masuk`, `tahun_lulus`, `fakultas`, `sumber_dana`, `email`, `no_hp`, `password`, `created_at`, `provinsi`, `kota`) VALUES
(1, '212313213', 'Fulan Embre', 'Laki-laki', 'Bandung', '1999-05-22', '55202', 'S1', '2018', 2024, 'Teknik Informatik', 'Gaji', 'fulan@mail.com', '08123456789', '$2y$10$vh.jCeJSGES50zTmTiCSzeAzdmj76oKkjlc.kV6mHcuiKF1D5Fwou', '2025-06-29 07:06:09', 'Jawa Barat', 'Bandung'),
(2, '', 'Tokoweb Creative Digital Agency (Tokoweb.co)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tokoweb.co@gmail.com', NULL, '$2y$10$FRA7rDkpj349Jxx53M4ap.V5m6j7EABXlC.zJl3E0nXLs47KyP7gu', '2025-07-02 23:50:50', NULL, NULL),
(6, '112233', 'puji ermanto', NULL, NULL, NULL, '55202', NULL, NULL, 2022, NULL, NULL, 'pujiermanto@gmail.com', NULL, '$2y$10$BxiKM0RubCkd7f8UAqFY3uwhvn0TAIY3WyD7fBDQQXs7DMLyPn1dC', '2025-07-03 09:40:21', NULL, NULL),
(7, NULL, 'Akmal Wy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'akmalwy12@gmail.com', NULL, '$2y$10$atZdkN9drZTG9Vj4eYRYL.yTo0L1WLqAY2o5pbNbs/FP9f.wSxu7m', '2025-09-08 14:22:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_fields`
--

CREATE TABLE `kuesioner_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `label` varchar(255) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `type` enum('text','number','select','textarea') NOT NULL DEFAULT 'text',
  `options` text DEFAULT NULL COMMENT 'JSON array untuk opsi select',
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `step` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Step form: 1 atau 2',
  `order` int(11) NOT NULL DEFAULT 0,
  `source_table` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kuesioner_fields`
--

INSERT INTO `kuesioner_fields` (`id`, `field_name`, `label`, `header`, `type`, `options`, `required`, `step`, `order`, `source_table`, `created_at`, `updated_at`) VALUES
(1, 'nim', 'NIM', 'Biodata Alumni ', 'text', '', 1, 1, 1, NULL, '2025-07-02 08:32:07', '2025-07-02 08:32:07'),
(2, 'nama', 'Nama', 'Biodata Alumni ', 'text', '', 1, 1, 2, NULL, '2025-07-02 08:32:42', '2025-07-02 08:32:42'),
(3, 'program_studi', 'Program Studi', 'Biodata Alumni ', 'select', '', 1, 1, 3, 'prodi', '2025-07-02 09:04:10', '2025-07-02 09:04:10'),
(4, 'tahun_lulus', 'Tahun Lulus', 'Biodata Alumni ', 'text', '', 1, 1, 4, '', '2025-07-02 09:13:53', '2025-07-02 09:13:53'),
(5, 'status_pekerjaan', 'Status Pekerjaan', 'Status Pekerjaan', 'select', '[\"Bekerja\", \"Wirausaha\", \"Belum Bekerja\", \"Studi Lanjut\"]', 0, 1, 5, '', '2025-07-02 09:15:09', '2025-07-02 09:15:09'),
(6, 'institusi_bekerja', 'Institusi Tempat Bekerja', 'Status Pekerjaan', 'text', '', 0, 1, 6, '', '2025-07-02 09:26:42', '2025-07-02 09:26:42'),
(7, 'posisi_pekerjaan', 'Posisi Pekerjaan', 'Status Pekerjaan', 'text', '', 0, 1, 7, '', '2025-07-02 09:28:06', '2025-07-02 09:28:06'),
(8, 'sektor_tempat_kerja', 'Jenis Pekerjaan', 'Informasi Tambahan Pekerjaan', 'select', '[\"PNS\", \"Swasta\", \"Wirausaha\", \"BUMN\", \"Lainnya\"]', 0, 1, 8, '', '2025-07-02 09:30:12', '2025-07-02 09:30:12'),
(9, 'sesuai_bidang', 'Pekerjaan Sesuai Bidang', 'Informasi Tambahan Pekerjaan', 'select', '[\"ya\", \"tidak\"]', 0, 1, 9, '', '2025-07-02 09:32:02', '2025-07-02 09:32:02'),
(10, 'tahun_mulai_bekerja', 'Tahun Mulai Bekerja ? (Contoh: 2024)', 'Informasi Tambahan Pekerjaan', 'text', '', 0, 1, 10, '', '2025-07-02 09:33:27', '2025-07-02 09:33:27'),
(11, 'bulan_mulai_mencari_pekerjaan', 'Mulai Mencari Kerja (Bulan sebelum/setelah lulus) ? (Contoh: 2 bulan setelah lulus)', 'Informasi Tambahan Pekerjaan', 'text', '', 0, 1, 11, '', '2025-07-02 09:34:31', '2025-07-02 09:34:31'),
(12, 'cara_mendapat_kerja', 'Cara Mendapatkan Pekerjaan', 'Informasi Tambahan Pekerjaan', 'textarea', '', 0, 1, 12, '', '2025-07-02 09:35:23', '2025-07-02 09:35:23'),
(13, 'gaji_pertama', 'Gaji Pertama ? (Contoh: 25000000)', 'Informasi Tambahan Pekerjaan', 'number', '', 0, 1, 13, '', '2025-07-02 09:36:00', '2025-07-02 09:36:00'),
(14, 'kepuasan_etika', 'Etika (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', 1, 2, 1, '', '2025-07-02 09:45:09', '2025-07-02 09:45:09'),
(15, 'kepuasan_keahlian_bidan_ilmu', 'Keahlian Bidang Ilmu (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', 0, 2, 2, '', '2025-07-02 15:57:43', '2025-07-02 15:57:43'),
(16, 'kepuasan_bahasa_asing', 'Bahasa Asing (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', 0, 2, 3, '', '2025-07-02 15:58:22', '2025-07-02 15:58:22'),
(17, 'kepuasan_teknologi_informasi', 'Teknologi Informasi (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 4, '', '2025-07-02 15:59:08', '2025-07-02 15:59:08'),
(18, 'kepuasan_komunikasi', 'Komunikasi (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 5, '', '2025-07-02 16:00:01', '2025-07-02 16:00:01'),
(19, 'kepuasan_kerjasama', 'Kerja Sama (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 6, '', '2025-07-02 16:00:48', '2025-07-02 16:00:48'),
(20, 'kepuasan_pengembangan_diri', 'Pengembangan Diri (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 7, '', '2025-07-02 16:01:39', '2025-07-02 16:01:39'),
(21, 'relevansi_kurikulum', 'Relevansi Kurikulum', 'Relevansi Kurikulum & Saran', 'select', '[\"Tinggi\",\"Sedang\",\"Rendah\"]', 0, 2, 8, '', '2025-07-02 16:02:28', '2025-07-02 16:02:28'),
(22, 'saran_kurikulum', 'Saran/Masukan untuk Kampus', 'Relevansi Kurikulum & Saran', 'textarea', '', 0, 2, 9, '', '2025-07-02 16:03:03', '2025-07-02 16:03:03'),
(23, 'harapan_umaha', 'Bagaimana harapan Anda terhadap lulusan UMAHA?', 'Relevansi Kurikulum & Saran', 'textarea', '', 0, 2, 10, '', '2025-07-02 16:03:39', '2025-07-02 16:03:39'),
(24, 'domisili_alumni', 'Domisili', 'Biodata Alumni', 'text', '', 0, 1, 5, '', '2025-07-04 01:55:29', '2025-07-04 01:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `landing_page`
--

CREATE TABLE `landing_page` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `subjudul` text DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'nonaktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_page`
--

INSERT INTO `landing_page` (`id`, `judul`, `subjudul`, `konten`, `gambar`, `status`, `created_at`, `updated_at`, `facebook`, `instagram`, `twitter`, `linkedin`, `youtube`) VALUES
(1, 'Tracer Study UMAHA', 'Jembatan antara kampus dan alumni untuk menilai dampak pendidikan dan kesiapan dunia kerja lulusan UMAHA.', 'Dukung pengembangan kurikulum dan peningkatan mutu lulusan dengan berpartisipasi aktif dalam Tracer Study Universitas Maarif Hasyim Latif.', NULL, 'aktif', '2025-07-02 15:04:02', '2025-07-03 09:43:29', 'https://facebook.com/umaha.official/', 'https://instagram.com/umaha.official/', 'https://twitter.com/umaha.official/', 'https://linkedin.com/company/umaha', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_lulusan`
--

CREATE TABLE `pengguna_lulusan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `nama_pengisi` varchar(100) DEFAULT NULL,
  `jabatan_pengisi` varchar(100) DEFAULT NULL,
  `email_pengisi` varchar(100) DEFAULT NULL,
  `no_telp_pengisi` varchar(30) DEFAULT NULL,
  `tahun_merekrut` int(11) DEFAULT NULL,
  `jumlah_lulusan_direkrut` int(11) DEFAULT NULL,
  `etika_kerja` tinyint(4) DEFAULT NULL,
  `keahlian_profesional` tinyint(4) DEFAULT NULL,
  `penguasaan_bahasa_asing` tinyint(4) DEFAULT NULL,
  `teknologi_informasi` tinyint(4) DEFAULT NULL,
  `komunikasi` tinyint(4) DEFAULT NULL,
  `kerjasama` tinyint(4) DEFAULT NULL,
  `pengembangan_diri` tinyint(4) DEFAULT NULL,
  `saran_umum` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_lulusan_detail`
--

CREATE TABLE `pengguna_lulusan_detail` (
  `id` int(11) NOT NULL,
  `pengguna_id` int(11) DEFAULT NULL,
  `alumni_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode_tracer`
--

CREATE TABLE `periode_tracer` (
  `id` int(11) NOT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `lulusan_tahun` varchar(10) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_tracer`
--

INSERT INTO `periode_tracer` (`id`, `tahun`, `lulusan_tahun`, `tanggal_mulai`, `tanggal_selesai`, `file_surat`) VALUES
(1, '2025', '2024', '2025-06-25', '2025-08-25', 'uploads/surat/1751163319_97a72915d38e2d41427f.pdf'),
(3, '2024', '2023', '2024-02-01', '2025-02-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode_prodi` varchar(255) DEFAULT NULL,
  `nama_prodi` varchar(100) DEFAULT NULL,
  `jenjang` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode_prodi`, `nama_prodi`, `jenjang`) VALUES
(1, '62201', 'S1 Akuntansi', 'S1'),
(2, '62401', 'D3 Akuntansi', 'D3'),
(3, '61201', 'S1 Manajemen', 'S1'),
(4, '94202', 'S1 Kewirausahaan', 'S1'),
(5, '74101', 'S1 Hukum', 'S1'),
(6, '55202', 'S1 Teknik Informatika', 'S1'),
(7, '56401', 'D3 Teknik Komputer', 'D3'),
(8, '26201', 'S1 Teknik Industri', 'S1'),
(9, '21201', 'S1 Teknik Mesin', 'S1'),
(10, '90241', 'S1 Desain Komunikasi Visual', 'S1'),
(11, '46202', 'S1 Mikrobiologi', 'S1'),
(12, '13450', 'D3 Teknologi Laboratorium Medis', 'D3'),
(13, '13350', 'D4 Teknologi Laboratorium Medis', 'D4'),
(14, '74101', 'S2 Hukum', 'S2'),
(15, '61101', 'S2 Manajemen', 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key_name` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`) VALUES
(1, 'panduan_tracer', 'uploads/panduan_tracer_1751260252.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tracer_study`
--

CREATE TABLE `tracer_study` (
  `id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `tahun_pengisian` int(11) NOT NULL,
  `tahun_lulus` int(255) DEFAULT NULL,
  `status_pekerjaan` enum('bekerja','wirausaha','belum_bekerja','studi_lanjut') NOT NULL,
  `institusi_bekerja` varchar(255) DEFAULT NULL,
  `posisi_pekerjaan` varchar(100) DEFAULT NULL,
  `tahun_mulai_bekerja` int(11) DEFAULT NULL,
  `gaji_pertama` int(11) DEFAULT NULL,
  `tempat_kerja_kabupaten` varchar(100) DEFAULT NULL,
  `sektor_tempat_kerja` varchar(100) DEFAULT NULL,
  `sesuai_bidang` enum('ya','tidak') DEFAULT NULL,
  `dapat_kerja_sebelum_lulus` enum('ya','tidak') DEFAULT NULL,
  `cara_mendapat_kerja` text DEFAULT NULL,
  `kepuasan_etika` tinyint(4) DEFAULT NULL,
  `kepuasan_keahlian_bidan_ilmu` tinyint(4) DEFAULT NULL,
  `kepuasan_bahasa_asing` tinyint(4) DEFAULT NULL,
  `kepuasan_teknologi_informasi` tinyint(4) DEFAULT NULL,
  `kepuasan_komunikasi` tinyint(4) DEFAULT NULL,
  `kepuasan_kerjasama` tinyint(4) DEFAULT NULL,
  `kepuasan_pengembangan_diri` tinyint(4) DEFAULT NULL,
  `relevansi_kurikulum` enum('tinggi','sedang','rendah') DEFAULT NULL,
  `saran_kurikulum` text DEFAULT NULL,
  `harapan_umaha` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracer_study`
--

INSERT INTO `tracer_study` (`id`, `alumni_id`, `tahun_pengisian`, `tahun_lulus`, `status_pekerjaan`, `institusi_bekerja`, `posisi_pekerjaan`, `tahun_mulai_bekerja`, `gaji_pertama`, `tempat_kerja_kabupaten`, `sektor_tempat_kerja`, `sesuai_bidang`, `dapat_kerja_sebelum_lulus`, `cara_mendapat_kerja`, `kepuasan_etika`, `kepuasan_keahlian_bidan_ilmu`, `kepuasan_bahasa_asing`, `kepuasan_teknologi_informasi`, `kepuasan_komunikasi`, `kepuasan_kerjasama`, `kepuasan_pengembangan_diri`, `relevansi_kurikulum`, `saran_kurikulum`, `harapan_umaha`, `created_at`) VALUES
(4, 1, 2025, 2024, 'bekerja', 'Antara News', 'Senior App Engineer', 2024, 5500000, NULL, 'BUMN', 'ya', NULL, 'Melamar melalui forum job seeker', 1, 1, 1, 1, 1, 1, 1, 'tinggi', 'Ok lah kalau begitu bos', NULL, '2025-07-02 23:27:22'),
(5, 6, 2025, 2022, 'bekerja', 'PT. Codex True False', 'Senior Engineer', 2023, 3500000, NULL, 'Swasta', 'ya', NULL, 'Mendaftar di forum job seeker', 1, 2, 1, 1, 1, 1, 1, 'tinggi', 'Aktifkan peran komunitas sharing keahlian bidang mahasiswa', 'Berbekal materi yang didapat alhamdulillah kami siap bersaing di kancah profesional', '2025-08-19 12:54:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `field_name` (`field_name`);

--
-- Indexes for table `landing_page`
--
ALTER TABLE `landing_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna_lulusan`
--
ALTER TABLE `pengguna_lulusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna_lulusan_detail`
--
ALTER TABLE `pengguna_lulusan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna_id` (`pengguna_id`),
  ADD KEY `alumni_id` (`alumni_id`);

--
-- Indexes for table `periode_tracer`
--
ALTER TABLE `periode_tracer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_name` (`key_name`);

--
-- Indexes for table `tracer_study`
--
ALTER TABLE `tracer_study`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumni_id` (`alumni_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `landing_page`
--
ALTER TABLE `landing_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna_lulusan`
--
ALTER TABLE `pengguna_lulusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna_lulusan_detail`
--
ALTER TABLE `pengguna_lulusan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `periode_tracer`
--
ALTER TABLE `periode_tracer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracer_study`
--
ALTER TABLE `tracer_study`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengguna_lulusan_detail`
--
ALTER TABLE `pengguna_lulusan_detail`
  ADD CONSTRAINT `pengguna_lulusan_detail_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna_lulusan` (`id`),
  ADD CONSTRAINT `pengguna_lulusan_detail_ibfk_2` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`);

--
-- Constraints for table `tracer_study`
--
ALTER TABLE `tracer_study`
  ADD CONSTRAINT `tracer_study_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
