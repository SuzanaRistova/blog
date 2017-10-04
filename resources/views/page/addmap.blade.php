@extends('layouts.app')

@section('content')

<div class="contanier">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new page</div>
                <div class="panel-body">
                    <h1>Add maps</h1>
                    <form method="post" action="{{ route('page.addmapsave') }}">
                        
                        {{ csrf_field() }}
                         
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                         <div class="form-group">
                            <label>Map</label>
                            <input type="text" class="form-control" name="map" id="map">
                            <div id="map-canvas" style="width: 300px; height: 300px;"></div>
                        </div>
                        <div class="form-group">
                            <label>Lat</label>
                            <input type="text" class="form-control" name="lat" id="lat">
                        </div>
                        <div class="form-group">
                            <label>Lng</label>
                            <input type="text" class="form-control" name="lng" id="lng">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-aLAQ_dkqmtildzme3joJQ4ZGB7qsv6M&libraries=places"
    async defer></script>
<script>
   
$(document).ready( function() {

     var map = new google.maps.Map(document.getElementById('map-canvas'),{

       center:{ lat: 27.72, lng: 85.36},
       
       zoom: 15,
    });
    var marker = new google.maps.Marker({
        
        position: {
            lat: 27.72,
            lng: 85.36,
        },
        
        map: map,
        
        draggable: true,
    });
    
    var searchbox = new google.maps.places.SearchBox(document.getElementById('map'));
    
    google.maps.event.addListener(searchbox, 'places_changed', function(){
        
        var places = searchbox.getPlaces();
        
        var bounds = new google.maps.LatLngBounds();
        
        var i;
        var place;
        for( i=0; place=places[i]; i++){
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
        }
        map.fitBounds(bounds);
        map.setZoom(15);
    });
    
     google.maps.event.addListener(marker, 'position_changed', function(){
         var lat = marker.getPosition().lat();
         var lng = marker.getPosition().lng();
         
         $('#lat').val(lat);
         $('#lng').val(lng);
     });
     
    
    });
    
</script>

