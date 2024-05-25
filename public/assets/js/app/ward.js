var addWardForm = document.getElementById("addWardForm");
var editWardForm = document.getElementById("editWardForm");
var addWardButton = document.getElementById("addWardButton");
var editWardButton = document.getElementById("editWardButton");
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

// Add event listener to the form's submit event
addWardForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Retrieve the form data
    var formData = new FormData(addWardForm);
    addWardButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/Ward.php?f=add_ward", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addWardButton.innerHTML = "Submit";
            closeModal('addWardModal');
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

// fetch lga for add modal
function fetchLGAs() {
    // Get the select element
    const LGASelect = document.getElementById('addLGA');

    // Fetch billers and populate the select element
    fetch('../classes/LGA.php?f=fetch_all_lga')
        .then(response => response.json())
        .then(data => {
            // Iterate over the billers and create options
            data.forEach(lga => {
                const option = document.createElement('option');
                option.value = lga.lgaId;
                option.textContent = lga.title;
                LGASelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching lgas:', error);
        });
}
// // fetch lgas for edit modal
function fetchLGAs2() {
    // Get the select element
    const LGASelect = document.getElementById('editWardLGA');

    // Fetch billers and populate the select element
    fetch('../classes/LGA.php?f=fetch_all_lga')
        .then(response => response.json())
        .then(data => {
            // Iterate over the billers and create options
            data.forEach(lga => {
                const option = document.createElement('option');
                option.value = lga.lgaId;
                option.textContent = lga.title;
                LGASelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching lgas:', error);
        });
}

// Add event listener to the form's submit event
editWardForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Retrieve the form data
    var formData = new FormData(editWardForm);
    editWardButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/Ward.php?f=update_ward", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            editWardButton.innerHTML = "Submit";
            closeModal('editWardModal');
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


function fetchAllWards() {
    const table = $('#datatable').DataTable();
    // Destroy the existing DataTable instance
    if ($.fn.DataTable.isDataTable(table)) {
        table.destroy();
    }

    $('#datatable').DataTable({
        ajax: {
            url: `../classes/Ward.php?f=fetch_all_ward`,
            type: 'GET',
            dataSrc: function (data) {
                return data.map(delivery => ({
                    title: delivery.title,
                    lga: delivery.lgaTitle,
                    state: delivery.state,
                    status: delivery.status === 1 ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">Inactive</span>',
                    theStatus : delivery.status,
                    wardId: delivery.wardId
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
            { data: 'lga' },
            { data: 'state' },
            { data: 'status' },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.theStatus === 1) {
                        return `
                            <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchWardDetails(${data.wardId})" >
                                <i class="fa fa-eye"></i>
                            </a>
                            <a type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm p-2 font-weight-bold text-xs" onclick="changeWardStatus(${data.wardId})" >
                                <i class="fa fa-arrow-down"></i>
                            </a>
                            `;
                    }else{
                        return `
                        <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchWardDetails(${data.wardId})" >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-success btn-sm p-2 font-weight-bold text-xs" onclick="changeWardStatus(${data.wardId}, 1)" >
                            <i class="fa fa-arrow-up"></i>
                        </a>
                        `;
                    }
                }
            }
        ]
    });
}

function fetchWardDetails(wardId) {
    fetch(`../classes/Ward.php?f=fetch_ward&value=${wardId}`)
        .then(response => response.json())
        .then(package => {
            // Populate the form with the fetched data
            document.getElementById('editWardId').value = package.wardId;
            document.getElementById('editWardTitle').value = package.title;
            document.getElementById('oldWardLGA').value = package.lgaId;
            document.getElementById('oldWardLGA').label = package.lgaTitle;
            document.getElementById('oldWardState').value = package.state;
            document.getElementById('oldWardState').label = package.state;

            // Show the details and remove loading spinner
           // Open the edit modal
           $('#editWardModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching package details:', error);
        });
}

function changeWardStatus(wardId, status){
    var formData = new FormData();
    formData.append("wardId", wardId);
    formData.append("status", status);
    fetch('..//classes/Ward.php?f=update_ward_status', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('toast-message').innerText = 'Success: ' + data.message;
                $('.toast').toast('show');
                fetchAllWards();
            }else{
                document.getElementById('toast-message').innerText = 'Error: ' + data.message;
                $('.toast').toast('show');
                fetchAllWards();
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('toast-message').innerText = 'Error: ' + error;
            $('.toast').toast('show');
            fetchAllWards();
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

function closeModal(modal) {
    $('#' + modal).modal('hide');
}

fetchAdminInformation();
document.addEventListener('DOMContentLoaded', function () {
    setInterval(fetchAdminInformation, 5000);
    fetchLGAs();
    fetchLGAs2();
    setInterval(fetchAllWards, 4000);
});