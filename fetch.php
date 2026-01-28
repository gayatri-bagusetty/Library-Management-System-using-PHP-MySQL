<?php
session_start();
// Security Check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginpage.php");
    exit();
}
include "db.php"; 

// 1. Capture the search term from the URL
$search_term = "";
if (isset($_GET['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_GET['search']);
}

// 2. Modify the SQL query to filter results
if (!empty($search_term)) {
    // Searches for the term anywhere in title, author, or isbn
    $query = "SELECT * FROM books 
              WHERE title LIKE '%$search_term%' 
              OR author LIKE '%$search_term%' 
              OR isbn LIKE '%$search_term%' 
              ORDER BY id DESC";
} else {
    // Default: Show all books (or limit to 50 for performance)
    $query = "SELECT * FROM books ORDER BY id DESC LIMIT 50";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Inventory | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), 
                        url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-attachment: fixed;
            color: #f8fafc;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 { margin: 0; color: #0ea5e9; font-size: 28px; }

        .btn-add {
            background: #0ea5e9;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-add:hover { background: #0284c7; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(15, 23, 42, 0.6);
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background: rgba(14, 165, 233, 0.2);
            color: #0ea5e9;
            text-align: left;
            padding: 15px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 15px;
        }

        tr:hover { background: rgba(255, 255, 255, 0.05); }

        .action-btns a {
            color: #f8fafc;
            margin-right: 15px;
            text-decoration: none;
            transition: 0.3s;
        }

        .delete-btn { color: #ef4444 !important; }
        .delete-btn:hover { color: #dc2626 !important; }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: #94a3b8;
            text-decoration: none;
        }
        .search-container {
    margin-bottom: 30px;
    background: rgba(255, 255, 255, 0.05);
    padding: 15px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.search-form {
    display: flex;
    gap: 10px;
    align-items: center;
}

.input-group {
    position: relative;
    flex-grow: 1;
    max-width: 500px;
}

.search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.input-group input {
    width: 100%;
    padding: 12px 12px 12px 45px;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(14, 165, 233, 0.3);
    border-radius: 8px;
    color: white;
    font-size: 15px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.input-group input:focus {
    outline: none;
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
    background: rgba(15, 23, 42, 0.9);
}

.search-btn {
    background: #0ea5e9;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.search-btn:hover {
    background: #0284c7;
}

.clear-btn {
    color: #94a3b8;
    text-decoration: none;
    font-size: 14px;
    padding: 0 10px;
}

.clear-btn:hover {
    color: #ef4444;
}
    </style>
</head>
<body>

<div class="container">
    <a href="dashboard/admin_dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Dashboard</a>
    
    <div class="header-section">
        <h2><i class="fa-solid fa-book"></i> Book Inventory</h2>
        <a href="add_book.php" class="btn-add"><i class="fa-solid fa-plus"></i> Add New Book</a>
    </div>
    <div class="search-container">
    <form method="GET" class="search-form">
        <div class="input-group">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" name="search" placeholder="Search by title, author, or ISBN..." 
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </div>
        <button type="submit" class="search-btn">Search</button>
        <?php if(isset($_GET['search'])): ?>
            <a href="fetch.php" class="clear-btn">Clear</a>
        <?php endif; ?>
    </form>
</div>
    <table>
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Edition</th>
                <th>Publication</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM books ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                    echo "<td><strong>" . htmlspecialchars($row['title']) . "</strong></td>";
                    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['edition']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['publication']) . "</td>";
                    echo "<td class='action-btns'>
                            <a href='#' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
                            <a href='fetch.php?delete_id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure?\")' title='Delete'><i class='fa-solid fa-trash'></i></a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No books found in the library.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
</div>

</body>
</html>