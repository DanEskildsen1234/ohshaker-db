function getCocktailSearch() {
    let input = document.querySelector('[data-search-input]');
    let resultsLocation = document.querySelector('[data-search-results]');
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
        resultsLocation.innerHTML = '';

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
            resultsLocation.appendChild(cln);
        });
        status = false;
    }, false);
}

function headerNav() {
    const openSearchButton = document.querySelector('[data-open-search]');
    const SearchInput = document.querySelector('[data-search-input]');
    const backButton = document.querySelector('[data-back]');
    const searchResults = document.querySelector('[data-search-results]');
    const logo = document.querySelector('[data-logo]');

    openSearchButton.addEventListener('click', ()=> {
        toggleView();
        SearchInput.value = "";
        searchResults.innerHTML = "";
    });
    backButton.addEventListener('click', ()=> {
        if (SearchInput.classList.contains('hidden')) {
            window.history.back();
        } else {
            toggleView();
        }
    });

    function toggleView() {
        SearchInput.classList.toggle('hidden');
        backButton.classList.toggle('hidden');
        logo.classList.toggle('hidden');
        searchResults.classList.toggle('hidden');
        openSearchButton.classList.toggle('hidden');
    }
}


window.addEventListener('DOMContentLoaded', (event) => {
    getCocktailSearch();
    headerNav();
});
