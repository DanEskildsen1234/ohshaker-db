let ingredientsPage = document.querySelector('#ingredientsPage');

if (ingredientsPage){
async function getIngredients() { 
    console.log("yep");
    const url = 'api/ingredient/read.php'; // these fields are passed to the api
    const method = "POST";
    const data = {};
    
    const response = JSON.parse(await fetchData(url, data, method)); 
    // response recieved from api
    console.log(response);
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
            for (let field in ingredient) {
                if (field === "nIngredientID") {
                    cln.querySelector(".ingredientSection").id = ingredient[field];
                } else {
                    cln.querySelector(`#${field}`).innerText = ingredient[field];
                }
            }
            ingredientSection.appendChild(cln);
        })
            // Release clone on frontend
        }
        let deleteIngredient = document.querySelectorAll(".delete-ingredient");
            
            deleteIngredient.addEventListener('click', () => {
                console.log('consoled');
            })
        
    getIngredients();
}
