// hide the notification after a click
var notifs = document.querySelectorAll(".notifications");
notifs.forEach(element =>
    element.addEventListener('click', (function(e) {
        element.hidden = true;
    }))
)

// -------------------------------- Add user --------------------------//  

var formAddUser = document.querySelector("#addUserForm"); // get the form used to add the user
// Event listener on the form
formAddUser.addEventListener('submit', (function(e) {
    event.preventDefault(); // stop the default action of the form

    addUser(this).then((response) => {
        if (response) {
            if (response.success) {
                document.querySelector("#inputUserLastname").value = response.userLastname;
                document.querySelector("#inputUserFirstname").value = response.userFirstname;
                document.querySelector("#inputUserEmail").value = response.userEmail;
                document.querySelector("#inputUserUsername").value = response.userUsername;
                document.querySelector("#inputUserPassword").value = response.userPassword;
                document.querySelector("#inputUserConfirmPassword").value = response.userConfirmPassword;
                document.querySelector("#inputUserAddress1").value = response.userAddress1;
                document.querySelector("#inputUserAddress2").value = response.userAddress2;
                document.querySelector("#inputUserCity").value = response.userCity;
                document.querySelector("#inputUserPostcode").value = response.userPostcode;
                if (response.userRoles.indexOf('admin') != -1) {
                    document.querySelector("#admin").checked = true;
                }
                if (response.userRoles.indexOf('moderator') != -1) {
                    document.querySelector("#mod").checked = true;
                }
                if (response.userRoles.indexOf('chief') != -1) {
                    document.querySelector("#chief").checked = true;
                }
                if (response.userState == "a") {
                    document.querySelector("#userState").options.selectedIndex = 0;
                } else if (response.userState == "b") {
                    document.querySelector("#userState").options.selectedIndex = 1;
                } else if (response.userState == "w") {
                    document.querySelector("#userState").options.selectedIndex = 2;
                }

                document.querySelector("#errorUserLastname").innerHTML = "";
                document.querySelector("#errorUserFirstname").innerHTML = "";
                document.querySelector("#errorUserEmail").innerHTML = "";
                document.querySelector("#errorUserUsername").innerHTML = "";
                document.querySelector("#errorUserPassword").innerHTML = "";
                document.querySelector("#errorUserConfirmPassword").innerHTML = "";
                document.querySelector("#errorUserAddress1").innerHTML = "";
                document.querySelector("#errorUserAddress2").innerHTML = "";
                document.querySelector("#errorUserCity").innerHTML = "";
                document.querySelector("#errorUserPostcode").innerHTML = "";

                document.querySelector("#userCreatedSuccess").hidden = false;

                setTimeout(function() {
                    window.location.href = ROOT+"user"; //will redirect to all users page
                }, 3000); //will call the function after 3 secs.

            } else {
                document.querySelector("#errorUserLastname").innerHTML = response.errorMessages['userLastname'];
                document.querySelector("#errorUserFirstname").innerHTML = response.errorMessages['userFirstname'];
                document.querySelector("#errorUserEmail").innerHTML = response.errorMessages['userEmail'];
                document.querySelector("#errorUserUsername").innerHTML = response.errorMessages['userUsername'];
                document.querySelector("#errorUserPassword").innerHTML = response.errorMessages['userPassword'];
                document.querySelector("#errorUserConfirmPassword").innerHTML = response.errorMessages['userConfirmPassword'];
                document.querySelector("#errorUserAddress1").innerHTML = response.errorMessages['userAddress1'];
                document.querySelector("#errorUserAddress2").innerHTML = response.errorMessages['userAddress2'];
                document.querySelector("#errorUserCity").innerHTML = response.errorMessages['userCity'];
                document.querySelector("#errorUserPostcode").innerHTML = response.errorMessages['userPostcode'];

                console.log(response.errorMessages)

            }
        }
    });
}))

/**
 * Ajax Request to add a user to the database
 * @param {form} obj
 * @returns mixed
 */
async function addUser(obj) {
    var myHeaders = new Headers();

    let formData = new FormData(obj);

    var myInit = {
        method: 'POST',
        headers: myHeaders,
        mode: 'cors',
        cache: 'default',
        body: formData
    };
    let response = await fetch(ROOT + 'user/add', myInit);
    try {
        if (response.ok) {
            return await response.json();
        } else {
            return false;
        }
    } catch (e) {
        console.error(e.message);
    }
}

// -------------------------------- Handle password strength --------------------------//
const pw = document.getElementById("inputUserPassword");

pw.addEventListener('keyup', function() {

    if (pw.value == '') {
        document.getElementById("pwdStrength").value = 0;

    } else {
        document.getElementById("pwdStrength").value = passwordStrength(pw.value);
    }
});

// Checks the strength of the password
function passwordStrength(pw) {

    var condition = changeColorConditions(pw);

    var n = 0;
    var strength = 0;
    if (/\d/.test(pw)) {
        n += 10;
    }
    if (/[a-z]/.test(pw)) {
        n += 26;
    }
    if (/[A-Z]/.test(pw)) {
        n += 26;
    }
    if (/\W/.test(pw)) {
        n += 28;
    }
    strength = Math.round(pw.length * Math.log(n) / Math.log(2));

    if (strength >= 100) {
        strength = 100;
    }
    if (condition == true) {
        strength = 100;
    }
    console.log(strength)
    return strength;
}

// Changes the color of the conditions depending of the input password
function changeColorConditions(pw) {
    var condition = false;

    if (/.{12,}/.test(pw) == true) {
        document.getElementById("pwdLength").style.color = 'green';
        condition = true;
    } else {
        document.getElementById("pwdLength").style.color = 'red';
        condition = false;
    }

    if (/[a-z]/.test(pw) == true) {
        document.getElementById("pwdLowCase").style.color = 'green';
        condition = true;
    } else {
        document.getElementById("pwdLowCase").style.color = 'red';
        condition = false;
    }

    if (/[A-Z]/.test(pw) == true) {
        document.getElementById("pwdUpperCase").style.color = 'green';
        condition = true;
    } else {
        document.getElementById("pwdUpperCase").style.color = 'red';
        condition = false;
    }

    if (/\d/.test(pw) == true) {
        document.getElementById("pwdDigit").style.color = 'green';
        condition = true;
    } else {
        document.getElementById("pwdDigit").style.color = 'red';
        condition = false;
    }

    if (/\W/.test(pw) == true) {
        document.getElementById("pwdSpecial").style.color = 'green';
        condition = true;
    } else {
        document.getElementById("pwdSpecial").style.color = 'red';
        condition = false;
    }

    return condition;
}