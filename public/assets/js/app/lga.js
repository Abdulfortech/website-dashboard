var addLGAForm = document.getElementById("addLGAForm");
var editLGAForm = document.getElementById("editLGAForm");
var addLGAButton = document.getElementById("addLGAButton");
var addCodeMessage = document.getElementById("addCode-message");
const addCode = document.getElementById("addCode");
const captionTitle = document.getElementById("caption-title");
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

addCode.addEventListener("input", function(event) {
    const value = addCode.value.trim();
    // Send request to check email
    if (value === '') {
        addCodeMessage.innerText = ""; // Clear the error message when the input is empty
    } else {
        fetch(`../classes/LGA.php?f=check_lga&value=${encodeURIComponent(value)}`)
            .then(response => response.json())
            .then(data => {
                // Handle response
                if (data.exists) {
                    addCode.classList.add('is-invalid');
                    addCodeMessage.classList.add('text-danger');
                    addCodeMessage.innerText = "This code already exists!";
                } else {
                    addCode.classList.remove('is-invalid');
                    addCodeMessage.classList.remove('text-danger');
                    addCodeMessage.innerText = "";
                    addCode.classList.add('is-valid');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                addCodeMessage.innerText = "error";

            });
    }
        
})

// Add event listener to the form's submit event
addLGAForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Retrieve the form data
    var formData = new FormData(addLGAForm);
    addLGAButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/LGA.php?f=add_lga", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addLGAButton.disabled = false;
            addLGAButton.innerHTML = "Submit";
            closeModal('addLGAModal');
            document.getElementById('toast-message').innerText = data.message;
            $('.toast').toast('show');
        } else {
            addLGAButton.disabled = true;
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
editLGAForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Retrieve the form data
    var formData = new FormData(editLGAForm);
    editLGAButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/LGA.php?f=update_lga", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            editLGAButton.innerHTML = "Submit";
            closeModal('editLGAModal');
            document.getElementById('toast-message').innerText = data.message;
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


function fetchAllLGAs() {
    const table = $('#datatable').DataTable();
    // Destroy the existing DataTable instance
    if ($.fn.DataTable.isDataTable(table)) {
        table.destroy();
    }

    $('#datatable').DataTable({
        ajax: {
            url: `../classes/LGA.php?f=fetch_all_lga`,
            type: 'GET',
            dataSrc: function (data) {
                return data.map(delivery => ({
                    title: delivery.title,
                    code: delivery.code,
                    state: delivery.state,
                    status: delivery.status === 1 ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">Inactive</span>',
                    theStatus : delivery.status,
                    lgaId: delivery.lgaId
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
            { data: 'title' },
            { data: 'code' },
            { data: 'state' },
            { data: 'status' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchLGA(${data.lgaId})" >
                            <i class="fa fa-edit"></i>
                        </a>
                        `;
                }
            }
        ]
    });
}

function fetchLGA(lgaId) {
    fetch(`../classes/LGA.php?f=fetch_LGA&value=${lgaId}`)
        .then(response => response.json())
        .then(package => {
            // Populate the form with the fetched data
            document.getElementById('editLGAId').value = package.lgaId;
            document.getElementById('editTitle').value = package.title;
            document.getElementById('editCode').value = package.code;
            document.getElementById('oldLGAState').value = package.state;
            document.getElementById('oldLGAState').label = package.state;

            // Show the details and remove loading spinner
           // Open the edit modal
           $('#editLGAModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching package details:', error);
        });
}

function changeLGAStatus(lgaId, status){
    var formData = new FormData();
    formData.append("lgaId", lgaId);
    formData.append("status", status);
    fetch('..//classes/LGA.php?f=update_lga_status', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('toast-message').innerText = 'Success: ' + data.message;
                $('.toast').toast('show');
                fetchAllLGAs();
            }else{
                document.getElementById('toast-message').innerText = 'Error: ' + data.message;
                $('.toast').toast('show');
                fetchAllLGAs();
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
    
    setInterval(fetchAllLGAs, 2000);
    setInterval(fetchAdminInformation, 3000);
});