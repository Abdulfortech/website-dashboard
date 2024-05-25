var uid = null;
var uusername = null;
var ufullname = null;
var ufname = null;
var ulname = null;
var uemail = null;
var uphone;
var ugender;
// export { userInformation };
function fetchUserInformation() {
    fetch('../classes/User.php?f=fetch_user_information')
        .then(response => response.json())
        .then(data => {
            uid = data.userId;
            ufullname = data.firstName + " " + data.lastName;
            uusername = data.username;
            uemail = data.email;            
            ufname = data.firstName;
            ulname = data.lastName;
            ugender = data.gender;
            uphone = data.phone;            
        })
        .catch(error => {
            // Handle any errors
            console.error('Error:', error);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    fetchUserInformation()

});

var userInfo = {
    id : uid,
    fullname: ufullname
};

// console.log(userInfo);


export default userInfo;