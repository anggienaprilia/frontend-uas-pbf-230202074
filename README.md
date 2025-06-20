<h2>Frontend UAS PBF - Laravel</h2>
<p>Repository ini merupakan frontend Laravel dari sistem manajemen rumah sakit, yang terhubung ke backend REST API. Dibuat untuk memenuhi Ujian Akhir Semester mata kuliah Pemrograman Berbasis Framework.</p>
<p><b>
    <br>Nama: Anggie Nurul Aprilia
    <br>NPM: 230202074
    <br>Kelas: TI 2D
</b></p>
<hr>
<p><strong>Teknologi</strong></p>
<ul style="list-style-type:disc;">
  <li>Laravel 11</li>
  <li>AdminLTE - Boostrap 3</li>
  <li>Postman</li>
</ul>
<hr>
<p><b>Struktur Proyek</b></p>
    <ul>
      <li><code>frontend-uas-230202074</code> – Proyek Laravel</li>
      <li>Menyediakan antarmuka CRUD untuk:
        <ul>
          <li>Pasien</li>
          <li>Obat</li>
        </ul>
      </li>
      <li>Terhubung ke REST API backend menggunakan Laravel HTTP Client
        (<code>Http::get()</code>, <code>Http::post()</code>, dll)
      </li>
    </ul>
<hr>

<strong>Cara Instalasi dan Menjalankan Project</strong>
<br>
<b><p>1. Install Laravel 11</b>
<br>Perintah untuk menginstall Laravel 11:
<br><pre>composer create-project laravel/laravel:^11 frontend-uas-pbf-230202074</pre>
Pastikan instalasi laravel 11 berada di C:\laragon\www agar memundahkan untuk menjalankannya. Setelah itu, masuk ke dalam folder laravel yang telah dibuat.
<br>Tujuan: Membuat folder proyek Laravel 11 baru yang digunakan sebagai frontend dari sistem manajemen rumah sakit. Di dalamnya nanti programmer akan menulis semua kode tampilan dan konsumsi API dari backend CI4.

<b><p>2. Instalasi AdminLTE 3 dan Bootstrap</b>
<br>Perintah untuk menginstall template AdminLTE 3:
<br><pre>composer require jeroennoten/laravel-adminlte</pre>
Lalu jalankan hasil instalasi dengan perintah
<pre>php artisan adminlte:install</pre>
Tujuan: Menggunakan template AdminLTE agar tampilan web frontend-nya langsung profesional (sudah ada sidebar, navbar, tombol Bootstrap, dll). AdminLTE cocok untuk dashboard aplikasi data seperti sistem manajemen rumah sakit

<b><p>3. Atur Konfigurasi .env</b>
<br>Edit file .env, sesuaikan konfigurasi berikut agar Laravel dapat mengakses backend:
<pre>APP_NAME=RumahSakit</pre>
<pre>APP_URL=http://localhost:8000</pre>
APP_URL adalah URL dari frontend Laravel.
<br>API_URL adalah URL dari backend CodeIgniter. Ini digunakan agar Laravel tahu ke mana harus mengirim request untuk ambil data obat/pasien.

<b><p>4. Tambahkan Konfigurasi API_URL</b>
<br>Konfigurasi API_URL dilakukan di config/service.php
<pre>'perpus_api' => ['base_uri' => env('API_URL', 'http://localhost:8080'),]</pre>
Tujuan: Menyimpan endpoint API backend agar bisa dipanggil secara global dari mana saja dalam Laravel. Ini semacam shortcut URL yang akan dipanggil nanti oleh ApiService.

<b><p>5. Buat Service API Helper</b>
<br>Konfigurasi API Helper dilakukan di app/Services/ApiService.php
<br>Tujuan: Membuat class khusus yang menangani request ke REST API CodeIgniter. Dengan ini, kamu tidak perlu nulis Http::get(...) di controller berulang-ulang — cukup panggil method get, post, put, atau delete dari service ini.

<b><p>6. Buat Controller</b>
<br>Konfigurasi controller
<pre>php artisan make:controller ObatController</pre>
<pre>php artisan make:controller PasienController</pre>
Tujuan: Mengelola logika frontend, misalnya menampilkan data dari API ke blade, mengirim form tambah/edit ke API dan menangani tombol hapus.

<b><p>7. routing Web</b>
<br>Routing Web dilakukan di routes/web.php
<pre>Route::resource('obat', ObatController::class);</pre>
<pre>Route::resource('pasien', PasienController::class);</pre>
Tujuan: Agar Laravel tau URL mana yang akan memanggil controller tertentu. 

<b><p>8. Blade Template (Views)</b>
<br>Blade Tempat dibuat pada resources/views/obat/index.blade.php, dll
<br>Tujuan: Menampilkan data di browser dengan desain HTML yang rapi (berbasis AdminLTE). Kamu bisa lihat daftar buku, tombol edit, tambah, dan hapus di sini.

<b><p>9. Jalankan Server</b>
<br>Konfigurasi untuk menjalankan server atau project
<pre>php artisan serve</pre>
Tujuan: Menyalakan frontend Laravel agar bisa diakses lewat browser di http://localhost:8000. Wajib dijalankan agar frontend bisa digunakan.

<hr>
<p><strong>Fitur CRUD</strong></p>
<b>Pasien</b>
<ul style="list-style-type:disc;">
  <li>Lihat daftar pasien</li>
  <li>Tambah data pasien</li>
  <li>Edit data pasien</li>
  <li>Hapus data pasien</li>
</ul>
<br>
<b>Obat</b>
<ul style="list-style-type:disc;">
  <li>Lihat daftar obat</li>
  <li>Tambah data obat</li>
  <li>Edit data obat</li>
  <li>Hapus data obat</li>
</ul>

<hr>
<p><strong>Fitur Tambahan</strong></p>
Fitur tambahan yang dibuat adalah fitur filter. Fitur filter biasanya digunakan untuk menyaring data yang ditampilkan, agar pengguna dapat dengan cepat menemukan informasi yang spesifik tanpa harus menelusuri seluruh daftar.
<br><b>Penggunaan fitur filter:</b>
<br><b>1. Filter Pasien</b>
<br>Contoh filter:
<ul style="list-style-type:disc;">
  <li>Berdasarkan nama pasien huruf A-Z</li>
  <li>Berdasarkan nama pasien huruf Z-A</li>
</ul>
![image](https://github.com/user-attachments/assets/292ec7db-bd99-4dc3-810b-fd2b51407a96)


<br><b>2. Filter Obat</b>
<br>Contoh filter:
<ul style="list-style-type:disc;">
  <li>Berdasarkan nama obat huruf A-Z</li>
  <li>Berdasarkan nama obat huruf Z-A</li>
  <li>Berdasarkan kategori obat huruf A-Z</li>
  <li>Berdasarkan kategori obat huruf Z-A</li>
</ul>
![image](https://github.com/user-attachments/assets/581376d0-0529-49ca-af10-46d5933dd1e7)


<hr>
<p><strong>STRUKTUR FOLDER FRONTEND</strong></p>

```bash
frontend-uas-230202074/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ObatController.php
│   │   │   ├── PasienController.php
│   │   └── Middleware/
│   ├── Providers/
│   └── Services/
│       └── ApiService.php       <-- Untuk koneksi ke backend CI4
│
├── bootstrap/
├── config/
│   └── services.php             <-- Tambahkan konfigurasi 'rumahsakit_api'
│
├── public/
│   └── index.php
│
├── resources/
│   ├── views/
│   │   ├── obat/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── pasien/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   └── welcome.blade.php (opsional)
│
├── routes/
│   └── web.php                 <-- Daftar route resource
│
├── .env                        <-- API_URL pointing to backend
├── composer.json
└── artisan
