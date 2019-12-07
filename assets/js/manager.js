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

    document.getElementById('');
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
