<!-- controllers/TeacherController.php -->
<?php
require_once 'config/db.php';

class TeacherController {
    
    // Authenticate teacher
    public static function authenticate($username, $password) {
        $conn = Database::getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM teachers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user; // Successful authentication
            }
        }
        
        return false; // Authentication failed
    }
}
?>
