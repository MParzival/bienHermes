
require('../css/app.css');

import noUiSlider from 'nouislider';
import 'nouislider/distribute/nouislider.css'

$('#contactButton').click(e => {
    e.preventDefault();
    $('#contactButton').toggle();
    $('#contactForm').toggle();
});

$(function () {
    $("[data-toggle=\"tooltip\"]").tooltip()
});


let password = document.getElementById("registration_form_plainPassword_first")
    , confirm_password = document.getElementById("registration_form_plainPassword_second");

function validatePassword(){
    if(password.value !== confirm_password.value) {
        confirm_password.setCustomValidity("vos mots de passes ne sont pas identique !");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in media/js/app.js');

const slider = document.getElementById('price-slider');
if (slider){
    const max = document.getElementById('max');
    const range = noUiSlider.create(slider, {
        start: [0, max.value || 8000000],
        connect: true,
        step: 100,
        range: {
            'min': 0,
            'max': 8000000
        }
    });

    range.on('slide', function (values, handle){
       //console.log(values, handle)
        if (handle === 1){
            max.value = Math.round(values[0])
        }
    })
}
