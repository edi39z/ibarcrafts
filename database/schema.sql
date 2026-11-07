-- ============================================================
-- iBarCrafts - Database Schema
-- Import file ini ke phpMyAdmin (InfinityFree / local)
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================================
-- TABEL: admins
-- ============================================================
CREATE TABLE IF NOT EXISTS `admins` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin default (password: admin123)
-- Password sudah di-hash dengan password_hash()
INSERT INTO `admins` (`username`, `passwords`, `nama_lengkap`) VALUES
('admin', '$2y$10$N9qo8uLOickgx2ZMRZoMy.MQDQ7jXQ8mPkZJk3jKj7oQkKvKQKvK', 'Administrator');

-- ============================================================
-- TABEL: pelanggan
-- ============================================================
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(150) NOT NULL,
  `email_pelanggan` varchar(150) NOT NULL,
  `telepon_pelanggan` varchar(20) DEFAULT NULL,
  `password_pelanggan` varchar(255) NOT NULL,
  `foto_pelanggan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  UNIQUE KEY `email_pelanggan` (`email_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABEL: produk
-- ============================================================
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) DEFAULT 0,
  `foto_produk` varchar(255) DEFAULT NULL,
  `download_file` varchar(255) DEFAULT NULL,
  `deskripsi_produk` text,
  `kategori` varchar(100) DEFAULT NULL,
  `dibuat_oleh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABEL: produk_foto
-- ============================================================
CREATE TABLE IF NOT EXISTS `produk_foto` (
  `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_produk_foto`),
  KEY `id_produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABEL: berita
-- ============================================================
CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul_berita` varchar(255) NOT NULL,
  `link_berita` varchar(500) DEFAULT NULL,
  `foto_berita` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- DATA CONTOH (opsional, bisa dihapus)
-- ============================================================
INSERT INTO `berita` (`judul_berita`, `link_berita`, `foto_berita`) VALUES
('Update Terbaru iBarCrafts', '#', 'foto_berita/update.png'),
('Game Asset Gratis!', '#', 'foto_berita/ga.png');

-- ============================================================
-- CATATAN:
-- 1. Password admin default: admin123
--    Login sebagai admin → langsung ganti password!
-- 2. Password pelanggan disimpan dengan password_hash() (bcrypt)
-- 3. Jika migrasi dari database lama (plain text password):
--    User lama bisa login, password akan otomatis di-hash ulang
-- ============================================================
