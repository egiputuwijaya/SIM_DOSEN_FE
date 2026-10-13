# SIM DOSEN - Frontend (Native PHP MVC)

Aplikasi Frontend untuk **Sistem Informasi Manajemen Dosen (SIM DOSEN)** yang dibangun menggunakan **PHP Native** murni dengan struktur arsitektur **MVC (Model-View-Controller)** bergaya **Laravel Framework**.

Frontend ini mengonsumsi REST API dari backend `sim-dosen-api` (`https://sim-dosen-api.vercel.app/api` atau `http://localhost:3000/api`) menggunakan autentikasi SSO berbasis JWT.

---

## 📁 Struktur Folder (Laravel-like MVC)

```text
SIM_DOSEN_FE/
├── app/
│   ├── Controllers/
│   │   ├── Controller.php         # Base Controller (render view, redirect, session flash)
│   │   ├── AuthController.php     # Autentikasi SSO, Quick Role Demo & Logout
│   │   └── DosenController.php    # CRUD Manajemen Dosen
│   ├── Core/
│   │   ├── App.php                # Bootstrap aplikasi & autoloader PSR-4
│   │   ├── Request.php            # HTTP Request wrapper & method spoofing (_method)
│   │   └── Router.php             # Router deklaratif (GET, POST, PUT, DELETE)
│   └── Helpers/
│       ├── ApiClient.php          # Wrapper HTTP cURL ke Backend REST API
│       ├── JwtHelper.php          # Generator & decoder token SSO (HS256)
│       ├── Session.php            # Manajemen session, flash alerts & pengecekan role
│       └── functions.php          # Global helpers (url(), asset(), e(), can_write(), old())
├── config/
│   └── config.php                 # Konfigurasi URL API, JWT secret & daftar role
├── resources/
│   └── views/
│       ├── auth/
│       │   └── login.php          # Tampilan login multi-opsi (Demo Role, SSO Live, Token)
│       ├── dosen/
│       │   ├── index.php          # Tabel data dosen + filter + statistik cepat
│       │   ├── create.php         # Form tambah dosen (khusus ADMIN / BAAK)
│       │   ├── edit.php           # Form edit dosen (khusus ADMIN / BAAK)
│       │   └── show.php           # Tampilan detail dosen
│       ├── errors/
│       │   └── 404.php            # Halaman 404 Not Found
│       └── layouts/
│           ├── app.php            # Layout utama (Navbar, Role Switcher, Modal, Footer)
│           └── guest.php          # Layout halaman login
├── routes/
│   └── web.php                    # Deklarasi rute aplikasi
├── public/
│   ├── .htaccess                  # Apache rewrite rules
│   ├── index.php                  # Front Controller (Entry Point)
│   └── assets/
│       ├── css/
│       │   └── app.css            # Desain Vanilla CSS modern responsif
│       └── js/
│           └── app.js             # Skrip interaktivitas client (filter, modal, toast)
├── .htaccess                      # Root rewrite ke folder public/
├── index.php                      # Root forwarder ke public/index.php
└── README.md
```

---

## 🚀 Cara Menjalankan

### Opsi 1: Menggunakan Laragon (Direkomendasikan)
Karena folder berada di `d:/laragon/laragon/www/SIM_DOSEN/SIM_DOSEN_FE`, Anda dapat langsung mengaksesnya melalui browser:
* URL: **`http://localhost/SIM_DOSEN/SIM_DOSEN_FE/`** atau **`http://localhost/SIM_DOSEN/SIM_DOSEN_FE/public/`**
* Atau jika menggunakan Virtual Host Laragon: **`http://sim-dosen-fe.test`**

### Opsi 2: Menggunakan PHP Built-in Server
Jalankan perintah berikut di terminal:
```bash
cd d:\laragon\laragon\www\SIM_DOSEN\SIM_DOSEN_FE
php -S 127.0.0.1:8000 -t public
```
Buka browser di: **`http://127.0.0.1:8000`**

---

## 🔐 Fitur Autentikasi & Role-Based Access Control (RBAC)

1. **⚡ Quick Role Demo (Disarankan untuk Pengujian Cepat)**:
   * Menghasilkan token JWT HS256 yang valid dan ditandatangani dengan `JWT_SECRET` yang sama persis dengan backend.
   * Anda dapat memilih role: `ADMIN`, `BAAK`, `DOSEN`, atau `MAHASISWA`.
2. **🔗 Live SSO sim-mhs-api**:
   * Melakukan request login riil ke `sim-mhs-api` (`POST /api/auth/login`).
3. **🔑 Paste Token Manual**:
   * Menempelkan access token Bearer secara langsung.

### Hak Akses Role
* **ADMIN & BAAK**: Akses penuh (bisa melihat, menambah data baru, mengedit, dan menghapus).
* **DOSEN & MAHASISWA**: Mode baca saja (*Read-Only*). Tombol Tambah, Edit, dan Hapus disembunyikan otomatis, dan akses rute penulisan diblokir.
* **Role Switcher Praktis**: Terdapat menu dropdown ganti role di header navbar atas untuk mendemonstrasikan perbedaan tampilan hak akses secara instan.

---

## ⚙️ Konfigurasi URL API Backend

Konfigurasi backend berada di `config/config.php`:
* **Vercel (Default)**: `'api_base_url' => 'https://sim-dosen-api.vercel.app/api'`
* **Lokal Express**: Jika backend dijalankan secara lokal (`npm run dev` pada `sim-dosen-api`), Anda dapat mengubah nilai `api_base_url` menjadi `'http://localhost:3000/api'`.
