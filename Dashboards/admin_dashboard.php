<?php
session_start();
// Security Check: Redirect if not an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../loginpage.php");
    exit();
}
include "../db.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Library System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0ea5e9;
            --dark-bg: #0f172a;
            --sidebar-item: #1e293b;
            --text-main: #334155;
            --white: #ffffff;
        }

        body { 
            margin: 0; 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            color: var(--text-main);
            display: flex;
        }

        /* Sidebar Styling */
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
            transform: translateX(5px);
        }

        /* Main Content Styling */
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

        /* Quick Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .stat-item i { font-size: 1.5rem; color: var(--primary); }
        .stat-item span { font-weight: 600; font-size: 1.2rem; color: var(--dark-bg); }
        .stat-item label { color: #64748b; font-size: 0.9rem; }

        .logout-btn { background: #ef4444 !important; color: white !important; margin-top: 50px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2><i class="fa-solid fa-book-open-reader"></i> LibSystem</h2>
    <a href="#" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="../add_book.php"><i class="fa-solid fa-plus"></i> Add Book</a>
    <a href="../user.php"><i class="fa-solid fa-user-plus"></i> Add User</a> 
    <a href="../fetch.php"><i class="fa-solid fa-list"></i> Book List</a>
    <a href="../loginpage.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main">
    <header>
        <div>
            <h1 style="margin:0;">Dashboard Overview</h1>
            <p style="color: #64748b;">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
        <div style="background: #e2e8f0; padding: 10px 20px; border-radius: 30px; font-weight: 600;">
            <i class="fa-solid fa-calendar-days"></i> <?php echo date("F j, Y"); ?>
        </div>
    </header>

    <div class="welcome-card">
        <h2 style="margin-top:0;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h2>
        <p style="opacity: 0.9;">Manage your library books, users, and transactions from this central panel. Everything is running smoothly today.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-item">
            <i class="fa-solid fa-book"></i>
            <span>1,240</span>
            <label>Total Books</label>
        </div>
        <div class="stat-item">
            <i class="fa-solid fa-users"></i>
            <span>452</span>
            <label>Active Students</label>
        </div>
        <div class="stat-item">
            <i class="fa-solid fa-hand-holding-hand"></i>
            <span>84</span>
            <label>Books Issued</label>
        </div>
        <div class="stat-item">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>12</span>
            <label>Overdue Books</label>
        </div>
    </div>
</div>

</body>
</html>