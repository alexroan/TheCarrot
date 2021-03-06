/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap');

$(document).ready(function(){
    $($(".cookie-consent").find('button')[0]).addClass("btn btn-secondary");
    $('.fade').css('opacity', '1');
});