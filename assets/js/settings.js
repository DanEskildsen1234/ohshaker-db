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

async function checkForManagerUpdate() {
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
async function postBartenderDelete(id) {
    const url = 'api/bartender/delete.php';
    const method = 'POST';
    const data = {"bartenderID": id};

    const response = JSON.parse(await fetchData(url, data, method));
    messageBox(response);
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

async function postBartenderRead() {
    const url = 'api/bartender/read.php';
    const method = 'POST';
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method));

    const updateBartenderSection = document.querySelector("[data-update-bartender]");

    // Get contents of template
    const bartenderTemp = document.querySelector("[data-bartender-template]").content;
    // For every object in the response
    response.forEach( (bartender) => {
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
    });

    //located here because fields need toz be initiated before event listener can be placed
    checkForBartenderUpdate();
}

async function checkForBartenderUpdate() {
    document.querySelectorAll('[data-update-bartender] input').forEach( (field)=>{
        field.addEventListener('change', (e) => {
            const bartenderID = field.parentElement.id;
            postBartenderUpdate(field.id, field.value, bartenderID)
        });
    });

    document.querySelectorAll('[data-delete-bartender]').forEach( (button)=>{
        button.addEventListener('click', ()=>{
            const bartenderID = button.parentElement.id;
            postBartenderDelete(bartenderID);
        });
    });
}

async function postBartenderUpdate(field, value, id) {
    const url = 'api/bartender/update.php';
    const method = 'POST';
    const data = {"field": field, "value": value, "bartenderID": id};

    const response = JSON.parse(await fetchData(url, data, method));
    messageBox(response);
}

/**
 * Window loaded initiate
 */
window.addEventListener('DOMContentLoaded', (event) => {
    const logoutButton = document.querySelector('[data-logout]');
    const deleteManagerButton = document.querySelector('[data-delete-manager]');
    const createButton = document.querySelector('[data-create]');

    const managerID = document.querySelector('[data-manager-id]');
    if (managerID) {
        postManagerRead();
        checkForManagerUpdate();
    }

    postBartenderRead();

    if (deleteManagerButton) {
        deleteManagerButton.addEventListener('click', () => {
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
