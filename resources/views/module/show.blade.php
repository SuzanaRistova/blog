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
                                 @if($user->hasRole('admin')) 
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('lesson.create', $module->id) }}">Create Lesson</a>
                                </td>
                                @endif
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
                                    <?php
                                        if(isset($lessons[$key-1]) && $lessons[$key-1]->isCompleted()){
                                            $lesson_completed = true;
                                        } else {
                                            $lesson_completed= false;
                                        }
                                    ?>
                                <tr>
                                    <td>{{ $lesson->title }}</td>
                                    <td>{{ $lesson->slug }}</td>
                                    <td>{{ $lesson->content }}</td>
                                    <td>  
                                        @if(($lesson_completed) || ($key == 0) )
                                            <a class="btn btn-primary" href="{{ route('lesson.show', $lesson->slug) }}">Show</a>
                                             @if($user->hasRole('admin')) <a class="btn btn-primary" href="{{ route('lesson.edit', $lesson->id) }}">Edit</a> @endif
                                             @if($user->hasRole('admin')) <a class="btn btn-primary" href="{{ route('lesson.delete', $lesson->id) }}">Delete</a> @endif
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
