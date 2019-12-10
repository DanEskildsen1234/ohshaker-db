async function postLogout() {
    const url = 'api/bartender/logout.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    window.location.href = 'index.php';
}

window.addEventListener('DOMContentLoaded', (event) => {
    const logoutButton = document.querySelector('[data-logout]');

    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            postLogout();
        }, false);
    }
});
