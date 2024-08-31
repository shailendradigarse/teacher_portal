<?php

use PHPUnit\Framework\TestCase;

// If StudentController is in the global namespace, remove or comment out the following line:
// use StudentController; 

// If StudentController is in a namespace, update the use statement accordingly:
// use YourNamespace\StudentController;

class StudentControllerTest extends TestCase
{
    private static $conn;

    public static function setUpBeforeClass(): void
    {
        // Setup the testing environment, e.g., creating a test database
        self::$conn = Database::getConnection();
        self::$conn->query("CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            subject_name VARCHAR(255) NOT NULL,
            marks INT NOT NULL,
            UNIQUE KEY name_subject (name, subject_name)
        )");
    }

    public static function tearDownAfterClass(): void
    {
        // Clean up after tests, e.g., removing test data
        if (self::$conn) {
            self::$conn->query("TRUNCATE TABLE students");
            self::$conn->close();
        }
    }


    public function testAddStudent()
    {
        // Arrange
        $name = "John Doe";
        $subject_name = "Mathematics";
        $marks = 90;

        // Act
        $result = StudentController::addStudent($name, $subject_name, $marks);

        // Assert
        $this->assertTrue($result);

        // Verify that the student was added to the database
        $stmt = self::$conn->prepare("SELECT * FROM students WHERE name = ? AND subject_name = ?");
        $stmt->bind_param("ss", $name, $subject_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->assertEquals(1, $result->num_rows);

        $stmt->close();
    }

    public function testEditStudent()
    {
        // Start transaction
        self::$conn->begin_transaction();

        try {
            // Arrange
            self::$conn->query("INSERT INTO students (name, subject_name, marks) VALUES ('Janea Doe', 'Science', 80)");
            $studentId = self::$conn->insert_id;

            // Test case: Attempt to update to a duplicate record
            $newName = "Janea Doe"; // Same as existing
            $newSubject = "Science"; // Same as existing
            $newMarks = 95;

            // Act
            $result = StudentController::editStudent($studentId, $newName, $newSubject, $newMarks);

            // Assert
            $this->assertEquals("duplicate_error", $result, 'Expected duplicate error but got: ' . $result);

            // Commit transaction
            self::$conn->commit();
        } catch (Exception $e) {
            // Rollback transaction in case of error
            self::$conn->rollback();
            throw $e;
        }
    }

    public function testDeleteStudent()
    {
        // Arrange
        self::$conn->query("INSERT INTO students (name, subject_name, marks) VALUES ('John Smith', 'History', 85)");
        $studentId = self::$conn->insert_id;

        // Act
        $result = StudentController::deleteStudent($studentId);

        // Assert
        $this->assertTrue($result);

        // Verify that the student was deleted from the database
        $stmt = self::$conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->assertEquals(0, $result->num_rows);

        $stmt->close();
    }
}
