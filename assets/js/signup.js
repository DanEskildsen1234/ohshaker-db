async function PostManagerSignUp() {
    const url = 'api/manager/create.php';
    const method = 'POST';

    const data = {};

    document.querySelectorAll('[data-sign-up-form] input').forEach( (input) => {
        let value = input.value;
        if (input.id === "expiration") {
            value = encodeExpiryDate(value);
        }
        data[input.id] = value;
    });

    console.log(data);

    const response = await fetchData(url, data, method);
    console.log(response);
}

window.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('[data-create]').addEventListener('click', (e) => {
        e.preventDefault();
        PostManagerSignUp();
    }, false)
});