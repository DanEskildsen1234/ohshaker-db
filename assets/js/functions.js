const url = "api/manager/login.php";
const data = {"username": "mylovelyusern22afffaddme41", "password": "mylovelypassword1Ad"};
const method = "POST";

fetchData(url, data, method);

async function fetchData(url, data, method) {
    const fd = new FormData();
    for (var i in data) {
        fd.append(i, data[i]);
    }

    try {
        const responseData = await postData(url, fd, method);
        console.log(JSON.stringify(responseData)); // JSON-string from `response.json()` call
    } catch (error) {
        console.error(error);
    }
}

async function postData(url, fd, method) {
    const response = await fetch(url, {
        method: method,
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: 'follow',
        referrer: 'no-referrer',
        body: fd
    });
    return await response.json(); // parses JSON response into native JavaScript objects
}