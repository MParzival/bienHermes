
require('../css/app.css');

import noUiSlider from 'nouislider';
import 'nouislider/distribute/nouislider.css'

$('#contactButton').click(e => {
    e.preventDefault();
    $('#contactButton').toggle();
    $('#contactForm').toggle();
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

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
