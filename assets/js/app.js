/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
import '../css/app.scss';
import 'bootstrap';

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// import $ from 'jquery';
const $ = require('jquery');


$(document).ready(function () {
   let $link = $('.js-sort-by');

   $.ajax({
      url: '/all-cards/get/' + $link.val(),
      method: 'POST'
   }).then(function(data) {
      $("#js-card").html(data);
      toggleCheckboxByValue('.js-sentence-checked',
          '.js-sentence-state');
      toggleCheckboxByValue('.js-pronun-checked',
          '.js-pronun-state');
   });
});

$('.js-sort-by').change(function (e) {
   let $link = $(e.currentTarget);

   $.ajax({
      url: '/all-cards/get/' + $link.val(),
      method: 'POST'
   }).then(function(data) {
      $("#js-card").html(data);
      toggleCheckboxByValue('.js-sentence-checked',
          '.js-sentence-state');
      toggleCheckboxByValue('.js-pronun-checked',
          '.js-pronun-state');
   });
});


$('.js-sentence-checked').click(function (e) {
   toggleCheckboxByValue(e.currentTarget,
       '.js-sentence-state');
});

$('.js-pronun-checked').click(function (e) {
   toggleCheckboxByValue(e.currentTarget,
       '.js-pronun-state');
});

const toggleCheckboxByValue = function (checkbox, element) {
   if ($(checkbox).prop('checked')) {
      $(element).show();
   } else {
      $(element).hide();
   }
};