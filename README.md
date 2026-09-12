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
    * If you previously imported an older dump, import this file again (or run the schema updates below) so passwords can use `password_hash` and sample questions are loaded.
4.  **Database Connection**: Default XAMPP settings are already in `config/config.php`. If your MySQL user or password is different, edit that file (or copy `config/config.example.php`).
5.  **Run the App**: Open your browser and go to `localhost/your_folder_name/`.

### Existing database upgrade

If you already created the tables from an older version, run this in phpMyAdmin:

```sql
ALTER TABLE student MODIFY password varchar(255) NOT NULL;
ALTER TABLE admin MODIFY password varchar(255) NOT NULL;
ALTER TABLE student ADD UNIQUE KEY email (email);
```

Then add questions from the admin panel (or re-import `Database/majorproject.sql`).

## ⚙️ Configuration (`config.php`)

The `config.php` file handles the connection between your PHP code and the MySQL database.

1.  Open `/config/config.php` (or copy `config.example.php` to `config.php`).
2.  Update the host, username, password, and database name if needed:

```php
<?php
$hostname     = getenv('DB_HOST') ?: 'localhost';
$username     = getenv('DB_USER') ?: 'root';
$db_password  = getenv('DB_PASS');
if ($db_password === false) {
    $db_password = ''; // default XAMPP password
}
$databaseName = getenv('DB_NAME') ?: 'majorproject';

$conn = mysqli_connect($hostname, $username, $db_password, $databaseName);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
```

## 🔐 Default Credentials

* **Admin Username**: `admin`
* **Admin Password**: `1234`
* **Demo Student Email**: `student@example.com`
* **Demo Student Password**: `1234`

Legacy MD5 passwords (including the defaults above) still work and are upgraded to `password_hash()` on the next successful login.

## 📁 Project Structure
* `/admin`: Admin control panel and management scripts.
* `/config`: Database connection settings.
* `/css`: Custom stylesheets for the user and admin interfaces.
* `/Database`: SQL dump file and access control.
* `/img`: Project images and banners.
* `/inc`: Shared bootstrap, helpers, header, and footer.
