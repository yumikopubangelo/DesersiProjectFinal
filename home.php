<?php 
include "database.php";
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Ensure script stops executing after redirect
}

include "database.php";

if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
    exit(); // Ensure script stops executing after redirect
}

// Periksa apakah pengguna memiliki akses admin
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;
$admin = false; // Set default value for admin access

if ($admin_akses !== null) {
    // Ensure that $admin_akses is an array
    $admin_akses = (array) $admin_akses;
    $admin = in_array("admin", $admin_akses);
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
    <link rel="stylesheet" href="css/radio.css">
    <link rel="stylesheet" href="css/list_kegiatan_home.css">
    <link rel="stylesheet" href="layout/tombol_menambahkan.css">
    
    <form action="home.php" method="POST">
        <button class="btn" type="submit" name="logout">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0092E4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L20 9L12 16M20 9H4M20 9L4 9"/>
            </svg>
        </button>
    </form>
</head>
<body>

<script>
    function handleRadioButtonClick(event) {
        // Menghapus kelas "checked" dari semua elemen radio
        var radioButtons = document.querySelectorAll('.radio-inputs .radio');
        radioButtons.forEach(function(radioButton) {
            radioButton.classList.remove('checked');
        });

        // Menambahkan kelas "checked" pada elemen radio yang dipilih
        var selectedRadioButton = event.currentTarget;
        selectedRadioButton.classList.add('checked');
    }
</script>

<!-- Welcome Message -->
<h3 class="welcome-message">Selamat Datang <?=$_SESSION["username"]?> </h3>

<!-- List Kegiatan -->
<div class="pack-container">
    <div class="header">
        <p class="title">
            
        </p>
        <div class="price-container">
            <span></span>
            <span>Kegiatan</span>
        </div>
    </div>
    <div>
        <ul class="lists">
            <li class="list">
                <span>
                    <svg aria-hidden="true" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.5 12.75l6 6 9-13.5" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </span>
                <p>
                    Kegiatan Hari Ini
                </p>
            </li>
            <li class="list">
                <span>
                    <svg aria-hidden="true" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.5 12.75l6 6 9-13.5" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </span>
                <p>
                    Timeline
                </p>
            </li>
        </ul>
    </div>
</div>

<?php 
// Check if 'admin' is in the array and ensure $_SESSION['admin_akses'] is an array
if (isset($_SESSION['admin_akses']) && is_array($_SESSION['admin_akses']) && in_array("admin", $_SESSION['admin_akses'])) {
?>
<button onclick="window.location.href='create_activity.php';">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
    <path fill="none" d="M0 0h24v24H0z"/>
    <path d="M20 11H13V4c0-.55-.45-1-1-1s-1 .45-1 1v7H4c-.55 0-1 .45-1 1s.45 1 1 1h7v7c0 .55.45 1 1 1s1-.45 1-1v-7h7c.55 0 1-.45 1-1s-.45-1-1-1z"/>
  </svg>
</button>


<?php
}
?>
<!-- Pindah Halaman -->
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
