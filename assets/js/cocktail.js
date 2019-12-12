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
    async function getGlobalIngredients() {
        let url = "api/ingredient/read.php";
        let data = {};
        let method = "POST";
        let response = JSON.parse(await fetchData(url, data, method));

        response.forEach((ingredient) => {
            
            if(editPage){
                var ingredientOption = document.createElement("option");
                ingredientOption.innerHTML = ingredient.cName;
                ingredientOption.value = ingredient.nIngredientID;

                document.getElementById("insert-ingredient").appendChild(ingredientOption);
            }
            
        })
    }

    async function getCocktail() {
        let searchParams = new URLSearchParams(document.location.search);
        let url = "api/cocktail/read.php";
        let data = {"cocktailID": searchParams.get('id')};
        let method = "POST";
        let response = JSON.parse(await fetchData(url, data, method));
        
        if (singlePage) {
            document.getElementById("edit").setAttribute('href', 'cocktailedit.php?id='+response.nCocktailID);
        }
        
        for (let field in response) {
            if (isNaN(field) && field != 'nCocktailID' && field != 'ingredients') {
                document.getElementById(field).innerText = response[field];
                
                if (editPage){
                    document.getElementById(field).value = response[field];
                }
            }
        }

        const updateIngredientSection = document.querySelector("[data-update-cocktail]");
        // Get template
        const ingredientTemp = document.querySelector("[data-ingredient-template]").content;

        // For each item in the object
        response.ingredients.forEach((ingredient) => {
            const cln = ingredientTemp.cloneNode(true);

            for (let field in ingredient) {
                if (field != 'nIngredientID'){
                    cln.querySelector(`#${field}`).innerHTML = ingredient[field];
                }
                if (editPage && field != 'nIngredientID'){
                    cln.querySelector(`#${field}`).value = ingredient[field];
                    cln.querySelector(`#${field}`).className = ingredient.nIngredientID;
                    cln.querySelector('#remove-ingredient').value = ingredient.nIngredientID;
                    // query selector for updating field
                    cln.querySelector(`#${field}`).addEventListener('blur', event => {
                         postUpdateCocktail();
                    })
                } 
            }
            if (editPage){
                cln.querySelector(`#remove-ingredient`).addEventListener('click', event => {
                    postUpdateCocktail();
                })
            }
            updateIngredientSection.appendChild(cln);
        });    
    }
    getGlobalIngredients();
    getCocktail();

    document.querySelectorAll('input').forEach(item => {
        item.addEventListener('blur', event => {
            postUpdateCocktail();
        })
     })
    
    document.getElementById("add-ingredient").addEventListener('click', event => {
        var dropdown = document.getElementById("insert-ingredient");
        var dropdownValue = dropdown.options[dropdown.selectedIndex].value;

        document.getElementById("add-ingredient").value = dropdownValue;
          postUpdateCocktail();
        })

        async function postUpdateCocktail() {
            let searchParams = new URLSearchParams(document.location.search);
            let measurement = document.getElementById("measurement").value;
            let measurementType = document.getElementById("measurementType").value;
            const url = 'api/cocktail/update.php';
            const method = 'POST';
            const data = {"cocktailID": searchParams.get('id'),
                          "field": event.target.id,
                          "value":event.target.value,
                          "measurement":measurement,
                          "measurementType": measurementType
                         };

            if(event.target.id == "measurement" || event.target.id == "measurementType"){
                return; 
            }

            if (event.target.id == 'remove-ingredient'){
                var elem = event.target.parentNode;
                elem.remove();
            }

            fetchData(url, data, method);
            // const response = JSON.parse(await fetchData(url, data, method));
            
            // messageBox(response);
            if (event.target.id == 'add-ingredient'){
                location.reload();
            }
    }

    let varDeleteCocktail = document.getElementById("delete-cocktail");
    varDeleteCocktail.addEventListener('click', event => {
        
        deleteCocktail();
        window.location.href = "index.php";
    });
    async function deleteCocktail() {
        let searchParams = new URLSearchParams(document.location.search);

        const url = "api/cocktail/delete.php";
        const data = {"cocktailID": searchParams.get('id')};
        const method = "POST";
        fetchData(url, data, method);
    }

}
