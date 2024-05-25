const captionTitle = document.getElementById("caption-title");
var adminId = null;
var adminName = null;
var adminEmail = null;
var adminFName = null;
var adminLName = null;
var adminPhone = null;

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

function closeModal(modal) {
    $('#' + modal).modal('hide');
}

fetchAdminInformation();
document.addEventListener('DOMContentLoaded', function () {
    setInterval(fetchAdminInformation, 5000);
});
