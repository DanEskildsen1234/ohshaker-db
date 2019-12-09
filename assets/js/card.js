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
