const captionTitle = document.getElementById("caption-title");
var editProfileForm = document.getElementById("editProfileForm");
var errorMessage = document.getElementById("error_message");
// admin information
var adminId = null;
var userFName = null;
var userEmail = null;
var userFName = null;
var userLName = null;
var userPhone = null;

async function fetchAdminInformation() {
    await fetch('../classes/Admin.php?f=fetch_admin_information')
        .then(response => response.json())
        .then(data => {
            adminId = data.adminId;
            adminName = data.firstName + " " + data.lastName;
            adminEmail = data.email;
            adminFName = data.firstName;
            adminLName = data.lastName;
            adminPhone = data.phone;
            captionTitle.textContent = adminName;
        })
        .catch(error => {
            // Handle any errors
            console.error('Error:', error);
        });
}

async function fetchProfileInformation() {
    await fetch('../classes/Admin.php?f=fetch_admin_information')
        .then(response => response.json())
        .then(data => {
            document.getElementById('editAdminId').value = data.adminId;
            document.getElementById('editFname').value = data.firstName;
            document.getElementById('editLname').value = data.lastName;
            document.getElementById('editAdminType').value = data.adminType;
            document.getElementById('editEmail').value = data.email;
            document.getElementById('editPhone').value = data.phone;
        })
        .catch(error => {
            // Handle any errors
            console.error('Error:', error);
        });
}

// Add event listener to the form's submit event
editProfileForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Retrieve the form data
    var formData = new FormData(editAdminForm);

    // Make the form submission using fetch
    fetch("../classes/Admin.php?f=update_admin_profile", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            editAdminButton.innerHTML = "Submit";
            closeModal('editAdminModal');
            document.getElementById('toast-message').innerText = 'Success: ' + data.message;
            $('.toast').toast('show');
        } else {
            errorMessage.style.display = "block";
            errorMessage.innerText = data.message;
            errorMessage.scrollIntoView({ behavior: 'smooth' });
        }
    })
    .catch(error => {
        errorMessage.style.display = "block";
        errorMessage.innerText = "An error occured!";
        errorMessage.scrollIntoView({ behavior: 'smooth' });
        console.error('Error:', error);
    });

});

fetchAdminInformation();
fetchProfileInformation();
document.addEventListener('DOMContentLoaded', function () {
    setInterval(fetchAdminInformation, 3000);
});