async function login() {
    const url = "api/manager/login.php";
    const data = {"username": "mylovelyusern22afffaddme41", "password": "mylovelypassword1Ad"};
    const method = "POST";

    const response = await fetchData(url, data, method);
    console.log(response);
}

login();