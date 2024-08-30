<?php

use PHPUnit\Framework\TestCase;
use StudentController;

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
            marks INT NOT NULL
        )");
    }

    // public static function tearDownAfterClass(): void
    // {
    //     // Clean up after tests, e.g., removing test data
    //     if (self::$conn) {
    //         self::$conn->query("DROP TABLE IF EXISTS students");
    //         self::$conn->close();
    //     }
    // }

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
        // Arrange
        self::$conn->query("INSERT INTO students (name, subject_name, marks) VALUES ('Jane Doe', 'Science', 80)");
        $studentId = self::$conn->insert_id;

        $newName = "Jane Smith";
        $newSubject = "Physics";
        $newMarks = 95;

        // Act
        $result = StudentController::editStudent($studentId, $newName, $newSubject, $newMarks);

        // Assert
        $this->assertTrue($result);

        // Verify that the student's data was updated in the database
        $stmt = self::$conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $this->assertEquals($newName, $student['name']);
        $this->assertEquals($newSubject, $student['subject_name']);
        $this->assertEquals($newMarks, $student['marks']);

        $stmt->close();
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
