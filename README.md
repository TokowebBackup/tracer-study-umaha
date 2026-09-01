# Tracer Study Universitas UMAHA
<img width="1920" height="1044" alt="Admin-Panel-Tracer-Study-UMAHA-10-16-2025_01_22_PM" src="https://github.com/user-attachments/assets/4673ac3b-12a4-45ba-b601-fb8c8ce922c2" />

<img width="1920" height="1983" alt="Tracer-Study-UMAHA" src="https://github.com/user-attachments/assets/74bad9f0-d590-4b99-8dc0-1b3ad747bcfd" />

Website resmi Tracer Study untuk Universitas Maarif Hasyim Latif (UMAHA), dibangun untuk mengelola data alumni, pengguna lulusan, serta menyediakan rekapitulasi visual dalam bentuk grafik dan tabel interaktif.

🌐 Live Website: [https://tracer-study.umaha.demo-tokoweb.my.id/tracer-study-umaha/public/](https://tracer-study.umaha.demo-tokoweb.my.id/tracer-study-umaha/public/)

---

## 🔧 Built With

- [CodeIgniter 4](https://codeigniter.com/)
- [Bootstrap 5](https://getbootstrap.com/)
- [Highcharts](https://www.highcharts.com/)
- [DataTables](https://datatables.net/)

---  

#### Before running update dependencies (optional)  
```
composer update
composer install --prefer-dist --optimize-autoloader
```  

## 🎯 Features

### 🛠 Admin Dashboard
- CRUD data alumni & pengguna lulusan
- Manajemen form kuisioner
- Manajemen pengguna dan otorisasi

### 👥 Alumni User
- Halaman login khusus alumni UMAHA
- Form kuisioner tracer study alumni (dibutuhkan login)
- Edit dan kirim ulang jawaban

### 🏢 Pengguna Lulusan
- Form kuisioner terbuka untuk perusahaan / instansi
- Mengumpulkan feedback terhadap kualitas lulusan UMAHA

### 📊 Rekapitulasi & Visualisasi
- Ringkasan data kuisioner alumni & pengguna lulusan
- Tabel interaktif (DataTables)
- Grafik statistik (Highcharts)

### 📋 Form Dinamis Kuesioner

    - Admin dapat menambahkan form kuesioner secara dinamis melalui menu Manajemen Form Kuesioner

    - Setiap field dapat dikonfigurasi:

        - Label: nama tampilan field

        - Nama Field (field_name): nama kolom database (tanpa spasi)

        - Tipe Input: text, number, select, textarea

        - Step Form: dikelompokkan menjadi Step 1 dan Step 2

        - Urutan Tampil: posisi field di dalam form

        - Wajib Diisi: opsi required atau tidak

        - Header/Judul Seksi: untuk pengelompokan tampilan form

        - Select Options:

            - Input manual dalam format JSON (contoh: ["Ya","Tidak"])

            - Atau ambil data dari tabel (misal: prodi, pekerjaan, dll)

    - Semua field yang ditambahkan akan:

        - Tersimpan di tabel kuesioner_fields

        - Dirender otomatis di form isian alumni

        - Disimpan otomatis ke tabel tracer_study (tanpa perlu ubah model)

    - Field baru langsung aktif tanpa ubah kode Controller atau Model

### 📁 Contoh Struktur Data Dinamis
```
field_name	label	type	required	step	options / source_table
status_pekerjaan	Status Pekerjaan	select	Ya	1	["Bekerja","Wirausaha"]
gaji_pertama	Gaji Pertama	number	Tidak	2	-
program_studi	Program Studi	select	Ya	1	source_table: prodi
```  

### 🧠 Mekanisme Dinamis

    - Sistem akan otomatis membaca field dari tabel kuesioner_fields

    - Form yang dirender akan menyesuaikan tanpa hardcoded HTML

    - Data yang disubmit akan tersimpan secara otomatis ke tracer_study karena Model TracerModel menyesuaikan kolom secara dinamis

    - Tidak perlu ubah kode saat menambah field baru (cukup lewat admin panel)
---

## 🚀 Getting Started

1. **Clone the repository**  
   ```bash
   git clone https://github.com/namamu/tracer-study-umaha.git
   cd tracer-study-umaha
   ```  

2. Install dependencies & setup

    - Sesuaikan .env file dengan konfigurasi database kamu

    -   Jalankan migrasi dan seed jika tersedia  

3. Start the server  
##### Clear cache
```
php spark cache:clear
```

##### Run server
```
php spark serve Or php spark serve --port 8000
```  

**Optional**
##### Change password
```
php -r "echo password_hash('password@321', PASSWORD_DEFAULT) . PHP_EOL;"
```

4. Akses di browser  
```
http://localhost:8080
```  

📁 Struktur Direktori Penting  
```
        app/Controllers – Logic utama aplikasi

        app/Views – Tampilan berbasis Bootstrap

        app/Models – Query ke database

        public/ – Akses utama website (entry point)

        app/Database/Seeds – Seeder untuk data awal (jika tersedia)  
```  

### Version controller command set
```
# 1️⃣ Pastikan tidak ada .env di working dir
ls -a | grep .env

# 2️⃣ Tambahkan .env ke gitignore
echo ".env" >> .gitignore
git add .gitignore
git commit -m "Add .env to gitignore"

# 3️⃣ Hapus semua jejak .env dari history repo
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch .env" \
  --prune-empty --tag-name-filter cat -- --all

# 4️⃣ Force push ulang
git push origin main --force

```  

##### Docs DB 
```
ALTER TABLE kuesioner_fields ADD conditional_field VARCHAR(100) NULL, ADD conditional_value VARCHAR(100) NULL, ADD section_key VARCHAR(100) NULL;
```

```
ALTER TABLE tracer_study
ADD domisili_alumni VARCHAR(255) NULL,
ADD bulan_mulai_mencari_pekerjaan VARCHAR(100) NULL,
ADD updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP;
``` 

##### Clean Data Tracer
```
SET FOREIGN_KEY_CHECKS = 0;

DELETE FROM pengguna_lulusan_detail;
DELETE FROM pengguna_lulusan;
DELETE FROM pengguna_request;
DELETE FROM tracer_study;

SET FOREIGN_KEY_CHECKS = 1;

ALTER TABLE pengguna_lulusan_detail AUTO_INCREMENT = 1;
ALTER TABLE pengguna_lulusan AUTO_INCREMENT = 1;
ALTER TABLE pengguna_request AUTO_INCREMENT = 1;
ALTER TABLE tracer_study AUTO_INCREMENT = 1;

```



🙌 Kontribusi

Pull request dan issue sangat diterima! Pastikan kamu mengikuti gaya penulisan dan standar proyek ini.  

📄 License

Proyek ini didistribusikan untuk kebutuhan internal pengembangan Universitas UMAHA. Kontak pemilik repository untuk penggunaan lebih lanjut.

🧑‍💻 Developed by:  [Puji Ermanto | AKA Tatang. S | AKA Maman Salajami | AKA Deden Inyuus](https://pujiermanto-portfolio.vercel.app)
