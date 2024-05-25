var addAdminForm = document.getElementById("addAdminForm");
var editAdminForm = document.getElementById("editAdminForm");
var addAdminButton = document.getElementById("addAdminButton");
var phoneMessage = document.getElementById("phone-message");
var emailMessage = document.getElementById("email-message");
var email = document.getElementById("addEmail");
var phone = document.getElementById("addPhone");
const captionTitle = document.getElementById("caption-title");
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

email.addEventListener("input", function(event) {
    const value = email.value.trim();
    const isValidEmail = validateEmail(value);
        if (isValidEmail || value === '') {
            // Send request to check email
            if (value === '') {
                emailMessage.innerText = ""; // Clear the error message when the input is empty
            } else {
                fetch(`../classes/Admin.php?f=check_email&value=${encodeURIComponent(value)}`)
                    .then(response => response.json())
                    .then(data => {
                        // Handle response
                        if (data.exists) {
                            email.classList.add('is-invalid');
                            emailMessage.classList.add('text-danger');
                            emailMessage.innerText = "This email already exists!";
                        } else {
                            email.classList.remove('is-invalid');
                            emailMessage.classList.remove('text-danger');
                            emailMessage.innerText = "";
                            email.classList.add('is-valid');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        emailMessage.innerText = "error";

                    });
            }
        } else {
            email.classList.add('is-invalid');
        }
})

phone.addEventListener("input", function(event) {
    const value = phone.value.trim();
    // Check phone number validity
    const isValidPhoneNumber = validatePhoneNumber(value);
    if (isValidPhoneNumber || value === '') {
        phone.classList.remove('is-invalid');
        phone.classList.add('is-valid');
    } else {
        phone.classList.add('is-invalid');
    }
})
// Add event listener to the form's submit event
addAdminForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Retrieve the form data
    var formData = new FormData(addAdminForm);
    addAdminButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/Admin.php?f=add_admin", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addAdminButton.innerHTML = "Submit";
            closeModal('addAdminModal');
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

// Add event listener to the form's submit event
editAdminForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Retrieve the form data
    var formData = new FormData(editAdminForm);
    editAdminButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/Admin.php?f=update_admin", {
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


function fetchAllAdmins() {
    const table = $('#datatable').DataTable();
    // Destroy the existing DataTable instance
    if ($.fn.DataTable.isDataTable(table)) {
        table.destroy();
    }

    $('#datatable').DataTable({
        ajax: {
            url: `../classes/Admin.php?f=fetch_all_admins`,
            type: 'GET',
            dataSrc: function (data) {
                return data.map(delivery => ({
                    name: delivery.firstName + " "+ delivery.lastName,
                    type: delivery.adminType,
                    email: delivery.email,
                    time: "<small>" + formatDateTime(delivery.createdAt) + "</small>",
                    status: delivery.status === 1 ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">Inactive</span>',
                    theStatus : delivery.status,
                    adminId: delivery.adminId
                }));
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'name' },
            { data: 'email' },
            { data: 'type' },
            { data: 'time' },
            { data: 'status' },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.theStatus === 1) {
                        return `
                            <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchAdminDetails(${data.adminId})" >
                                <i class="fa fa-eye"></i>
                            </a>
                            <a type="button" data-bs-toggle="modal" class="btn btn-info btn-sm p-2 font-weight-bold text-xs" onclick="resetAdmin(${data.adminId})" >
                                <i class="fa fa-lock"></i>
                            </a>
                            <a type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm p-2 font-weight-bold text-xs" onclick="changeAdminStatus(${data.adminId})" >
                                <i class="fa fa-arrow-down"></i>
                            </a>
                            `;
                    }else{
                        return `
                        <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchAdminDetails(${data.adminId})" >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-info btn-sm p-2 font-weight-bold text-xs" onclick="resetAdmin(${data.adminId})" >
                            <i class="fa fa-lock"></i>
                        </a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-success btn-sm p-2 font-weight-bold text-xs" onclick="changeAdminStatus(${data.adminId}, 1)" >
                            <i class="fa fa-arrow-up"></i>
                        </a>
                        `;
                    }
                }
            }
        ]
    });
}

function fetchAdminDetails(adminId) {
    fetch(`../classes/Admin.php?f=fetch_admin&value=${adminId}`)
        .then(response => response.json())
        .then(package => {
            // Populate the form with the fetched data
            document.getElementById('editAdminId').value = package.adminId;
            document.getElementById('editFname').value = package.firstName;
            document.getElementById('editLname').value = package.lastName;
            document.getElementById('oldAdminType').value = package.adminType;
            document.getElementById('oldAdminType').label = package.adminType;
            document.getElementById('editEmail').value = package.email;
            document.getElementById('editPhone').value = package.phone;

            // Show the details and remove loading spinner
           // Open the edit modal
           $('#editAdminModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching package details:', error);
        });
}

function changeAdminStatus(adminId, status){
    var formData = new FormData();
    formData.append("adminId", adminId);
    formData.append("status", status);
    fetch('..//classes/Admin.php?f=update_admin_status', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('toast-message').innerText = 'Success: ' + data.message;
                $('.toast').toast('show');
                fetchAllAdmins();
            }else{
                document.getElementById('toast-message').innerText = 'Error: ' + data.message;
                $('.toast').toast('show');
                fetchAllAdmins();
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('toast-message').innerText = 'Error: ' + error;
            $('.toast').toast('show');
            fetchAllAdmins();
        });
}

function resetAdmin(adminId){
    var formData = new FormData();
    formData.append("adminId", adminId);
    fetch('..//classes/Admin.php?f=reset_admin', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('toast-message').innerText = 'Success: ' + data.message;
                $('.toast').toast('show');
                fetchAllAdmins();
            }else{
                document.getElementById('toast-message').innerText = 'Error: ' + data.message;
                $('.toast').toast('show');
                fetchAllAdmins();
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('toast-message').innerText = 'Error: ' + error;
            $('.toast').toast('show');
            fetchAllAdmins();
        });
}

// Function to format number with thousands separator
function formatNumber(number) {
    return new Intl.NumberFormat().format(number);
}

// Function to format date with time
function formatDateTime(dateTime) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric' };
    return new Date(dateTime).toLocaleString('en-US', options);
}

// Function to validate email 
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Function to validate the phone number
function validatePhoneNumber(phoneNumber) {
    const re = /^\d{11}$/;
    return re.test(phoneNumber);
}

function closeModal(modal) {
    $('#' + modal).modal('hide');
}

function showDataSuccessMessage() {
    // After successful query
    document.getElementById("error_message").style.display = "none";
    addAdminForm.style.display = 'none';
    document.getElementById('successFull').style.display = 'block';
    // Clear form after 5 seconds
    setTimeout(function () {
        document.getElementById("error_message").style.display = "none";
        addAdminForm.reset();
        addAdminForm.style.display = 'block';
        document.getElementById('successFull').style.display = 'none';
    }, 8000); // Change the duration as needed (in milliseconds)
}

fetchAdminInformation();
document.addEventListener('DOMContentLoaded', function () {
    // $(document).ready( function () {
    //     $('#myTable').DataTable();
    // } );
    
    fetchAllAdmins();
    setInterval(fetchAdminInformation, 5000);
});