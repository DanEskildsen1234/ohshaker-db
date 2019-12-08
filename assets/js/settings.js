async function postLogout() {
    const url = 'api/manager/logout.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    window.location.href = 'cocktails.php';
}

async function postDelete() {
    const url = 'api/manager/delete.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    window.location.href = 'index.php';
}

async function postManagerRead () {
    const url = 'api/manager/read.php';
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);

    for (let field in response) {
        document.getElementById(field).value = response[field];
    }
}

async function checkForUpdates() {
    document.querySelectorAll('#update-manager input').forEach( (field)=>{
        field.addEventListener('change', (e) => {
            postManagerUpdate(field.id, field.value);
        });
    });
}

async function postManagerUpdate(field, value) {
    const url = 'api/manager/update.php';
    const method = 'POST';
    const data = {"field": field, "value": value};

    const response = JSON.parse(await fetchData(url, data, method));
    if (response.status === 0) {
        document.querySelector('[data-success]').innerText = "";
        document.querySelector('[data-error]').innerText = response.message;
    }

    if (response.status === 1) {
        document.querySelector('[data-error]').innerText = "";
        document.querySelector('[data-success]').innerText = response.message;
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    const logoutButton = document.querySelector('[data-logout]');
    const deleteButton = document.querySelector('[data-delete]');

    const managerID = document.querySelector('[data-manager-id]');
    if (managerID) {
        postManagerRead();
        checkForUpdates();
    }

    if (deleteButton) {
        deleteButton.addEventListener('click', () => {
            postDelete();
        }, false);
    }

    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            postLogout();
        }, false);
    }
});
