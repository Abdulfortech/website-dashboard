var addCenterForm = document.getElementById("addCenterForm");
var editCenterForm = document.getElementById("editCenterForm");
var addCenterButton = document.getElementById("addCenterButton");
var editCenterButton = document.getElementById("editCenterButton");
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
addCenterForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Retrieve the form data
    var formData = new FormData(addCenterForm);
    addCenterButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/Center.php?f=add_center", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addCenterButton.innerHTML = "Submit";
            closeModal('addCenterModal');
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
    const LGASelect = document.getElementById('addCenterLGA');

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
// fetch lgas for edit modal
function fetchLGAs2() {
    // Get the select element
    const LGASelect = document.getElementById('editCenterLGA');

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
editCenterForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Retrieve the form data
    var formData = new FormData(editCenterForm);
    editCenterButton.innerHTML = "Sending...";

    // Make the form submission using fetch
    fetch("../classes/Center.php?f=update_center", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            editCenterButton.innerHTML = "Submit";
            closeModal('editCenterModal');
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


function fetchAllCenters() {
    const table = $('#datatable').DataTable();
    // Destroy the existing DataTable instance
    if ($.fn.DataTable.isDataTable(table)) {
        table.destroy();
    }

    $('#datatable').DataTable({
        ajax: {
            url: `../classes/Center.php?f=fetch_all_center`,
            type: 'GET',
            dataSrc: function (data) {
                return data.map(delivery => ({
                    title: delivery.title,
                    category: delivery.category,
                    jurisdiction: delivery.lgaTitle,
                    status: delivery.status === 1 ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">Inactive</span>',
                    theStatus : delivery.status,
                    centerId: delivery.centerId
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
            { data: 'category' },
            { data: 'jurisdiction' },
            { data: 'status' },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.theStatus === 1) {
                        return `
                            <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchCenterDetails(${data.centerId})" >
                                <i class="fa fa-eye"></i>
                            </a>
                            <a type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm p-2 font-weight-bold text-xs" onclick="changeCenterStatus(${data.centerId})" >
                                <i class="fa fa-arrow-down"></i>
                            </a>
                            `;
                    }else{
                        return `
                        <a type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm p-2 font-weight-bold text-xs" onclick="fetchCenterDetails(${data.centerId})" >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-success btn-sm p-2 font-weight-bold text-xs" onclick="changeCenterStatus(${data.centerId}, 1)" >
                            <i class="fa fa-arrow-up"></i>
                        </a>
                        `;
                    }
                }
            }
        ]
    });
}

function fetchCenterDetails(centerId) {
    fetch(`../classes/Center.php?f=fetch_center&value=${centerId}`)
        .then(response => response.json())
        .then(package => {
            // Populate the form with the fetched data
            document.getElementById('editCenterId').value = package.centerId;
            document.getElementById('editCenterTitle').value = package.title;
            document.getElementById('oldCenterCategory').value = package.category;
            document.getElementById('oldCenterCategory').label = package.category;
            document.getElementById('oldCenterLGA').value = package.lgaId;
            document.getElementById('oldCenterLGA').label = package.lgaTitle;
            document.getElementById('editCenterEmail').value = package.email;
            document.getElementById('editCenterPhone').value = package.phone;
            document.getElementById('editCenterAddress').value = package.address;

            // Show the details and remove loading spinner
           // Open the edit modal
           $('#editCenterModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching package details:', error);
        });
}

function changeCenterStatus(centerId, status){
    var formData = new FormData();
    formData.append("centerId", centerId);
    formData.append("status", status);
    fetch('..//classes/Center.php?f=update_center_status', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('toast-message').innerText = 'Success: ' + data.message;
                $('.toast').toast('show');
                fetchAllCenters();
            }else{
                document.getElementById('toast-message').innerText = 'Error: ' + data.message;
                $('.toast').toast('show');
                fetchAllCenters();
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('toast-message').innerText = 'Error: ' + error;
            $('.toast').toast('show');
            fetchAllCenters();
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
    setInterval(fetchAllCenters, 4000);
});