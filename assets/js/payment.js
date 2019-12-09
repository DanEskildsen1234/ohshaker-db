async function postPreviousPayments() { 
    const url = 'api/payment/read.php'; // these fields are passed to the api
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method)); // response recieved from api

    const previousPaymentSection = document.querySelector("[data-previous-payments]");
        // Get template
        const previousPaymentTemp = document.querySelector("[data-previous-payments-template]").content;
        // For every object in the response
        response.forEach( (payment)=> {
            // Create a clone
            const cln = previousPaymentTemp.cloneNode(true);
            // For each item in the object
            for (let field in payment) {
                if (field === "nPaymentID") {
                    cln.querySelector("div").id = payment[field];
                } else {
                    cln.querySelector(`#${field}`).innerText = payment[field];
                    //cln.querySelector(`#${field}`).setAttribute('disabled', true); // disables editing
                }
            }
            // Release clone on frontend
            previousPaymentSection.appendChild(cln);
        })
}

postPreviousPayments();

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

window.addEventListener('DOMContentLoaded', (event) => { // wait for dom content to load
const paymentButton = document.querySelector('[data-payBtn]');

if (paymentButton) {
    paymentButton.addEventListener('click', () => {
        postPayment();
    }, false);
}
});
