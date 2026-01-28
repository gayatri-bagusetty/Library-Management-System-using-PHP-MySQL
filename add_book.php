<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginpage.php");
    exit();
}
include "db.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Using a high-quality library background image */
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
        }

        .form-container h2 {
            margin-top: 0;
            color: #1e293b;
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            border-bottom: 2px solid #0ea5e9;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #475569;
            font-weight: 600;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #0ea5e9;
            outline: none;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        }

        .btn-submit {
            background: #0ea5e9;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #0284c7;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #0ea5e9;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fa-solid fa-book-medical"></i> Add New Book</h2>
    <form action="insert_book.php" method="POST">
        <div class="form-group">
            <label for="isbn">ISBN Number</label>
            <input type="text" id="isbn" name="isbn" placeholder="e.g. 978-3-16-148410-0" required>
        </div>

        <div class="form-group">
            <label for="title">Book Title</label>
            <input type="text" id="title" name="title" placeholder="Enter full title" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" name="author" placeholder="Enter author name" required>
        </div>

        <div class="form-group">
            <label for="edition">Edition</label>
            <input type="text" id="edition" name="edition" placeholder="e.g. 5th Edition">
        </div>

        <div class="form-group">
            <label for="publication">Publication</label>
            <input type="text" id="publication" name="publication" placeholder="Publisher name">
        </div>

        <button type="submit" class="btn-submit">Save Book to Library</button>
    </form>
    <a href="dashboard/admin_dashboard.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
</div>

</body>
</html>