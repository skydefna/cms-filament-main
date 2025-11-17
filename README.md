# Deployment Guides
## Setting up queue
```
php /home/your-site/your-site.tabalongkab.go.id/artisan queue:work
```

## Setting up scheduler
```
php /home/your-site/your-site.tabalongkab.go.id/artisan schedule:run >> /dev/null 2>&1
```
before going to next step make a bucket for your public storage

## Deployment script
```
git reset --hard HEAD && git clean -fd
git fetch && git merge
composer install --no-dev --no-interaction --optimize-autoloader
php artisan optimize:clear
php artisan setting:clear-cache
php artisan migrate --force
npm i && npm run build
php artisan optimize
```
## Important notes
make sure your `APP_ENV=local` and `APP_DEBUG=false`

then run 
```php 
php artisan migrate and php artisan optimize:clear
```

or if you want seeding make:sure run `composer install` (without additional flag like --no-dev)

rebuild asset
```
npm run build
```

## clear setting cache
```
php artisan setting:clear-cache
```

## Admin Panel
go to https://yoursite/admin-panel

for super-admin you can define email in .env APP_SUPER_ADMIN

# Panduan Pengguna CMS Filament

Panduan ini akan membantu Anda memahami dan menggunakan aplikasi CMS Filament secara efektif. Ini adalah Sistem Manajemen Konten berbasis Laravel yang dibangun dengan Panel Admin Filament.

## Daftar Isi

1. [Memulai](#memulai)
2. [Akses Panel Admin](#akses-panel-admin)
3. [Manajemen Konten](#manajemen-konten)
4. [Manajemen Media](#manajemen-media)
5. [Manajemen Media Sosial](#manajemen-media-sosial)
6. [Manajemen Kontak](#manajemen-kontak)
7. [Manajemen Inovasi](#manajemen-inovasi)
8. [Manajemen User](#manajemen-user)
9. [Pengaturan Website](#pengaturan-website)
10. [SEO dan Analytics](#seo-dan-analytics)
11. [Pemecahan Masalah](#pemecahan-masalah)

## Memulai

### Persyaratan Sistem
- PHP 8.1 atau lebih tinggi
- Database MySQL/PostgreSQL
- Composer
- Node.js dan npm
- Web server (Apache/Nginx)

### Pengaturan Awal
1. Clone repository dan install dependencies
2. Salin `.env.example` ke `.env` dan konfigurasi environment Anda
3. Atur koneksi database
4. Jalankan migrasi dan seeder
5. Akses panel admin

### Variabel Environment Penting
```env
APP_NAME=Your Site Name
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yoursite.com
APP_SUPER_ADMIN=your-email@domain.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# File Storage
FILESYSTEM_DISK=public
FILAMENT_FILESYSTEM_DISK=public

# Mail Configuration
MAIL_MAILER=smtp
MAIL_FROM_ADDRESS=noreply@yoursite.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Akses Panel Admin

### Mengakses Panel Admin
- URL: `https://yoursite.com/admin-panel`
  anda bisa menggunakan email dan password yang diberikan

### Ikhtisar Dashboard
Dashboard menyediakan:
- Ikhtisar statistik cepat
- Ringkasan aktivitas terbaru
- Indikator status sistem
- Tombol aksi cepat

## Manajemen Konten

### Manajemen Kategori Postingan
Organisir postingan Anda dengan kategori yang berada di grup navigasi "Post".

**Mengelola Kategori:**
1. Navigasi ke **Kategori Postingan** di grup "Post"
2. Klik **Buat** untuk menambahkan kategori baru
3. Isi field yang diperlukan:
   - **Nama Kategori**: Judul kategori (wajib diisi)
   - **Aktif**: Toggle untuk mengaktifkan/menonaktifkan kategori

**Fitur Kategori:**
- Drag & drop untuk mengatur urutan (reorderable)
- Toggle aktif/nonaktif langsung dari tabel
- Tidak ada pagination (semua kategori ditampilkan)
- Bulk delete untuk menghapus beberapa kategori sekaligus

### Manajemen Postingan
Postingan adalah jenis konten utama untuk berita, artikel, dan entri blog yang berada di grup navigasi "Post".

**Membuat Postingan Baru:**
1. Navigasi ke **Postingan** di grup "Post"
2. Klik **Buat** untuk membuat postingan baru
3. Isi field yang diperlukan:
   - **Kategori**: Pilih dari kategori yang tersedia (wajib)
   - **Judul**: Headline postingan (wajib)
   - **Publikasikan**: Toggle untuk mempublikasikan postingan (default: aktif)
   - **Konten Postingan**: Isi artikel menggunakan TipTap rich text editor (wajib)
   - **Thumbnail**: Upload gambar dengan aspect ratio 16:9 (wajib, max 1MB)

**Fitur Postingan:**
- Rich text editor TipTap dengan formatting lengkap
- Image editor terintegrasi untuk thumbnail
- Crop otomatis ke aspect ratio 16:9
- URL SEO-friendly dengan struktur tahun/bulan/slug
- Preview URL langsung di tabel admin
- Toggle publikasi langsung dari tabel
- Sorting berdasarkan tanggal pembuatan (terbaru di atas)

**Tips Postingan:**
- Gunakan judul yang menarik dan SEO-friendly
- Thumbnail akan otomatis di-crop ke rasio 16:9
- Konten mendukung formatting rich text, gambar, dan link
- URL otomatis dibuat berdasarkan tanggal dan judul

### Manajemen Agenda/Acara
Kelola acara dan item agenda yang berada di grup navigasi "Post".

**Membuat Agenda:**
1. Pergi ke **Agenda** di grup "Post"
2. Klik **Buat** untuk menambahkan agenda baru
3. Isi informasi agenda:
   - **Judul**: Nama acara (wajib, slug otomatis dibuat)
   - **Deskripsi**: Detail acara (opsional)
   - **Tanggal Mulai**: Tanggal dimulainya acara (wajib)
   - **Tanggal Akhir**: Tanggal berakhirnya acara (opsional, harus setelah tanggal mulai)
   - **Jam Mulai**: Waktu dimulainya acara (wajib)
   - **Jam Selesai**: Waktu berakhirnya acara (opsional, harus setelah jam mulai)
   - **Lokasi**: Tempat acara (opsional)
   - **Tampilkan Peta Lokasi**: Toggle untuk menampilkan peta

**Fitur Peta Lokasi:**
Jika toggle "Tampilkan Peta Lokasi" diaktifkan:
- **Cari Lokasi**: Field pencarian lokasi
- **Peta Interaktif**: Google Maps dengan kontrol lengkap
- **Latitude/Longitude**: Koordinat otomatis terisi
- **Autocomplete**: Pencarian lokasi otomatis untuk Indonesia
- **Drag & Drop**: Marker dapat dipindahkan
- **Reverse Geocoding**: Alamat otomatis terisi dari koordinat

**Tips Agenda:**
- Gunakan tanggal dan waktu yang akurat
- Aktifkan peta hanya jika lokasi spesifik diperlukan
- Deskripsi mendukung text biasa (bukan rich text)
- URL agenda menggunakan slug yang dibuat dari judul

### Manajemen Halaman
Halaman statis untuk konten permanen seperti Tentang Kami, Kontak, dll yang berada di grup navigasi "Post".

**Membuat Halaman:**
1. Pergi ke **Halaman** di grup "Post"
2. Klik **Buat** untuk membuat halaman baru
3. Isi informasi halaman:
   - **Judul**: Nama halaman (wajib, slug otomatis dibuat)
   - **Konten**: Isi halaman menggunakan TipTap rich text editor (wajib)
   - **Publikasikan**: Toggle untuk mempublikasikan halaman (wajib)

**Fitur Halaman:**
- Rich text editor TipTap dengan Grid Builder Action
- URL SEO-friendly berdasarkan slug
- Preview URL langsung di tabel admin
- Copy URL dengan satu klik
- Toggle publikasi langsung dari tabel
- Sorting berdasarkan tanggal pembuatan

**Tips Halaman:**
- Gunakan judul yang jelas dan deskriptif
- Konten mendukung formatting rich text, gambar, dan grid layout
- URL dapat di-copy langsung dari tabel untuk referensi
- Pastikan halaman dipublikasikan agar dapat diakses publik

### Manajemen Menu
Kontrol navigasi website Anda yang berada di grup navigasi "Post".

**Mengelola Menu:**
1. Navigasi ke **Menu** di grup "Post"
2. Klik **Buat** untuk membuat item menu baru
3. Konfigurasi menu:
   - **Jenis Menu**: Pilih tipe menu (wajib)
   - **Judul**: Nama menu yang ditampilkan (wajib)
   - **URL**: Untuk tipe External (opsional)
   - **Path**: Untuk tipe Internal (opsional)
   - **Pilih Halaman**: Untuk tipe Page (opsional)

**Tipe Menu:**
- **PAGE**: Menu yang mengarah ke halaman statis yang sudah dibuat
- **URL_INTERNAL**: Menu sistem yang sudah diatur (beranda, postingan, agenda, dll)
- **URL_EXTERNAL**: Menu yang mengarah ke link eksternal
- **DROPDOWN**: Menu induk untuk sub-menu (tidak memiliki link)

**Fitur Menu:**
- Tidak ada pagination (semua menu ditampilkan)
- Tidak ada pencarian
- Menu internal tidak bisa dihapus kecuali oleh super-admin
- Refresh otomatis setelah edit/hapus
- Relasi parent-child untuk dropdown menu

**Tips Menu:**
- Gunakan tipe PAGE untuk halaman statis yang sudah dibuat
- Tipe INTERNAL untuk fitur sistem seperti beranda, postingan terbaru
- Tipe EXTERNAL untuk link ke website lain
- Tipe DROPDOWN sebagai pengelompokan sub-menu

## Pengaturan Website

### Pengaturan Umum
Konfigurasi informasi dasar situs yang berada di grup navigasi "Pengaturan".

**Mengakses Pengaturan Umum:**
1. Navigasi ke **Pengaturan Umum** di grup "Pengaturan"
2. Konfigurasi melalui tab-tab berikut:

**Tab Umum:**
- **Nama Situs**: Nama lengkap website Anda
- **Nama Singkat**: Versi singkat nama situs

**Tab Logo:**
- **Logo Utama**: Upload logo utama (max 625KB)
- **Logo Sekunder**: Upload logo alternatif dengan tinggi 160px
- **Favicon**: Upload icon website 32x32px

**Tab Struktur Organisasi:**
- **Tinggi Node**: Tinggi node dalam struktur organisasi
- **Lebar Node**: Lebar node dalam struktur organisasi

**Tab Pengumuman:**
- **Pengumuman**: Teks berjalan untuk pengumuman (max 200 karakter)

**Tab Aspect Ratio Slider:**
- **Lebar**: Lebar aspect ratio slider
- **Tinggi**: Tinggi aspect ratio slider

### Pengaturan Lokasi
Konfigurasi informasi berbasis lokasi yang berada di grup navigasi "Pengaturan".

**Mengakses Pengaturan Lokasi:**
1. Navigasi ke **Pengaturan Lokasi** di grup "Pengaturan"
2. Atur informasi berikut:
   - **Alamat**: Alamat lengkap organisasi (wajib)
   - **Latitude**: Koordinat lintang (otomatis terisi dari peta)
   - **Longitude**: Koordinat bujur (otomatis terisi dari peta)
   - **Cari Lokasi**: Field pencarian untuk menemukan lokasi
   - **Peta Interaktif**: Google Maps dengan kontrol lengkap

**Fitur Peta:**
- Drag & drop marker untuk mengatur posisi
- Autocomplete pencarian lokasi untuk Indonesia
- Reverse geocoding untuk mengisi alamat otomatis
- Zoom dan kontrol peta lengkap
- Default lokasi Indonesia

## Manajemen Media

### Manajemen Slider
Kontrol slider dan banner homepage untuk menampilkan konten utama di halaman depan website yang berada di grup navigasi "Lainnya".

**Membuat Slider:**
1. Pergi ke **Slider** di grup "Lainnya"
2. Klik **Buat** untuk menambahkan slider baru
3. Isi informasi slider:
   - **Title**: Headline utama slider yang akan ditampilkan (wajib)
   - **Desc**: Teks pendukung atau penjelasan slider (opsional)
   - **Aktif**: Toggle untuk mengaktifkan/menonaktifkan slider (wajib)
   - **Hyperlink**: URL tujuan ketika slider diklik (opsional)
   - **Image**: Upload gambar background slider (wajib, max 2MB)

**Fitur Slider:**
- Drag & drop untuk mengatur urutan (reorderable)
- Preview gambar langsung di admin panel
- Image editor dengan crop otomatis sesuai aspect ratio
- Kontrol status untuk publikasi langsung dari tabel
- Responsive design otomatis
- Support format JPEG, PNG, GIF, WebP

**Tips Slider:**
- Gunakan gambar dengan aspect ratio yang sesuai dengan pengaturan di Pengaturan Umum
- Pastikan teks judul dan deskripsi mudah dibaca dengan kontras yang baik
- Urutkan slider berdasarkan prioritas konten dengan drag & drop
- Gunakan maksimal 5-7 slider untuk performa optimal
- Aktifkan hanya slider yang relevan dan terkini

### Tautan Banner
Kelola banner promosi dan tautan yang berada di grup navigasi "Lainnya".

**Mengelola Tautan Banner:**
1. Navigasi ke **Banner Link** di grup "Lainnya"
2. Klik **Buat** untuk menambahkan banner baru
3. Konfigurasi:
   - **URL**: Tautan tujuan banner (opsional)
   - **Gambar**: Upload gambar banner (wajib, max 2MB)

**Fitur Banner Link:**
- Image editor dengan aspect ratio 16:9
- Resize otomatis ke 160x90 pixels
- Drag & drop untuk mengatur urutan
- Support berbagai format gambar

### Video YouTube
Sematkan dan kelola konten video yang berada di grup navigasi "Lainnya".

**Menambahkan Video YouTube:**
1. Pergi ke **Youtube Video** di grup "Lainnya"
2. Klik **Buat** untuk menambahkan video baru
3. Tambahkan video dengan:
   - **URL**: Tautan video YouTube (wajib berawalan youtube.com)
   - **Title**: Judul video (wajib, otomatis terisi dari YouTube)
   - **Thumbnail**: URL thumbnail (otomatis terisi dari YouTube)

**Fitur Video YouTube:**
- Auto-fetch metadata dari YouTube
- Thumbnail otomatis dari YouTube
- Preview thumbnail di form
- URL copyable di tabel
- Sorting berdasarkan tanggal pembuatan

### Struktur Organisasi
Kelola staf dan struktur organisasi yang berada di grup navigasi "Lainnya".

**Mengelola Karyawan:**
1. Navigasi ke **Struktur Organisasi** di grup "Lainnya"
2. Klik **Buat** untuk menambahkan pegawai baru
3. Tambahkan staf dengan:
   - **Nama**: Nama lengkap pegawai (wajib)
   - **Jabatan**: Jabatan pegawai (wajib)
   - **Gambar**: Foto pegawai (opsional, max 1MB, aspect ratio 1:1)

**Fitur Struktur Organisasi:**
- Image editor dengan crop 1:1 untuk foto pegawai
- Default avatar jika tidak ada foto
- Struktur Organisasi Builder untuk mengatur hierarki
- Refresh otomatis setelah edit/hapus
- Circular image display di tabel

**Menu Pegawai memiliki Struktur Organisasi Builder** untuk mengatur atasan dan bawahan pegawai yang akan membentuk SOTK secara otomatis.

## Manajemen Media Sosial

### Pengaturan Media Sosial
Kelola tautan dan integrasi media sosial untuk meningkatkan jangkauan website.

**Mengelola Media Sosial:**
1. Navigasi ke **Media Sosial** di menu admin
2. Klik **Buat** untuk menambahkan akun media sosial baru
3. Isi informasi media sosial:
   - **Platform**: Pilih platform media sosial (Facebook, Instagram, Twitter, YouTube, TikTok, LinkedIn, dll)
   - **Nama Akun**: Nama akun atau handle media sosial
   - **URL**: Tautan lengkap ke profil media sosial
   - **Icon**: Icon platform akan otomatis muncul berdasarkan platform yang dipilih

**Fitur Media Sosial:**
- Tautan eksternal dengan target blank
- Urutan bisa disesuaikan

**Tips Media Sosial:**
- Pastikan URL media sosial valid dan dapat diakses
- Urutkan berdasarkan prioritas atau popularitas platform
- Aktifkan hanya akun yang masih aktif digunakan
- Periksa secara berkala apakah tautan masih berfungsi

## Manajemen Kontak

### Manajemen Kontak
Kelola informasi kontak organisasi yang berada di grup navigasi "Lainnya".

**Mengelola Kontak:**
1. Navigasi ke **Kontak** di grup "Lainnya"
2. Klik **Buat** untuk menambahkan kontak baru
3. Isi informasi kontak:
   - **Nama**: Jenis kontak (misalkan WhatsApp, Email, Telepon, dll) (wajib)
   - **Nilai**: Nomor telepon, alamat email, atau informasi kontak lainnya (wajib)
   - **Icon**: Upload icon kontak (wajib, aspect ratio 1:1, resize ke 120x120px)

**Fitur Kontak:**
- Drag & drop untuk mengatur urutan tampilan
- Image editor dengan crop 1:1 untuk icon
- Resize otomatis ke 120x120 pixels
- Tidak ada pagination (semua kontak ditampilkan)
- Tidak ada pencarian
- Link ke Flaticon untuk download icon

**Tips Manajemen Kontak:**
- Gunakan nama yang jelas untuk jenis kontak (WhatsApp, Email, Telepon)
- Pastikan nilai kontak akurat dan dapat dihubungi
- Download icon dari Flaticon untuk konsistensi visual
- Urutkan kontak berdasarkan prioritas atau frekuensi penggunaan

## Manajemen Inovasi

### Manajemen Inovasi
Kelola showcase inovasi dan terobosan yang telah dilakukan oleh organisasi.

**Membuat Inovasi Baru:**
1. Navigasi ke **Inovasi** di menu admin (grup "Lainnya")
2. Klik **Buat** untuk menambahkan inovasi baru
3. Isi informasi inovasi:
   - **Nama**: Nama inovasi atau program yang dikembangkan
   - **Berupa Aplikasi**: Toggle untuk menandai apakah inovasi berupa aplikasi digital
   - **Deskripsi**: Penjelasan singkat tentang inovasi (wajib diisi)
   - **Artikel**: Konten detail menggunakan rich text editor (opsional)

4. **Jika inovasi berupa aplikasi**, isi tautan berikut (opsional):
   - **Playstore URL**: Tautan ke Google Play Store
   - **Appstore URL**: Tautan ke Apple App Store  
   - **Web URL**: Tautan ke versi web aplikasi

**Fitur Inovasi:**
- **Drag & Drop Ordering**: Atur urutan tampilan inovasi dengan menyeret baris di tabel
- **Toggle Aplikasi**: Kontrol dinamis untuk menampilkan/menyembunyikan field URL aplikasi
- **Rich Text Editor**: Editor TipTap untuk artikel dengan formatting lengkap
- **Validasi URL**: Otomatis memvalidasi format URL yang dimasukkan
- **Auto-clearing**: URL aplikasi otomatis dihapus jika toggle "Berupa Aplikasi" dinonaktifkan

**Mengelola Urutan Inovasi:**
1. Di halaman daftar inovasi, gunakan handle drag (ikon garis) di sebelah kiri setiap baris
2. Seret dan lepas untuk mengatur urutan tampilan
3. Urutan akan tersimpan otomatis

**Tips Manajemen Inovasi:**
- Gunakan deskripsi yang jelas dan mudah dipahami untuk menjelaskan manfaat inovasi
- Aktifkan toggle "Berupa Aplikasi" hanya untuk inovasi digital/aplikasi
- Isi minimal satu URL (Playstore, Appstore, atau Web) untuk aplikasi
- Gunakan artikel untuk dokumentasi lengkap dan panduan penggunaan
- Atur urutan berdasarkan prioritas atau tingkat kepentingan inovasi

**Kolom Tabel:**
- **Urutan**: Nomor urutan tampilan (dapat diubah dengan drag & drop)
- **Nama**: Nama inovasi
- **Berupa Aplikasi**: Status toggle yang dapat diubah langsung dari tabel
- **Playstore URL**: Tautan Google Play Store (tersembunyi secara default)
- **Appstore URL**: Tautan Apple App Store (tersembunyi secara default)  
- **Web URL**: Tautan aplikasi web (tersembunyi secara default)
- **Created At/Updated At**: Timestamp (tersembunyi secara default)

**Aksi Tersedia:**
- **Edit**: Mengubah data inovasi
- **Delete**: Menghapus inovasi
- **Bulk Delete**: Menghapus beberapa inovasi sekaligus

## Manajemen User

### Manajemen User
Kelola pengguna sistem yang berada di grup navigasi "Manajemen User".

**Mengelola User:**
1. Navigasi ke **User** di grup "Manajemen User"
2. Klik **Buat** untuk menambahkan user baru
3. Isi informasi user:
   - **Nama**: Nama lengkap user (wajib)
   - **Email**: Alamat email user (wajib, unique)
   - **Nomor Telepon**: Nomor telepon dengan format +62 (opsional)
   - **Password**: Password user (wajib untuk user baru)
   - **Password Confirmation**: Konfirmasi password (wajib untuk user baru)
   - **Roles**: Pilih role/peran user (checkbox list)

**Fitur User Management:**
- Filter role berdasarkan level akses (super-admin tidak bisa diedit kecuali oleh super-admin)
- Copy email dan nomor telepon langsung dari tabel
- Badge role dengan warna berbeda
- Email verification otomatis saat edit
- Reset password dengan notifikasi email
- Bulk delete untuk menghapus beberapa user sekaligus

**Aksi User:**
- **Edit**: Mengubah data user (password tidak bisa diedit via form edit)
- **Delete**: Menghapus user (tidak bisa menghapus diri sendiri)
- **Reset Password**: Mengatur ulang password user dengan notifikasi email

**Tips User Management:**
- Gunakan email yang valid untuk notifikasi sistem
- Nomor telepon harus berawalan +62 untuk Indonesia
- Assign role sesuai dengan tanggung jawab user
- Gunakan reset password untuk keamanan yang lebih baik

### Manajemen Role
Kelola peran dan hak akses pengguna yang berada di grup navigasi "Manajemen User".

**Mengelola Role:**
1. Navigasi ke **Role** di grup "Manajemen User"
2. Klik **Buat** untuk menambahkan role baru
3. Isi informasi role:
   - **Name**: Nama role (wajib, unique)
   - **Guard Name**: Guard yang digunakan (default: web)
   - **Select All**: Toggle untuk memilih semua permission
   - **Permissions**: Pilih permission spesifik untuk role

**Fitur Role Management:**
- Shield integration untuk permission management
- Select all toggle untuk kemudahan
- Permission grouping berdasarkan resource
- Badge guard name dan permission count
- Tidak ada pagination (semua role ditampilkan)

**Tips Role Management:**
- Gunakan nama role yang jelas dan deskriptif
- Berikan permission minimal yang diperlukan (principle of least privilege)
- Test role baru dengan user test sebelum assign ke user aktif
- Dokumentasikan tanggung jawab setiap role
