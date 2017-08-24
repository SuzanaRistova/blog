@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lessons</div>
                <div class="panel-body">
                     <table class="table">
                        <thead>
                         <tr>
                           <th>Title</th>
                           <th>Slug</th>
                           <th>Content</th>
                           <th>Action</th>
                         </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $lesson->title }}</td>
                                <td>{{ $lesson->slug }}</td>
                                <td>{{ $lesson->content }}</td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('lesson.edit', $lesson->id) }}">Edit</a>
                                    <a class="btn btn-primary" href="{{ route('lesson.delete', $lesson->id) }}">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                     </table>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
