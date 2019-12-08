function getCocktailSearch() {
    let input = document.querySelector("[data-search");

    input.addEventListener('change', async ()=> {
        const response = await fetch('api/cocktail/search.php' + '?query=' + input.value, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            redirect: 'follow',
            referrer: 'no-referrer',
        });
        console.log(await response.json());
    }, false);
}

window.addEventListener('DOMContentLoaded', (event) => {
    getCocktailSearch();
});
