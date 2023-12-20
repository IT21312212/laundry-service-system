document.addEventListener("DOMContentLoaded", function () {
    const editButton = document.getElementById("edit-button");
    const updateButton = document.getElementById("update-button");
    const deleteButton = document.getElementById("delete-button");
    const editFields = document.querySelectorAll('.editable');

    editButton.addEventListener("click", function () {
        // Remove the readonly attribute from all editable fields
        editFields.forEach(function (field) {
            field.removeAttribute("readonly");
        });

        // Show the "Update" button and "Delete" button and hide the "Edit" button
        updateButton.style.display = "inline";
        deleteButton.style.display = "inline";
        editButton.style.display = "none";
    });

    updateButton.addEventListener("click", function () {
        // Here, you would perform the update operation, and if it's successful, display the modal.
        // For demonstration purposes, let's assume the update is successful immediately.
        // You can replace this with your actual update logic.
        // For example: if (updateSuccessful) {
        // Hide the "Update" and "Delete" buttons and show the "Edit" button again
        updateButton.style.display = "none";
        deleteButton.style.display = "none";
        editButton.style.display = "inline";
        // }
    });

    // Add a click event listener to the Delete button
    deleteButton.addEventListener("click", function () {
        if (confirm('Are you sure you want to delete this data?')) {
            // Make an AJAX request to delete the data
            const xhr = new XMLHttpRequest();
            xhr.open('POST','deleteprofile.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        if (xhr.responseText.trim() === 'success') {
                            alert('Data deleted successfully.');
                            resetFormFields();
                            window.location.href ='login.html';
                        } else {
                            alert('Failed to delete data. Please try again later.');
                        }
                    } else {
                        alert('Error: ' + xhr.status);
                    }
                }
            };
            xhr.send();
        }
    });

    function resetFormFields() {
        editFields.forEach(function (field) {
            field.value = field.defaultValue;
        });
    }
});
