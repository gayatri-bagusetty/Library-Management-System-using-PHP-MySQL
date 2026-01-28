<?php
session_start();
include "db.php";
$search = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

// Query to check book details and check if it is already issued
$sql = "SELECT b.*, 
        (SELECT status FROM issue_books WHERE book_id = b.id AND status = 'issued' LIMIT 1) as current_status 
        FROM books b 
        WHERE b.title LIKE '%$search%' OR b.author LIKE '%$search%' OR b.isbn LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Library Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #f1f5f9; padding: 40px; }
        .nav-back { margin-bottom: 20px; display: inline-block; text-decoration: none; color: #64748b; font-weight: 600; }
        
        .search-bar { background: white; padding: 20px; border-radius: 15px; display: flex; gap: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 40px; }
        .search-bar input { flex: 1; border: 1px solid #e2e8f0; padding: 12px 20px; border-radius: 10px; font-size: 16px; outline: none; }
        .search-bar button { background: #0ea5e9; color: white; border: none; padding: 0 30px; border-radius: 10px; font-weight: 600; cursor: pointer; }
        
        .book-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .book-card { background: white; border-radius: 16px; padding: 25px; border: 1px solid #e2e8f0; transition: 0.3s; position: relative; overflow: hidden; }
        .book-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        
        .book-card h3 { margin: 0 0 10px 0; color: #1e293b; }
        .book-card p { margin: 5px 0; color: #64748b; font-size: 14px; }
        
        .avail-badge { display: inline-block; margin-top: 15px; padding: 6px 15px; border-radius: 30px; font-size: 12px; font-weight: 700; }
        .status-ok { background: #dcfce7; color: #166534; }
        .status-no { background: #fee2e2; color: #991b1b; }
        
        .book-card i.watermark { position: absolute; right: -10px; bottom: -10px; font-size: 80px; color: #f1f5f9; z-index: 0; }
        .card-content { position: relative; z-index: 1; }
    </style>
</head>
<body>

<a href="dashboard/student_dashboard.php" class="nav-back"><i class="fa-solid fa-chevron-left"></i> Back to Dashboard</a>

<div class="search-bar">
    <form style="display:contents;" method="GET">
        <input type="text" name="q" placeholder="Search by Title, Author, or ISBN..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Find Book</button>
    </form>
</div>

<div class="book-grid">
    <?php while($book = mysqli_fetch_assoc($result)): ?>
    <div class="book-card">
        <i class="fa-solid fa-book watermark"></i>
        <div class="card-content">
            <h3><?php echo $book['title']; ?></h3>
            <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
            <p><strong>ISBN:</strong> <?php echo $book['isbn']; ?></p>
            <p><strong>Publisher:</strong> <?php echo $book['publication']; ?></p>
            
            <?php if($book['current_status'] == 'issued'): ?>
                <span class="avail-badge status-no"><i class="fa-solid fa-circle-xmark"></i> NOT AVAILABLE</span>
            <?php else: ?>
                <span class="avail-badge status-ok"><i class="fa-solid fa-circle-check"></i> AVAILABLE FOR ISSUE</span>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
</div>

</body>
</html>