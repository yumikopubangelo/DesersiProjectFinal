<?php 
session_start();
include "database.php";
if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
}

if(isset($_SESSION['photo_filename'])){
    $photo_filename = $_SESSION['photo_filename'];
    // You can continue adding more code here if needed
}else{
    echo "Session variable 'photo_filename' is not set.";
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: index.php"); // Arahkan pengguna ke halaman login jika belum login
    exit();
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
    <link rel="stylesheet" href="css/akun.css">
<form action="home.php" method="POST">
    <button class="btn" type="submit" name="logout">
    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0092E4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 2L20 9L12 16M20 9H4M20 9L4 9"/>
</svg>
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

<h3 class="welcome-message">Selamat Datang <?=$_SESSION["username"]?> </h3>
<div class="container">
<div class="card">
<div class="card-photo">
    <?php if(isset($_SESSION['photo_filename'])): ?>
        <img src="photo/<?php echo $_SESSION['photo_filename']; ?>" alt="Foto Profil" height="50px" width="50px">
    <?php endif; ?>
</div>



    <div class="card-title"><?=$_SESSION["username"]?> <br>
        <span>Guru Produktif SIJA & TJKT</span>
    </div>
    <div class="card-socials">
        <button class="card-socials-btn facebook">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" id="Layer_21" height="24" data-name="Layer 21"><title></title><path d="M16.75,9H13.5V7a1,1,0,0,1,1-1h2V3H14a4,4,0,0,0-4,4V9H8v3h2v9h3.5V12H16Z"></path></svg>
        </button>
        <button class="card-socials-btn github">
            <svg viewBox="0 0 24 24" height="33" width="33" xmlns="http://www.w3.org/2000/svg"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"></path></svg>
        </button>
        <button class="card-socials-btn linkedin">
            <svg height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m51.326 185.85h90.011v270.872h-90.011zm45.608-130.572c-30.807 0-50.934 20.225-50.934 46.771 0 26 19.538 46.813 49.756 46.813h.574c31.396 0 50.948-20.814 50.948-46.813-.589-26.546-19.551-46.771-50.344-46.771zm265.405 124.209c-47.779 0-69.184 26.28-81.125 44.71v-38.347h-90.038c1.192 25.411 0 270.872 0 270.872h90.038v-151.274c0-8.102.589-16.174 2.958-21.978 6.519-16.174 21.333-32.923 46.182-32.923 32.602 0 45.622 24.851 45.622 61.248v144.926h90.024v-155.323c0-83.199-44.402-121.911-103.661-121.911z"></path></svg>
        </button>
    </div>
</div>
</div>

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



<div>

</div>

</body>
</html>