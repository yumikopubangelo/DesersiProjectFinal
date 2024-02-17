<?php
session_start();
include "database.php";

// Check if user is logged in as admin
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;

if ($admin_akses !== null && in_array("admin", (array) $admin_akses)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize user input
        $username = isset($_POST['username']) ? mysqli_real_escape_string($db, $_POST['username']) : '';

        if (!empty($username)) {
            // Get user ID based on username
            $query = "SELECT id FROM users WHERE username = '$username'";
            $result = mysqli_query($db, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $guru_id = $row['id'];

                // Check if 'aktivitas_id' is set in the URL parameter
                if (isset($_GET['aktifitas_id'])) {
                    $aktivitas_id = $_GET['aktifitas_id'];

                    // Insert attendance data into the database
                    $query = "INSERT INTO kehadiran (id, aktivitas_id, guru_id) VALUES (NULL, ?, ?)";
                    $stmt = mysqli_prepare($db, $query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ii", $aktivitas_id, $guru_id);
                        mysqli_stmt_execute($stmt);

                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            // Data berhasil disimpan
                            header("Location: list_hadir.php");
                            exit();
                        } else {
                            echo "Error: Failed to save attendance data.";
                        }
                    } else {
                        echo "Error: " . mysqli_error($db);
                    }
                } else {
                    echo "Error: Activity ID not found in URL parameter.";
                }
            } else {
                echo "Error: User with username '$username' not found!";
            }
        } else {
            echo "Error: Username cannot be empty.";
        }
    } else {
        echo "Error: Data not submitted via POST method!";
    }
} else {
    // Redirect users who are not logged in as admin to the login page
    header("Location: index.php");
    exit();
}

// Close database connection
mysqli_close($db);
?>
