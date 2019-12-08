async function postPayment() {
    let creditCardID = document.querySelector('[data-cardID]').value;
    console.log(creditCardID);

    const url = 'api/payment/create.php';
    const method = "POST";
    const data = {"cardID": creditCardID};

    const response = JSON.parse(await fetchData(url, data, method));

    if (response.status === 0) {
        document.querySelector('[data-error]').innerText = response.message;
    }
    
    if (response.status === 1) {
        document.querySelector('[data-error]').innerText = "";
        document.querySelector('[data-success]').innerText = response.message;
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
const paymentButton = document.querySelector('[data-payBtn]');

if (paymentButton) {
    paymentButton.addEventListener('click', () => {
        postPayment();
    }, false);
}
});