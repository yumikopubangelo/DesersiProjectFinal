


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-box">
    <form action="index.php" method="POST" class="form">
        <span class="title">Login</span>
        <span class="subtitle">Senang melihat anda kembali!</span>
        <div class="form-container">
            <input type="text" class="input" placeholder="Username" name="username">
            <input type="password" class="input" placeholder="Password" name="password" id="passwordInput">
            <span toggle="#passwordInput" class="toggle-password">Lihat</span>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
    <div class="form-section">
        <p>Gk punya Akun?? <a href="SIgn-Up.php">Daftar Sekarang!</a></p>
        <?php
include "database.php";
session_start();

if (isset($_SESSION["is_login"])) {
    header("Location: home.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement
    $sql = "SELECT * FROM users WHERE username=? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Memverifikasi password menggunakan password_verify()
        if (password_verify($password, $data["password"])) {
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            echo "<script>location.href='home.php';</script>";
            exit(); // Keluar dari skrip setelah mengarahkan pengguna
        } else {
            echo '<p style="color: red; font-weight: bold;">Password tidak cocok</p>';
        }
    } else {
        echo '<p style="color: red; font-weight: bold;">Akun tidak ditemukan</p>';
    }

    $stmt->close();
    $db->close();
}
?>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var passwordInput = document.getElementById("passwordInput");
        var togglePassword = document.querySelector(".toggle-password");

        togglePassword.addEventListener("click", function () {
            var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
        });
    });
</script>
</body>
</html>