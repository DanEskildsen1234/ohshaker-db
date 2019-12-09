async function postCard() {
    let expDate = document.querySelector('[data-expDate]').value;
    let CCV = document.querySelector('[data-CCV]').value;
    let IBAN = document.querySelector('[data-IBAN]').value;

    const url = 'api/card/create.php';
    const method = "POST";
    const data = {"expiration": expDate, "CCV": CCV, "IBAN": IBAN};

    const response = JSON.parse(await fetchData(url, data, method));
    console.log(response);

    if (response.status === 0) {
        document.querySelector('[data-error]').innerText = response.message;
    }
    
    if (response.status === 1) {
        document.querySelector('[data-error]').innerText = "";
        document.querySelector('[data-success]').innerText = response.message;
    }
}

window.addEventListener('DOMContentLoaded', (event) => { // wait for dom content to load
const cardButton = document.querySelector('[data-btnAddCard]');

if (cardButton) {
    cardButton.addEventListener('click', () => {
        postCard();
        console.log('hej')
    }, false);
}
});

async function postExistingCard() { 
    const url = 'api/card/read.php'; // these fields are passed to the api
    const method = "POST";
    const data = {};

    const response = JSON.parse(await fetchData(url, data, method)); // response recieved from api

    const existingCardSection = document.querySelector("[data-existing-cards]");
        // Get template
        const existingCardTemp = document.querySelector("[data-existing-cards-template]").content;
        // For every object in the response
        response.forEach( (card)=> {
            // Create a clone
            const cln = existingCardTemp.cloneNode(true);
            // For each item in the object
            for (let field in card) {
                if (field === "nCreditCardID") {
                    cln.querySelector("div").id = card[field];
                } else if (field === "nManagerID") {
                    cln.querySelector(`#${field}`).classList.add('hidden');
                } else {
                    cln.querySelector(`#${field}`).innerText = card[field];
                    //cln.querySelector(`#${field}`).setAttribute('disabled', true); // disables editing
                }
            }
            // Release clone on frontend
            existingCardSection.appendChild(cln);
        })
}

postExistingCard();
