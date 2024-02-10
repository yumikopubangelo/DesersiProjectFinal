<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Attendance</title>
    <link rel="stylesheet" href="css/manual.css"> <!-- Ubah sesuai dengan lokasi file CSS Anda -->
</head>
<body>
    <h2>Manual Attendance</h2>
    <form action="process_manual_attendance.php" method="POST">
        <label for="user_id">User ID:</label><br>
        <input type="text" id="user_id" name="user_id" required><br><br>
        
        <label for="activity_id">Activity ID:</label><br>
        <input type="text" id="activity_id" name="activity_id" required><br><br>
        
        <label for="attendance_time">Attendance Time:</label><br>
        <input type="datetime-local" id="attendance_time" name="attendance_time" required><br><br>
        
        <input type="submit" value="Submit Attendance">
    </form>
</body>
</html>
