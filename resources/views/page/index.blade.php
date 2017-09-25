@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pages</div>
                <div class="panel-body">
                     <?php if($admin_role) { ?><a class="btn btn-primary" href="{{ route('page.create') }}">Add page</a><?php } ?>
                     <table class="table">
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
                            @include('page._modal', ['page' => $page])
                            <tr class="item<?= $page->id?>">
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->content }}</td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('page.show', $page->slug) }}">Show</a>
                                    <?php if($admin_role) { ?><a class="btn btn-primary" href="{{ route('page.edit', $page->id) }}">Edit</a><?php } ?>
                                    <?php if($admin_role) { ?><a class="btn btn-primary delete-button" href="{{ route('page.delete', $page->id) }}">Delete</a><?php } ?>
                                    <?php if($admin_role) { ?><button class="edit-modal" data-image-page="/uploads/pages/large/{{ $page->image }}" data-content="{{$page->content}}" data-slug="{{$page->slug}}" data-title="{{$page->title}}" data-id="{{ $page->id }}">Update </button><?php } ?>
                                </td>
                            </tr>
                            @endforeach   
                        </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection