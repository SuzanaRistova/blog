@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="title-container">
                    <div class="title">
                        @if($page->image != NULL)
                            <img src="/uploads/pages/small/{{ $page->image}}"/>
                        @endif
                        <?= $page->title; ?>
                    </div>
                </div>                        
                <div class="body-container">
                    @if($page->image != NULL)
                        <img class="page-image" src="/uploads/pages/large/{{ $page->image}}"/>
                    @endif
                    <div class="content"><?= $page->content; ?></div>
                    @if(($page->lat != Null) || ($page->lng != NULL))
                    <h1>Maps</h1>
                    <div id="map-canvas" style="width: 300px; height: 300px; margin: 0 auto;"></div>
                    @endif
                    <div class="back">
                        <a href="{{ url()->previous() }}">Back</a>
                    </div>
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
    var lat = {{ $page->lat }};
    var lng = {{ $page->lng }};
    var title = "{{ $page->title}}";
    var content = "{{ $page->content}}";
    
    var map = new google.maps.Map(document.getElementById('map-canvas'),{
       center:{ lat: lat, lng: lng},
       zoom: 15,
    });
    var marker = new google.maps.Marker({
        position: {
            lat: lat,
            lng: lng,
        },
        map: map,
    });
    
    
     var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading">'+title+'</h4>'+
            '<div id="bodyContent">'+
            '<p> ' +
            ''+content+
            '</p>'+
            '</div>'+
            '</div>';
     
      var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
     
      marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
    
    });
    
</script>


