<?php
// Lakukan koneksi ke database (asumsikan koneksi sudah dibuat sebelumnya)
include 'database.php'; // Ubah sesuai dengan nama file koneksi Anda

// Periksa apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai judul, deskripsi, dan metode absensi dari inputan form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $absensi_method = $_POST['absensi_method'];

    // Gunakan pernyataan SQL INSERT untuk menyimpan detail kegiatan beserta metode absensi
    $query = "INSERT INTO kegiatan (title, description, absensi_method) VALUES ('$title', '$description', '$absensi_method')";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Kegiatan berhasil ditambahkan ke database
        // Lakukan tindakan lanjutan jika diperlukan
        echo "Activity created successfully!";
    } else {
        // Penanganan kesalahan jika ada
        echo "Error: " . mysqli_error($db);
    }
} else {
    // Jika data tidak dikirimkan melalui metode POST, tampilkan pesan error
    echo "Error: Data not submitted via POST method!";
}
// Tutup koneksi
mysqli_close($db);
?>
