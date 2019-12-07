async function postLogin() {
    const url = "api/manager/login.php";
    const method = "POST";

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const data = {"username": username, "password": password};

    const response = JSON.parse(await fetchData(url, data, method));

    if (response.status === 0) {
        document.querySelector("[data-error]").innerHTML = response.message;
    }

    if (response.status === 1) {
        window.location.href = "cocktails.php"
    }
}

async function postLogout() {
    const url = "api/manager/logout.php";
    const method = "POST";
    const data = {};

    const response = await fetchData(url, data, method);
    console.log(response);
}

function setEventListeners() {
    const loginButton = document.querySelector("[data-login]");
    const logoutButton = document.querySelector("[data-logout]");

    loginButton.addEventListener("click", () => {
        postLogin();
    }, false);

    logoutButton.addEventListener("click", () => {
        postLogout();
    }, false);
}

window.addEventListener('DOMContentLoaded', (event) => {
    setEventListeners();
});