@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modules</div>
                <div class="panel-content">
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
                                <td>{{ $module->title }}</td>
                                <td>{{ $module->slug }}</td>
                                <td>{{ $module->content }}</td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('lesson.create', $module->id) }}">Create Lesson</a>
                                </td>
                            </tr>
                        </tbody>
                     </table>
               </div>
                
                <div class="panel-heading">Lessons</div>
                <div class="panel-body">
                        <table class="table table-striped">
                           <thead>
                            <tr>
                              <th>Title</th>
                              <th>Slug</th>
                              <th>Content</th>
                              <th>Action</th>
                            </tr>
                           </thead>
                           <tbody>
                                @foreach($lessons as $key => $lesson)
                                <tr>
                                    <td>{{ $lesson->title }}</td>
                                    <td>{{ $lesson->slug }}</td>
                                    <td>{{ $lesson->content }}</td>
                                    @if( (isset($lessons[$key-1]) && $lessons[$key-1]->completed == 1) || ($key == 0) )
                                    <td>   
                                        <a class="btn btn-primary" href="{{ route('lesson.show', $lesson->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('lesson.edit', $lesson->id) }}">Edit</a>
                                        <a class="btn btn-primary" href="{{ route('lesson.delete', $lesson->id) }}">Delete</a>
                                    </td>
                                    @endif
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
