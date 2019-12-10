async function postLogin() {
    const url = 'api/manager/login.php';
    const method = 'POST';

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const data = {"username": username, "password": password};

    const response = JSON.parse(await fetchData(url, data, method));

    if (response.status === 0) {
        document.querySelector('[data-error]').innerText = response.message;
    }

    if (response.status === 1) {
        window.location.href = 'cocktail.php'
    }
}

function setEventListeners() {
    const loginButton = document.querySelector('[data-login]');

    if (loginButton) {
        loginButton.addEventListener('click', () => {
            postLogin();
        }, false);
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    setEventListeners();
});
