<?php
// config/db.php
class Database {
    private static $conn;

    public static function getConnection() {
        if (self::$conn === null) {
            // Replace these values with your actual database credentials
            $servername = "localhost";  // The server name or IP address
            $username = "root";         // Your database username
            $password = "";             // Your database password
            $dbname = "teacher_portal"; // Your database name

            self::$conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }

    // Optionally, you can add a function to close the connection
    public static function closeConnection() {
        if (self::$conn !== null) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
?>
