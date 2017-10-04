@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Pages</div>
                <div id="maps" style="width:100%; height: 400px;"></div>
                <div class="panel-body">
                    <input type="text" name="daterange"/>
                     <?php if($admin_role) { ?><a class="btn btn-primary" href="{{ route('page.create') }}">Add page</a><?php } ?>
                    <table class="table table-bordered">
                        <thead>
                         <tr>
                           <th>Title</th>
                           <th>Slug</th>
                           <th>Content</th>
                           <th>Actions</th>
                         </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                            <tr class="item<?= $page->id?>">
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->content }}</td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('page.show', $page->slug) }}">Show</a>
                                    <?php if($admin_role) { ?><a class="btn btn-primary" href="{{ route('page.edit', $page->id) }}">Edit</a><?php } ?>
                                    <?php if($admin_role) { ?><a class="btn btn-primary delete-button" href="{{ route('page.delete', $page->id) }}">Delete</a><?php } ?>
                                    <?php if($admin_role) { ?><a class="btn btn-primary" href="{{ route('page.addmap') }}">Add map</a><?php } ?>
                                    <?php if($admin_role) { ?><button class="edit-modal" data-image="{{ $page->image }}" data-content="{{$page->content}}" data-slug="{{$page->slug}}" data-title="{{$page->title}}" data-id="{{ $page->id }}">Update </button><?php } ?>
                                </td>
                            </tr>
                            @endforeach   
                        </tbody>
                     </table>
                     {{ $pages_paginate->links() }}
                </div>
               <div id="disqus_thread"></div>
               
            </div>
        </div>
    </div>
</div>
                <?php 
for($i=0; $i< count($pages); $i++) {
    echo $pages[$i]->lat; 
}
?>
@endsection

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-aLAQ_dkqmtildzme3joJQ4ZGB7qsv6M&libraries=places"
    async defer></script>
<script>
    $(document).ready( function() {
       var location = [
        ['Bondi Beach', -33.890542, 151.274856],
        ['Coogee Beach', -33.923036, 151.259052],
        ['test Beach', -33.95, 151.28],
  ];
    var title = "{{ $page->title}}";
    var content = "{{ $page->content}}";
    
    var map = new google.maps.Map(document.getElementById('maps'),{
     center:{ lat: -33.8, lng: 151.27 },
       zoom: 15,
    });
    
       for (i = 0; i < location.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(location[i][1], location[i][2]),
                map: map,
            });
            
           
    }
    
    infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
        return function() {
            infowindow.setContent("dadad");
            infowindow.open(map,marker);
        };
    })(marker,content,infowindow));  
    
    
//     marker.addListener('click', function() {
//                infowindow = new google.maps.InfoWindow();
//                infowindow.setContent("location[i][0]");
//                infowindow.open(map, marker);
//            });
    
    
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
    });
    
    
//     var marker = location.map(function(location, i) {
////          return new google.maps.Marker({
//           position: { lat: location[1], lng: location[2]},
//           map: map,
////          });
//        });
//        

//    
//     var options =  {
//         imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
//     };
          
//    var markerCluster = new MarkerClusterer(map, markers, options);
   
    
</script>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://http-blog-dev-2.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            