<header>
    <div>
        <?php
            if ($_SERVER['REQUEST_URI'] === '/login.php' || $_SERVER['REQUEST_URI'] === '/'
                || $_SERVER['REQUEST_URI'] === '' || $_SERVER['REQUEST_URI'] === '/index.php') {
                echo"<img data-logo alt='OhShaker Logo'>
                     <button data-back class='hidden'>Back</button>
                ";
            } else {
                echo"<button data-back>Back</button>";
            }
        ?>
    </div>
    <div>
        <input class="hidden" type="text" data-search-input>
        <button data-open-search>Search</button>
    </div>
    <div>
        <a href="settings.php">Settings</a>
    </div>
</header>

<section data-search-results class="hidden">

</section>
<template data-search-item>
    <a>
        <p></p>
    </a>
</template>

<script src="assets/js/functions.js"></script>
<script src="assets/js/header.js"></script>
