async function PostManagerSignUp() {
    const url = 'api/manager/create.php';
    const method = 'POST';

    const data = {};

    document.querySelectorAll('[data-sign-up-form] input').forEach((input) => {
        let value = input.value;
        if (input.id === "expiration") {
            value = encodeExpiryDate(value);
        }
        data[input.id] = value;
    });

    const response = JSON.parse(await fetchData(url, data, method));
    if (response.status === 0) {
        document.querySelector('[data-error]').innerText = response.message;
    }
    if (response.status === 1) {
        window.location.href = "index.php"
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('[data-create]').addEventListener('click', (e) => {
        e.preventDefault();
        PostManagerSignUp();
    }, false)
});
