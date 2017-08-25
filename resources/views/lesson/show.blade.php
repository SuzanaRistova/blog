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
                           <th>Completed</th>
                           <th>Action</th>
                         </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $lesson->title }}</td>
                                <td>{{ $lesson->slug }}</td>
                                <td>{{ $lesson->content }}</td>
                                <td>
                                    {{($completed) ? "Completed" : "Not completed"}}
                                </td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('session.create', $lesson->id) }}">Create Session</a>
                               </td>
                            </tr>
                        </tbody>
                     </table>
               </div>
                 <div class="panel-heading">Sessions</div>
                <div class="panel-body">
                        <table class="table table-striped">
                           <thead>
                            <tr>
                              <th>Title</th>
                              <th>Slug</th>
                              <th>Content</th>
                              <th>Video</th>
                              <th>Completed</th>
                              <th>Action</th>
                            </tr>
                           </thead>
                           <tbody>
                                @foreach($sessions as $session)
                                <tr>
                                    <td>{{ $session->title }}</td>
                                    <td>{{ $session->slug }}</td>
                                    <td>{{ $session->content }}</td>
                                    <td>{{ $session->video }}</td>
                                    <td>{{ $session->completed }}</td>
                                    <td>   
                                        <a class="btn btn-primary" href="{{ route('session.show', $session->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('session.edit', $session->id) }}">Edit</a>
                                        <a class="btn btn-primary" href="{{ route('session.delete', $session->id) }}">Delete</a>
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
