/**
 * LOG OUT FUNCTION
 */
async function postLogout() {
    const url = 'api/manager/logout.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    window.location.href = 'cocktails.php';
}

/**
 * Manager functions
 */
async function postManagerDelete() {
    const url = 'api/manager/delete.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    window.location.href = 'index.php';
}

async function postManagerRead() {
    const url = 'api/manager/read.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));

    for (let field in response) {
        document.getElementById(field).value = response[field];
    }
}

async function checkForManagerUpdates() {
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
    messageBox(response);
}

/**
 * Bartender functions
 */
async function postBartenderRead() {
    const url = 'api/bartender/read.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));

    const updateBartenderSection = document.querySelector("[data-update-bartender]");

    // Get template
    const bartenderTemp = document.querySelector("[data-bartender-template]").content;
    // For every object in the response
    response.forEach( (bartender)=> {
        // Create a clone
        const cln = bartenderTemp.cloneNode(true);
        // For each item in the object
        for (let field in bartender) {
            if (field === "nBartenderID") {
                cln.querySelector("div").id = bartender[field];
            } else {
                cln.querySelector(`#${field}`).value = bartender[field];
            }
        }
        // Release clone on frontend
        updateBartenderSection.appendChild(cln);
    })
}

async function postBartenderCreate() {
    const url = 'api/bartender/create.php';
    const method = 'POST';
    const data = {};

    document.querySelectorAll('[data-create-bartender-form] input').forEach((input) => {
        data[input.id] = input.value;
    });

    const response = JSON.parse(await fetchData(url, data, method));
    messageBox(response);
}

/**
 * Window loaded initiate
 */
window.addEventListener('DOMContentLoaded', (event) => {
    const logoutButton = document.querySelector('[data-logout]');
    const deleteButton = document.querySelector('[data-delete]');
    const createButton = document.querySelector('[data-create]');

    const managerID = document.querySelector('[data-manager-id]');
    if (managerID) {
        postManagerRead();
        checkForManagerUpdates();
    }

    postBartenderRead();

    if (deleteButton) {
        deleteButton.addEventListener('click', () => {
            postManagerDelete();
        }, false);
    }

    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            postLogout();
        }, false);
    }

    if (createButton) {
        createButton.addEventListener('click', (e)=> {
            e.preventDefault();
            postBartenderCreate();
        })
    }
});

/**
 * Message to the frontend
 */
function messageBox(message) {
    if (message.status === 0) {
        document.querySelector('[data-success]').innerText = "";
        document.querySelector('[data-error]').innerText = message.message;
    }

    if (message.status === 1) {
        document.querySelector('[data-error]').innerText = "";
        document.querySelector('[data-success]').innerText = message.message;
    }
}
