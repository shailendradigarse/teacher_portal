<!-- templates/student_list.php -->
<div class="student-list">
    <div class="student-list-header">
        <h2>Student List</h2>
        <button class="open-modal" onclick="showAddStudentModal()">Add Student</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['subject_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['marks']); ?></td>
                    <td>
                    <a href="#" onclick="showEditStudentModal(<?php echo $student['id']; ?>, '<?php echo htmlspecialchars($student['name']); ?>', '<?php echo htmlspecialchars($student['subject_name']); ?>', <?php echo $student['marks']; ?>)">Edit</a>
                        <a href="#" onclick="showConfirmDeleteModal(<?php echo $student['id']; ?>)">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

<!-- Modal for adding a new student -->
<div id="addStudentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddStudentModal()">&times;</span>
        <h2>Add New Student</h2>
        <form action="add_student.php" method="POST">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="text" name="subject_name" placeholder="Subject Name" required>
            <input type="number" name="marks" placeholder="Marks" required>
            <button type="submit">Add Student</button>
        </form>
    </div>
</div>

<!-- Edit Student Modal -->
<div id="editStudentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditStudentModal()">&times;</span>
        <h2>Edit Student</h2>
        <form id="editStudentForm" action="edit_student.php" method="POST">
            <input type="hidden" name="id" id="editStudentId">
            <input type="text" name="name" id="editStudentName" placeholder="Student Name" required>
            <input type="text" name="subject_name" id="editStudentSubject" placeholder="Subject Name" required>
            <input type="number" name="marks" id="editStudentMarks" placeholder="Marks" required>
            <button type="submit">Update Student</button>
        </form>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmDeleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeConfirmDeleteModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this student?</p>
        <button id="confirmDeleteButton" class="confirm-delete">Yes, Delete</button>
        <button onclick="closeConfirmDeleteModal()">Cancel</button>
    </div>
</div>