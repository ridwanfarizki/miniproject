
#Cara Penggunaan Mini Project<br>
Mini Project ini dibuat sebagai aplikasi informasi cuaca dengan data dari https://www.metaweather.com/api/ yang menampilkan berdasarkan hari ini sampai dengan hari berikutnya sampai 5 hari kedepan. Aplikasi ini memiliki fitur pencarian berdasarkan kota, menyimpan hasil informasi cuaca berdasarkan pencarian kota.

#Tools Requirements<br> 
1. Framework Codeigniter 3.1.9
2. XAMPP v.3.2.2
3. Chrome (Add On Allow-Control-Allow-Origin: *)

#Fitur yang terdapat di aplikasi ini<br>
Pencarian dan Menampilkan Indormasi Cuaca Berdasarkan Kota
CRUD Kota
Penyimpanan hasil dari pencarian informasi cuaca

#Installation<br>
1. Install dan aktifkan Addon Allow-Control-Allow-Origin: * pada chrome(parse data json dari https://www.metaweather.com/api/ ke aplikasi)
2. Masukkan folder projek "miniproject" ke dalam htdocs atau web server
3. import database miniproject.sql
4. setting database.php di project/application/config/database
	'hostname' => 'localhost:3307',
	'username' => 'root',
	'password' => '',
	'database' => 'miniproject', 
sesuaikan dengan settingan database yang kalian miliki
5. jalankan aplikasi mu di browser dengan link sesuai path project berada

<img src="/ridwanfarizki/miniproject/raw/master/tampilan1.png" style="max-width:100%;">
