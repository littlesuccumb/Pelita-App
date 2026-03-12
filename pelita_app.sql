-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2025 pada 08.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelita_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `seri` varchar(255) DEFAULT NULL,
  `tahun_produksi` year(4) DEFAULT NULL,
  `spesifikasi` text DEFAULT NULL,
  `warna` varchar(255) DEFAULT NULL,
  `berat` decimal(8,2) DEFAULT NULL COMMENT 'dalam kg',
  `dimensi` varchar(255) DEFAULT NULL COMMENT 'pxlxt dalam cm',
  `garansi` varchar(255) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `harga_beli` decimal(14,2) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah_total` int(11) NOT NULL DEFAULT 1,
  `jumlah_tersedia` int(11) NOT NULL DEFAULT 1,
  `jumlah_maintenance` int(11) NOT NULL DEFAULT 0,
  `kondisi` enum('baik','rusak ringan','rusak berat') NOT NULL DEFAULT 'baik',
  `lokasi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL COMMENT 'DEPRECATED: Foto utama barang (gunakan relasi barang_foto untuk multiple foto)',
  `harga_sewa` decimal(14,2) NOT NULL DEFAULT 0.00,
  `status` enum('tersedia','dipinjam','maintenance') NOT NULL DEFAULT 'tersedia',
  `dapat_dipinjam` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Menentukan apakah barang dapat dipinjam (1=Ya, 0=Tidak)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lainnya` text DEFAULT NULL COMMENT 'Keterangan dan spesifikasi tambahan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kategori_id`, `kode_barang`, `nama_barang`, `merk`, `type`, `seri`, `tahun_produksi`, `spesifikasi`, `warna`, `berat`, `dimensi`, `garansi`, `tanggal_pembelian`, `harga_beli`, `deskripsi`, `jumlah_total`, `jumlah_tersedia`, `jumlah_maintenance`, `kondisi`, `lokasi`, `foto`, `harga_sewa`, `status`, `dapat_dipinjam`, `created_at`, `updated_at`, `lainnya`) VALUES
(1, 1, 'BRG-PRJ-01', 'Proyektor HD', 'Epson', 'EB-X41', 'X41-2023', '2023', 'XGA (1024 x 768) resolution, 3,600 lumens brightness, HDMI, VGA, USB connectivity', 'Putih', 2.50, '30x20x10', '2 tahun', '2023-06-15', 8500000.00, 'Proyektor resolusi tinggi untuk presentasi dan acara multimedia', 10, 8, 0, 'baik', 'Multimedia Room / Convention Hall', 'barang/proyektor.png', 50000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-12-04 20:07:20', NULL),
(2, 1, 'BRG-SS-01', 'Speaker & Sound System', 'JBL', 'EON615', 'EON-615-PRO', '2022', '1000W powered speaker, 15\" woofer, Bluetooth connectivity, XLR/TRS inputs', 'Hitam', 18.60, '46x38x69', '3 tahun', '2022-08-20', 12000000.00, 'Sistem suara profesional untuk acara besar dan konser', 5, 1, 0, 'baik', 'Convention Hall', 'barang/speaker.png', 100000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-11-11 13:31:50', NULL),
(3, 2, 'BRG-KRS-01', 'Kursi Lipat', 'Chitose', 'Folding Chair', 'FC-100', '2021', 'Plastik PP berkualitas tinggi, tahan cuaca, lipat praktis', 'Biru', 3.20, '45x45x80', '1 tahun', '2021-03-10', 150000.00, 'Kursi lipat plastik serbaguna untuk berbagai acara', 100, 85, 15, 'baik', 'Convention Hall / Aula', 'barang/kursi lipat.png', 5000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-12-04 19:37:50', 'Bahan besi'),
(4, 2, 'BRG-MJG-01', 'Meja Lipat', 'Indachi', 'Folding Table', 'FT-180', '2021', 'Top kayu lapis dilapisi HPL, kaki besi powder coating', 'Coklat Kayu', 25.50, '180x80x75', '2 tahun', '2021-04-15', 750000.00, 'Meja lipat besar untuk pelatihan, seminar, dan pameran', 20, 12, 0, 'baik', 'Ruang Rapat / Showroom', 'barang/meja lipat.png', 10000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-12-04 20:07:21', NULL),
(5, 3, 'BRG-PC-01', 'Komputer Desktop', 'ASUS', 'All-in-One', 'V241FAK-BA441T', '2022', 'Intel Core i3-10110U, 4GB RAM, 1TB HDD, 23.8\" Monitor, Windows 11', 'Hitam', 5.80, '54x35x18', '3 tahun', '2022-01-20', 9500000.00, 'Komputer desktop all-in-one untuk lab multimedia dan pembelajaran', 40, 30, 0, 'baik', 'Lab Multimedia', 'barang/komputer.png', 0.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-12-04 19:37:58', 'test'),
(6, 3, 'BRG-VR-01', 'Oculus VR Headset', 'Meta', 'Quest 2', 'MH-A3A00', '2023', '128GB storage, 6DOF tracking, 90Hz refresh rate, hand tracking', 'Putih', 0.50, '19x14x10', '1 tahun', '2023-09-10', 5500000.00, 'Perangkat VR terbaru untuk pengalaman virtual reality dan augmented reality', 5, 1, 0, 'baik', 'Oculus VR Room', 'barang/oculus vr.png', 600000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-12-06 20:55:33', NULL),
(7, 4, 'BRG-LG-01', 'Lampu Studioooo', 'Godox', 'SL-60W', 'SL60W-2023', '2023', '60W LED continuous light, 5600K color temperature, CRI 96+, Bowens mount', 'Hitam', 1.95, '22x15x20', '2 tahun', '2023-05-12', 2800000.00, 'Lampu LED profesional untuk studio foto dan video production', 5, 5, 0, 'baik', 'Studio Foto', 'barang/lampu studio.png', 50000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-11-13 19:53:13', NULL),
(8, 4, 'BRG-MIX-01', 'Sound Mixer', 'Yamaha', 'MG10XU', 'MG10XU-V2', '2022', '10-channel mixing console, built-in SPX effects, USB interface, phantom power', 'Hitam', 2.40, '32x22x7', '3 tahun', '2022-11-05', 4500000.00, 'Mixer audio profesional untuk dubbing, recording, dan live performance', 5, 5, 0, 'baik', 'Studio Dubbing', 'barang/sound mixer.png', 75000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-11-13 12:47:16', NULL),
(9, 4, 'BRG-KMR-01', 'Kamera Profesional', 'Canon', 'EOS R6 Mark II', 'R6M2-2023', '2023', '24.2MP full-frame sensor, 4K video recording, dual card slots, image stabilization', 'Hitam', 0.59, '14x10x9', '2 tahun internasional', '2023-07-18', 42000000.00, 'Kamera DSLR mirrorless profesional untuk studio foto dan videografi', 15, 14, 0, 'baik', 'Studio Foto', 'barang/kamera.png', 75000.00, 'tersedia', 1, '2025-09-17 23:17:36', '2025-12-06 20:55:40', NULL),
(11, 5, 'CTP-OLA-01312-2025', 'Alat Fitness', 'Mizuno', 'Gatau juga ah', '123421', '2017', 'Gatau ah pusing', 'Ijo', 5.00, '20 x 10 x 40', '2 Tahun', NULL, 500000.00, 'Salam Olahraga', 5, 4, 0, 'baik', 'Lapang Olahraga CTP', 'barang/barang_1758746675_hN6BgJOitl.png', 50000.00, 'tersedia', 1, '2025-09-24 13:44:35', '2025-11-09 21:33:42', 'Bahan Baku : besi'),
(13, 2, 'CTP-FUR-32124-2025', 'Donat Pinkan', 'Jco', 'Bulat', '12654', '2025', 'Enaknyooo', 'Pinky', 12.00, '20 x 10 x 40', '2 Tahun', '2025-09-01', 2000.00, 'Bulat dan Berlubang', 20, 15, 0, 'baik', 'Lantai 3', 'barang/barang_1759007238_yWdUW1RWzz.png', 20000.00, 'tersedia', 1, '2025-09-27 14:07:19', '2025-11-12 13:59:19', 'Bahan baku : Tepung dan gula dan terimakasih'),
(15, 4, 'CTP-ALA-45632-2025', 'Pizza', 'Jco', 'Bulat', '123421', '2010', 'Lezattos', 'Ijo', 10.00, '20 x 10 x 40', '5 Tahun', '2025-06-03', 20000.00, 'Pizza', 50, 44, 0, 'baik', 'Lapang Olahraga CTP', 'barang/barang_1759388860_6FJJbExoNl.png', 10000.00, 'tersedia', 1, '2025-10-02 00:07:40', '2025-11-21 03:08:07', 'Bahan roti'),
(18, 6, 'CTP-MAK-00001-2025', 'Donat Chocolatte', 'Dunkins Donat', 'Bulat', 'DN-203', '2024', 'Bulat dan Lezatttt', 'Chocolate', 0.20, '3x3x5', '2 Tahun', '2025-08-02', 5000.00, 'Donat lezat dan chocolate', 60, 30, -5, 'baik', 'Dapur', 'barang/barang_1761340175_U3NGCQcbRM.png', 50000.00, 'tersedia', 1, '2025-10-24 14:09:35', '2025-11-21 18:21:04', 'Bahan baku : Roti gandum ber protein tinggi'),
(19, 6, 'CTP-MAK-00002-2025', 'Cupcake Chocolatte', 'Samsung', 'Kue', 'CC-021', '2025', 'Cupcake lezat', 'Chocolate', 0.20, '2x5x2', '3 Tahun', '2025-10-03', 10000.00, 'Cupcake lumerr', 50, 30, -5, 'baik', 'Dapur', 'barang/barang_1761340605_KjjqEqtDaA.png', 100000.00, 'tersedia', 1, '2025-10-24 14:16:45', '2025-11-21 03:07:23', 'Bahan baku : Roti panggang'),
(20, 6, 'CTP-MAK-00004-2025', 'Cupcake Vanilla', 'Samsung', 'Cookies', 'CC-01232', '2024', 'Cupcake unik dengan tampilan yang menggoda', 'Cream', 0.50, '2x4x3', '6 Tahun', '2025-10-12', 10000.00, 'Cupcake lezat dan nikmat', 40, 40, -10, 'baik', 'Dapur', 'barang/barang_1761416542_OBp3CuCm4F.png', 50000.00, 'tersedia', 1, '2025-10-25 11:22:22', '2025-11-21 03:07:52', 'Bahan Baku : Roti import'),
(21, 6, 'CTP-MAK-00005-2025', 'Crossaint', 'Samsung', 'Roti', 'CR-00982', '2025', 'Lezat', 'Emas', 2.00, '5x6x5', '2 Tahun', '2025-10-19', 20000.00, 'Enak', 15, 13, 0, 'baik', 'Dapur', 'barang/barang_1761417468_B3hT83KRlp.png', 70000.00, 'tersedia', 1, '2025-10-25 11:37:48', '2025-11-28 19:55:46', 'Manis'),
(25, 3, 'CTP-KOM-23233-2025', 'Baso', 'Samsung', 'Bulat', '232323', '2020', NULL, 'Hijau', 199.00, '2x5x2', '900 Tahun', NULL, NULL, NULL, 13, 10, -3, 'baik', 'Saku celana', 'barang/barang_1764359884_mICibYrKT6.jpg', 2000.00, 'tersedia', 1, '2025-11-28 19:58:04', '2025-12-03 18:55:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_foto`
--

CREATE TABLE `barang_foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL COMMENT 'Path file foto',
  `is_primary` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Apakah foto ini foto utama (1=Ya, 0=Tidak)',
  `urutan` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampilan foto (semakin kecil semakin depan)',
  `keterangan` varchar(255) DEFAULT NULL COMMENT 'Keterangan/caption foto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_foto`
--

INSERT INTO `barang_foto` (`id`, `barang_id`, `foto`, `is_primary`, `urutan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'barang/proyektor.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(2, 2, 'barang/speaker.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(3, 3, 'barang/kursi lipat.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(4, 4, 'barang/meja lipat.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(5, 5, 'barang/komputer.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(6, 6, 'barang/oculus vr.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(7, 7, 'barang/lampu studio.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(8, 8, 'barang/sound mixer.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(9, 9, 'barang/kamera.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(10, 11, 'barang/barang_1758746675_hN6BgJOitl.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 09:51:22'),
(11, 13, 'barang/barang_1759007238_yWdUW1RWzz.png', 1, 0, 'Foto utama', '2025-10-24 09:51:22', '2025-10-24 13:38:27'),
(12, 15, 'barang/barang_1759388860_6FJJbExoNl.png', 1, 0, 'Foto utama (migrasi dari sistem lama)', '2025-10-24 09:51:22', '2025-10-24 13:41:04'),
(14, 13, 'barang/barang_1761328774_hiRLKqFeMO.png', 0, 1, 'Bagian samping', '2025-10-24 10:59:34', '2025-10-24 13:38:27'),
(19, 18, 'barang/barang_1761340175_primary_T0mJTXRd6b.png', 1, 0, 'Foto Utama', '2025-10-24 14:09:35', '2025-10-24 14:12:38'),
(20, 18, 'barang/barang_1761340251_ilAvAP4rN0.png', 0, 1, NULL, '2025-10-24 14:10:51', '2025-10-24 14:12:38'),
(21, 18, 'barang/barang_1761340264_smpvVgkqgu.jpg', 0, 2, NULL, '2025-10-24 14:11:04', '2025-10-24 14:12:38'),
(22, 19, 'barang/barang_19_primary_1761340605_YFofOzE2.png', 1, 0, 'Foto Utama', '2025-10-24 14:16:45', '2025-10-24 14:16:45'),
(23, 19, 'barang/barang_1761340722_YpTascQz1B.jpg', 0, 1, NULL, '2025-10-24 14:18:42', '2025-10-24 14:18:42'),
(24, 19, 'barang/barang_1761340734_UwiuQqxS1s.png', 0, 2, NULL, '2025-10-24 14:18:54', '2025-10-24 14:18:54'),
(25, 20, 'barang/barang_20_primary_1761416542_qsUjHV5S.png', 1, 0, 'Foto Utama', '2025-10-25 11:22:22', '2025-10-25 11:22:22'),
(26, 20, 'barang/barang_20_detail_1_1761416542_VoGMUORo.png', 0, 1, 'Foto Detail 1', '2025-10-25 11:22:22', '2025-10-25 11:22:22'),
(27, 20, 'barang/barang_20_detail_2_1761416542_Yfd8ZU2E.png', 0, 2, 'Foto Detail 2', '2025-10-25 11:22:22', '2025-10-25 11:22:22'),
(28, 20, 'barang/barang_20_detail_3_1761416542_o6t5BwtL.png', 0, 3, 'Foto Detail 3', '2025-10-25 11:22:22', '2025-10-25 11:22:22'),
(29, 20, 'barang/barang_20_detail_4_1761416542_qGPcL7Cx.png', 0, 4, 'Foto Detail 4', '2025-10-25 11:22:22', '2025-10-25 11:22:22'),
(30, 21, 'barang/barang_21_primary_1761417468_WdknwufX.png', 1, 0, 'Foto Utama', '2025-10-25 11:37:48', '2025-11-17 14:38:12'),
(31, 21, 'barang/barang_21_detail_1_1761417468_ikm0OcwW.png', 0, 1, 'Foto Detail 1', '2025-10-25 11:37:48', '2025-11-17 14:38:12'),
(32, 21, 'barang/barang_21_detail_2_1761417468_SE64wAR6.png', 0, 2, 'Foto Detail 2', '2025-10-25 11:37:48', '2025-11-17 14:38:12'),
(45, 25, 'barang/barang_25_primary_1764359884_Xyw5rY4r.jpg', 1, 0, 'Foto Utama', '2025-11-28 19:58:04', '2025-11-28 19:58:04'),
(46, 25, 'barang/barang_25_detail_1_1764359997_kILVlv5r.jpg', 0, 1, 'Foto Detail 1', '2025-11-28 19:59:57', '2025-11-28 19:59:57'),
(47, 25, 'barang/barang_25_detail_2_1764360681_o7gazO2d.jpg', 0, 2, 'Foto Detail 2', '2025-11-28 20:11:21', '2025-11-28 20:11:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_dokumen` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id`, `peminjaman_id`, `jenis_dokumen`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'berita_acara', 'dokumen/berita_acara/berita-acara-1-1763970262.docx', '2025-11-24 07:44:22', '2025-11-24 07:44:22'),
(2, 2, 'berita_acara', 'dokumen/berita_acara/berita-acara-2-1764094483.docx', '2025-11-25 18:14:51', '2025-11-25 18:14:51'),
(3, 3, 'berita_acara', 'dokumen/berita_acara/berita-acara-3-1764878841.docx', '2025-12-04 20:07:28', '2025-12-04 20:07:28'),
(4, 4, 'berita_acara', 'dokumen/berita_acara/berita-acara-4-1765054540.docx', '2025-12-06 20:55:46', '2025-12-06 20:55:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Audio Visuall', 'Peralatan presentasi seperti proyektor, sound system', '2025-09-17 23:17:36', '2025-10-10 12:20:36'),
(2, 'Furniture', 'Kursi, meja, backdrop, etalase', '2025-09-17 23:17:36', '2025-09-17 23:17:36'),
(3, 'Komputer & IT', 'PC, laptop, perangkat multimedia, VR', '2025-09-17 23:17:36', '2025-09-17 23:17:36'),
(4, 'Alat Studio', 'Lampu studio, mikrofon, mixer, kamera', '2025-09-17 23:17:36', '2025-09-17 23:17:36'),
(5, 'Olahraga & Outdoor', 'Alat fitness outdoor dan fasilitas taman', '2025-09-17 23:17:36', '2025-09-17 23:17:36'),
(6, 'Makanan', 'Makanan untuk di makan', '2025-10-24 13:59:09', '2025-11-18 11:34:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipe` enum('aktivitas','notifikasi') NOT NULL DEFAULT 'aktivitas' COMMENT 'Tipe: aktivitas untuk log biasa, notifikasi untuk notifikasi user',
  `aksi` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `tipe`, `aksi`, `detail`, `url`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'aktivitas', 'Menghapus Avatar', 'Menghapus foto profil', NULL, 0, NULL, '2025-11-24 07:20:32', '2025-11-24 07:20:32'),
(2, 1, 'aktivitas', 'Request OTP Password', 'Meminta kode OTP untuk ganti password', NULL, 0, NULL, '2025-11-24 07:22:00', '2025-11-24 07:22:00'),
(3, 1, 'aktivitas', 'Mengubah Profil', 'Memperbarui informasi profil: Super Admin', NULL, 0, NULL, '2025-11-24 07:22:28', '2025-11-24 07:22:28'),
(4, 1, 'aktivitas', 'Request OTP Password', 'Meminta kode OTP untuk ganti password', NULL, 0, NULL, '2025-11-24 07:22:57', '2025-11-24 07:22:57'),
(5, 1, 'aktivitas', 'Mengubah Password', 'Memperbarui password akun dengan verifikasi OTP', NULL, 0, NULL, '2025-11-24 07:23:41', '2025-11-24 07:23:41'),
(6, 14, 'aktivitas', 'Mengajukan Permohonan', 'Mengajukan permohonan untuk: Oculus VR Headset', NULL, 0, NULL, '2025-11-24 07:25:58', '2025-11-24 07:25:58'),
(7, 1, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Terry Mutiara Utari dengan nomor PRM/2025/11/001', 'http://172.16.100.61:8000/admin/permohonan/1', 1, '2025-11-24 07:28:17', '2025-11-24 07:25:58', '2025-11-24 07:28:17'),
(8, 2, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Terry Mutiara Utari dengan nomor PRM/2025/11/001', 'http://172.16.100.61:8000/admin/permohonan/1', 0, NULL, '2025-11-24 07:25:58', '2025-11-24 07:25:58'),
(9, 14, 'aktivitas', 'Mengedit Permohonan', 'Mengedit permohonan ID: 1', NULL, 0, NULL, '2025-11-24 07:26:34', '2025-11-24 07:26:34'),
(10, 1, 'aktivitas', 'Menambah User', 'Super Admin menambahkan user baru: Rifky Ardiansyah (rifkyctp@gmail.com) dengan role: pengurus_aset', NULL, 0, NULL, '2025-11-24 07:27:07', '2025-11-24 07:27:07'),
(11, 14, 'aktivitas', 'Upload Surat Bertanda Tangan', 'Upload surat bertanda tangan untuk permohonan: PRM/2025/11/001', NULL, 0, NULL, '2025-11-24 07:27:32', '2025-11-24 07:27:32'),
(12, 1, 'aktivitas', 'Menyetujui Permohonan', 'Menyetujui permohonan ID: 1 dari user: Terry Mutiara Utari', NULL, 0, NULL, '2025-11-24 07:28:35', '2025-11-24 07:28:35'),
(13, 14, 'notifikasi', 'Permohonan Disetujui', 'Permohonan Anda dengan nomor PRM/2025/11/001 telah disetujui', 'http://172.16.100.61:8000/permohonan/1', 1, '2025-11-24 07:28:55', '2025-11-24 07:28:35', '2025-11-24 07:28:55'),
(14, 1, 'aktivitas', 'Menyetujui Peminjaman', 'Menyetujui peminjaman ID: 1 - Barang: Oculus VR Headset untuk user: Terry Mutiara Utari', NULL, 0, NULL, '2025-11-24 07:44:22', '2025-11-24 07:44:22'),
(15, 14, 'notifikasi', 'Peminjaman Disetujui', 'Peminjaman Oculus VR Headset telah disetujui. Silakan lakukan pembayaran', 'http://172.16.100.61:8000/peminjaman/1', 1, '2025-11-24 07:45:39', '2025-11-24 07:44:22', '2025-11-24 07:45:39'),
(16, 14, 'aktivitas', 'Melakukan Pembayaran', 'Melakukan pembayaran untuk peminjaman barang ID: 1 dengan metode: cash', NULL, 0, NULL, '2025-11-24 07:45:03', '2025-11-24 07:45:03'),
(17, 1, 'aktivitas', 'Menyelesaikan Peminjaman', 'Menyelesaikan peminjaman ID: 1 - Barang: Oculus VR Headset dari user: Terry Mutiara Utari', NULL, 0, NULL, '2025-11-24 07:46:20', '2025-11-24 07:46:20'),
(18, 14, 'notifikasi', 'Peminjaman Selesai', 'Peminjaman Oculus VR Headset telah selesai. Terima kasih!', 'http://172.16.100.61:8000/peminjaman/1', 1, '2025-11-24 07:46:29', '2025-11-24 07:46:20', '2025-11-24 07:46:29'),
(19, 15, 'aktivitas', 'Menambahkan Barang Baru', 'Menambahkan barang: komputer render dengan kode: CTP-KOM-00001-2025 (Kategori: Komputer & IT, Jumlah: 1 unit) dengan 2 foto', NULL, 0, NULL, '2025-11-24 08:10:55', '2025-11-24 08:10:55'),
(20, 1, 'aktivitas', 'Mengubah User', 'Super Admin mengubah data user: Muhamad Aliph Fauzansyah (mhmdal0104@gmail.com)', NULL, 0, NULL, '2025-11-24 08:34:01', '2025-11-24 08:34:01'),
(21, 1, 'aktivitas', 'Mengubah User', 'Super Admin mengubah data user: Muhamad Aliph Fauzansyah (mhmdal0104@gmail.com)', NULL, 0, NULL, '2025-11-25 16:47:17', '2025-11-25 16:47:17'),
(22, 16, 'aktivitas', 'Mengajukan Permohonan', 'Mengajukan permohonan untuk: Kursi Lipat, Meja Lipat, Komputer Desktop', NULL, 0, NULL, '2025-11-25 17:59:57', '2025-11-25 17:59:57'),
(23, 1, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/11/002', 'http://127.0.0.1:8000/admin/permohonan/2', 0, NULL, '2025-11-25 17:59:57', '2025-11-25 17:59:57'),
(24, 2, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/11/002', 'http://127.0.0.1:8000/admin/permohonan/2', 0, NULL, '2025-11-25 17:59:57', '2025-11-25 17:59:57'),
(25, 4, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/11/002', 'http://127.0.0.1:8000/admin/permohonan/2', 1, '2025-11-25 18:13:48', '2025-11-25 17:59:57', '2025-11-25 18:13:48'),
(26, 16, 'aktivitas', 'Upload Surat Bertanda Tangan', 'Upload surat bertanda tangan untuk permohonan: PRM/2025/11/002', NULL, 0, NULL, '2025-11-25 18:01:55', '2025-11-25 18:01:55'),
(27, 4, 'aktivitas', 'Menyetujui Permohonan', 'Menyetujui permohonan ID: 2 dari user: Fufu Fafa', NULL, 0, NULL, '2025-11-25 18:14:01', '2025-11-25 18:14:01'),
(28, 16, 'notifikasi', 'Permohonan Disetujui', 'Permohonan Anda dengan nomor PRM/2025/11/002 telah disetujui', 'http://127.0.0.1:8000/permohonan/2', 0, NULL, '2025-11-25 18:14:01', '2025-11-25 18:14:01'),
(29, 4, 'aktivitas', 'Menyetujui Peminjaman', 'Menyetujui peminjaman ID: 2 - Barang: Kursi Lipat, Meja Lipat, Komputer Desktop untuk user: Fufu Fafa', NULL, 0, NULL, '2025-11-25 18:14:51', '2025-11-25 18:14:51'),
(30, 16, 'notifikasi', 'Peminjaman Disetujui', 'Peminjaman Kursi Lipat telah disetujui. Silakan lakukan pembayaran', 'http://127.0.0.1:8000/peminjaman/2', 0, NULL, '2025-11-25 18:14:51', '2025-11-25 18:14:51'),
(31, 4, 'aktivitas', 'Menambahkan Barang Baru', 'Menambahkan barang: Pulpen dengan kode: CTP-FUR-12003-2025 (Kategori: Furniture, Jumlah: 5 unit) dengan 4 foto', NULL, 0, NULL, '2025-11-25 18:28:08', '2025-11-25 18:28:08'),
(32, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Pulpen (Kode: CTP-FUR-12003-2025) - Kategori: Furniture', NULL, 0, NULL, '2025-11-25 21:27:35', '2025-11-25 21:27:35'),
(33, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Korek Api (Kode: CTP-AUD-17139-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-25 21:30:31', '2025-11-25 21:30:31'),
(34, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Korek Api (Kode: CTP-AUD-17139-2025) - Kategori: Audio Visuall 1 foto berhasil diupload.', NULL, 0, NULL, '2025-11-25 21:48:44', '2025-11-25 21:48:44'),
(35, 4, 'aktivitas', 'Hapus Foto Barang', 'Menghapus foto dari barang: Korek Api (Kode: CTP-AUD-17139-2025)', NULL, 0, NULL, '2025-11-25 21:51:08', '2025-11-25 21:51:08'),
(36, 4, 'aktivitas', 'Hapus Foto Barang', 'Menghapus foto dari barang: Pulpen (Kode: CTP-FUR-12003-2025)', NULL, 0, NULL, '2025-11-27 09:22:41', '2025-11-27 09:22:41'),
(37, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Pulpen (Kode: CTP-FUR-12003-2025) - Kategori: Furniture 1 foto berhasil diupload.', NULL, 0, NULL, '2025-11-27 09:23:38', '2025-11-27 09:23:38'),
(38, 4, 'aktivitas', 'Menghapus Barang', 'Menghapus barang: komputer render (Kode: CTP-KOM-00001-2025) - Kategori: Komputer & IT', NULL, 0, NULL, '2025-11-28 19:05:30', '2025-11-28 19:05:30'),
(39, 4, 'aktivitas', 'Menghapus Barang', 'Menghapus barang: Pulpen (Kode: CTP-FUR-12003-2025) - Kategori: Furniture', NULL, 0, NULL, '2025-11-28 19:31:56', '2025-11-28 19:31:56'),
(40, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Korek Api (Kode: CTP-AUD-17139-2025) menjadi TIDAK DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 19:32:27', '2025-11-28 19:32:27'),
(41, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Korek Api (Kode: CTP-AUD-17139-2025) menjadi DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 19:32:45', '2025-11-28 19:32:45'),
(42, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Korek Api (Kode: CTP-AUD-17139-2025) menjadi TIDAK DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 19:49:47', '2025-11-28 19:49:47'),
(43, 4, 'aktivitas', 'Mengubah Status Barang', 'Mengubah status barang: Korek Api (Kode: CTP-AUD-17139-2025) dari \"Tersedia\" ke \"Tersedia\"', NULL, 0, NULL, '2025-11-28 19:49:59', '2025-11-28 19:49:59'),
(44, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Korek Api (Kode: CTP-AUD-17139-2025) menjadi DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 19:50:17', '2025-11-28 19:50:17'),
(45, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Korek Api (Kode: CTP-AUD-17139-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 19:51:05', '2025-11-28 19:51:05'),
(46, 4, 'aktivitas', 'Menghapus Barang', 'Menghapus barang: Korek Api (Kode: CTP-AUD-17139-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 19:51:41', '2025-11-28 19:51:41'),
(47, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Crossainttt (Kode: CTP-MAK-00005-2025) - Kategori: Makanan', NULL, 0, NULL, '2025-11-28 19:55:16', '2025-11-28 19:55:16'),
(48, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Crossaint (Kode: CTP-MAK-00005-2025) - Kategori: Makanan', NULL, 0, NULL, '2025-11-28 19:55:46', '2025-11-28 19:55:46'),
(49, 4, 'aktivitas', 'Menambahkan Barang Baru', 'Menambahkan barang: Baso dengan kode: CTP-KOM-23233-2025 (Kategori: Komputer & IT, Jumlah: 13 unit) dengan 1 foto', NULL, 0, NULL, '2025-11-28 19:58:04', '2025-11-28 19:58:04'),
(50, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Baso (Kode: CTP-KOM-23233-2025) - Kategori: Komputer & IT 1 foto berhasil diupload.', NULL, 0, NULL, '2025-11-28 19:59:57', '2025-11-28 19:59:57'),
(51, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Baso (Kode: CTP-KOM-23233-2025) - Kategori: Komputer & IT 1 foto berhasil diupload.', NULL, 0, NULL, '2025-11-28 20:11:21', '2025-11-28 20:11:21'),
(52, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Baso (Kode: CTP-KOM-23233-2025) - Kategori: Komputer & IT', NULL, 0, NULL, '2025-11-28 20:11:57', '2025-11-28 20:11:57'),
(53, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Baso (Kode: CTP-KOM-23233-2025) menjadi TIDAK DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 20:12:30', '2025-11-28 20:12:30'),
(54, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Baso (Kode: CTP-KOM-23233-2025) menjadi DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 20:12:48', '2025-11-28 20:12:48'),
(55, 4, 'aktivitas', 'Menambah Maintenance', 'Menjadwalkan maintenance preventif untuk 3 unit barang: Baso (Kode: CTP-KOM-23233-2025) - Teknisi: Gibran - Estimasi Biaya: Rp 500.000', NULL, 0, NULL, '2025-11-28 20:13:52', '2025-11-28 20:13:52'),
(56, 4, 'aktivitas', 'Menambahkan Barang Baru', 'Menambahkan barang: Sepatu dengan kode: CTP-OLA-23265-2025 (Kategori: Olahraga & Outdoor, Jumlah: 15 unit) dengan 3 foto', NULL, 0, NULL, '2025-11-28 20:26:27', '2025-11-28 20:26:27'),
(57, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Sepatuu (Kode: CTP-OLA-23265-2025) - Kategori: Olahraga & Outdoor', NULL, 0, NULL, '2025-11-28 20:27:01', '2025-11-28 20:27:01'),
(58, 4, 'aktivitas', 'Menghapus Barang', 'Menghapus barang: Sepatuu (Kode: CTP-OLA-23265-2025) - Kategori: Olahraga & Outdoor', NULL, 0, NULL, '2025-11-28 20:27:38', '2025-11-28 20:27:38'),
(59, 4, 'aktivitas', 'Menambahkan Barang Baru', 'Menambahkan barang: Cuanki dengan kode: CTP-AUD-12121-2025 (Kategori: Audio Visuall, Jumlah: 12 unit) dengan 3 foto', NULL, 0, NULL, '2025-11-28 20:34:05', '2025-11-28 20:34:05'),
(60, 4, 'aktivitas', 'Menambahkan Barang Baru', 'Menambahkan barang: kake dengan kode: CTP-AUD-11212-2025 (Kategori: Audio Visuall, Jumlah: 19 unit) dengan 1 foto', NULL, 0, NULL, '2025-11-28 20:38:01', '2025-11-28 20:38:01'),
(61, 4, 'aktivitas', 'Menghapus Barang', 'Menghapus barang: kake (Kode: CTP-AUD-11212-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 20:38:33', '2025-11-28 20:38:33'),
(62, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Cuankiw (Kode: CTP-AUD-12121-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 20:40:16', '2025-11-28 20:40:16'),
(63, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Cuanki (Kode: CTP-AUD-12121-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 20:40:43', '2025-11-28 20:40:43'),
(64, 4, 'aktivitas', 'Mengubah Data Barang', 'Mengubah data barang: Cuanki (Kode: CTP-AUD-12121-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 20:42:24', '2025-11-28 20:42:24'),
(65, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Cuanki (Kode: CTP-AUD-12121-2025) menjadi TIDAK DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 20:46:07', '2025-11-28 20:46:07'),
(66, 4, 'aktivitas', 'Mengubah Status Barang', 'Mengubah status barang: Cuanki (Kode: CTP-AUD-12121-2025) dari \"Tersedia\" ke \"Tersedia\"', NULL, 0, NULL, '2025-11-28 20:46:46', '2025-11-28 20:46:46'),
(67, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Cuanki (Kode: CTP-AUD-12121-2025) menjadi DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 20:48:34', '2025-11-28 20:48:34'),
(68, 4, 'aktivitas', 'Menghapus Barang', 'Menghapus barang: Cuanki (Kode: CTP-AUD-12121-2025) - Kategori: Audio Visuall', NULL, 0, NULL, '2025-11-28 20:48:59', '2025-11-28 20:48:59'),
(69, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Baso (Kode: CTP-KOM-23233-2025) menjadi TIDAK DAPAT dipinjam', NULL, 0, NULL, '2025-11-28 20:49:52', '2025-11-28 20:49:52'),
(70, 4, 'aktivitas', 'Auto-Update Maintenance', 'Maintenance otomatis dimulai untuk 3 unit barang: Baso (CTP-KOM-23233-2025)', NULL, 0, NULL, '2025-11-28 20:50:16', '2025-11-28 20:50:16'),
(71, 4, 'aktivitas', 'Menyelesaikan Maintenance', 'Menyelesaikan maintenance 3 unit barang: Baso (Kode: CTP-KOM-23233-2025) - Kondisi Akhir: baik', NULL, 0, NULL, '2025-11-28 20:51:24', '2025-11-28 20:51:24'),
(72, 4, 'aktivitas', 'Mengubah User', 'Super Admin mengubah data user: Fufu Fafa (satoru01044@gmail.com)', NULL, 0, NULL, '2025-11-29 20:12:33', '2025-11-29 20:12:33'),
(73, 16, 'aktivitas', 'Melakukan Pembayaran', 'Melakukan pembayaran untuk peminjaman barang ID: 2 dengan metode: transfer', NULL, 0, NULL, '2025-11-29 20:17:45', '2025-11-29 20:17:45'),
(74, 1, 'notifikasi', 'Pembayaran Baru', 'Pembayaran baru dari Fufu Fafa sebesar Rp 90.000', 'http://192.168.1.10:8000/admin/pembayaran/2', 0, NULL, '2025-11-29 20:17:45', '2025-11-29 20:17:45'),
(75, 2, 'notifikasi', 'Pembayaran Baru', 'Pembayaran baru dari Fufu Fafa sebesar Rp 90.000', 'http://192.168.1.10:8000/admin/pembayaran/2', 0, NULL, '2025-11-29 20:17:45', '2025-11-29 20:17:45'),
(76, 4, 'notifikasi', 'Pembayaran Baru', 'Pembayaran baru dari Fufu Fafa sebesar Rp 90.000', 'http://192.168.1.10:8000/admin/pembayaran/2', 0, NULL, '2025-11-29 20:17:45', '2025-11-29 20:17:45'),
(77, 16, 'aktivitas', 'Mengajukan Permohonan', 'Mengajukan permohonan untuk: Kamera Profesional', NULL, 0, NULL, '2025-12-03 17:22:14', '2025-12-03 17:22:14'),
(78, 1, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/001', 'http://127.0.0.1:8000/admin/permohonan/3', 0, NULL, '2025-12-03 17:22:14', '2025-12-03 17:22:14'),
(79, 2, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/001', 'http://127.0.0.1:8000/admin/permohonan/3', 0, NULL, '2025-12-03 17:22:14', '2025-12-03 17:22:14'),
(80, 4, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/001', 'http://127.0.0.1:8000/admin/permohonan/3', 0, NULL, '2025-12-03 17:22:14', '2025-12-03 17:22:14'),
(81, 16, 'aktivitas', 'Mengajukan Permohonan', 'Mengajukan permohonan untuk: Oculus VR Headset, Kamera Profesional', NULL, 0, NULL, '2025-12-03 18:46:56', '2025-12-03 18:46:56'),
(82, 1, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/002', 'http://127.0.0.1:8000/admin/permohonan/4', 0, NULL, '2025-12-03 18:46:56', '2025-12-03 18:46:56'),
(83, 2, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/002', 'http://127.0.0.1:8000/admin/permohonan/4', 0, NULL, '2025-12-03 18:46:56', '2025-12-03 18:46:56'),
(84, 4, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/002', 'http://127.0.0.1:8000/admin/permohonan/4', 0, NULL, '2025-12-03 18:46:56', '2025-12-03 18:46:56'),
(85, 4, 'aktivitas', 'Toggle Status Dapat Dipinjam', 'Mengubah status dapat dipinjam barang: Baso (Kode: CTP-KOM-23233-2025) menjadi DAPAT dipinjam', NULL, 0, NULL, '2025-12-03 18:55:19', '2025-12-03 18:55:19'),
(86, 16, 'aktivitas', 'Upload Surat Bertanda Tangan', 'Upload surat bertanda tangan untuk permohonan: PRM/2025/12/002', NULL, 0, NULL, '2025-12-03 19:40:18', '2025-12-03 19:40:18'),
(87, 4, 'aktivitas', 'Menyelesaikan Peminjaman', 'Menyelesaikan peminjaman ID: 2 - Barang: Kursi Lipat, Meja Lipat, Komputer Desktop dari user: Fufu Fafa', NULL, 0, NULL, '2025-12-04 19:37:58', '2025-12-04 19:37:58'),
(88, 16, 'notifikasi', 'Peminjaman Selesai', 'Peminjaman Kursi Lipat telah selesai. Terima kasih!', 'http://localhost:8000/peminjaman/2', 0, NULL, '2025-12-04 19:37:58', '2025-12-04 19:37:58'),
(89, 16, 'aktivitas', 'Mengajukan Permohonan', 'Mengajukan permohonan untuk: Proyektor HD, Meja Lipat', NULL, 0, NULL, '2025-12-04 19:59:02', '2025-12-04 19:59:02'),
(90, 1, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/003', 'http://192.168.1.10:8000/admin/permohonan/5', 0, NULL, '2025-12-04 19:59:02', '2025-12-04 19:59:02'),
(91, 2, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/003', 'http://192.168.1.10:8000/admin/permohonan/5', 0, NULL, '2025-12-04 19:59:02', '2025-12-04 19:59:02'),
(92, 4, 'notifikasi', 'Permohonan Baru', 'Permohonan baru dari Fufu Fafa dengan nomor PRM/2025/12/003', 'http://192.168.1.10:8000/admin/permohonan/5', 1, '2025-12-06 20:52:47', '2025-12-04 19:59:02', '2025-12-06 20:52:47'),
(93, 16, 'aktivitas', 'Upload Surat Bertanda Tangan', 'Upload surat bertanda tangan untuk permohonan: PRM/2025/12/003', NULL, 0, NULL, '2025-12-04 20:02:07', '2025-12-04 20:02:07'),
(94, 4, 'aktivitas', 'Menyetujui Permohonan', 'Menyetujui permohonan ID: 5 dari user: Fufu Fafa', NULL, 0, NULL, '2025-12-04 20:05:59', '2025-12-04 20:05:59'),
(95, 16, 'notifikasi', 'Permohonan Disetujui', 'Permohonan Anda dengan nomor PRM/2025/12/003 telah disetujui', 'http://localhost:8000/permohonan/5', 0, NULL, '2025-12-04 20:05:59', '2025-12-04 20:05:59'),
(96, 4, 'aktivitas', 'Menyetujui Peminjaman', 'Menyetujui peminjaman ID: 3 - Barang: Proyektor HD, Meja Lipat untuk user: Fufu Fafa', NULL, 0, NULL, '2025-12-04 20:07:28', '2025-12-04 20:07:28'),
(97, 16, 'notifikasi', 'Peminjaman Disetujui', 'Peminjaman Proyektor HD telah disetujui. Silakan lakukan pembayaran', 'http://localhost:8000/peminjaman/3', 0, NULL, '2025-12-04 20:07:28', '2025-12-04 20:07:28'),
(98, 16, 'aktivitas', 'Melakukan Pembayaran', 'Melakukan pembayaran untuk peminjaman barang ID: 3 dengan metode: cash', NULL, 0, NULL, '2025-12-06 19:14:53', '2025-12-06 19:14:53'),
(99, 4, 'aktivitas', 'Menyetujui Permohonan', 'Menyetujui permohonan ID: 4 dari user: Fufu Fafa', NULL, 0, NULL, '2025-12-06 20:54:06', '2025-12-06 20:54:06'),
(100, 16, 'notifikasi', 'Permohonan Disetujui', 'Permohonan Anda dengan nomor PRM/2025/12/002 telah disetujui', 'http://192.168.1.10:8000/permohonan/4', 0, NULL, '2025-12-06 20:54:06', '2025-12-06 20:54:06'),
(101, 4, 'aktivitas', 'Menyetujui Peminjaman', 'Menyetujui peminjaman ID: 4 - Barang: Oculus VR Headset, Kamera Profesional untuk user: Fufu Fafa', NULL, 0, NULL, '2025-12-06 20:55:46', '2025-12-06 20:55:46'),
(102, 16, 'notifikasi', 'Peminjaman Disetujui', 'Peminjaman Oculus VR Headset telah disetujui. Silakan lakukan pembayaran', 'http://192.168.1.10:8000/peminjaman/4', 0, NULL, '2025-12-06 20:55:46', '2025-12-06 20:55:46'),
(103, 16, 'aktivitas', 'Mengedit Permohonan', 'Mengedit permohonan ID: 3', NULL, 0, NULL, '2025-12-09 07:00:57', '2025-12-09 07:00:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenance`
--

CREATE TABLE `maintenance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_aset` enum('barang') NOT NULL,
  `aset_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1 COMMENT 'Jumlah unit yang di-maintenance',
  `tanggal` datetime DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenis_maintenance` varchar(255) DEFAULT NULL,
  `status` enum('dijadwalkan','dalam_proses','selesai','dibatalkan') NOT NULL DEFAULT 'dalam_proses',
  `tanggal_selesai` datetime DEFAULT NULL,
  `catatan_penyelesaian` text DEFAULT NULL,
  `biaya` decimal(14,2) NOT NULL DEFAULT 0.00,
  `teknisi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `maintenance`
--

INSERT INTO `maintenance` (`id`, `jenis_aset`, `aset_id`, `jumlah`, `tanggal`, `deskripsi`, `jenis_maintenance`, `status`, `tanggal_selesai`, `catatan_penyelesaian`, `biaya`, `teknisi`, `created_at`, `updated_at`) VALUES
(1, 'barang', 25, 3, '2025-11-29 03:13:52', 'Penggantian presiden', 'preventif', 'selesai', '2025-11-29 03:51:24', 'atos', 500000.00, 'Gibran', '2025-11-28 20:13:52', '2025-11-28 20:51:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_06_132126_add_fields_to_users_table', 1),
(5, '2025_09_06_132128_create_kategori_barang_table', 1),
(6, '2025_09_06_132129_create_barang_table', 1),
(7, '2025_09_06_132130_create_kategori_ruangan_table', 1),
(8, '2025_09_06_132130_create_ruangan_table', 1),
(9, '2025_09_06_132131_create_permohonan_table', 1),
(10, '2025_09_06_132132_create_peminjaman_table', 1),
(11, '2025_09_06_132133_create_peminjaman_detail_table', 1),
(12, '2025_09_06_132134_create_pembayaran_table', 1),
(13, '2025_09_06_132135_create_maintenance_table', 1),
(14, '2025_09_06_132136_create_jadwal_ruangan_table', 1),
(15, '2025_09_06_132137_create_dokumen_table', 1),
(16, '2025_09_06_132137_create_pengaturan_table', 1),
(17, '2025_09_06_132138_create_log_aktivitas_table', 1),
(18, '2025_09_18_043944_add_extra_fields_to_users_table', 1),
(19, '2025_09_18_050710_update_role_enum_in_users_table', 1),
(22, '2025_09_22_161416_cleanup_ruangan_focus_on_barang', 2),
(23, '2025_09_22_171541_create_permohonan_items_table', 3),
(24, '2025_09_25_181841_add_kop_surat_and_draft_surat_to_permohonan_table', 4),
(25, '2025_09_26_191031_add_lainnya_field_to_barang_table', 5),
(26, '2025_09_27_194244_add_status_columns_to_maintenance_table', 6),
(27, '2025_09_29_164356_add_peminjaman_fields_to_permohonan_table', 7),
(28, '2025_10_05_184711_create_password_reset_otps_table', 8),
(29, '2025_10_05_185123_add_avatar_to_users_table', 8),
(30, '2025_10_07_172116_create_registration_otps_table', 9),
(32, '2025_10_08_183359_add_dapat_dipinjam_to_barang_table', 10),
(33, '2025_10_10_205549_add_jumlah_to_maintenance_table', 11),
(34, '2025_10_12_200218_fix_existing_peminjaman_stock', 12),
(35, '2025_10_15_182318_add_notification_fields_to_log_aktivitas', 13),
(36, '2025_10_24_164425_create_barang_foto_table', 14),
(37, '2025_10_24_164435_add_note_to_barang_foto_column', 14),
(38, '2025_11_20_061341_add_jumlah_maintenance_to_barang_table', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_otps`
--

CREATE TABLE `password_reset_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_otps`
--

INSERT INTO `password_reset_otps` (`id`, `user_id`, `otp`, `expires_at`, `is_used`, `created_at`, `updated_at`) VALUES
(2, 1, '725894', '2025-11-24 07:23:40', 1, '2025-11-24 07:22:52', '2025-11-24 07:23:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `metode` enum('cash','transfer','gratis') DEFAULT NULL,
  `jumlah` decimal(14,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','lunas','batal') NOT NULL DEFAULT 'pending',
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `peminjaman_id`, `metode`, `jumlah`, `status`, `bukti_transfer`, `tanggal_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, 'cash', 1200000.00, 'lunas', NULL, '2025-11-24 14:45:03', '2025-11-24 07:28:35', '2025-11-24 07:45:03'),
(2, 2, 'transfer', 90000.00, 'pending', 'dokumen/bukti_transfer/bukti_transfer_2_1764447465.jpg', '2025-11-30 03:17:45', '2025-11-25 18:14:00', '2025-11-29 20:17:45'),
(3, 3, 'cash', 450000.00, 'lunas', NULL, '2025-12-07 02:14:53', '2025-12-04 20:05:59', '2025-12-06 19:14:53'),
(4, 4, NULL, 2025000.00, 'pending', NULL, NULL, '2025-12-06 20:54:06', '2025-12-06 20:54:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permohonan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_aset` enum('barang') NOT NULL,
  `aset_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `keperluan` text DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak','selesai') NOT NULL DEFAULT 'menunggu',
  `biaya` decimal(14,2) NOT NULL DEFAULT 0.00,
  `berita_acara` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `permohonan_id`, `jenis_aset`, `aset_id`, `tanggal_mulai`, `tanggal_selesai`, `keperluan`, `status`, `biaya`, `berita_acara`, `created_at`, `updated_at`) VALUES
(1, 14, 1, 'barang', 6, '2025-11-25 00:00:00', '2025-11-26 00:00:00', 'Untuk studi banding', 'selesai', 1200000.00, 'dokumen/berita_acara/berita-acara-1-1763970262.docx', '2025-11-24 07:28:35', '2025-11-24 07:46:20'),
(2, 16, 2, 'barang', 3, '2025-11-27 00:00:00', '2025-11-28 00:00:00', 'Reuniannnnn', 'selesai', 90000.00, 'dokumen/berita_acara/berita-acara-2-1764094483.docx', '2025-11-25 18:14:00', '2025-12-04 19:37:50'),
(3, 16, 5, 'barang', 1, '2025-12-06 00:00:00', '2025-12-08 00:00:00', 'Acara acara acaraan', 'disetujui', 450000.00, 'dokumen/berita_acara/berita-acara-3-1764878841.docx', '2025-12-04 20:05:59', '2025-12-04 20:07:28'),
(4, 16, 4, 'barang', 6, '2025-12-31 00:00:00', '2026-01-02 00:00:00', 'asjhasjajshasasa', 'disetujui', 2025000.00, 'dokumen/berita_acara/berita-acara-4-1765054540.docx', '2025-12-06 20:54:06', '2025-12-06 20:55:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga_satuan` decimal(14,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id`, `peminjaman_id`, `barang_id`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 600000.00, 1200000.00, '2025-11-24 07:28:35', '2025-11-24 07:28:35'),
(2, 2, 3, 5, 5000.00, 50000.00, '2025-11-25 18:14:01', '2025-11-25 18:14:01'),
(3, 2, 4, 2, 10000.00, 40000.00, '2025-11-25 18:14:01', '2025-11-25 18:14:01'),
(4, 2, 5, 10, 0.00, 0.00, '2025-11-25 18:14:01', '2025-11-25 18:14:01'),
(5, 3, 1, 2, 50000.00, 300000.00, '2025-12-04 20:05:59', '2025-12-04 20:05:59'),
(6, 3, 4, 5, 10000.00, 150000.00, '2025-12-04 20:05:59', '2025-12-04 20:05:59'),
(7, 4, 6, 1, 600000.00, 1800000.00, '2025-12-06 20:54:06', '2025-12-06 20:54:06'),
(8, 4, 9, 1, 75000.00, 225000.00, '2025-12-06 20:54:06', '2025-12-06 20:54:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan`
--

CREATE TABLE `permohonan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_permohonan` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `alasan_penolakan` varchar(255) DEFAULT NULL,
  `nama_pemohon` varchar(255) NOT NULL,
  `alamat_pemohon` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `bidang_instansi` varchar(255) DEFAULT NULL,
  `alamat_instansi` varchar(255) DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `kop_surat` varchar(255) DEFAULT NULL,
  `draft_surat` varchar(255) DEFAULT NULL,
  `surat_permohonan` varchar(255) DEFAULT NULL,
  `status` enum('Dalam Proses','Disetujui','Ditolak') NOT NULL DEFAULT 'Dalam Proses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permohonan`
--

INSERT INTO `permohonan` (`id`, `no_permohonan`, `user_id`, `alasan_penolakan`, `nama_pemohon`, `alamat_pemohon`, `kabupaten`, `kecamatan`, `kelurahan`, `kode_pos`, `no_telp`, `no_ktp`, `nama_instansi`, `jabatan`, `bidang_instansi`, `alamat_instansi`, `tanggal_mulai`, `tanggal_selesai`, `keperluan`, `kop_surat`, `draft_surat`, `surat_permohonan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PRM/2025/11/001', 14, NULL, 'Terry Mutiara Utari', 'Perum. Bukit Sariwangi Jl. Taman Sariwangi 1 No. 57', 'Kab. Bandung Barat', 'Parongpong', 'Sariwangi', '40559', '082120405252', '3277026904960001', 'SD Tangerang 15', 'Guru', 'Sekolah Dasar', 'Jl. Ahmad Yani No. 20', '2025-11-25 00:00:00', '2025-11-26 00:00:00', 'Untuk studi banding', 'dokumen/kop_surat/kop_surat_1763969157_69240885ac211.jpg', 'dokumen/draft_surat/draft_surat_PRM_2025_11_001_1763969194.rtf', 'dokumen/surat_ttd/surat_ttd_PRM/2025/11/001_1763969252.pdf', 'Disetujui', '2025-11-24 07:25:58', '2025-11-24 07:28:35'),
(2, 'PRM/2025/11/002', 16, NULL, 'Fufu Fafa', 'Jalan Amir Machmud', 'Kota Cimahi', 'Cimahi Utara', 'Amir', '12345', '088218452673', '3277020201010002', 'Pemkot', 'Dokter', NULL, NULL, '2025-11-27 00:00:00', '2025-11-28 00:00:00', 'Reuniannnnn', 'dokumen/kop_surat/kop_surat_1764093588_6925ee9493bb6.jpg', 'dokumen/draft_surat/draft_surat_PRM_2025_11_002_1764093596.rtf', 'dokumen/surat_ttd/surat_ttd_PRM/2025/11/002_1764093714.pdf', 'Disetujui', '2025-11-25 17:59:50', '2025-11-25 18:14:00'),
(3, 'PRM/2025/12/001', 16, NULL, 'Fufu Fafa', 'Jalan Amir Machmud', 'Kota Cimahi', 'Cimahi Utara', 'Amir', '12345', '088218452673', '3277020201010002', 'Pemkot', 'Dokter', NULL, NULL, '2025-12-11 00:00:00', '2025-12-12 00:00:00', 'askansasasasa', 'dokumen/kop_surat/kop_surat_1764782529_693071c1a58a2.jpg', 'dokumen/draft_surat/draft_surat_PRM_2025_12_001_1765263654.rtf', NULL, 'Dalam Proses', '2025-12-03 17:22:10', '2025-12-09 07:00:56'),
(4, 'PRM/2025/12/002', 16, NULL, 'Fufu Fafa', 'Jalan Amir Machmud', 'Kota Cimahi', 'Cimahi Utara', 'Amir', '12345', '088218452673', '3277020201010002', 'Pemkot', 'Dokter', NULL, NULL, '2025-12-31 00:00:00', '2026-01-02 00:00:00', 'asjhasjajshasasa', 'dokumen/kop_surat/kop_surat_1764787615_6930859fa0780.jpg', 'dokumen/draft_surat/draft_surat_PRM_2025_12_002_1764787616.rtf', 'dokumen/surat_ttd/surat_ttd_PRM/2025/12/002_1764790818.pdf', 'Disetujui', '2025-12-03 18:46:56', '2025-12-06 20:54:06'),
(5, 'PRM/2025/12/003', 16, NULL, 'Fufu Fafa', 'Jalan Amir Machmud', 'Kota Cimahi', 'Cimahi Utara', 'Amir', '12345', '088218452673', '3277020201010002', 'PT LEN INDONESIA', 'Pemohon', 'Teknologi Nuklir', 'Planet Merkurius No. 66', '2025-12-06 00:00:00', '2025-12-08 00:00:00', 'Acara acara acaraan', 'dokumen/kop_surat/kop_surat_1764878331_6931e7fb5eb6b.jpg', 'dokumen/draft_surat/draft_surat_PRM_2025_12_003_1764878340.rtf', 'dokumen/surat_ttd/surat_ttd_PRM/2025/12/003_1764878526.pdf', 'Disetujui', '2025-12-04 19:58:53', '2025-12-04 20:05:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_items`
--

CREATE TABLE `permohonan_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permohonan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_aset` enum('barang') NOT NULL DEFAULT 'barang',
  `aset_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permohonan_items`
--

INSERT INTO `permohonan_items` (`id`, `permohonan_id`, `jenis_aset`, `aset_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 1, 'barang', 6, 1, '2025-11-24 07:26:34', '2025-11-24 07:26:34'),
(3, 2, 'barang', 3, 5, '2025-11-25 17:59:50', '2025-11-25 17:59:50'),
(4, 2, 'barang', 4, 2, '2025-11-25 17:59:50', '2025-11-25 17:59:50'),
(5, 2, 'barang', 5, 10, '2025-11-25 17:59:50', '2025-11-25 17:59:50'),
(7, 4, 'barang', 6, 1, '2025-12-03 18:46:56', '2025-12-03 18:46:56'),
(8, 4, 'barang', 9, 1, '2025-12-03 18:46:56', '2025-12-03 18:46:56'),
(9, 5, 'barang', 1, 2, '2025-12-04 19:58:53', '2025-12-04 19:58:53'),
(10, 5, 'barang', 4, 5, '2025-12-04 19:58:53', '2025-12-04 19:58:53'),
(11, 3, 'barang', 9, 1, '2025-12-09 07:00:47', '2025-12-09 07:00:47'),
(12, 3, 'barang', 1, 3, '2025-12-09 07:00:47', '2025-12-09 07:00:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registration_otps`
--

CREATE TABLE `registration_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `registration_otps`
--

INSERT INTO `registration_otps` (`id`, `email`, `otp`, `expires_at`, `is_used`, `created_at`, `updated_at`) VALUES
(1, 'terrymutiara@gmail.com', '147961', '2025-11-24 07:22:02', 1, '2025-11-24 07:21:34', '2025-11-24 07:22:02'),
(2, 'satoru01044@gmail.com', '060572', '2025-11-25 17:48:24', 1, '2025-11-25 17:47:49', '2025-11-25 17:48:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UtQozuTVQP90E0NTVmbzwW7sAyhm52XCdnjkaVag', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSDlNUW1ZVGVLRzNwNDNKUjN4REs2amdaOGhRMWZWblpVc0hGaGFOcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVybW9ob25hbi8zIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1765264003);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','super_admin','pengurus_aset') NOT NULL DEFAULT 'user',
  `jabatan` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `nama_organisasi` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `role`, `jabatan`, `instansi`, `nama_organisasi`, `no_telp`, `alamat`, `no_ktp`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadminpelita@cimahitechnopark.id', NULL, NULL, '$2y$12$GH91jl7y1RUw/rYGKIFeruU4BCPn/0z9rIgbJBdGWROlmdtvwjYsy', 'super_admin', 'Kepala Bagian', 'Cimahi Technopark', 'Cimahi Technopark', '081234567890', 'Jl. Baros No. 1, Cimahi', '3204050909990001', 'Baros', 'Cimahi Tengah', 'Cimahi', '40521', 'bZfJW9bzyGAEm8VUX7yKsPrVxJTWbgf0iOT1mTHQQdS3nITXhG84l61Ws734', '2025-09-17 23:17:35', '2025-11-24 07:23:41'),
(2, 'Admin CS', 'admin@pelita.com', 'avatars/ULmzm5K3rTVI5tBkUGaIVeNdMA1W2EkGhwJezyzf.jpg', NULL, '$2y$12$LC03ou6PwVgEnLPg6Q56H.QbYGDIBkteUB5L5shpYzTfRUpofBKUm', 'admin', 'Customer Service', 'Cimahi Technopark', 'Cimahi Technopark', '081298765432', 'Jl. Leuwigajah No. 2, RT:03/RW:01', '3204050911110002', 'Leuwigajah', 'Cimahi Selatan', 'Cimahi', '40533', NULL, '2025-09-17 23:17:36', '2025-11-18 11:40:31'),
(3, 'Pengurus Aset', 'pengurus@pelita.com', NULL, NULL, '$2y$12$8IHJbggmJzzK4xrofdcYIuDjs9jMA.dgrYM7q9zMtaWY4tcehXL.K', 'pengurus_aset', 'Pengurus Aset', 'Cimahi Technopark', 'Cimahi Technopark', '081211112222', 'Jl. Cibeber No. 4, Cimahi', '3204050922220003', 'Cibeber', 'Cimahi Selatan', 'Cimahi', '40531', NULL, '2025-09-17 23:17:36', '2025-10-14 13:59:23'),
(4, 'Muhamad Aliph Fauzansyah', 'mhmdal0104@gmail.com', 'avatars/LNlzglfJS6IOeD9OMlFDwoNGZ6BEiAUbQ0tYp9qA.png', NULL, '$2y$12$VhBRbqViyOKIyXJ4yUA7DOwaESQwu4T3dCT8gB9qt3oEBdLWTWDLy', 'super_admin', 'Pemohon', 'Umum', 'Komunitas Pemuda Cimahi', '082295065071', 'Jl. Citeureup No. 3, Cimahi', '3204050933330004', 'Citeureup', 'Cimahi Utara', 'Cimahi', '40512', NULL, '2025-09-17 23:17:36', '2025-11-25 16:47:17'),
(14, 'Terry Mutiara Utari', 'terrymutiara@gmail.com', NULL, NULL, '$2y$12$F41qLg/fconk22caHYd/R.7tl95kHSbk6gJurqAb/AUBWN5QrcwUO', 'user', 'Penyuluh Perindustrian Dan Perdagangan', 'Pemkot Cimahi', 'CTP', '082120405252', 'Perum. Bukit Sariwangi Jl. Taman Sariwangi 1 No. 57', '3277026904960001', 'Sariwangi', 'Parongpong', 'Kab. Bandung Barat', '40559', 'Xp5WqKYtSOkjHIP1MLfM0LxnMqvd4TJ216NDeJwBRwrpgAP7kKCEnLgcphxQ', '2025-11-24 07:22:03', '2025-11-24 07:22:03'),
(15, 'Rifky Ardiansyah', 'rifkyctp@gmail.com', 'avatars/rZESROc7B7Zrj17iUsFC1xmHBv1AaqajPp3hM2TQ.jpg', NULL, '$2y$12$LvSN1f1FGV5U5DBir1VeMuTiKi5iBPrvTdvYDe86xfQirQ0wH4u5.', 'pengurus_aset', 'PNS', 'CTP', NULL, NULL, 'CTP', NULL, NULL, NULL, NULL, NULL, 'fSAEyB5plCqFA1eYgfOwVyQerlqG1JAWemnaWVdSi3E5acTpmphqAiqKth1b', '2025-11-24 07:27:07', '2025-11-24 07:27:07'),
(16, 'Fufu Fafa', 'satoru01044@gmail.com', NULL, NULL, '$2y$12$ZJxLa92xEWRTvwtB2PZrjOBDiGUMMp0t7/zSAEW54WzF52Iy1kIzO', 'user', 'Dokter', 'Pemkot', 'Pemuda Pancasila', '088218452673', 'Jalan Amir Machmud', '3277020201010002', 'Amir', 'Cimahi Utara', 'Kota Cimahi', '12345', NULL, '2025-11-25 17:48:25', '2025-11-29 20:12:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `barang_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `barang_foto`
--
ALTER TABLE `barang_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_foto_barang_id_is_primary_index` (`barang_id`,`is_primary`),
  ADD KEY `barang_foto_barang_id_urutan_index` (`barang_id`,`urutan`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_tipe_read` (`user_id`,`tipe`,`is_read`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indeks untuk tabel `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_otps_user_id_otp_is_used_index` (`user_id`,`otp`,`is_used`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_permohonan_id_foreign` (`permohonan_id`);

--
-- Indeks untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_detail_peminjaman_id_foreign` (`peminjaman_id`),
  ADD KEY `peminjaman_detail_barang_id_foreign` (`barang_id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengaturan_nama_unique` (`nama`);

--
-- Indeks untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permohonan_no_permohonan_unique` (`no_permohonan`),
  ADD KEY `permohonan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `permohonan_items`
--
ALTER TABLE `permohonan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permohonan_items_permohonan_id_foreign` (`permohonan_id`),
  ADD KEY `permohonan_items_aset_id_foreign` (`aset_id`);

--
-- Indeks untuk tabel `registration_otps`
--
ALTER TABLE `registration_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_otps_email_otp_is_used_index` (`email`,`otp`,`is_used`),
  ADD KEY `registration_otps_email_index` (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `barang_foto`
--
ALTER TABLE `barang_foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `permohonan_items`
--
ALTER TABLE `permohonan_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `registration_otps`
--
ALTER TABLE `registration_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_barang` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `barang_foto`
--
ALTER TABLE `barang_foto`
  ADD CONSTRAINT `barang_foto_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  ADD CONSTRAINT `password_reset_otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_permohonan_id_foreign` FOREIGN KEY (`permohonan_id`) REFERENCES `permohonan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD CONSTRAINT `peminjaman_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `peminjaman_detail_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD CONSTRAINT `permohonan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permohonan_items`
--
ALTER TABLE `permohonan_items`
  ADD CONSTRAINT `permohonan_items_aset_id_foreign` FOREIGN KEY (`aset_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permohonan_items_permohonan_id_foreign` FOREIGN KEY (`permohonan_id`) REFERENCES `permohonan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
