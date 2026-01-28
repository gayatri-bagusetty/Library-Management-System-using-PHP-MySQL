<?php
session_start();
include "db.php";

// Check if data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $book_id   = mysqli_real_escape_string($conn, $_POST['book_id']);
    $due_date  = mysqli_real_escape_string($conn, $_POST['due_date']);
    $issue_date = date('Y-m-d');

    // Insert the record
    $sql = "INSERT INTO issue_books (book_id, user_name, issue_date, due_date, status) 
            VALUES ('$book_id', '$user_name', '$issue_date', '$due_date', 'issued')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Success: Book issued to $user_name!');
                window.location.href='dashboard/admin_dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Could not issue book. " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }
}
?>