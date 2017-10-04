
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery-ui');
require('./daterangepicker');

window.Vue = require('vue');

Vue.use(VeeValidate);

import * as moment from 'moment'

import VeeValidate from 'vee-validate';

Vue.component('example', require('./components/Example.vue'));

Vue.component('page', require('./components/Page.vue'));

Vue.component('modal', {
    template: ` <div class="">
                    <div class="modal-content">
                        <div class="modal-background"></div>
                        
                        <div class="modal-header">
                            <button type="button" class="close"  @click="$emit('close')" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Modal</h4>
                        </div>
    
                        <form @submit.prevent="savePage()" action="#">
                            <p :class="{ 'control': true }">
                                <input v-validate="'required|title'" :class="{'input': true, 'is-danger': errors.has('title') }"  v-model="title" type="text" name="title" placeholder="Title">
                                <span v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</span>
                            </p>   
                        <p :class="{ 'control': true }">
                            <input v-validate="'required|slug'" :class="{'input': true, 'is-danger': errors.has('slug') }" v-model="slug" type="text" name="slug" placeholder="Slug">
                            <span v-show="errors.has('slug')" class="help is-danger">{{ errors.first('slug') }}</span>
                        </p>
                        <p :class="{ 'control': true }">
                            <input v-validate="'required|content'" :class="{'input': true, 'is-danger': errors.has('content') }" v-model="content" type="text" name="content" placeholder="Content">
                            <span v-show="errors.has('content')" class="help is-danger">{{ errors.first('content') }}</span>
                        </p>
                        <p :class="{ 'control': true }">
                            <input v-validate="'required|image'" :class="{'input': true, 'is-danger': errors.has('image') }" v-model="image" type="file" name="image" placeholder="Content">
                            <span v-show="errors.has('image')" class="help is-danger">{{ errors.first('image') }}</span>
                        </p>
                            <button>Submit</button>
                        </form>
                           
                        <button class="modal-close" @click="$emit('close')">Close</button>
                    </div> 
                </div> `,
    data: function () {
        return {
            title: '',
            slug: '',
            content: '',
            image: ''

        }
     },
  
    methods: {

        savePage() {
             axios.post('vue/pages', {
                        title: this.title,
                        slug: this.slug,
                        content: this.content,
                        image: this.image
                      })
                    this.$validator.validateAll({
                        title: this.title,
                        slug: this.slug,
                        content: this.content,
                        image: this.image
                    })
                    .then((res) => {
                        this.title = '';
                        this.slug = '';
                        this.content = '';
                        this.image = '';
             
                    })
                    .catch((err) => console.error(err));
        },
    },
});
    
//new Vue({
//    el: '#root',
//    
//        data: {
//            showModal: false,
//        },
//});

Vue.component('autocomplete', require('./components/Autocomplete.vue'));

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
//    var location = [
//    ['Bondi Beach', -33.890542, 151.274856],
//    ['Coogee Beach', -33.923036, 151.259052],
//    ['test Beach', -33.95, 151.28],
//  ];
//     var map = new google.maps.Map(document.getElementById('map-canvas'),{
//
//       center:{ lat: 27.72, lng: 85.36},
//       
//       zoom: 15,
//    });
//    var marker = new google.maps.Marker({
//        
////        position: { lat: location[1], lng: location[2]},
//        position: {
//            lat: 27.72,
//            lng: 85.36,
//        },
//        
//        map: map,
//        
//        draggable: true,
//    });
//    
//    var searchbox = new google.maps.places.SearchBox(document.getElementById('map'));
//    
//    google.maps.event.addListener(searchbox, 'places_changed', function(){
//        
//        var places = searchbox.getPlaces();
//        
//        var bounds = new google.maps.LatLngBounds();
//        
//        var i;
//        var place;
//        for( i=0; place=places[i]; i++){
//            bounds.extend(place.geometry.location);
//            marker.setPosition(place.geometry.location);
//        }
//        map.fitBounds(bounds);
//        map.setZoom(15);
//    });
    
//    var k;
//     for( k = 0; k < location.length; k++ ) {
//          var loc = location[k]
//          var marker = new google.maps.Marker({
//          position: {lat: loc[1], lng: loc[2]},
//          map: map,
//        });
//    }
    
//     google.maps.event.addListener(marker, 'position_changed', function(){
//         var lat = marker.getPosition().lat();
//         var lng = marker.getPosition().lng();
//         
//         $('#lat').val(lat);
//         $('#lng').val(lng);
//     });
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
   $('input[name="daterange"]').daterangepicker();
        
    $(document).on('click', '.edit-modal', function (e) {
        e.preventDefault();
        $('#id').val($(this).data('id'));
        var $id = $('#id').val();
        $('#title').val($(this).data('title'));
        $('#slug').val($(this).data('slug'));
        var content =  $('#content').val($(this).data('content'));
        var content_value = content.val();
        tinymce.activeEditor.setContent(content_value);
//        var image = $('#image').val($(this).data('image'));
//        var add_image = document.getElementById('image');
//        add_image.src = "/uploads/pages/large/"+image.val();
        $('#confirm-update').modal('show');
    });
    
    $('#update_page_modal').on('submit', function(e) {
          e.preventDefault();
        var form = $(this);
        var $id = $('#id').val();
        var $title =  $('#title').val();
        var $slug = $('#slug').val();
        var $content =   tinymce.activeEditor.getContent();
//        var $image =  "/uploads/pages/large/"+$('#image_id').val();
        
        $.ajax({
            type: "POST",
            url: "/page/save",
            dataType: "JSON",
            data: {
                '_token': $('meta[name=csrf-token]').attr("content"),
                'id': $id,
                'title': $title,
                'slug': $slug,
                'content': $content,
                
            },

            success: function (data) {
      
                if (data.success) {
                    if ($(".form-group").hasClass("has-error")) {
                        $(".form-group").removeClass("has-error");
                        $(".help-block strong").remove();
                    }
                    $('#confirm-update').modal('hide');
                    $('.item' + $id).replaceWith("<tr class='item" + $id + "'><td>" + $title + "</td><td>" + $slug + "</td><td>" + $content + "</td><td><a class='btn btn-primary' href='/page/show/" + $slug + "'>Show</a><a class='btn btn-primary' href='admin/page/edit/" + $id + "'>Edit</a><a class='btn btn-primary delete-button' href='admin/page/delete/" + $id + "'>Delete</a><button class='edit-modal' data-content='" + $content + "' data-slug='" + $slug + "' data-title='" + $title + "' data-id='" + $id + "'>Update </button></tr>");
                }
            
                if (data.errors) {
                    var errors = data.errors;
                    $.each(errors, function (key, value) {
                            $(".form-group." + key).addClass("has-error");
                            if ($(".help-block." + key).find("strong").length < 1) {
                                $(".help-block." + key).append('<strong>' + value + '</strong>');
                            }
                    });
                }
            },
            
            error: function (data) {
                var errors = data.responseJSON;
                alert(errors);
            }
        });
       
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
        auto_focus: 'content',
        mode : "specific_textareas",
        editor_selector : "content"
    });
    
    

    
});
