
# Teacher Portal Project

A robust teacher portal built with PHP, HTML, and JavaScript. The portal includes functionality for teacher login, managing student listings, and adding/editing student details.

## Table of Contents

- [Teacher Portal Project](#teacher-portal-project)
  - [Table of Contents](#table-of-contents)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Database Setup](#database-setup)
  - [Running the Project](#running-the-project)
  - [Testing](#testing)
  - [Usage](#usage)
  - [Troubleshooting](#troubleshooting)
  - [Contact](#contact)

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

- **PHP** (version 8.2 or later)
- **MySQL** (or MariaDB)
- **Composer** (PHP package manager)
- **Apache** or **Nginx** web server
- **Git** (for version control, optional but recommended)

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/yourusername/teacher-portal.git
   ```

2. **Navigate to the project directory**:

   ```bash
   cd teacher-portal
   ```

3. **Install dependencies using Composer**:

   ```bash
   composer install
   ```

## Database Setup

1. **Create a MySQL database**:

   Log in to your MySQL server and create a database:

   ```sql
   CREATE DATABASE teacher_portal;
   ```

2. **Create the necessary tables**:

   Run the following SQL commands to create the `students` and `teachers` tables:

   ```sql
   USE teacher_portal;

   CREATE TABLE students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        subject_name VARCHAR(100) NOT NULL,
        marks INT NOT NULL,
        UNIQUE(name, subject_name) -- To prevent duplicate name and subject combinations
    );

   CREATE TABLE teachers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL
    );

   -- Insert a sample teacher for testing (use a password hash)
   INSERT INTO teachers (username, password) VALUES ('test_teacher', '$2y$10$gqbcINyhkRI7g7bM6wpNNuNhAFs43OKpjKYCdhm74QhtI/372ZXC.'); -- Replace with a real hash password is 123456
   ```

3. **Configure database connection**:

   Edit the `config/db.php` file with your database credentials:

   ```php
   <?php
   class Database {
       private static $connection;

       public static function getConnection() {
           if (self::$connection == null) {
               self::$connection = new mysqli("localhost", "your_username", "your_password", "teacher_portal");

               if (self::$connection->connect_error) {
                   die("Connection failed: " . self::$connection->connect_error);
               }
           }
           return self::$connection;
       }
   }
   ?>
   ```

   Replace `your_username`, `your_password`, and `teacher_portal` with your actual MySQL username, password, and database name.

## Running the Project

1. **Start your web server**:

   Ensure that your web server (Apache/Nginx) is running and configured to serve files from the `teacher_portal` directory.

2. **Access the application**:

   Open your web browser and navigate to:

   ```
   http://localhost/teacher-portal/index.php
   ```

## Testing

1. **Run PHPUnit tests**:

   Make sure PHPUnit is installed via Composer and run the tests:

   ```bash
   vendor/bin/phpunit --configuration phpunit.xml
   ```

2. **Check test results**:

   The test results will show whether all unit tests have passed. Review any failures or errors for debugging.

## Usage

- **Teacher Login**: Use the sample teacher credentials (`test_teacher`) with the password used in the database setup.
- **Manage Students**: After logging in, you can add, edit, or delete student records using the portal.

## Troubleshooting

- **Database Connection Issues**: Ensure your database credentials in `config/db.php` are correct and that the MySQL server is running.
- **PHP Errors**: Check the web server's error logs for PHP error messages. Ensure all required PHP extensions (like `mysqli`) are enabled.
- **Web Server Configuration**: Make sure your web server is configured correctly to serve PHP files and the project directory.

## Contact

For issues or contributions, please open an issue or submit a pull request on GitHub.

---

**Note**: This is a basic project setup. For production use, ensure to follow best security practices, including using environment variables for sensitive configurations, and setting appropriate permissions.
