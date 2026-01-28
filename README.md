# Library-Management-System-using-PHP-MySQL

A professional, web-based Library Management System built with **PHP, MySQL, and CSS (Glassmorphism design)**. This system features separate dashboards for Admins and Students, real-time fine calculation, and book tracking.

## ✨ Key Features
* **Admin Dashboard**: Manage books, track active issues, and register new users.
* **Student Dashboard**: View borrowed books, track due dates, and see live fine amounts.
* **Book Search**: Advanced search functionality with availability status badges.
* **Automated Fines**: Real-time logic to calculate fines based on overdue days.
* **Modern UI**: Responsive design featuring a dark-themed sidebar and Inter font.

## 🛠️ Tech Stack
* **Frontend**: HTML5, CSS3 (Custom Properties), FontAwesome 6.
* **Backend**: PHP (Procedural).
* **Database**: MySQL / MariaDB.

---

## 🚀 Installation Guide

### Prerequisites
* [XAMPP](https://www.apachefriends.org/index.html) or WAMP installed.
* GitHub Account.

### Step-by-Step Setup
1.  **Clone the Repository**
    ```bash
    git clone [https://github.com/YOUR_USERNAME/Library-System.git](https://github.com/YOUR_USERNAME/Library-System.git)
    ```
2.  **Database Configuration**
    * Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
    * Create a new database named `library_database`.
    * Import the `database.sql` file (or run the CREATE TABLE queries provided in the code).
3.  **Connection Setup**
    * Ensure `db.php` has your correct database credentials:
    ```php
    $conn = mysqli_connect("localhost", "root", "", "library_database");
    ```
4.  **Run the Project**
    * Move the project folder to `C:/xampp/htdocs/`.
    * Open your browser and go to `http://localhost/your-folder-name/loginpage.php`.

---

## 📸 Screenshots
*Include screenshots of your Admin and Student dashboards here!*
