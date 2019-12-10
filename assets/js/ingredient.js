let ingredientsPage = document.querySelector('#ingredientsPage');
let editIngredientPage = document.querySelector('#editIngredientPage');

if (ingredientsPage){
async function getIngredients() { 
    console.log("yep");
    const url = 'api/ingredient/read.php'; // these fields are passed to the api
    const method = "POST";
    const data = {};
    
    const response = JSON.parse(await fetchData(url, data, method)); 
    // response recieved from api
    const ingredientSection = document.querySelector("[data-ingredient-section]");
        // Get template
        const ingredientTemp = document.querySelector("[data-ingredient-template]").content;
        // For every object in the response
        console.log(ingredientTemp)
        response.forEach( (ingredient)=> {
            console.log(ingredient);
            // Create a clone
            const cln = ingredientTemp.cloneNode(true);
            // For each item in the object

            cln.querySelector(`.delete-ingredient`).addEventListener('click', event => {
                document.getElementById(`${event.currentTarget.parentNode.id}`).remove();
                deleteIngredient();
            })

            for (let field in ingredient) {
                if (field === "nIngredientID") {
                    cln.querySelector(".ingredientSection").id = ingredient[field];
                    cln.querySelector(".edit-ingredient").setAttribute('href', 'ingredientedit.php?id=' + ingredient[field]);

                } else {
                    cln.querySelector(`#${field}`).innerText = ingredient[field];
                }
            }
            ingredientSection.appendChild(cln);
        })
            // Release clone on frontend
        }

        async function deleteIngredient() {
            const url = 'api/ingredient/delete.php';
        const method = 'POST';
        const data = {"ingredientID": event.target.parentNode.id};
        
        fetchData(url, data, method);
    };   
    getIngredients();
}

if (editIngredientPage) {
    
async function getIngredient() {
    let searchParams = new URLSearchParams(document.location.search);
    let url = "api/ingredient/read.php";
    let data = {"ingredientID": searchParams.get('id')};
    let method = "POST";

    let response = JSON.parse(await fetchData(url, data, method));
    console.log(response);
    // response recieved from api
    const ingredientSection = document.querySelector("[data-ingredient-section]");
        // Get template
        const ingredientTemp = document.querySelector("[data-ingredient-template]").content;
        // For every object in the response
            // Create a clone
            const cln = ingredientTemp.cloneNode(true);
            // For each item in the object

            for (let field in response) {
                if (field === "nIngredientID") {
                    cln.querySelector(".ingredientSection").id = response[field];
                } else {
                    cln.querySelector(`#${field}`).value = response[field];   
                    cln.querySelector(`#${field}`).addEventListener('blur', event => {
                        updateIngredient();
                    })
                }
            }
            ingredientSection.appendChild(cln);
    }

async function updateIngredient() {
    let searchParams = new URLSearchParams(document.location.search);
    let url = "api/ingredient/update.php";
    let data = {"ingredientID": searchParams.get('id'),
                "name": event.target.value};
    let method = "POST";

    fetchData(url, data, method);

}

    if(editIngredientPage){
        getIngredient();
    }
}