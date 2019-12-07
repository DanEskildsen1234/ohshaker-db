async function postLogin() {
    const url = 'api/manager/login.php';
    const method = 'POST';

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const data = {"username": username, "password": password};

    const response = JSON.parse(await fetchData(url, data, method));

    if (response.status === 0) {
        document.querySelector('[data-error]').innerHTML = response.message;
    }

    if (response.status === 1) {
        window.location.href = 'cocktails.php';
    }
}

async function postLogout() {
    const url = 'api/manager/logout.php';
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    window.location.href = 'cocktails.php';
}

async function postManagerRead () {
    const url = 'api/manager/read.php';
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);

    document.getElementById('surname').value = response.cSurname;
    document.getElementById('firstName').value = response.cFirstname;
    document.getElementById('username').value = response.cUsername;
    document.getElementById('email').value = response.cEmail;
    document.getElementById('phone').value = response.cPhoneNumber;
    document.getElementById('address').value = response.cAddress;
    document.getElementById('zip').value = response.cZip;
    document.getElementById('joined').innerText = response.dJoined;
}

function setEventListeners() {
    const loginButton = document.querySelector('[data-login]');
    const logoutButton = document.querySelector('[data-logout]');

    if (loginButton) {
        loginButton.addEventListener('click', () => {
            postLogin();
        }, false);
    }

    if (logoutButton) {
        logoutButton.addEventListener("click", () => {
            postLogout();
        }, false);
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    setEventListeners();

    var managerID = document.querySelector('[data-manager-id]');
    if (managerID) {
        postManagerRead();
    }
});
