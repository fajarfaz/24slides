@extends('layouts.app')

@section('content')
<div class="container">
	@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

  <form method="post" action="{{ route('update.department',$department->id) }}" class="text-center border border-light p-5">
    @method('PATCH')
    @csrf
    <div class="form-group">
      <label for="name">Department Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Nama Department" name="name" value="{{ $department->name }}">
    </div>
    <div class="form-group">
      <label for="users_id">Department Leader:</label>
        <select name="users_id" class="form-control">
          @foreach($users as $user)
            <option value="{{ $user->id }}" @unless($user->id != $department->users_id) selected  @endunless>{{ $user->name }}</option>
          @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
