
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

Vue.component('home', require('./components/Home.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app'
});

$(document).ready( function() {
    
    $.ajaxSetup({
     headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
    
    
//  Completed Sessions
    $("#completed-view").click(function () {
        var complete = 0;
        var session_id = $('#session_id').val();
        var $this = $(this);
        if ($(this).is(":checked")) {
            complete = 1;
            $(this).val(1);
        } else {
            complete = 0;
            $(this).val(0);
        }
        
        $.ajax({
            type: "POST",
            url: "/session/save",
            dataType: 'json',
            data: {
                '_token': $('meta[name=csrf-token]').attr("content"),
                'completed': complete,
                'session_id': session_id,
            },
            success: function (data) {
            },
            errors: function (data) {
            }
        });
    });
    
    //  Checked
     $("#completed").click(function () {
        var complete = 0;
        var session_id = $('#session_id').val();
        var $this = $(this);
        if ($(this).is(":checked")) {
            complete = 1;
            $(this).val(1);
        } else {
            complete = 0;
            $(this).val(0);
        }
    });

//    Sweet Alert
    $('body').on('click', '.delete-button', function (e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");

        sweetAlert({
            title: "Are you sure?",
            text: "You will not be able to recover this workspace!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            html: false
        }, function () {
            window.location.href = linkURL;
        });
    });
    
   tinymce.init({
        selector: 'textarea',
        auto_focus: 'content'
    });
    

    
});
