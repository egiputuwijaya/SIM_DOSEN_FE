# SIM DOSEN (Frontend) - Universitas Muhammadiyah Bengkulu

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue.svg)](https://www.php.net/)
[![Architecture](https://img.shields.io/badge/Architecture-Native%20MVC%20(Laravel--like)-brightgreen.svg)]()
[![Frontend](https://img.shields.io/badge/Frontend-Vanilla%20CSS%20%26%20JS%20(Zero--Dependencies)-orange.svg)]()
[![Auth](https://img.shields.io/badge/Auth-SSO%20JWT%20(sim--mhs--api)-purple.svg)]()
[![Status](https://img.shields.io/badge/Status-Production%20Ready-success.svg)]()

Aplikasi antarmuka web (**Frontend**) untuk **Sistem Informasi Manajemen Dosen (SIM DOSEN)** di lingkungan **Universitas Muhammadiyah Bengkulu (UMB)**. Sistem ini dibangun menggunakan **PHP Native murni** dengan arsitektur **MVC (Model-View-Controller)** modern yang mengadopsi standar dan konvensi *clean architecture* ala framework **Laravel**.

Aplikasi ini beroperasi secara *decoupled* (terpisah dari backend) dan berkomunikasi dengan REST API Backend (`sim-dosen-api`) menggunakan protokol HTTP RESTful serta mengintegrasikan sistem autentikasi **Single Sign-On (SSO)** lintas sistem berbasis token JWT (*JSON Web Token*).

---

## 📑 Daftar Isi

1. [Fungsi & Tujuan Sistem](#-fungsi--tujuan-sistem)
2. [Arsitektur & Teknologi](#-arsitektur--teknologi)
3. [Daftar Fitur & Modul Utama](#-daftar-fitur--modul-utama)
   - [1. Modul Landing Page Publik](#1-modul-landing-page-publik)
   - [2. Modul Autentikasi Single Sign-On (SSO)](#2-modul-autentikasi-single-sign-on-sso)
   - [3. Modul Dashboard Administrator & Statistik](#3-modul-dashboard-administrator--statistik)
   - [4. Modul Kelola Data Dosen (CRUD Enterprise)](#4-modul-kelola-data-dosen-crud-enterprise)
   - [5. Modul Portal Profil Mandiri Dosen](#5-modul-portal-profil-mandiri-dosen)
4. [Sistem Role & Autentikasi SSO](#-sistem-role--autentikasi-sso)
   - [Daftar Role yang Didukung](#daftar-role-yang-didukung)
   - [Matriks Hak Akses (RBAC)](#matriks-hak-akses-rbac)
   - [Alur Autentikasi SSO Lintas Sistem](#alur-autentikasi-sso-lintas-sistem)
5. [Struktur Folder & Penjelasan File](#-struktur-folder--penjelasan-file)
6. [Panduan Instalasi & Penggunaan](#-panduan-instalasi--penggunaan)
   - [Prasyarat Sistem](#prasyarat-sistem)
   - [Cara 1: Menjalankan di Laragon / XAMPP (Localhost)](#cara-1-menjalankan-di-laragon--xampp-localhost)
   - [Cara 2: Menggunakan PHP Built-in Server](#cara-2-menggunakan-php-built-in-server)
   - [Cara 3: Deployment ke Shared Hosting / InfinityFree](#cara-3-deployment-ke-shared-hosting--infinityfree)
7. [Konfigurasi Sistem (`config.php`)](#-konfigurasi-sistem-configphp)
8. [Panduan Pemeliharaan & Kontribusi](#-panduan-pemeliharaan--kontribusi)

---

## 🎯 Fungsi & Tujuan Sistem

SIM DOSEN Universitas Muhammadiyah Bengkulu berfungsi sebagai pusat data dan tata kelola administrasi kepegawaian dosen universitas yang terintegrasi. Tujuan utama sistem ini meliputi:

1. **Digitalisasi Data Pendidik**: Mengelola identitas lengkap dosen, NIP, NUPTK, Nomor Registrasi, Unit Penempatan (Fakultas/Prodi), Jabatan Fungsional, Kepangkatan/Golongan, Status Sertifikasi (Serdos), dan Ikatan Kerja.
2. **Monitoring & Statistik Real-time**: Menyajikan metrik agregat dosen aktif, distribusi jabatan fungsional, rasio kualifikasi pendidikan (S2/S3), dan status keaktifan mengajar untuk kebutuhan pimpinan dan akreditasi BAN-PT.
3. **Portal Mandiri Dosen**: Memberikan akses kepada setiap dosen untuk meninjau status profil kepegawaian dan validitas data pribadinya secara transparan.
4. **Interoperabilitas Lintas Sistem**: Terhubung langsung dengan ekosistem Single Sign-On (SSO) kampus sehingga satu akun dapat digunakan bersama dengan SIM Mahasiswa dan sistem akademik lainnya.
5. **Aksesibilitas Universal (Fully Responsive)**: Tampilan visual berstandar enterprise yang optimal dan adaptif digunakan di layar Komputer/Desktop, Tablet, maupun Handphone/Smartphone.

---

## 🛠 Arsitektur & Teknologi

* **Bahasa Pemrograman**: PHP Native (v8.0 atau lebih tinggi).
* **Pola Desain Arsitektur**: **MVC (Model-View-Controller)** murni dengan pendekatan *Laravel-like* (Router deklaratif, Controller berbasis kelas, Request handler dengan *method spoofing*, Helper global, dan View layout engine).
* **Styling & Tampilan**: **Vanilla CSS Modern** (CSS Variables, Flexbox, CSS Grid, clamp typography, efek glassmorphism, micro-animations, dan media queries responsif tanpa framework eksternal).
* **Client-side Interactivity**: Vanilla JavaScript (ES6+) untuk kontrol off-canvas drawer, modal popup, filter tabel dinamis, slideshow developer, dan toggle visibility password.
* **Protokol Integrasi**: cURL HTTP Client dengan otorisasi Bearer Token JWT ke REST API Backend.

---

## 🚀 Daftar Fitur & Modul Utama

### 1. Modul Landing Page Publik (`/`)
Halaman beranda institusi yang memperkenalkan ekosistem SIM Dosen kepada publik dan civitas akademika sebelum melakukan autentikasi:
* **Sticky Glassmorphism Navbar**: Menu navigasi tetap melayang di bagian atas layar baik pada desktop maupun smartphone.
* **Hero Banner Dinamis**: Menampilkan ringkasan sistem, logo UMB, CTA login instan, dan preview antarmuka aplikasi.
* **Statistik Cepat Kampus**: Menampilkan indikator angka ringkas dosen terdaftar, dosen tersertifikasi, dan program studi.
* **Pilar Tridharma & Layanan**: Menjelaskan cakupan tridharma (Pendidikan & Pengajaran, Penelitian Ilmiah, Pengabdian Kepada Masyarakat).
* **Alur Integrasi API RESTful**: Diagram langkah-langkah komunikasi data dari pengguna, FE Native MVC, hingga REST API Backend.
* **Showcase Tim Pengembang**: Bagian interaktif dengan slideshow foto pengembang otomatis, indikator dot, dan tiga kartu peran pengembang (*Fullstack/Backend*, *Frontend Lead*, *UI/UX Designer*) yang dilengkapi tautan profil GitHub.
* **FAQ Interaktif**: Pertanyaan yang sering diajukan mengenai sistem, integrasi SSO, dan sinkronisasi data dengan sistem akreditasi.
* **Modular Partial Footer**: Tautan navigasi, informasi kampus Gedung Rektorat UMB, dan *copyright*.

### 2. Modul Autentikasi Single Sign-On (SSO) (`/login`)
Sistem autentikasi terpusat untuk keamanan akun:
* **Desain Split-Panel Modern**: Panel kiri menampilkan identitas institusi UMB dan pilar layanan; panel kanan memuat formulir masuk terenkripsi.
* **Integrasi Live SSO `sim-mhs-api`**: Mengirim permintaan autentikasi ke server penyedia identitas kampus. Jika server utama offline, sistem memiliki mekanisme *fallback* otomatis ke backend `sim-dosen-api`.
* **Fitur Show/Hide Password**: Tombol mata interaktif untuk kenyamanan pengguna saat memasukkan kata sandi.
* **Role Routing Cerdas**: Pengguna langsung diarahkan ke halaman yang sesuai hak aksesnya saat berhasil login:
  - Role `ADMIN` / `BAAK` $\rightarrow$ `/dashboard`
  - Role `DOSEN` $\rightarrow$ `/profil`
* **Keamanan Sesi Terpusat**: Token JWT disimpan dalam sesi server yang aman dan dilampirkan otomatis pada setiap request API.

### 3. Modul Dashboard Administrator & Statistik (`/dashboard`)
Khusus untuk pengelola sistem, pimpinan, dan BAAK:
* **Banner Selamat Datang Personal**: Menampilkan nama akun login, status koneksi API, dan tombol aksi cepat (*Kelola Data Dosen*, *Tambah Dosen Baru*).
* **4 Kartu Metrik Utama**:
  - Total Dosen Terdaftar.
  - Jumlah Dosen Status Aktif Siap Ajar.
  - Jumlah Dosen dengan Ikatan Tetap (Homebase).
  - Jumlah Dosen Tersertifikasi (Lulus Serdos).
* **Grafik Analitik Sebaran Jabatan Fungsional**: Visualisasi persentase jenjang Asisten Ahli, Lektor, Lektor Kepala, hingga Guru Besar/Profesor.
* **Distribusi Pendidikan & Status Keaktifan**: Ringkasan persentase lulusan S2 vs S3 dan kotak hitung dosen Aktif, Cuti, dan Tugas Belajar.
* **Tabel Dosen Terbaru**: Ringkasan 5 dosen terbaru dengan pintasan cepat ke tabel kelola data.

### 4. Modul Kelola Data Dosen (CRUD Enterprise) (`/dosen`)
Pusat manajemen seluruh data pengajar universitas:
* **Pencarian Real-time Multikriteria**: Cari data dosen secara instan berdasarkan nama lengkap, NIP, NUPTK, maupun program studi.
* **Filter Ganda Cerdas**: Filter berdasarkan status aktivitas (*Semua*, *Aktif*, *Cuti*, *Tugas Belajar*, *Keluar*) dan ikatan kerja (*Dosen Tetap*, *Dosen Tidak Tetap*, *Dosen Luar Biasa*).
* **Tabel Responsif Berfitur Touch Momentum**: Tabel lebar yang mendukung geser horizontal mulus (*smooth horizontal scroll*) di smartphone tanpa merusak tata letak layar.
* **Formulir Tambah Data Dosen (`/dosen/create`)**: Input data dosen baru dengan validasi field, pesan error responsif, dan indikator field wajib.
* **Formulir Edit Data Dosen (`/dosen/{id}/edit`)**: Pembaruan profil dengan data lama terisi otomatis (*auto-filled*).
* **Halaman Detail Dosen (`/dosen/{id}`)**: Tampilan komprehensif seluruh 13 atribut data dosen.
* **Modal Quick Preview Detail**: Modal kilat untuk meninjau data dosen langsung dari tabel tanpa berpindah halaman.
* **Modal Konfirmasi Hapus**: Perlindungan dari penghapusan tidak disengaja menggunakan modal konfirmasi dengan peringatan sistem.

### 5. Modul Portal Profil Mandiri Dosen (`/profil`)
Halaman khusus untuk pengguna yang login sebagai Dosen:
* **Kartu Identitas Dosen**: Menampilkan avatar inisial bergradien, nama lengkap beserta gelar akademik, badge role, ID sistem, dan unit fakultas.
* **Panel Metadata Kepegawaian**: Blok visual berlatar netral menampilkan NIP, NUPTK, Nomor Registrasi, dan status kepegawaian.
* **Rincian Jabatan & Jenjang Akademik**: Menampilkan status serdos, golongan/kepangkatan, jenjang ijazah terakhir, dan rumpun bidang ilmu.
* **Informasi Sesi SSO Aktif**: Rincian status autentikasi SSO, username aktif, hak akses (*Read-Only*), dan penyedia identitas (*Identity Provider*).
* **Pemberitahuan Kebijakan Data**: Panduan resmi bagi dosen jika terdapat perubahan data akademik untuk berkoordinasi dengan BAAK.

---

## 🔐 Sistem Role & Autentikasi SSO

Sistem mengadopsi kontrol akses berbasis peran (**Role-Based Access Control / RBAC**) yang ketat untuk menjaga integritas data kepegawaian universitas.

### Daftar Role yang Didukung

| Nama Role | Deskripsi Pengguna | Hak Akses Utama | Default Redirect |
| :--- | :--- | :--- | :--- |
| **`ADMIN`** | Administrator Sistem & Pusat Komputer | **Akses Penuh (Full CRUD)** | `/dashboard` |
| **`BAAK`** | Biro Administrasi Akademik & Kepegawaian | **Akses Penuh (Full CRUD)** | `/dashboard` |
| **`DOSEN`** | Tenaga Pendidik / Dosen Universitas | **Read-Only (Profil Mandiri)** | `/profil` |
| **`MAHASISWA`** | Mahasiswa Terdaftar UMB | **Read-Only (Katalog Dosen)** | `/dosen` |
| **`REKTORAT` / `DEKANAT` / `KAPRODI`** | Pejabat Struktural & Pimpinan Prodi | **Read-Only (Monitoring)** | `/dashboard` |

### Matriks Hak Akses (RBAC)

```text
+-----------------------+------------+------------+-----------+-----------+
| Aksi / Rute           | ADMIN/BAAK |   DOSEN    | MAHASISWA | STRUKTUR  |
+-----------------------+------------+------------+-----------+-----------+
| Lihat Landing Page    |     ✅     |     ✅     |    ✅     |    ✅     |
| Login SSO             |     ✅     |     ✅     |    ✅     |    ✅     |
| Dashboard Statistik   |     ✅     |     ❌     |    ❌     |    ✅     |
| Lihat Profil Pribadi  |     ✅     |     ✅     |    ❌     |    ❌     |
| Lihat Daftar Dosen    |     ✅     |     ❌     |    ✅     |    ✅     |
| Quick Detail Dosen    |     ✅     |     ❌     |    ✅     |    ✅     |
| Tambah Dosen (Create) |     ✅     |     ❌     |    ❌     |    ❌     |
| Edit Dosen (Update)   |     ✅     |     ❌     |    ❌     |    ❌     |
| Hapus Dosen (Delete)  |     ✅     |     ❌     |    ❌     |    ❌     |
+-----------------------+------------+------------+-----------+-----------+
```

> [!NOTE]
> Akun dengan role **`DOSEN`** diarahkan secara khusus ke `/profil`. Jika mencoba mengakses form tambah, edit, atau rute penghapusan secara manual di bilah URL, sistem melalui `DosenController::requireWriteAccess()` akan memblokir akses dan mengembalikannya ke halaman profil disertai notifikasi peringatan.

### Alur Autentikasi SSO Lintas Sistem

```
+---------------+         1. Input Login          +-----------------+
|  Pengguna     | ------------------------------> | SIM DOSEN (FE)  |
+---------------+                                 +-----------------+
                                                           |
                                      2. POST /api/v1/auth/login
                                                           v
                                                  +-----------------+
                                                  |   sim-mhs-api   | (Identity Provider)
                                                  +-----------------+
                                                           |
                                            3. Return Access Token (JWT)
                                                           v
+---------------+         4. Set Session          +-----------------+
| Browser Client|<------------------------------- | SIM DOSEN (FE)  |
+---------------+                                 +-----------------+
        |                                                  |
        | 5. Request Data Dosen                            | 6. cURL GET /dosen
        |    (via Session Cookie)                          |    Authorization: Bearer <Token>
        v                                                  v
+-------------------------------------------------+  +-----------------+
| Halaman Dashboard / Profil / Kelola Data Dosen  |  |  sim-dosen-api  | (Backend Service)
+-------------------------------------------------+  +-----------------+
```

---

## 📁 Struktur Folder & Penjelasan File

Aplikasi ini menggunakan struktur modular yang rapi dan terorganisir:

```text
SIM_DOSEN_FE/
│
├── app/                                # Inti Logika Aplikasi (Application Core)
│   ├── Controllers/                    # Lapisan Controller (Penanganan Request & Alur Data)
│   │   ├── Controller.php              # Base Controller: render view, redirect, session flash helper
│   │   ├── AuthController.php          # Logika login SSO, decoding payload JWT, proteksi sesi, logout
│   │   ├── DosenController.php         # Penanganan CRUD dosen, dashboard analitik, dan profil mandiri
│   │   └── HomeController.php          # Kontroler Landing Page publik (statistik & pengembang)
│   │
│   ├── Core/                           # Kernel & Infrastruktur Framework Native
│   │   ├── App.php                     # Bootstrapper aplikasi, registry config, dan autoloader PSR-4
│   │   ├── Request.php                 # HTTP Request wrapper, parsing input sanitasi, method spoofing
│   │   └── Router.php                  # Engine routing deklaratif berbasis URI regex dan parameter
│   │
│   └── Helpers/                        # Kelas Pembantu & Utilitas Sistem
│       ├── ApiClient.php               # HTTP client cURL untuk komunikasi REST API + Bearer Token
│       ├── JwtHelper.php               # Parser payload JWT dan generator token HS256 untuk testing
│       ├── Session.php                 # Manajemen sesi server, flash data, dan pemeriksa hak akses RBAC
│       └── functions.php               # Fungsi global helper: url(), asset(), e(), svg_icon(), old(), dll.
│
├── config/                             # Konfigurasi Sistem
│   └── config.php                      # Pengaturan Base URL, API Endpoint, URL SSO, dan definisi Role
│
├── resources/                          # Sumber Daya Tampilan & Antarmuka
│   └── views/
│       ├── auth/
│       │   └── login.php               # Antarmuka masuk SSO split-screen berfitur show/hide password
│       ├── dosen/
│       │   ├── dashboard.php           # Dashboard analitik statistik kepegawaian & sebaran jabatan
│       │   ├── index.php               # Tabel data dosen responsif + filter toolbar + modal triggers
│       │   ├── create.php              # Formulir penambahan data dosen baru (Admin & BAAK)
│       │   ├── edit.php                # Formulir pembaruan data dosen (Admin & BAAK)
│       │   ├── show.php                # Halaman detail profil dosen lengkap
│       │   └── profile.php             # Halaman portal profil mandiri khusus dosen (Read-Only)
│       ├── home/
│       │   └── index.php               # Halaman Landing Page publik SIM Dosen
│       ├── partials/                   # Komponen Reusable Landing Page
│       │   ├── navbar.php              # Sticky Top Navbar publik berlogo UMB
│       │   └── footer.php              # Footer institusi berdesain gelap modern
│       ├── layouts/                    # Template Induk Halaman
│       │   ├── app.php                 # Layout utama aplikasi internal (Sidebar Drawer, Topbar, Modals)
│       │   └── guest.php               # Layout minimalis untuk halaman autentikasi/tamu
│       └── errors/
│           └── 404.php                 # Halaman penanganan rute tidak ditemukan (Not Found)
│
├── routes/                             # Deklarasi Jalur Navigasi
│   └── web.php                         # Definisi seluruh rute aplikasi (GET, POST, PUT, DELETE)
│
├── public/                             # Document Root Publik (Akses Terbuka)
│   ├── index.php                       # Front Controller (Titik Masuk Utama Eksekusi PHP)
│   ├── .htaccess                       # Aturan Apache Rewrite untuk memetakan URL ke index.php
│   └── assets/                         # Aset Statis Client-Side
│       ├── logoumb.png                 # Logo resmi Universitas Muhammadiyah Bengkulu
│       ├── css/
│       │   └── app.css                 # File Stylesheet utama (Design System & Media Queries)
│       ├── js/
│       │   └── app.js                  # Skrip JavaScript interaktivitas UI
│       └── person/                     # Foto profil tim pengembang (slideshow landing page)
│           ├── person1.png
│           ├── person2.png
│           └── person3.png
│
├── .htaccess                           # Root rewrite forwarder ke folder public/ (Hosting Safe)
├── index.php                           # Root loader forwarder ke public/index.php
└── README.md                           # Dokumentasi teknis sistem
```

---

## 💻 Panduan Instalasi & Penggunaan

### Prasyarat Sistem
* **PHP**: Versi `8.0` atau lebih tinggi.
* **Ekstensi PHP**: `curl`, `json`, `mbstring`, `openssl`.
* **Web Server**: Apache dengan modul `mod_rewrite` diaktifkan, atau Nginx, atau PHP Built-in Server.

---

### Cara 1: Menjalankan di Laragon / XAMPP (Localhost)

1. Letakkan folder proyek di dalam web root web server Anda:
   * **Laragon**: `d:/laragon/laragon/www/SIM_DOSEN/SIM_DOSEN_FE`
   * **XAMPP**: `C:/xampp/htdocs/SIM_DOSEN_FE`
2. Pastikan Apache di Laragon / XAMPP sudah berjalan (*Start All*).
3. Buka browser dan akses melalui salah satu URL berikut:
   * **Laragon Virtual Host (Otomatis)**:
     ```text
     http://sim_dosen_fe.test/
     ```
   * **URL Subfolder Standar**:
     ```text
     http://localhost/SIM_DOSEN/SIM_DOSEN_FE/
     ```
   *(Sistem memiliki mekanisme pendeteksi folder otomatis di `config.php` sehingga asset CSS/JS dan URL rute akan berfungsi tanpa konfigurasi manual).*

---

### Cara 2: Menggunakan PHP Built-in Server

Anda dapat menjalankan sistem tanpa web server eksternal menggunakan server bawaan PHP:

1. Buka Terminal atau Command Prompt.
2. Masuk ke direktori folder `SIM_DOSEN_FE`:
   ```bash
   cd d:\laragon\laragon\www\SIM_DOSEN\SIM_DOSEN_FE
   ```
3. Jalankan server yang mengarah langsung ke folder `public/`:
   ```bash
   php -S 127.0.0.1:8000 -t public
   ```
4. Buka peramban di URL:
   ```text
   http://127.0.0.1:8000
   ```

---

### Cara 3: Deployment ke Shared Hosting / InfinityFree

Proyek ini telah dilengkapi dengan arsitektur **Dual-Layer `.htaccess`** sehingga kompatibel dengan hosting gratis seperti **InfinityFree**, **cPanel**, maupun VPS:

1. **Struktur File**:
   * Unggah seluruh isi folder `SIM_DOSEN_FE` ke dalam direktori `htdocs/` pada InfinityFree.
2. **Keamanan Dokumen Root**:
   * File `.htaccess` dan `index.php` pada tingkat terluar (*root directory*) secara otomatis meneruskan seluruh *traffic* masuk ke folder `public/index.php`.
   * Berkas sensitif di dalam `app/`, `config/`, dan `resources/` terlindungi dari akses publik langsung.
3. **Konfigurasi URL Backend**:
   * Pastikan URL API backend pada `config/config.php` telah mengarah ke server produksi backend (contoh: Vercel).

---

## ⚙️ Konfigurasi Sistem (`config.php`)

Seluruh pengaturan utama sistem terpusat pada file [`config/config.php`](file:///d:/laragon/laragon/www/SIM_DOSEN/SIM_DOSEN_FE/config/config.php):

```php
return [
    'app_name' => 'SIM DOSEN Universitas Muhammadiyah Bengkulu',
    'app_version' => '1.0.0',

    // URL REST API Backend sim-dosen-api
    'api_base_url' => 'https://sim-dosen-api.vercel.app/api',

    // URL Endpoint SSO sim-mhs-api (Penyedia identitas)
    'sso_login_url' => 'https://sim-mhs-api.vercel.app/api/v1/auth/login',

    // URL Fallback jika sim-mhs-api tidak dapat dihubungi
    'sso_fallback_url' => 'https://sim-dosen-api.vercel.app/api/auth/login',

    // Role yang memiliki izin Create, Edit, dan Delete data dosen
    'write_roles' => ['ADMIN', 'BAAK'],

    // Role yang memiliki hak akses baca (Read-Only)
    'read_roles' => [
        'ADMIN', 'BAAK', 'DOSEN', 'MAHASISWA',
        'REKTORAT', 'DEKANAT', 'KAPRODI', 'ADMIN_PRODI', 'ADMIN_DEKANAT'
    ],
];
```

> [!TIP]
> Jika Anda mengembangkan backend secara lokal menggunakan Node.js/Express di port 3000, ubah `'api_base_url'` menjadi `'http://localhost:3000/api'`.

---

## 👨‍💻 Panduan Pemeliharaan & Kontribusi

* **Menambahkan Halaman/Rute Baru**:
  1. Daftarkan rute baru di [`routes/web.php`](file:///d:/laragon/laragon/www/SIM_DOSEN/SIM_DOSEN_FE/routes/web.php) dengan format `Router::get('/url', [NamaController::class, 'method']);`.
  2. Tambahkan aksi pada Controller yang bersangkutan di `app/Controllers/`.
  3. Buat tampilan view di `resources/views/`.
* **Memodifikasi Tampilan Desain**:
  - Seluruh token warna, tipografi, dan komponen global didefinisikan di [`public/assets/css/app.css`](file:///d:/laragon/laragon/www/SIM_DOSEN/SIM_DOSEN_FE/public/assets/css/app.css).
  - Gunakan variabel CSS yang telah disediakan seperti `var(--primary)`, `var(--slate-800)`, `var(--radius-md)`, dan `var(--shadow-sm)` untuk menjaga konsistensi visual.
* **Menambah Ikon**:
  - Gunakan helper global `<?= svg_icon('nama-ikon', 'kelas-tambahan', 18) ?>` yang didefinisikan pada [`app/Helpers/functions.php`](file:///d:/laragon/laragon/www/SIM_DOSEN/SIM_DOSEN_FE/app/Helpers/functions.php) untuk menjaga performa rendering tetap instan tanpa membebani library font ikon pihak ketiga.

---

**SIM DOSEN Universitas Muhammadiyah Bengkulu**  
*Mewujudkan Tata Kelola Pendidik yang Profesional, Modern, dan Terintegrasi.*
