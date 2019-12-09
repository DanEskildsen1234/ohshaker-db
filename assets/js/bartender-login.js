async function postLogin() {
    const url = 'api/bartender/login.php';
    const method = 'POST';

    const bartenderID = document.getElementById("bartenderID").value;
    const pin = document.getElementById("pin").value;

    const data = {"bartenderID": bartenderID, "pin": pin};

    const response = JSON.parse(await fetchData(url, data, method));

    if (response.status === 0) {
        document.querySelector('[data-error]').innerText = response.message;
    }

    if (response.status === 1) {
        window.location.href = 'settings.php'
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
