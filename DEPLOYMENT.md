# Deployment Guide - iBarCrafts (InfinityFree)

## Data Akun Anda

| Item | Nilai |
|---|---|
| **Domain** | `ibarcrafts.site.je` |
| **Account Username** | `ifo_43381445` |
| **Panel URL** | `https://ibarcrafts.site.je/controlpanel` |
| **Folder Website** | `htdocs/` (bukan `public_html/`) |
| **Database prefix** | `ifo_43381445` |

> ⚠️ **Ganti password hosting Anda** — password pernah tampil di screenshot chat.
> ⚠️ **DNS caching 24–72 jam** — tapi upload file & setup database bisa langsung dilakukan.

---

## Step 1: Buat Database MySQL

1. Login ke panel → https://ibarcrafts.site.je/controlpanel
2. Menu **MySQL Databases** (di sidebar kiri)
3. Klik **Create New Database**
4. Isi form:
   - **Database name**: `ibarcrafts` → jadi `ifo_43381445_ibarcrafts`
   - **Username**: `ibarcrafts` → jadi `ifo_43381445_ibarcrafts`
   - **Password**: isi sendiri / generate
   - **Host**: panel akan menampilkan (contoh: `sql312.epizy.com`)
5. Klik **Create**

### Catat semua dari panel:
```
Database name:  ifo_43381445_ibarcrafts
Username:       ifo_43381445_ibarcrafts
Password:       (password yang Anda buat)
Host:           sqlXXX.epizy.com   ← PENTING, bukan localhost!
```

---

## Step 2: Update config/koneksi.php

Buka `config/koneksi.php`, ganti bagian PRODUCTION:

```php
define('PROD_HOST', 'sqlXXX.epizy.com');           // ← dari panel
define('PROD_USER', 'ifo_43381445_ibarcrafts');
define('PROD_PASS', 'PASTE_PASSWORD_DARI_STEP_1');
define('PROD_DB',   'ifo_43381445_ibarcrafts');
```

Upload ulang file ini, atau edit langsung di File Manager.

> ⚠️ **Penting:** di InfinityFree, host database **tidak pernah** `localhost`.
> Kalau diisi `localhost`, koneksi akan gagal dengan error "Access denied".

---

## Step 3: Upload File

**File ZIP sudah disiapkan di:** `build/ibarcrafts.zip`

### Cara A — File Manager (paling mudah)

1. Panel → menu **File Manager** (atau **Websites** → **File Manager**)
2. Buka folder `htdocs/`
3. Klik **Upload** → upload `build/ibarcrafts.zip`
4. Klik kanan file zip → **Extract** → extract ke `htdocs/`
5. **Hapus** `ibarcrafts.zip` setelah extract (hemat storage, quota 5GB)

### Cara B — FTP (FileZilla, lebih cepat)

| Setting | Nilai |
|---|---|
| Host | `ftp.ibarcrafts.site.je` |
| Username | `ifo_43381445` |
| Password | password hosting Anda |
| Port | `21` |
| Remote path | `/htdocs/` |

> InfinityFree FTP **hanya aktif** setelah account terverifikasi via email.
> Kalau belum bisa FTP, pakai File Manager.

---

## Step 4: Import Database

1. Panel → **MySQL Databases** → klik ikon **phpMyAdmin** di baris database Anda
2. Pilih database `ifo_43381445_ibarcrafts` di dropdown kiri
3. Tab **Import**
4. Upload file `database/schema.sql`
5. Klik **Go** → tunggu selesai
6. Verifikasi tabel: `admins`, `berita`, `pelanggan`, `produk`, `produk_foto`

---

## Step 5: Pastikan Folder Upload Ada & Writable

Cek folder ini sudah ada di `htdocs/`:
- `foto_produk/`
- `foto_pelanggan/`
- `foto_berita/`
- `ZipFiles/`

Kalau belum ada, buat manual (New Folder). Set permission `755` jika perlu.

---

## Step 6: Test!

Buka `https://ibarcrafts.site.je`

| Test | Expectasi |
|---|---|
| Halaman utama | Navbar + berita tampil |
| Klik Login | Form login tampil |
| Login admin | `admin` / `admin123` → masuk dashboard |
| Registrasi pelanggan | Akun baru dibuat, password ter-hash |
| Upload produk | Foto muncul di daftar produk |
| Detail produk | Deskripsi & tombol download tampil |

---

## Step 7: Amankan (WAJIB)

1. **Ganti password admin default** di phpMyAdmin:
   ```sql
   UPDATE admins SET passwords = 'HASH_BARU' WHERE username = 'admin';
   ```
   Generate hash:
   ```php
   <?php echo password_hash('password_baru_anda', PASSWORD_DEFAULT); ?>
   ```
2. **Ganti password hosting** di panel → Account → Change Password
3. **Hapus `database/schema.sql`** dari server setelah import (bocor hash admin default)
4. **Hapus `DEPLOYMENT.md`** dari server (tidak perlu online)

---

## Update Deployment (Deploy Ulang)

```
1. Ubah kode di local
2. zip ulang folder (tanpa folder build/)
3. Upload zip ke htdocs/
4. Extract (pilih "Replace existing files")
```

Atau pakai FTP: upload hanya file yang berubah.

---

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| "Access denied for user" | Host DB bukan `localhost` — pakai `sqlXXX.epizy.com` |
| "Koneksi database gagal" | Cek 4 kredensial di `config/koneksi.php` |
| Error 500 | Buka error log: panel → **Errors** / **Error Log** |
| Foto produk tidak tampil | Folder `foto_produk/` harus ada & writable |
| Halaman kosong / warning | PHP version: panel → **PHP Version** (pilih 8.x) |
| Login admin gagal | Password default `admin123`, verify import schema.sql sukses |
| "Call to undefined function e()" | Pastikan `config/helper.php` ter-upload & ter-require |
| Domain belum bisa diakses | Tunggu DNS propagation (24–72 jam) |

---

## Peringatan Keamanan

- **Jangan** commit `config/koneksi.php` berisi password production ke GitHub publik
- Minimal 1x per bulan: update PHP version, rotasi password DB
- Hapus file backup/scratch dari server setelah deploy
