async function getCocktails() {
    const url = "api/cocktail/read.php";
    const data = {};
    const method = "POST";

    const response = JSON.parse(await fetchData(url, data, method));
    
    for( let key in response ){
        var cocktailDiv = document.createElement("div");
        document.getElementById("cocktail").appendChild(cocktailDiv);
        cocktailDiv.innerHTML += response[key].cName;
        cocktailDiv.setAttribute('id', response[key].nCocktailID);
    }
    


}

getCocktails();

