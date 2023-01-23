document.addEventListener("DOMContentLoaded", function (){
    // initialize the form element for Dvd
    document.getElementById('size').required = true;
    document.getElementsByClassName('weightWrap')[0].style.display = 'none';
    document.getElementsByClassName('dimensionWrap')[0].style.display = 'none';

    // select the product switcher 
    var dropDown = document.getElementById('productType');
    dropDown.addEventListener('change', () => {
        var wraps = ['sizeWrap', 'weightWrap', 'dimensionWrap'];
        // reset all product specific form elements
        wraps.forEach((wrap) => {
            var htmlEl = document.getElementsByClassName(wrap)[0];
            htmlEl.style.display = 'none';
            htmlEl.querySelectorAll('input').forEach((input) => {input.required = false; input.value =''});
        });
        // set the selected form element to be visible and required
        var selectedHtmlEl = document.getElementsByClassName(wraps[dropDown.selectedIndex])[0];
        selectedHtmlEl.style.display = 'block';
        selectedHtmlEl.querySelectorAll('input').forEach((input) => {input.required = true; });
    });

});

// // Example POST method implementation:
            // async function postData(url = '', data = {}) {
            //     // Default options are marked with *
            //     const response = await fetch(url, {
            //         method: 'POST', // *GET, POST, PUT, DELETE, etc.
            //         mode: 'cors', // no-cors, *cors, same-origin
            //         cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            //         credentials: 'same-origin', // include, *same-origin, omit
            //         headers: {
            //             'Content-Type': 'application/json'
            //             // 'Content-Type': 'application/x-www-form-urlencoded',
            //         },
            //         redirect: 'follow', // manual, *follow, error
            //         referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            //         body: JSON.stringify(data) // body data type must match "Content-Type" header
            // });
            //     return response.json(); // parses JSON response into native JavaScript objects
            // };
            // postData('create.php', args)
            //     .then(() => {
            //         console.log('success!!!'); // JSON data parsed by `data.json()` call
            // });