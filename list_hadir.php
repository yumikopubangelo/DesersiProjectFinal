<?php
session_start();
include "database.php"; // Pastikan file ini berisi kode koneksi database yang diperlukan
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Ensure script stops executing after redirect
}

// Periksa apakah pengguna sudah login sebagai admin
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;

if ($admin_akses !== null) {
    // Ensure that $admin_akses is an array
    $admin_akses = (array)$admin_akses;
    $admin = in_array("admin", $admin_akses);

    if (!$admin) {
        // Redirect users without admin access to home.php
        header("Location: home.php");
        exit(); // Make sure to exit after a redirect
    }
} else {
    // Redirect users who are not logged in to the login page
    header("Location: index.php");
    exit(); // Make sure to exit after a redirect
}
// Dapatkan id pengguna yang sedang login

// Periksa apakah 'aktifitas_id' telah diset

// Periksa apakah ada ID kegiatan dari parameter URL
if(isset($_GET['aktifitas_id'])) {
    $id_kegiatan = $_GET['aktifitas_id'];

    // Query untuk mendapatkan detail kegiatan berdasarkan id_kegiatan yang dipilih
    $query_kegiatan = "SELECT * FROM kegiatan WHERE aktifitas_id = $id_kegiatan";
    $result_kegiatan = mysqli_query($db, $query_kegiatan);

    if (!$result_kegiatan) {
        echo "Error: " . mysqli_error($db);
        exit();
    }

    // Ambil data kegiatan dari hasil query
    $kegiatan = mysqli_fetch_assoc($result_kegiatan);
} else {
    // Jika ID kegiatan tidak ditemukan dalam parameter URL, lakukan penanganan kesalahan atau redirect ke halaman lain
    echo "Error: ID kegiatan tidak ditemukan.";
    exit();
}

// Query untuk mendapatkan daftar kehadiran yang terkait dengan id kegiatan yang dipilih
$query_kehadiran = "SELECT kehadiran.*, users.username 
                   FROM kehadiran 
                   INNER JOIN users ON kehadiran.guru_id = users.id
                   WHERE kehadiran.aktivitas_id = ?";
$stmt_kehadiran = mysqli_prepare($db, $query_kehadiran);
mysqli_stmt_bind_param($stmt_kehadiran, "i", $id_kegiatan);
mysqli_stmt_execute($stmt_kehadiran);
$result_kehadiran = mysqli_stmt_get_result($stmt_kehadiran);

if (!$result_kehadiran) {
    echo "Error: " . mysqli_error($db);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan</title>
    <link rel="stylesheet" href="layout/list.css">
</head>
<body>
    <h1>Detail Kegiatan</h1>
    <h2>Nama Kegiatan: <?php echo $kegiatan['title']; ?></h2>
    <p>Deskripsi: <?php echo $kegiatan['description']; ?></p>
    <p>Tanggal: <?php echo $kegiatan['attendance_time']; ?></p>

    <h2>Daftar Kehadiran</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Waktu Kehadiran</th>
                <!-- Tambahkan kolom lain jika diperlukan -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_kehadiran)) : ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['waktu_kehadiran']; ?></td>
                    <!-- Tambahkan kolom lain jika diperlukan -->
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>