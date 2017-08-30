@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modules</div>
                <div class="panel-body">
                    @if($user->hasRole('admin'))
                        <a class="btn btn-primary" href="{{ route('module.create') }}">Add module</a>
                    @endif
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
                            @foreach($modules as $module)
                            <tr>
                                <td>{{ $module->title }}</td>
                                <td>{{ $module->slug }}</td>
                                <td>{{ $module->content }}</td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('module.show', $module->slug) }}">Show</a>
                                    @if($user->hasRole('admin')) <a class="btn btn-primary" href="{{ route('module.edit', $module->id) }}">Edit</a> @endif
                                    @if($user->hasRole('admin')) <a class="btn btn-primary" href="{{ route('module.delete', $module->id) }}">Delete</a> @endif
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