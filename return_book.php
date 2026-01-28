<?php
session_start();
include "db.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Update status to returned and set return_date to today
    $sql = "UPDATE issue_books SET status = 'returned', return_date = CURDATE() WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Book returned successfully!'); window.location='dashboard/admin_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>