async function fetchData(url, data, method) {
    const fd = new FormData();
    for (var i in data) {
        fd.append(i, data[i]);
    }

    try {
        const responseData = await postData(url, fd, method);
        return JSON.stringify(responseData);
    } catch (error) {
        console.error(error);
        return error;
    }
}

async function postData(url, data, method) {
    const response = await fetch(url, {
        method: method,
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        redirect: 'follow',
        referrer: 'no-referrer',
        body: data
    });
    return await response.json(); // parses JSON response into native JavaScript objects
}
