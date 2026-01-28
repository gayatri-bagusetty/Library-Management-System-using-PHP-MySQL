<?php
session_start();
// Security Check: Redirect if not a student
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../loginpage.php");
    exit();
}
include "../db.php"; 

$current_user = $_SESSION['username'];
$today = date('Y-m-d');

// Query to get issued books for this specific student
$query = "SELECT b.title, i.issue_date, i.due_date, i.status 
          FROM issue_books i 
          JOIN books b ON i.book_id = b.id 
          WHERE i.user_name = '$current_user' AND i.status = 'issued'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Library System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0ea5e9;
            --dark-bg: #0f172a;
            --sidebar-item: #1e293b;
            --text-main: #334155;
            --white: #ffffff;
            --danger: #ef4444;
            --success: #10b981;
        }

        body { 
            margin: 0; 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            color: var(--text-main);
            display: flex;
        }

        /* Sidebar Styling - Matching Admin */
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            background: var(--dark-bg); 
            position: fixed; 
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h2 { 
            color: var(--white); 
            font-size: 1.5rem;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar a { 
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px; 
            color: #94a3b8; 
            text-decoration: none; 
            margin-bottom: 8px; 
            border-radius: 8px; 
            transition: all 0.3s ease;
        }

        .sidebar a:hover, .sidebar a.active { 
            background: var(--primary); 
            color: var(--white);
        }

        /* Main Content */
        .main { 
            margin-left: 260px; 
            padding: 40px; 
            width: 100%;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome-card { 
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            padding: 30px; 
            border-radius: 16px; 
            color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        /* Table Card Styling */
        .content-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            text-align: left;
            padding: 12px;
            color: #64748b;
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 2px solid #f1f5f9;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .fine-text { color: var(--danger); font-weight: 600; }
        .status-pill {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #dcfce7;
            color: #166534;
        }

        .logout-btn { background: #ef4444 !important; color: white !important; margin-top: 50px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2><i class="fa-solid fa-graduation-cap"></i> LibSystem</h2>
    <a href="#" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="../search_books.php"><i class="fa-solid fa-magnifying-glass"></i> Find Books</a>
    <a href="../loginpage.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main">
    <header>
        <div>
            <h1 style="margin:0;">Student Overview</h1>
            <p style="color: #64748b;">Welcome back, <?php echo htmlspecialchars($current_user); ?></p>
        </div>
        <div style="background: #e2e8f0; padding: 10px 20px; border-radius: 30px; font-weight: 600;">
            <i class="fa-solid fa-calendar-days"></i> <?php echo date("F j, Y"); ?>
        </div>
    </header>

    <div class="welcome-card">
        <h2 style="margin-top:0;">Hello, <?php echo htmlspecialchars($current_user); ?>! 👋</h2>
        <p style="opacity: 0.9;">You can track your borrowed books, check due dates, and see pending fines here.</p>
    </div>

    <div class="content-card">
        <h3 style="margin-top:0;"><i class="fa-solid fa-book-bookmark"></i> My Borrowed Books</h3>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Due Date</th>
                    <th>Remaining Time</th>
                    <th>Fine Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($row = mysqli_fetch_assoc($result)): 
                    $due = $row['due_date'];
                    // Calculate days difference
                    $diff = (strtotime($due) - strtotime($today)) / (60 * 60 * 24);
                    // Fine logic: $2.00 per day if overdue
                    $fine = ($diff < 0) ? abs($diff) * 2.00 : 0.00;
                ?>
                <tr>
                    <td style="font-weight: 600;"><?php echo $row['title']; ?></td>
                    <td><?php echo $due; ?></td>
                    <td>
                        <?php echo ($diff < 0) ? "<span style='color:var(--danger)'>".abs($diff)." Days Overdue</span>" : $diff." Days Left"; ?>
                    </td>
                    <td class="fine-text">$<?php echo number_format($fine, 2); ?></td>
                    <td><span class="status-pill"><?php echo strtoupper($row['status']); ?></span></td>
                </tr>
                <?php endwhile; 
                if(mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='5' style='text-align:center; padding:30px; color:#94a3b8;'>No books currently borrowed.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>