function getCocktailSearch() {
    let input = document.querySelector('[data-search]');
    const location = document.querySelector('[data-search-results]');
    const item = document.querySelector( '[data-search-item]').content;

    let lastValue = "";
    let status = false;
    input.addEventListener('keypress', async ()=> {
        const inputValue = input.value;
        if (status === true || inputValue === "" || !/^[a-zA-Z].*$/.test(inputValue
            || lastValue === inputValue) ) {
            return;
        }
        status = true;
        lastValue = inputValue;
        location.innerHTML = "";

        const response = await fetch('api/cocktail/search.php' + '?query=' + inputValue, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            redirect: 'follow',
            referrer: 'no-referrer',
        });

        const results = await response.json();
        results.forEach( (result)=> {
            console.log(result);
            const cln = item.cloneNode(true);
            cln.querySelector('a').href = "single?id="+result.nCocktailID;
            cln.querySelector('p').innerText = result.cName;
            location.appendChild(cln);
        });
        status = false;
    }, false);
}

window.addEventListener('DOMContentLoaded', (event) => {
    getCocktailSearch();
});
