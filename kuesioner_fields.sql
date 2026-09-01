-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2026 at 10:12 AM
-- Server version: 9.6.0
-- PHP Version: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracer_umaha`
--

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_fields`
--

CREATE TABLE `kuesioner_fields` (
  `id` int UNSIGNED NOT NULL,
  `field_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('text','number','select','textarea') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `options` text COLLATE utf8mb4_unicode_ci COMMENT 'JSON array untuk opsi select',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `step` tinyint NOT NULL DEFAULT '1' COMMENT 'Step form: 1 atau 2',
  `order` int NOT NULL DEFAULT '0',
  `source_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `conditional_field` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditional_value` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kuesioner_fields`
--

INSERT INTO `kuesioner_fields` (`id`, `field_name`, `label`, `header`, `type`, `options`, `required`, `step`, `order`, `source_table`, `created_at`, `updated_at`, `conditional_field`, `conditional_value`, `section_key`) VALUES
(1, 'nim', 'NIM', 'Biodata Alumni ', 'text', '', 1, 1, 1, NULL, '2025-07-02 08:32:07', '2025-07-02 08:32:07', NULL, NULL, NULL),
(2, 'nama', 'Nama', 'Biodata Alumni ', 'text', '', 1, 1, 2, NULL, '2025-07-02 08:32:42', '2025-07-02 08:32:42', NULL, NULL, NULL),
(3, 'program_studi', 'Program Studi', 'Biodata Alumni ', 'select', '', 1, 1, 3, 'prodi', '2025-07-02 09:04:10', '2025-07-02 09:04:10', NULL, NULL, NULL),
(4, 'tahun_lulus', 'Tahun Lulus', 'Biodata Alumni ', 'text', '', 1, 1, 4, '', '2025-07-02 09:13:53', '2025-07-02 09:13:53', NULL, NULL, NULL),
(5, 'status_pekerjaan', 'Status Pekerjaan', 'Status Pekerjaan', 'select', '[\"Bekerja\", \"Wirausaha\", \"Belum Bekerja\", \"Studi Lanjut\"]', 0, 1, 5, '', '2025-07-02 09:15:09', '2025-07-02 09:15:09', NULL, NULL, NULL),
(6, 'institusi_bekerja', 'Institusi Tempat Bekerja', 'Status Pekerjaan', 'text', '', 0, 1, 6, '', '2025-07-02 09:26:42', '2025-07-02 09:26:42', NULL, NULL, NULL),
(7, 'posisi_pekerjaan', 'Posisi Pekerjaan', 'Status Pekerjaan', 'text', '', 0, 1, 7, '', '2025-07-02 09:28:06', '2025-07-02 09:28:06', NULL, NULL, NULL),
(8, 'sektor_tempat_kerja', 'Jenis Pekerjaan', 'Informasi Tambahan Pekerjaan', 'select', '[\"PNS\", \"Swasta\", \"Wirausaha\", \"BUMN\", \"Lainnya\"]', 0, 1, 8, '', '2025-07-02 09:30:12', '2025-07-02 09:30:12', NULL, NULL, NULL),
(9, 'sesuai_bidang', 'Pekerjaan Sesuai Bidang', 'Informasi Tambahan Pekerjaan', 'select', '[\"ya\", \"tidak\"]', 0, 1, 9, '', '2025-07-02 09:32:02', '2025-07-02 09:32:02', NULL, NULL, NULL),
(10, 'tahun_mulai_bekerja', 'Tahun Mulai Bekerja ? (Contoh: 2024)', 'Informasi Tambahan Pekerjaan', 'text', '', 0, 1, 10, '', '2025-07-02 09:33:27', '2025-07-02 09:33:27', NULL, NULL, NULL),
(11, 'bulan_mulai_mencari_pekerjaan', 'Mulai Mencari Kerja (Bulan sebelum/setelah lulus) ? (Contoh: 2 bulan setelah lulus)', 'Informasi Tambahan Pekerjaan', 'text', '', 0, 1, 11, '', '2025-07-02 09:34:31', '2025-07-02 09:34:31', NULL, NULL, NULL),
(12, 'cara_mendapat_kerja', 'Cara Mendapatkan Pekerjaan', 'Informasi Tambahan Pekerjaan', 'textarea', '', 0, 1, 12, '', '2025-07-02 09:35:23', '2025-07-02 09:35:23', NULL, NULL, NULL),
(13, 'gaji_pertama', 'Gaji Pertama ? (Contoh: 25000000)', 'Informasi Tambahan Pekerjaan', 'number', '', 0, 1, 13, '', '2025-07-02 09:36:00', '2025-07-02 09:36:00', NULL, NULL, NULL),
(14, 'kepuasan_etika', 'Etika (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', 1, 2, 1, '', '2025-07-02 09:45:09', '2025-07-02 09:45:09', NULL, NULL, NULL),
(15, 'kepuasan_keahlian_bidan_ilmu', 'Keahlian Bidang Ilmu (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', 0, 2, 2, '', '2025-07-02 15:57:43', '2025-07-02 15:57:43', NULL, NULL, NULL),
(16, 'kepuasan_bahasa_asing', 'Bahasa Asing (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', 0, 2, 3, '', '2025-07-02 15:58:22', '2025-07-02 15:58:22', NULL, NULL, NULL),
(17, 'kepuasan_teknologi_informasi', 'Teknologi Informasi (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 4, '', '2025-07-02 15:59:08', '2025-07-02 15:59:08', NULL, NULL, NULL),
(18, 'kepuasan_komunikasi', 'Komunikasi (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 5, '', '2025-07-02 16:00:01', '2025-07-02 16:00:01', NULL, NULL, NULL),
(19, 'kepuasan_kerjasama', 'Kerja Sama (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 6, '', '2025-07-02 16:00:48', '2025-07-02 16:00:48', NULL, NULL, NULL),
(20, 'kepuasan_pengembangan_diri', 'Pengembangan Diri (1 = Sangat Kurang, 5 = Sangat Baik)', 'Penilaian terhadap pembelajaran di kampus', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 0, 2, 7, '', '2025-07-02 16:01:39', '2025-07-02 16:01:39', NULL, NULL, NULL),
(21, 'relevansi_kurikulum', 'Relevansi Kurikulum', 'Relevansi Kurikulum & Saran', 'select', '[\"Tinggi\",\"Sedang\",\"Rendah\"]', 0, 2, 8, '', '2025-07-02 16:02:28', '2025-07-02 16:02:28', NULL, NULL, NULL),
(22, 'saran_kurikulum', 'Saran/Masukan untuk Kampus', 'Relevansi Kurikulum & Saran', 'textarea', '', 0, 2, 9, '', '2025-07-02 16:03:03', '2025-07-02 16:03:03', NULL, NULL, NULL),
(23, 'harapan_umaha', 'Bagaimana harapan Anda terhadap lulusan UMAHA?', 'Relevansi Kurikulum & Saran', 'textarea', '', 0, 2, 10, '', '2025-07-02 16:03:39', '2025-07-02 16:03:39', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `field_name` (`field_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
