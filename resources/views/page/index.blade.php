@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pages</div>
                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ route('page.create') }}">Add page</a>
                     <table class="table">
                        <thead>
                         <tr>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Actions</th>
                         </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                                        <tr>
                            <td>{{ $page->name }}</td>
                            <td>{{ $page->email }}</td>
                            <td>   
                                <a class="btn btn-primary" href="{{ route('page.show', $page->id) }}">Show</a>

                                @if($admin_role) 
                                    <a class="btn btn-primary" href="{{ route('page.edit', $page->id) }}">Edit</a>
                                @endif

                                @if($admin_role) 
                                    <a class="btn btn-primary" href="{{ route('page.delete', $page->id) }}">Delete</a>
                                @endif
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