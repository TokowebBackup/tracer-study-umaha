-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2026 at 06:58 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_admin` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_admin`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$zmunf9nOZ6dSzPMl8xqtDO7yE/35znyqQZqIbMiJ1rPu7sSdlk1/i', 'Administrator', 'admin@umaha.ac.id', '2025-06-29 07:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `program_studi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenjang` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_masuk` year DEFAULT NULL,
  `tahun_lulus` int DEFAULT NULL,
  `fakultas` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `provinsi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kota` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `nim`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `program_studi`, `jenjang`, `tahun_masuk`, `tahun_lulus`, `fakultas`, `sumber_dana`, `email`, `nik`, `npwp`, `no_hp`, `password`, `created_at`, `provinsi`, `kota`) VALUES
(1, '212313213', 'Fulan Embre', 'Laki-laki', 'Bandung', '1999-05-22', '55202', 'S1', '2018', 2024, 'Teknik Informatik', 'Gaji', 'fulan@mail.com', NULL, NULL, '08123456789', '$2y$10$.QKieLKZqRrg3aS0eU60LOI36htckhKNXG4s0JeFA9hVpiqsEQhSu', '2025-06-29 07:06:09', 'Jawa Barat', 'Bandung'),
(2, '12139183913', 'puji ermanto', NULL, NULL, NULL, '26201', NULL, NULL, 2024, NULL, NULL, 'pujiermanto@gmail.com', NULL, NULL, NULL, '$2y$10$V1f8bxa2ZpdA/T1Xn.o9i.MuXrVZ/lMKPIlNkVKum5YomfDoc1jsC', '2026-05-12 22:57:40', NULL, NULL);

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
(23, 'harapan_umaha', 'Bagaimana harapan Anda terhadap lulusan UMAHA?', 'Relevansi Kurikulum & Saran', 'textarea', '', 0, 2, 10, '', '2025-07-02 16:03:39', '2025-07-02 16:03:39', NULL, NULL, NULL),
(24, 'email', 'Email', 'Biodata Alumni', 'text', '', 1, 1, 14, '', NULL, NULL, NULL, NULL, NULL),
(25, 'nik', 'NIK', 'Biodata Alumni', 'text', '', 0, 1, 15, '', NULL, NULL, NULL, NULL, NULL),
(26, 'npwp', 'NPWP', 'Biodata Alumni', 'text', '', 0, 1, 16, '', NULL, NULL, NULL, NULL, NULL),
(27, 'sumber_biaya_studi_lanjut', 'Sumber Biaya Studi Lanjut', 'Studi Lanjut', 'select', '[\"Biaya Sendiri\",\"Beasiswa\",\"LPDP\",\"Lainnya\"]', 0, 1, 17, '', NULL, NULL, 'status_pekerjaan', 'Studi Lanjut', NULL),
(28, 'perguruan_tinggi_studi_lanjut', 'Nama Perguruan Tinggi', 'Studi Lanjut', 'text', '', 0, 1, 18, '', NULL, NULL, 'status_pekerjaan', 'Studi Lanjut', NULL),
(29, 'program_studi_lanjut', 'Program Studi Lanjut', 'Studi Lanjut', 'text', '', 0, 1, 19, '', NULL, NULL, 'status_pekerjaan', 'Studi Lanjut', NULL),
(30, 'nama_usaha', 'Nama Usaha', 'Data Wirausaha', 'text', '', 0, 1, 20, '', NULL, NULL, 'status_pekerjaan', 'Wirausaha', NULL),
(31, 'skala_usaha', 'Skala Usaha', 'Data Wirausaha', 'select', '[\"Mikro\",\"Kecil\",\"Menengah\",\"Besar\"]', 0, 1, 21, '', NULL, NULL, 'status_pekerjaan', 'Wirausaha', NULL),
(32, 'pendapatan_usaha', 'Pendapatan Usaha per Bulan', 'Data Wirausaha', 'number', '', 0, 1, 22, '', NULL, NULL, 'status_pekerjaan', 'Wirausaha', NULL),
(37, 'kebutuhan_etika', 'Etika Profesional Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 100, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'kebutuhan_keahlian_bidang_ilmu', 'Keahlian Bidang Ilmu Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 101, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'kebutuhan_bahasa_inggris', 'Bahasa Inggris Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 102, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'kebutuhan_teknologi_informasi', 'Teknologi Informasi Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 103, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'kebutuhan_komunikasi', 'Komunikasi Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 104, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'kebutuhan_kerjasama', 'Kerjasama Tim Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 105, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'kebutuhan_pengembangan_diri', 'Pengembangan Diri Dibutuhkan di Tempat Kerja', 'Kebutuhan Kompetensi di Tempat Kerja', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 106, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'kontribusi_perkuliahan', 'Kontribusi Perkuliahan', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 110, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'kontribusi_demonstrasi', 'Kontribusi Demonstrasi Dosen', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 111, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'kontribusi_riset', 'Kontribusi Riset / Penelitian', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 112, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'kontribusi_diskusi', 'Kontribusi Diskusi / Seminar', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 113, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'kontribusi_praktikum', 'Kontribusi Praktikum', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 114, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'kontribusi_magang', 'Kontribusi Magang / PKL', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 115, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'kontribusi_studi_kasus', 'Kontribusi Studi Kasus', 'Kontribusi Metode Pembelajaran', 'select', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, 2, 116, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'mulai_mencari_kerja', 'Kapan Mulai Mencari Kerja', 'Proses Pencarian Kerja', 'select', '[\"Sebelum lulus\",\"Setelah lulus\",\"Tidak mencari kerja\"]', 1, 2, 120, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'jumlah_lamaran', 'Jumlah Perusahaan yang Dilamar', 'Proses Pencarian Kerja', 'select', '[\"Belum pernah melamar\",\"1-2 perusahaan\",\"3-5 perusahaan\",\"6-10 perusahaan\",\"11-20 perusahaan\",\"Lebih dari 20 perusahaan\"]', 1, 2, 121, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'jumlah_respon', 'Jumlah Respon Lamaran', 'Proses Pencarian Kerja', 'select', '[\"Tidak ada\",\"1-2 perusahaan\",\"3-5 perusahaan\",\"6-10 perusahaan\",\"Lebih dari 10 perusahaan\"]', 1, 2, 122, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'jumlah_wawancara', 'Jumlah Undangan Wawancara', 'Proses Pencarian Kerja', 'select', '[\"Tidak ada\",\"1 perusahaan\",\"2-3 perusahaan\",\"4-5 perusahaan\",\"Lebih dari 5 perusahaan\"]', 1, 2, 123, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'aktif_mencari_kerja', 'Status Aktif Mencari Kerja', 'Proses Pencarian Kerja', 'select', '[\"Ya\",\"Tidak karena sudah bekerja\",\"Tidak karena studi lanjut\",\"Tidak karena alasan lain\"]', 1, 2, 124, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'alasan_pekerjaan_tidak_sesuai', 'Alasan Mengambil Pekerjaan Tidak Sesuai Bidang', 'Proses Pencarian Kerja', 'textarea', NULL, 0, 2, 125, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `landing_page`
--

CREATE TABLE `landing_page` (
  `id` int NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `subjudul` text COLLATE utf8mb4_general_ci,
  `konten` text COLLATE utf8mb4_general_ci,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_general_ci DEFAULT 'nonaktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `facebook` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_page`
--

INSERT INTO `landing_page` (`id`, `judul`, `subjudul`, `konten`, `gambar`, `status`, `created_at`, `updated_at`, `facebook`, `instagram`, `twitter`, `linkedin`, `youtube`) VALUES
(1, 'Tracer Study UMAHA', 'Jembatan antara kampus dan alumni untuk menilai dampak pendidikan dan kesiapan dunia kerja lulusan UMAHA.', 'Dukung pengembangan kurikulum dan peningkatan mutu lulusan dengan berpartisipasi aktif dalam Tracer Study Universitas Maarif Hasyim Latif.', NULL, 'aktif', '2025-07-02 15:04:02', '2025-07-02 15:04:02', 'https://facebook.com/umaha', 'https://instagram.com/umaha', 'https://twitter.com/umaha', 'https://linkedin.com/umaha', '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-05-12-155809', 'App\\Database\\Migrations\\AddNikNpwpToAlumni', 'default', 'App', 1778601700, 1),
(2, '2026-05-13-000001', 'App\\Database\\Migrations\\FinalisasiTracerKemendikbud', 'default', 'App', 1778637912, 2),
(3, '2026-05-13-000002', 'App\\Database\\Migrations\\CreatePenggunaRequest', 'default', 'App', 1778654391, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_lulusan`
--

CREATE TABLE `pengguna_lulusan` (
  `id` int NOT NULL,
  `nama_perusahaan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_perusahaan` text COLLATE utf8mb4_general_ci,
  `nama_pengisi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan_pengisi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_pengisi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telp_pengisi` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_merekrut` int DEFAULT NULL,
  `jumlah_lulusan_direkrut` int DEFAULT NULL,
  `etika_kerja` tinyint DEFAULT NULL,
  `keahlian_profesional` tinyint DEFAULT NULL,
  `penguasaan_bahasa_asing` tinyint DEFAULT NULL,
  `teknologi_informasi` tinyint DEFAULT NULL,
  `komunikasi` tinyint DEFAULT NULL,
  `kerjasama` tinyint DEFAULT NULL,
  `pengembangan_diri` tinyint DEFAULT NULL,
  `saran_umum` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `nama_pegawai_dinilai` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asal_program_studi_pegawai` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_lulus_pegawai` year DEFAULT NULL,
  `harapan_lulusan_umaha` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna_lulusan`
--

INSERT INTO `pengguna_lulusan` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `nama_pengisi`, `jabatan_pengisi`, `email_pengisi`, `no_telp_pengisi`, `tahun_merekrut`, `jumlah_lulusan_direkrut`, `etika_kerja`, `keahlian_profesional`, `penguasaan_bahasa_asing`, `teknologi_informasi`, `komunikasi`, `kerjasama`, `pengembangan_diri`, `saran_umum`, `created_at`, `nama_pegawai_dinilai`, `asal_program_studi_pegawai`, `tahun_lulus_pegawai`, `harapan_lulusan_umaha`) VALUES
(3, 'Lembaga Kantor Berita Nasional Antara', 'Jakarta', 'Yayan Jatnika ', 'Special Director', 'yayan@antaranews.com', '0882313131313', 2024, 1, 1, 1, 2, 1, 3, 1, 1, 'Lorem ipsum dolor sit amet constrectum amedish ameda', '2026-05-13 13:31:59', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_lulusan_detail`
--

CREATE TABLE `pengguna_lulusan_detail` (
  `id` int NOT NULL,
  `pengguna_id` int DEFAULT NULL,
  `alumni_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_request`
--

CREATE TABLE `pengguna_request` (
  `id` int UNSIGNED NOT NULL,
  `alumni_id` int UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_perusahaan` text COLLATE utf8mb4_general_ci,
  `email_hrd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penilai` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan_penilai` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telp_penilai` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_submitted` tinyint(1) NOT NULL DEFAULT '0',
  `submitted_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode_tracer`
--

CREATE TABLE `periode_tracer` (
  `id` int NOT NULL,
  `tahun` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lulusan_tahun` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_tracer`
--

INSERT INTO `periode_tracer` (`id`, `tahun`, `lulusan_tahun`, `tanggal_mulai`, `tanggal_selesai`, `file_surat`) VALUES
(1, '2026', '2025', '2025-06-25', '2026-08-25', 'uploads/surat/1778602507_27b6ecd771f1e65d04bf.pdf'),
(3, '2024', '2025', '2024-02-01', '2025-02-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int NOT NULL,
  `kode_prodi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_prodi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenjang` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id` int NOT NULL,
  `key_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`) VALUES
(1, 'panduan_tracer', 'uploads/panduan_tracer_1778606710.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tracer_study`
--

CREATE TABLE `tracer_study` (
  `id` int NOT NULL,
  `alumni_id` int NOT NULL,
  `tahun_pengisian` int NOT NULL,
  `tahun_lulus` int DEFAULT NULL,
  `status_pekerjaan` enum('bekerja','wirausaha','belum_bekerja','studi_lanjut') COLLATE utf8mb4_general_ci NOT NULL,
  `institusi_bekerja` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `posisi_pekerjaan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_mulai_bekerja` int DEFAULT NULL,
  `gaji_pertama` int DEFAULT NULL,
  `tempat_kerja_kabupaten` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sektor_tempat_kerja` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sesuai_bidang` enum('ya','tidak') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dapat_kerja_sebelum_lulus` enum('ya','tidak') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cara_mendapat_kerja` text COLLATE utf8mb4_general_ci,
  `kepuasan_etika` tinyint DEFAULT NULL,
  `kepuasan_keahlian_bidan_ilmu` tinyint DEFAULT NULL,
  `kepuasan_bahasa_asing` tinyint DEFAULT NULL,
  `kepuasan_teknologi_informasi` tinyint DEFAULT NULL,
  `kepuasan_komunikasi` tinyint DEFAULT NULL,
  `kepuasan_kerjasama` tinyint DEFAULT NULL,
  `kepuasan_pengembangan_diri` tinyint DEFAULT NULL,
  `relevansi_kurikulum` enum('tinggi','sedang','rendah') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saran_kurikulum` text COLLATE utf8mb4_general_ci,
  `harapan_umaha` longtext COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `domisili_alumni` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bulan_mulai_mencari_pekerjaan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` text COLLATE utf8mb4_general_ci,
  `nik` text COLLATE utf8mb4_general_ci,
  `npwp` text COLLATE utf8mb4_general_ci,
  `sumber_biaya_studi_lanjut` text COLLATE utf8mb4_general_ci,
  `perguruan_tinggi_studi_lanjut` text COLLATE utf8mb4_general_ci,
  `program_studi_lanjut` text COLLATE utf8mb4_general_ci,
  `nama_usaha` text COLLATE utf8mb4_general_ci,
  `skala_usaha` text COLLATE utf8mb4_general_ci,
  `pendapatan_usaha` int DEFAULT NULL,
  `kebutuhan_etika` tinyint(1) DEFAULT NULL,
  `kebutuhan_keahlian_bidang_ilmu` tinyint(1) DEFAULT NULL,
  `kebutuhan_bahasa_inggris` tinyint(1) DEFAULT NULL,
  `kebutuhan_teknologi_informasi` tinyint(1) DEFAULT NULL,
  `kebutuhan_komunikasi` tinyint(1) DEFAULT NULL,
  `kebutuhan_kerjasama` tinyint(1) DEFAULT NULL,
  `kebutuhan_pengembangan_diri` tinyint(1) DEFAULT NULL,
  `kontribusi_perkuliahan` tinyint(1) DEFAULT NULL,
  `kontribusi_demonstrasi` tinyint(1) DEFAULT NULL,
  `kontribusi_riset` tinyint(1) DEFAULT NULL,
  `kontribusi_diskusi` tinyint(1) DEFAULT NULL,
  `kontribusi_praktikum` tinyint(1) DEFAULT NULL,
  `kontribusi_magang` tinyint(1) DEFAULT NULL,
  `kontribusi_studi_kasus` tinyint(1) DEFAULT NULL,
  `mulai_mencari_kerja` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_lamaran` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_respon` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_wawancara` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aktif_mencari_kerja` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alasan_pekerjaan_tidak_sesuai` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracer_study`
--

INSERT INTO `tracer_study` (`id`, `alumni_id`, `tahun_pengisian`, `tahun_lulus`, `status_pekerjaan`, `institusi_bekerja`, `posisi_pekerjaan`, `tahun_mulai_bekerja`, `gaji_pertama`, `tempat_kerja_kabupaten`, `sektor_tempat_kerja`, `sesuai_bidang`, `dapat_kerja_sebelum_lulus`, `cara_mendapat_kerja`, `kepuasan_etika`, `kepuasan_keahlian_bidan_ilmu`, `kepuasan_bahasa_asing`, `kepuasan_teknologi_informasi`, `kepuasan_komunikasi`, `kepuasan_kerjasama`, `kepuasan_pengembangan_diri`, `relevansi_kurikulum`, `saran_kurikulum`, `harapan_umaha`, `created_at`, `domisili_alumni`, `bulan_mulai_mencari_pekerjaan`, `updated_at`, `email`, `nik`, `npwp`, `sumber_biaya_studi_lanjut`, `perguruan_tinggi_studi_lanjut`, `program_studi_lanjut`, `nama_usaha`, `skala_usaha`, `pendapatan_usaha`, `kebutuhan_etika`, `kebutuhan_keahlian_bidang_ilmu`, `kebutuhan_bahasa_inggris`, `kebutuhan_teknologi_informasi`, `kebutuhan_komunikasi`, `kebutuhan_kerjasama`, `kebutuhan_pengembangan_diri`, `kontribusi_perkuliahan`, `kontribusi_demonstrasi`, `kontribusi_riset`, `kontribusi_diskusi`, `kontribusi_praktikum`, `kontribusi_magang`, `kontribusi_studi_kasus`, `mulai_mencari_kerja`, `jumlah_lamaran`, `jumlah_respon`, `jumlah_wawancara`, `aktif_mencari_kerja`, `alasan_pekerjaan_tidak_sesuai`) VALUES
(4, 1, 2025, 2024, 'bekerja', 'Antara News', 'Senior App Engineer', 2024, 5500000, NULL, 'BUMN', 'ya', NULL, 'Melamar melalui forum job seeker', 1, 1, 1, 1, 1, 1, 1, 'tinggi', 'Ok lah kalau begitu bos', 'Bagus dan punya loyalitas selalu', '2025-07-02 23:27:22', NULL, '', '2026-05-12 10:01:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 2026, 2024, '', '', '', 0, 0, NULL, '', '', NULL, '', 2, 2, 2, 1, 1, 1, 1, 'tinggi', 'Lorem ipsum dulu', 'Lorem ipsum dolor sit amet', '2026-05-13 00:04:57', NULL, '', '2026-05-13 03:45:17', 'pujiermanto@gmail.com', '3332132131231', '', 'Beasiswa', 'Institut Teknologi Sepuluh Nopember (ITS)', 'Magister Teknik Industri', '', '', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 'Tidak mencari kerja', 'Belum pernah melamar', 'Tidak ada', 'Tidak ada', 'Tidak karena studi lanjut', '');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `pengguna_request`
--
ALTER TABLE `pengguna_request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `landing_page`
--
ALTER TABLE `landing_page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengguna_lulusan`
--
ALTER TABLE `pengguna_lulusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengguna_lulusan_detail`
--
ALTER TABLE `pengguna_lulusan_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna_request`
--
ALTER TABLE `pengguna_request`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periode_tracer`
--
ALTER TABLE `periode_tracer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracer_study`
--
ALTER TABLE `tracer_study`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
