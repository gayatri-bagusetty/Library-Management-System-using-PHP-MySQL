<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginpage.php");
    exit();
}
include "db.php"; 

// Fetch books and students for the dropdowns
$books_query = mysqli_query($conn, "SELECT id, title FROM books");
$students_query = mysqli_query($conn, "SELECT user_name FROM users WHERE role='student'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Issue Book | Admin Control</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            display: flex; justify-content: center; align-items: center; min-height: 100vh;
        }
        .issue-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px; border-radius: 20px; width: 100%; max-width: 450px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        .issue-card h2 { text-align: center; color: #1e293b; margin-bottom: 25px; border-bottom: 2px solid #0ea5e9; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #475569; }
        select, input {
            width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 10px;
            font-size: 15px; background: #f8fafc; box-sizing: border-box;
        }
        .btn-issue {
            background: #0ea5e9; color: white; border: none; width: 100%; padding: 14px;
            border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s;
        }
        .btn-issue:hover { background: #0284c7; transform: translateY(-2px); }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="issue-card">
    <h2><i class="fa-solid fa-hand-holding-hand"></i> Issue New Book</h2>
    <form action="process_issue.php" method="POST">
        <div class="form-group">
            <label>Select Student</label>
            <select name="user_name" required>
                <option value="">-- Select Student --</option>
                <?php while($row = mysqli_fetch_assoc($students_query)) {
                    echo "<option value='".$row['user_name']."'>".$row['user_name']."</option>";
                } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Select Book</label>
            <select name="book_id" required>
                <option value="">-- Select Book Title --</option>
                <?php while($row = mysqli_fetch_assoc($books_query)) {
                    echo "<option value='".$row['id']."'>".$row['title']."</option>";
                } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Due Date</label>
            <input type="date" name="due_date" required min="<?php echo date('Y-m-d'); ?>">
        </div>

        <button type="submit" class="btn-issue">Confirm Transaction</button>
    </form>
    <a href="dashboard/admin_dashboard.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
</div>

</body>
</html>