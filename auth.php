<?php
session_start();
include "db.php";

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    
    // Get data from form
    $login_input = mysqli_real_escape_string($conn, $_POST['uname']);
    $password    = mysqli_real_escape_string($conn, $_POST['psw']);
    $role        = mysqli_real_escape_string($conn, $_GET['role']); 

    // Match the query to your columns: user_name, password, and role
    $sql = "SELECT * FROM users 
            WHERE user_name='$login_input' 
            AND password='$password' 
            AND role='$role'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Setting session variables
        $_SESSION['username'] = $row['user_name'];
        $_SESSION['role']     = $row['role'];
        
        if ($role == 'admin') {
            header("Location: dashboard/admin_dashboard.php");
            exit();
        } else {
            header("Location: dashboard/student_dashboard.php");
            exit();
        }
    } else {
        echo "<script>alert('Invalid Login! Please check your Username, Password, or Role.'); window.location='loginpage.php';</script>";
    }
}
?>