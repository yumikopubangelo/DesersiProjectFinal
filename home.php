<?php 
include "database.php";
session_start();
if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
}



// Periksa apakah pengguna sudah login
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;

if ($admin_akses !== null) {
    // Ensure that $admin_akses is an array
    $admin_akses = (array)$admin_akses;
    $admin = in_array("admin", $admin_akses);

    if ($admin) {
        // Code for admin access
        echo "User has admin access.";
    } else {
        // Handle the case where 'admin_akses' is an array but doesn't contain 'admin'
        echo "User doesn't have admin access.";
    }
} else {
    // Handle the case where 'admin_akses' is not set
    echo "Admin access not available.";
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
    <link rel="stylesheet" href="css/tombol_menambahkan.css">
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

<?php 
// Check if 'admin' is in the array and ensure $_SESSION['admin_akses'] is an array
if (isset($_SESSION['admin_akses']) && is_array($_SESSION['admin_akses']) && in_array("admin", $_SESSION['admin_akses'])) {
?>
    <!-- Your existing code for admin access -->
    <input checked="" class="checkbox" type="checkbox"> 
    <div class="mainbox">
        <div class="iconContainer">
            <svg viewBox="0 0 24 24" height="1em" xmlns="http://www.w3.org/2000/svg" class="plus_icon">
                <path d="M19 11H13V5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 19.5523 12 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11Z"/>
            </svg>
        </div>
        <input class="search_input" placeholder="search" type="text">
    </div>
<?php
}
?>

</body>
</html>
