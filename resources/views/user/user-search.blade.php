@extends('layouts.app')

@section('content')
<div class="container">

	<h2>Laravel Full Text Search using Scout and algolia</h2><br/>


	<form method="POST" action="{{ route('create-user') }}" autocomplete="off">

		@if(count($errors))

			<div class="alert alert-danger">

				<strong>Whoops!</strong> There were some problems with your input.

				<br/>

				<ul>

					@foreach($errors->all() as $error)

					<li>{{ $error }}</li>

					@endforeach

				</ul>

			</div>

		@endif


		<input type="hidden" name="_token" value="{{ csrf_token() }}">


		<div class="row">

			<div class="col-md-6">

				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

					<input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">

					<span class="text-danger">{{ $errors->first('name') }}</span>

				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group">

					<button class="btn btn-success">Create New Item</button>

				</div>

			</div>

		</div>

	</form>


	<div class="panel panel-primary">

	  <div class="panel-heading">Item management</div>

	  <div class="panel-body">

	    	<form method="GET" action="{{ route('user-lists') }}">


				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<input type="text" name="namesearch" class="form-control" placeholder="Enter Name For Search" value="{{ old('namesearch') }}">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<button class="btn btn-success">Search</button>

						</div>

					</div>

				</div>

			</form>


			<table class="table table-bordered">

				<thead>

					<th>Id</th>

					<th>Name</th>

					<th>Creation Date</th>

					<th>Updated Date</th>

				</thead>

				<tbody>

					@if($users->count())

						@foreach($users as $key => $user)

							<tr>

								<td>{{ ++$key }}</td>

								<td>{{ $user->name }}</td>

								<td>{{ $user->created_at }}</td>

								<td>{{ $user->updated_at }}</td>

							</tr>

						@endforeach

					@else

						<tr>

							<td colspan="4">There are no data.</td>

						</tr>

					@endif

				</tbody>

			</table>

			{{ $users->links() }}

	  </div>

	</div>


</div>
@endsection
