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

_**Login Page**_
<img width="1919" height="865" alt="image" src="https://github.com/user-attachments/assets/c990bcb1-6bd8-4ef8-a5d8-97346b5f51ec" />

_**Admin Dashboard**_
<img width="1919" height="873" alt="image" src="https://github.com/user-attachments/assets/49296090-f0e8-4098-9590-70c9954beca3" />

_**Add book**_
<img width="1919" height="869" alt="image" src="https://github.com/user-attachments/assets/eb04a50b-5f4f-4383-b909-bfa0d1f3aedc" />

_**Add New User**_
<img width="1919" height="866" alt="image" src="https://github.com/user-attachments/assets/cef02153-2322-401f-afa3-9a08f3da33b6" />

_**Book List**_
<img width="1917" height="874" alt="image" src="https://github.com/user-attachments/assets/d21926db-e5a8-4ebf-b6fd-c2c18d92c8b0" />

_**Student Dashboard**_
<img width="1919" height="876" alt="image" src="https://github.com/user-attachments/assets/15868af3-5506-48d4-af6b-e49ee7a9b0e0" />

_**Find Books**_
<img width="1919" height="870" alt="image" src="https://github.com/user-attachments/assets/a53773d4-0580-4b95-b21b-178a3e6a1c8c" />
