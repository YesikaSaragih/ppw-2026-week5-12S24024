# SIPUS-Del — Sistem Informasi Perpustakaan Kampus Del

**Mata Kuliah:** Pemrograman & Pengujian Web (12S3101)  
**Modul:** Praktikum Minggu 05 — Pola Arsitektur Model-View-Controller (MVC), Eloquent ORM, Validasi Server-Side, Blade Component Engine, dan Asset Bundling  
**Program Studi:** Sarjana Sistem Informasi / Sarjana Informatika &bull; Institut Teknologi Del  
**Repositori:** `ppw-2026-week5-12S24024`  
**Nama Mahasiswa / Pengembang:** Yesika Saragih (12S24024)

---

## 1. Deskripsi Proyek

**SIPUS-Del** adalah aplikasi pengelolaan data perpustakaan berbasis web untuk Institut Teknologi Del. Aplikasi ini dirancang untuk memudahkan pustakawan dan civitas akademika dalam mengelola data klasifikasi bidang ilmu (Kategori) serta katalog buku (Buku) secara terstruktur, aman, dan efisien.

Aplikasi ini dibangun menggunakan framework **Laravel 11.x/13.x** dengan mengadopsi arsitektur *Server-Side Rendering* (SSR) dan pola desain *Model-View-Controller* (MVC).

---

## 2. Tujuan Praktikum Week 5

Praktikum ini bertujuan untuk mencapai kompetensi Sub-CPMK:
1. Menerapkan pemisahan tugas (*Separation of Concerns* / SoC) antara Model, View, dan Controller.
2. Memahami alur siklus hidup HTTP Request pada arsitektur modern framework Laravel.
3. Menguasai Eloquent ORM, relasi relasional *One-to-Many*, dan Active Record pattern.
4. Mencegah permasalahan performa kritis **N+1 Query Problem** melalui teknik *Eager Loading* (`with()`).
5. Mengimplementasikan Database Version Control melalui skema *Migrations*, *Factories*, dan *Seeders*.
6. Menerapkan RESTful Resource Routing (7 aksi baku) dan *Implicit Route Model Binding*.
7. Mengamankan aplikasi web melalui validasi sisi server (*Server-Side Validation*), perlindungan token CSRF (`@csrf`), dan pengamanan output Blade dari serangan XSS.
8. Membangun antarmuka modular bertema identitas **Del Royal Purple** (`#4C1D95`) menggunakan *Blade Components* (`<x-layout>`).
9. Melakukan audit dan pencatatan kueri SQL secara real-time via `DB::listen`.

---

## 3. Fitur Utama

- **Manajemen Kategori Buku (CRUD Lengkap):**
  - Melihat daftar kategori disertai penghitungan otomatis jumlah buku terkait (`withCount('bukus')`).
  - Menambah kategori baru dengan validasi kode unik dan nama bidang keilmuan.
  - Melihat rincian detail kategori dan seluruh daftar buku yang terdaftar di dalamnya.
  - Memperbarui data kategori dengan pengecualian ID saat validasi kode unik.
  - Menghapus kategori beserta buku terkait (*cascade on delete*).
- **Manajemen Koleksi Buku (CRUD Lengkap):**
  - Menampilkan katalog buku dengan pagination aktif (10 item/halaman) dan *Eager Loading* kategori.
  - Menambah koleksi buku dengan validasi ketat (ISBN unik, judul min 5 karakter, stok non-negatif, tahun terbit valid).
  - Melihat detail spesifikasi lengkap buku, status ketersediaan stok, dan deskripsi sinopsis.
  - Memperbarui informasi buku melalui method spoofing `PUT`.
  - Menghapus buku dengan konfirmasi interaktif via method `DELETE`.
- **Keamanan & Validasi Masukan:**
  - Validasi ketat di sisi server dengan pesan kesalahan human-friendly berbahasa Indonesia.
  - Pemulihan nilai input lama via helper `old()`.
  - Proteksi penuh terhadap serangan Cross-Site Request Forgery (CSRF).
  - Proteksi Mass Assignment melalui deklarasi atribut `$fillable`.
- **Pemantauan Kueri SQL (Query Audit Log):**
  - Listener query otomatis yang mencatat waktu eksekusi (ms) dan statement SQL ke dalam berkas log untuk membuktikan mitigasi N+1.

---

## 4. Teknologi yang Digunakan

- **Bahasa Pemrograman:** PHP 8.2 / 8.3 / 8.5+ CLI
- **Framework Web:** Laravel Framework 11.x / 13.x
- **Basis Data:** SQLite (bawaan file `database/database.sqlite`)
- **Pustaka CSS / Antarmuka:** Bootstrap 5.3.3 & Bootstrap Icons 1.11.3
- **Templating Engine:** Blade Component Engine
- **Manajer Dependensi:** Composer 2.x
- **Pengujian Otomatis:** PHPUnit 11/12

---

## 5. Struktur Folder & Penjelasan Arsitektur MVC

Aplikasi diorganisasi mengikuti arsitektur MVC terstandarisasi:

```text
SIPUS-Del/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php
│   │       ├── KategoriController.php   <-- [Controller] Mengatur logika bisnis & alur data kategori
│   │       └── BukuController.php       <-- [Controller] Mengatur alur data buku & eager loading
│   ├── Models/
│   │   ├── Kategori.php                 <-- [Model] Entitas Kategori & relasi hasMany ke Buku
│   │   └── Buku.php                     <-- [Model] Entitas Buku & relasi belongsTo ke Kategori
│   └── Providers/
│       └── AppServiceProvider.php       <-- Konfigurasi DB::listen query audit & Bootstrap Paginator
├── database/
│   ├── factories/
│   │   ├── KategoriFactory.php          <-- Pembangkit data mock kategori via Faker
│   │   └── BukuFactory.php              <-- Pembangkit data mock buku via Faker
│   ├── migrations/
│   │   ├── 2026_10_12_000001_create_kategoris_table.php <-- Skema tabel kategoris
│   │   └── 2026_10_12_000002_create_bukus_table.php     <-- Skema tabel bukus & foreign key
│   └── seeders/
│       ├── DatabaseSeeder.php           <-- Runner utama seeder
│       ├── KategoriSeeder.php           <-- Seeder 6 kategori akademik Del
│       └── BukuSeeder.php               <-- Seeder 24 buku realistis akademik
├── resources/
│   └── views/
│       ├── components/
│       │   └── layout.blade.php         <-- [View] Master Shell Layout bertema Del Purple (#4C1D95)
│       ├── buku/                        <-- [View] Template CRUD Buku (index, create, show, edit)
│       └── kategori/                    <-- [View] Template CRUD Kategori (index, create, show, edit)
├── routes/
│   └── web.php                          <-- Pendaftaran rute RESTful resource & redirect
├── storage/
│   └── logs/
│       └── laravel.log                  <-- Berkas pencatatan query audit SQL
└── tests/
    └── Feature/
        ├── BukuCrudTest.php             <-- Pengujian otomatis CRUD buku, validasi, & mitigasi N+1
        └── KategoriCrudTest.php         <-- Pengujian otomatis CRUD kategori & aturan unik
```

### Penjelasan Peran MVC:
- **Model (`app/Models`):** Berfungsi sebagai representasi entitas data dan aturan hubungan antar tabel di basis data. Model melindungi integritas kolom dengan `$fillable`.
- **View (`resources/views`):** Berfungsi menyajikan data ke layar peramban pengguna. View terbebas dari eksekusi kueri langsung dan menggunakan direktif aman seperti `{{ }}`, `@forelse`, dan `@csrf`.
- **Controller (`app/Http/Controllers`):** Konduktor yang menangkap permintaan HTTP, memicu validasi, memanggil metode Eloquent pada Model, dan menyalurkan hasilnya ke View.

---

## 6. Skema Database & Relasi Eloquent

### A. Tabel `kategoris`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | BIGINT (Unsigned) | Primary Key (Auto Increment) |
| `kode_kategori` | VARCHAR(10) | Kode pengenal kategori, bersifat **UNIK** |
| `nama_kategori` | VARCHAR(100) | Nama bidang keilmuan/kategori |
| `created_at` | TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | Waktu modifikasi data terakhir |

### B. Tabel `bukus`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | BIGINT (Unsigned) | Primary Key (Auto Increment) |
| `isbn` | VARCHAR(255) | Nomor identifikasi buku, bersifat **UNIK** |
| `judul` | VARCHAR(200) | Judul buku (minimal 5 karakter) |
| `penulis` | VARCHAR(150) | Nama penulis buku |
| `penerbit` | VARCHAR(150) | Nama penerbit buku |
| `tahun_terbit` | INTEGER | Tahun terbit publikasi buku |
| `kategori_id` | BIGINT (Unsigned) | Foreign Key merujuk ke `kategoris.id` (`cascadeOnDelete`) |
| `stok` | INTEGER | Jumlah eksemplar buku (minimal 0) |
| `sinopsis` | TEXT | Ringkasan sinopsis (opsional / nullable) |
| `created_at` | TIMESTAMP | Waktu pembuatan data |
| `updated_at` | TIMESTAMP | Waktu modifikasi data terakhir |

### Relasi Antar Entitas:
- **`Kategori` to `Buku` (One-to-Many):**  
  ```php
  // app/Models/Kategori.php
  public function bukus(): HasMany {
      return $this->hasMany(Buku::class);
  }
  ```
- **`Buku` to `Kategori` (Many-to-One / Inverse):**  
  ```php
  // app/Models/Buku.php
  public function kategori(): BelongsTo {
      return $this->belongsTo(Kategori::class);
  }
  ```

---

## 7. Cara Instalasi Dependensi

Pastikan berada pada direktori utama proyek `c:\laragon\www\SIPUS-Del`:

```bash
composer install
```

---

## 8. Cara Menyiapkan Berkas `.env`

Salin template lingkungan atau gunakan konfigurasi berikut:

```bash
cp .env.example .env
php artisan key:generate
```

Pastikan variabel basis data pada berkas `.env` mengarah ke SQLite:

```env
APP_NAME="SIPUS-Del"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# Database otomatis menggunakan database/database.sqlite
```

---

## 9. Cara Migrasi & Seeding Database

Jalankan perintah berikut untuk mereset skema dan menyuntikkan minimal 5 kategori serta 20+ buku realistis:

```bash
php artisan migrate:fresh --seed
```

Hasil eksekusi:
- **6 Kategori Buku** baku akademik Institut Teknologi Del (`KAT-RPL`, `KAT-SI`, `KAT-AI`, `KAT-SEC`, `KAT-MAT`, `KAT-DEL`).
- **24 Koleksi Buku** lengkap dengan nomor ISBN valid, stok non-negatif, dan sinopsis mendalam.

---

## 10. Cara Menjalankan Server Aplikasi

Jalankan built-in server Artisan:

```bash
php artisan serve
```

Aplikasi dapat dibuka melalui browser pada alamat:  
👉 **[http://localhost:8000](http://localhost:8000)** (secara otomatis dialihkan ke halaman katalog buku `/buku`).

---

## 11. Konfigurasi Aset Antarmuka (Vite / Bootstrap CDN)

Sesuai panduan Modul Praktikum (Snippet Lab 3), antarmuka SIPUS-Del memuat framework **Bootstrap 5.3.3** dan **Bootstrap Icons** secara langsung melalui Content Delivery Network (CDN) berkinerja tinggi pada `resources/views/components/layout.blade.php`. Pendekatan ini membuat aplikasi ringan, mandiri, dan bebas hambatan kompilasi lokal tanpa dependensi tambahan.

Jika Anda ingin menjalankan tooling frontend bawaan Vite untuk pengembangan lebih lanjut:
```bash
npm install
npm run dev
```

---

## 12. Cara Menjalankan Automated Tests

Aplikasi dilengkapi suite pengujian otomatis yang menguji seluruh fungsionalitas CRUD, integritas relasi, validasi masukan form, dan mitigasi N+1 query problem.

Jalankan pengujian via Artisan:

```bash
php artisan test
```

### Hasil Pengujian Aktual:
```text
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true

   PASS  Tests\Feature\BukuCrudTest
  ✓ dapat menampilkan halaman index buku
  ✓ dapat menampilkan halaman tambah buku
  ✓ dapat menyimpan buku baru dengan relasi kategori
  ✓ validasi isbn duplikat ditolak
  ✓ validasi judul kurang dari 5 karakter ditolak
  ✓ validasi stok negatif ditolak
  ✓ validasi kategori tidak valid ditolak
  ✓ dapat menampilkan detail buku
  ✓ dapat memperbarui data buku
  ✓ dapat menghapus buku
  ✓ eager loading mencegah n plus 1 problem

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response

   PASS  Tests\Feature\KategoriCrudTest
  ✓ dapat menampilkan halaman index kategori
  ✓ dapat menampilkan halaman tambah kategori
  ✓ dapat menyimpan kategori baru
  ✓ validasi kode kategori harus unik
  ✓ validasi input wajib kategori
  ✓ dapat menampilkan detail kategori
  ✓ dapat menampilkan form edit kategori
  ✓ dapat memperbarui kategori
  ✓ dapat menghapus kategori

  Tests:    22 passed (63 assertions)
```

---

## 13. Audit Kueri SQL & Pembuktian Eager Loading (Mitigasi N+1)

### Cara Kerja Audit:
Pada `app/Providers/AppServiceProvider.php`, listener `DB::listen` didaftarkan:

```php
public function boot(): void
{
    \Illuminate\Pagination\Paginator::useBootstrapFive();

    \Illuminate\Support\Facades\DB::listen(function ($query) {
        \Illuminate\Support\Facades\Log::info(sprintf(
            "[SQL AUDIT] (%.2f ms) %s",
            $query->time,
            $query->sql
        ));
    });
}
```

Setiap kueri database yang dieksekusi akan dicatat ke berkas:  
`storage/logs/laravel.log`

### Contoh Log Kueri Aktual yang Diperoleh Saat Membuka `/buku`:
```text
[SQL AUDIT] (0.14 ms) select count(*) as "aggregate" from "bukus"
[SQL AUDIT] (0.18 ms) select * from "bukus" order by "created_at" desc limit 10 offset 0
[SQL AUDIT] (0.12 ms) select * from "kategoris" where "kategoris"."id" in (1, 2, 3, 4)
```

### Analisis Hasil Audit:
1. **Query 1 (Agregasi Pagination):** `select count(*) as "aggregate" from "bukus"` menghitung total buku untuk paginator.
2. **Query 2 (Data Koleksi Buku):** `select * from "bukus" order by "created_at" desc limit 10 offset 0` mengambil 10 buku teratas.
3. **Query 3 (Relasi Kategori via Eager Loading):** `select * from "kategoris" where "kategoris"."id" in (1, 2, 3, 4)` mengambil seluruh data kategori untuk ke-10 buku tersebut secara serentak menggunakan operator `IN (...)`.

**Perbandingan dengan Masalah N+1 (Lazy Loading):**
- **Jika Tanpa Eager Loading:** Mengambil 10 buku akan memicu 1 kueri buku + 10 kueri kategori terpisah = **11 kueri SQL**.
- **Dengan Eager Loading (`with('kategori')`):** Data diringkas menjadi tepat **2 kueri data terpadu** (ditambah 1 kueri pagination), terlepas dari berapapun jumlah buku yang ditampilkan di halaman.

---

## 14. Daftar Endpoint RESTful CRUD

| Metode HTTP | URI Endpoint | Nama Route | Action Controller | Deskripsi |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | &mdash; | Redirect | Dialihkan langsung ke `/buku` |
| `GET` | `/buku` | `buku.index` | `BukuController@index` | Menampilkan katalog buku & pagination |
| `GET` | `/buku/create` | `buku.create` | `BukuController@create` | Form penambahan buku baru |
| `POST` | `/buku` | `buku.store` | `BukuController@store` | Validasi & simpan buku ke database |
| `GET` | `/buku/{buku}` | `buku.show` | `BukuController@show` | Menampilkan rincian detail buku |
| `GET` | `/buku/{buku}/edit`| `buku.edit` | `BukuController@edit` | Form pengubahan data buku |
| `PUT/PATCH` | `/buku/{buku}` | `buku.update` | `BukuController@update` | Validasi & perbarui data buku |
| `DELETE` | `/buku/{buku}` | `buku.destroy` | `BukuController@destroy` | Menghapus buku dari database |
| `GET` | `/kategori` | `kategori.index` | `KategoriController@index` | Menampilkan daftar kategori buku |
| `GET` | `/kategori/create` | `kategori.create` | `KategoriController@create` | Form penambahan kategori baru |
| `POST` | `/kategori` | `kategori.store` | `KategoriController@store` | Validasi & simpan kategori baru |
| `GET` | `/kategori/{kategori}` | `kategori.show` | `KategoriController@show` | Detail kategori & daftar buku terkait |
| `GET` | `/kategori/{kategori}/edit`| `kategori.edit`| `KategoriController@edit` | Form pengubahan kategori |
| `PUT/PATCH` | `/kategori/{kategori}` | `kategori.update`| `KategoriController@update` | Validasi & perbarui kategori |
| `DELETE` | `/kategori/{kategori}` | `kategori.destroy`| `KategoriController@destroy` | Menghapus kategori & buku terkait |

---

## 15. Checklist Persyaratan Modul

| No | Komponen Penilaian | Bobot | Status | Bukti Implementasi |
| :---: | :--- | :---: | :---: | :--- |
| 1 | Skema Data & Migrations | 20% | **TERPENUHI (100%)** | Tabel `kategoris` & `bukus` lengkap dengan index unik dan foreign key cascade |
| 2 | Model Eloquent & Relasi | 20% | **TERPENUHI (100%)** | Relasi `hasMany()` dan `belongsTo()`, `$fillable` terproteksi, mitigasi N+1 terbukti |
| 3 | Routing RESTful & Controller | 20% | **TERPENUHI (100%)** | 7 aksi lengkap terdaftar via `Route::resource` dengan *Implicit Route Model Binding* |
| 4 | Validasi Server-Side & CSRF | 15% | **TERPENUHI (100%)** | Validasi ketat `$request->validate()` berbahasa Indonesia, token `@csrf`, spoofing method |
| 5 | Blade Templating & UI | 15% | **TERPENUHI (100%)** | Komponen master layout `<x-layout>` bertema Del Purple (`#4C1D95`), flash alert, `@forelse` |
| 6 | Seeders, Logging, Git | 10% | **TERPENUHI (100%)** | Seeder 6 kategori & 24 buku realistis, log `[SQL AUDIT]`, 22 automated tests lulus |

---

## 16. Catatan Konfigurasi & Panduan Eksekusi di Laragon

1. **Driver Basis Data:** Aplikasi menggunakan driver `sqlite` bawaan PHP. Pastikan ekstensi `pdo_sqlite` dan `sqlite3` aktif di berkas `php.ini` (telah diaktifkan secara otomatis).
2. **Kompilasi Frontend:** Styling antarmuka menggunakan Bootstrap 5.3.3 berbasis CDN sehingga dapat langsung berjalan mulus tanpa kewajiban menjalankan `npm run dev` atau `npm run build`.
3. **Pembersihan Log:** Berkas `storage/logs/laravel.log` secara berkala dapat dipantau atau dibersihkan tanpa mengganggu alur sistem.
