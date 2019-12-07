var cocktailsPage = document.querySelector('#cocktailPage');
if (cocktailsPage){

    async function getCocktails() {
        const url = "api/cocktail/read.php";
        const data = {};
        const method = "POST";

        const response = JSON.parse(await fetchData(url, data, method));
        
        for( let key in response ){
            var cocktailDiv = document.createElement("a");
            document.getElementById("cocktail").appendChild(cocktailDiv);
            cocktailDiv.innerHTML += response[key].cName;
            cocktailDiv.setAttribute('id', response[key].nCocktailID);
            cocktailDiv.setAttribute('class', 'cocktails');
            cocktailDiv.setAttribute('href', 'single.php?id='+response[key].nCocktailID);
        }
    }
    getCocktails();
}

var singlePage = document.querySelector('#singlePage');
if (singlePage){
    async function getCocktail() {

        var searchParams = new URLSearchParams(document.location.search);
        console.log(searchParams)
        const url = "api/cocktail/read.php";
        const data = {"cocktailID": searchParams.get('id')};

        console.log(searchParams.get('id'));
        const method = "POST";
        const response = JSON.parse(await fetchData(url, data, method));

        var cocktailDiv = document.createElement("a");
        document.getElementById("cocktail").appendChild(cocktailDiv);
        cocktailDiv.innerHTML += response[0].cName;
        cocktailDiv.setAttribute('id', response[0].nCocktailID);
        cocktailDiv.setAttribute('class', 'cocktail');    
    }
    getCocktail();
};
