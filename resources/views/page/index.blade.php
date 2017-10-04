@extends('layouts.app')
@include('page._modal')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Pages</div>
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
@endsection

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
                            