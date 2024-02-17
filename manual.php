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
// Check if aktivitas_id is included in the URL parameter and is not 

if(isset($_GET['aktifitas_id'])) {
    echo "Aktifitas ID: " . $_GET['aktifitas_id'];
} else {
    echo "Aktifitas ID not found in URL parameter.";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Attendance</title>
    <link rel="stylesheet" href="css/manual.css"> <!-- Ubah sesuai dengan lokasi file CSS Anda -->
    <link rel="stylesheet" href="layout/button_manual.css">
</head>
<body>
    <h2>Manual Attendance</h2>
    <form action="process_manual_attendance.php?aktifitas_id=<?php echo $_GET['aktifitas_id']; ?>" method="POST">
    <input type="hidden" name="aktivitas_id" value="<?php echo $_GET['aktifitas_id']; ?>">
        
        <label for="username">Username Guru:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <a href="process_manual_attendance.php?aktivitas_id=<?php echo $_GET['aktifitas_id']; ?>"> <input type="submit" value="Submit Attendance"></a>
        <a href="list_hadir.php?aktifitas_id=<?php echo $_GET['aktifitas_id']; ?>"><button type="button">List Kehadiran</button></a>

    </form>
</body>
</html>
