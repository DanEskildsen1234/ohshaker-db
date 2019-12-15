async function postCard() {
    let expDate = encodeExpiryDate(document.querySelector('[data-expDate]').value);
    let CCV = document.querySelector('[data-CCV]').value;
    let IBAN = document.querySelector('[data-IBAN]').value;

    const url = 'api/card/create.php';
    const method = "POST";
    const data = {"expiration": expDate, "CCV": CCV, "IBAN": IBAN};

    const response = JSON.parse(await fetchData(url, data, method));

    if (response.status === 0) {
        document.querySelector('[data-error]').innerText = response.message;
    }
    
    if (response.status === 1) {
        document.querySelector('[data-error]').innerText = "";
        document.querySelector('[data-success]').innerText = response.message;
    }
}

// wait for dom content to load
window.addEventListener('DOMContentLoaded', (event) => { 
const cardButton = document.querySelector('[data-btnAddCard]');

if (cardButton) {
    cardButton.addEventListener('click', () => {
        postCard();
    }, false);
}
});

async function postExistingCard() { 
    // these fields are passed to the api
    const url = 'api/card/read.php'; 
    const method = "POST";
    const data = {};
    
    // response recieved from api
    const response = JSON.parse(await fetchData(url, data, method)); 

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
                    cln.querySelector(`#${field}`).innerText = card[field];
                } else if (field === "nManagerID") {
                    cln.querySelector(`#${field}`).classList.add('hidden');
                } else {
                    cln.querySelector(`#${field}`).innerText = card[field];
                    // disables editing
                    //cln.querySelector(`#${field}`).setAttribute('disabled', true); 
                }
            }
            // Release clone on frontend
            existingCardSection.appendChild(cln);
        })
}

postExistingCard();
