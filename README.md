# Online Examination System

A web-based portal developed for conducting multiple-choice examinations. This project was built as a Major Project by CST 6th Semester students.

## 🚀 Features

### User (Student) Side
* **Registration & Login**: Students can create an account and log in to the portal.
* **Profile Management**: Update personal details like name, username, and email.
* **Online Exam**: Take timed multiple-choice tests.
* **Real-time Scoring**: View final results immediately after completing the test.
* **Answer Review**: Review all questions and see the correct answers.

### Admin Side
* **Admin Dashboard**: Manage the overall system.
* **User Management**: Enable, disable, or remove student accounts.
* **Question Management**: Add new questions with multiple options or remove existing ones.

## 🛠️ Tech Stack
* **Backend**: PHP
* **Database**: MySQL (MariaDB)
* **Frontend**: HTML, CSS, JavaScript
* **Server**: XAMPP (Apache)

## 📋 Installation & Setup

1.  **Clone the Project**: Copy the project folder into your local server directory (e.g., `C://xampp/htdocs/`).
2.  **Start Services**: Open the XAMPP Control Panel and start **Apache** and **MySQL**.
3.  **Database Configuration**:
    * Open `phpMyAdmin` (localhost/phpmyadmin).
    * Create a new database named `majorproject`.
    * Import the `majorproject.sql` file located in the `/Database` folder.
4.  **Run the App**: Open your browser and go to `localhost/your_folder_name/`.

## ⚙️ Configuration (`config.php`)

The `config.php` file handles the connection between your PHP code and the MySQL database. Follow these steps to write or update it:

1.  Navigate to the `/config` folder.
2.  Create or open a file named `config.php`.
3.  Paste the following code into the file:

```php
<?php
$hostname = "localhost";    // Usually localhost for XAMPP
$username = "root";         // Default XAMPP username
$passward = "";             // Default XAMPP password is empty
$databaseName = "majorproject"; // Must match the name created in phpMyAdmin

// Create connection
$conn = mysqli_connect($hostname, $username, $passward, $databaseName);

// Check connection
if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
?>
```

## 🔐 Default Credentials

* **Admin Username**: `admin`
* **Admin Password**: `1234`

## 📁 Project Structure
* `/admin`: Admin control panel and management scripts.
* `/config`: Database connection settings.
* `/css`: Custom stylesheets for the user and admin interfaces.
* `/Database`: SQL dump file and access control.
* `/img`: Project images and banners.
* `/inc`: Reusable header and footer components.