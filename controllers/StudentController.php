<!-- controllers/StudentController.php -->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php'; 

class StudentController {
    
    // Add or update student
    public static function addStudent($name, $subject_name, $marks) {
        $conn = Database::getConnection();
        
        // Check if the student with the same name and subject already exists
        $stmt = $conn->prepare("SELECT * FROM students WHERE name = ? AND subject_name = ?");
        $stmt->bind_param("ss", $name, $subject_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update existing student's marks
            $stmt = $conn->prepare("UPDATE students SET marks = marks + ? WHERE name = ? AND subject_name = ?");
            $stmt->bind_param("iss", $marks, $name, $subject_name);
        } else {
            // Add new student
            $stmt = $conn->prepare("INSERT INTO students (name, subject_name, marks) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $name, $subject_name, $marks);
        }

        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    
    // Get all students
    public static function getAllStudents() {
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM students");
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        return $students;
    }
    
    // Get student by ID
    public static function getStudentById($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Edit student details
    public static function editStudent($id, $name, $subject_name, $marks) {
        $conn = Database::getConnection();
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM students WHERE name = ? AND subject_name = ? AND id != ?");
        $checkStmt->bind_param("ssi", $name, $subject_name, $id);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();
        
        if ($count > 0) {
            // Return an error message or handle the duplicate case
            error_log("Duplicate entry detected for name '$name' and subject '$subject_name' with ID '$id'");
            return "duplicate_error";
        }

        $stmt = $conn->prepare("UPDATE students SET name = ?, subject_name = ?, marks = ? WHERE id = ?");
        $stmt->bind_param("ssii", $name, $subject_name, $marks, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;

    }
    
    // Delete student
    public static function deleteStudent($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
?>
