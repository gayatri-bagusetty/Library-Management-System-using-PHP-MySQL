<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize input to prevent SQL injection
    $isbn        = mysqli_real_escape_string($conn, $_POST['isbn']);
    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $author      = mysqli_real_escape_string($conn, $_POST['author']);
    $edition     = mysqli_real_escape_string($conn, $_POST['edition']);
    $publication = mysqli_real_escape_string($conn, $_POST['publication']);

    // 2. Prepare the SQL query
    $sql = "INSERT INTO books (isbn, title, author, edition, publication) 
            VALUES ('$isbn', '$title', '$author', '$edition', '$publication')";

    // 3. Execute and check
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Book added successfully!');
                window.location.href='add_book.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>