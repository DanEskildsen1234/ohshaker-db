var cocktailsPage = document.querySelector('#cocktailPage');
if (cocktailsPage){

    async function getCocktails() {
        const url = "api/cocktail/read.php";
        const data = {};
        const method = "POST";

        const response = JSON.parse(await fetchData(url, data, method));
        
        for( let key in response ){
            var cocktailNameDiv = document.createElement("a");
            document.getElementById("cocktail").appendChild(cocktailNameDiv);
            cocktailNameDiv.innerHTML += response[key].cName;
            cocktailNameDiv.setAttribute('id', response[key].nCocktailID);
            cocktailNameDiv.setAttribute('class', 'cocktails');
            cocktailNameDiv.setAttribute('href', 'single.php?id='+response[key].nCocktailID);
        }
    }
    getCocktails();
}

var singlePage = document.querySelector('#singlePage');
if (singlePage){
    async function getCocktail() {

        // GET AND CREATE COCKTAIL DATA

        var searchParams = new URLSearchParams(document.location.search);
        const url = "api/cocktail/read.php";
        const data = {"cocktailID": searchParams.get('id')};
        const method = "POST";
        const response = JSON.parse(await fetchData(url, data, method));

        // Generate cocktail Name
        var cocktailNameDiv = document.createElement("div");
        document.getElementById("cocktail").appendChild(cocktailNameDiv);
        cocktailNameDiv.innerHTML += response[0].cName;
        cocktailNameDiv.setAttribute('class', 'cocktailName');    

        // Generate cocktail Recipe
        var cocktailRecipeDiv = document.createElement("div");
        document.getElementById("cocktail").appendChild(cocktailRecipeDiv);
        cocktailRecipeDiv.innerHTML += response[0].cCocktailRecipe;
        cocktailRecipeDiv.setAttribute('class', 'cocktailRecipe');    

        // Generate cocktail ShakenStirred
        var cocktailShakenStirredDiv = document.createElement("div");
        document.getElementById("cocktail").appendChild(cocktailShakenStirredDiv);
        cocktailShakenStirredDiv.innerHTML += response[0].eShakenStirred;
        cocktailShakenStirredDiv.setAttribute('class', 'cocktailShakenStirred');
        
        // Generate cocktail CubedCrushed
        var cocktailCubedCrushedDiv = document.createElement("div");
        document.getElementById("cocktail").appendChild(cocktailCubedCrushedDiv);
        cocktailCubedCrushedDiv.innerHTML += response[0].eCubedCrushed;
        cocktailCubedCrushedDiv.setAttribute('class', 'cocktailShakenStirred');


        for( let ingredientDetails in response ){
            // if exists, log the recipes too
            if (typeof response[ingredientDetails].cIngredientName !== 'undefined') {

                // Generate ingredient name
                var ingredientNameDiv = document.createElement("div");
                document.getElementById("cocktail").appendChild(ingredientNameDiv);
                ingredientNameDiv.innerHTML += response[ingredientDetails].cIngredientName;
                ingredientNameDiv.setAttribute('class', 'ingredientName');

                
                // Generate ingredient measurement+measurement type
                var ingredientMeasurementDiv = document.createElement("div");
                document.getElementById("cocktail").appendChild(ingredientMeasurementDiv);
                ingredientMeasurementDiv.innerHTML += response[ingredientDetails].nMeasurement += response[ingredientDetails].eMeasurementType;
                ingredientMeasurementDiv.setAttribute('class', 'ingredientMeasurement');
                
            }
        }
    }

    getCocktail();
};
