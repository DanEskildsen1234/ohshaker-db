async function postLogout() {
    const url = 'api/manager/logout.php';
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    window.location.href = 'cocktails.php';
}

let surnameField = document.getElementById('surname').value;
let firstNameField = document.getElementById('firstName').value;
let usernameField = document.getElementById('username').value;
let emailField = document.getElementById('email').value;
let phoneField = document.getElementById('phone').value;
let addressField = document.getElementById('address').value;
let zipField = document.getElementById('zip').value;
let joinedField = document.getElementById('joined').innerText;

async function postManagerRead () {
    const url = 'api/manager/read.php';
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);

    surnameField = response.cSurname;
    firstNameField = response.cFirstname;
    usernameField = response.cUsername;
    emailField = response.cEmail;
    phoneField = response.cPhoneNumber;
    addressField = response.cAddress;
    zipField = response.cZip;
    joinedField = response.dJoined;
}

async function postManagerUpdate() {

}

window.addEventListener('DOMContentLoaded', (event) => {
    const logoutButton = document.querySelector('[data-logout]');

    var managerID = document.querySelector('[data-manager-id]');
    if (managerID) {
        postManagerRead();
    }

    if (logoutButton) {
        logoutButton.addEventListener("click", () => {
            postLogout();
        }, false);
    }
});
