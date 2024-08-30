// assets/js/app.js

function showNotification(message, isError = false) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.classList.toggle('error', isError);
    notification.style.display = 'block';

    // Automatically hide the notification after 3 seconds
    setTimeout(() => {
        notification.style.display = 'none';
    }, 3000);
}

function showAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'flex';
}

function closeAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'none';
}
// Function to show the confirmation delete modal
function showConfirmDeleteModal(studentId) {
    document.getElementById('confirmDeleteModal').style.display = 'flex';
    
    // Set up the confirm delete button with the correct student ID
    const confirmButton = document.getElementById('confirmDeleteButton');
    confirmButton.onclick = function() {
        // Redirect to delete_student.php with the student ID
        window.location.href = `delete_student.php?id=${studentId}`;
    };
}

function closeConfirmDeleteModal() {
    document.getElementById('confirmDeleteModal').style.display = 'none';
}

// Show the Edit Student modal with pre-filled data
function showEditStudentModal(id, name, subject, marks) {
    document.getElementById('editStudentId').value = id;
    document.getElementById('editStudentName').value = name;
    document.getElementById('editStudentSubject').value = subject;
    document.getElementById('editStudentMarks').value = marks;
    document.getElementById('editStudentModal').style.display = 'flex';
}

// Close the Edit Student modal
function closeEditStudentModal() {
    document.getElementById('editStudentModal').style.display = 'none';
}