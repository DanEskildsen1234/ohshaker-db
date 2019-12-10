let ingredientsPage = document.querySelector('#ingredientsPage');
let ingredientsPage = document.querySelector('#editIngredientPage');

if (ingredientsPage || editIngredientPage){
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
        
    async function getCocktail() {
        let searchParams = new URLSearchParams(document.location.search);
        let url = "api/cocktail/read.php";
        let data = {"ingredientID": searchParams.get('id')};
        let method = "POST";

        let response = JSON.parse(await fetchData(url, data, method));
        
    }

    if(editIngredientPage){
        getCocktail();
    }

    getIngredients();


    async function deleteIngredient() {
        const url = 'api/ingredient/delete.php';
        const method = 'POST';
        const data = {"ingredientID": event.target.parentNode.id};

        fetchData(url, data, method);
        };


        async function editIngredient() {
            const url = 'api/ingredient/edit.php';
            const method = 'POST';
            const data = {"ingredientID": event.target.parentNode.id};
    
            fetchData(url, data, method);
            };

}
