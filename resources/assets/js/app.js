
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready( function() {
    $("#completed").click(function () {
        var checked = 0;
        var session_id = $('#session_id').val();
        var $this = $(this);
        if ($(this).is(":checked")) {
            checked = 1;
            $(this).val(1);
        } else {
            checked = 0;
            $(this).val(0);
        }
        
        $.ajax({
            type: "POST",
            url: "/session/save",
            dataType: 'json',
            data: {
                '_token': $('meta[name=csrf-token]').attr("content"),
                'completed': checked,
                'session_id': session_id,
            },
            success: function (data) {
                
            },
            errors: function (data) {
            }
        });
    });
