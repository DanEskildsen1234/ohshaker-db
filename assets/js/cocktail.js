let cocktailsPage = document.querySelector('#cocktailPage');
if (cocktailsPage){

    async function getCocktails() {
        const url = "api/cocktail/read.php";
        const data = {};
        const method = "POST";

        const response = JSON.parse(await fetchData(url, data, method));
        
        for( let key in response ){
            let cocktailName = document.createElement("a");
            document.getElementById("cocktail").appendChild(cocktailName);
            cocktailName.innerHTML += response[key].cName;
            cocktailName.setAttribute('id', response[key].nCocktailID);
            cocktailName.setAttribute('class', 'cocktails');
            cocktailName.setAttribute('href', 'single.php?id='+response[key].nCocktailID);
        }
    }
    getCocktails();
}

let singlePage = document.querySelector('#singlePage');
let editPage = document.querySelector('#editPage');
if (singlePage || editPage){
    async function getCocktail() {
        let searchParams = new URLSearchParams(document.location.search);
        let url = "api/cocktail/read.php";
        let data = {"cocktailID": searchParams.get('id')};
        let method = "POST";
        let response = JSON.parse(await fetchData(url, data, method));
        
        document.getElementById("edit").setAttribute('href', 'cocktailedit.php?id='+response.nCocktailID);
        
        for (let field in response) {
            if (isNaN(field) && field != 'nCocktailID' && field != 'ingredients') {
                console.log(field); // gets field
                // console.log(response[field]); // gets value of field
                document.getElementById(field).innerText = response[field];
            }
        }

        const updateIngredientSection = document.querySelector("[data-update-ingredient]");
        // Get template
        const ingredientTemp = document.querySelector("[data-ingredient-template]").content;

        // For each item in the object
        response.ingredients.forEach((ingredient) => {
            const cln = ingredientTemp.cloneNode(true);
            for (let field in ingredient) {
                            if (field != 'nIngredientID'){
                                cln.querySelector(`#${field}`).innerHTML = ingredient[field];
                        }
                    }
                    updateIngredientSection.appendChild(cln);
                });
                // Release clone on frontend
    
}
    getCocktail();
}
