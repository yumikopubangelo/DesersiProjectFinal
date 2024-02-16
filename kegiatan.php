<?php 
include "database.php";
session_start();

// Check if the user clicked on logout
if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

// Query untuk mengambil kegiatan hari ini
$query_today = "SELECT * FROM kegiatan WHERE attendance_time = CURDATE()";
$result_today = mysqli_query($db, $query_today);

// Query untuk mengambil kegiatan yang telah berlalu
$query_past = "SELECT * FROM kegiatan WHERE attendance_time < CURDATE()";
$result_past = mysqli_query($db, $query_past);

if (!$result_today || !$result_past) {
    die("Query failed: " . mysqli_error($db));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="stylesheet" href="css/style_profil.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/radio_kegiatan.css">
    <link rel="stylesheet" href="layout/table.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section-title {
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

       
    </style>
</head>
<body>

<h1 class="welcome-message">Selamat Datang <?=$_SESSION["username"]?> </h1>
<form action="home.php" method="POST">
    <button class="btn" type="submit" name="logout">
        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0092E4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2L20 9L12 16M20 9H4M20 9L4 9"/>
        </svg>
    </button>
</form>

<h2 class="section-title">Kegiatan Hari Ini</h2>
<table>
    <thead>
        <tr>
            <th>Nama Kegiatan</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Input Kehadiran</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result_today)) : ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['attendance_time']; ?></td>
                <td><a href="manual.php?aktifitas_id=<?php echo $row['aktifitas_id']; ?>">Input Absensi</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2 class="section-title">Kegiatan yang Telah Berlalu</h2>
<table>
    <thead>
        <tr>
            <th>Nama Kegiatan</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Input Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result_past)) : ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['attendance_time']; ?></td>
                <td><a href="list_hadir.php?aktifitas_id=<?php echo $row['aktifitas_id']; ?>">List Kehadiran</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="radio-inputs">
    <label class="radio" for="radio-home" onclick="window.location.href='home.php'">
        <input id="radio-home" type="radio" name="radio" checked="">
        <span class="name">Home</span>
    </label>
    <label class="radio" for="radio-kegiatan" onclick="window.location.href='kegiatan.php'">
        <input id="radio-kegiatan" type="radio" name="radio">
        <span class="name">Kegiatan</span>
    </label>
    <label class="radio" for="radio-akun" onclick="window.location.href='akun.php'">
        <input id="radio-akun" type="radio" name="radio">
        <span class="name">Akun</span>
    </label>
</div>

</body>
</html>
