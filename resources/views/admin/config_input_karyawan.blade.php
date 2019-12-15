@extends('layouts.app')

@section('content')
<div class="container">
	@if ($message1 = Session::get('success1'))
        <div class="alert alert-success alert-block">
        	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message1 }}</strong>
        </div>
  @endif
  @if ($message2 = Session::get('success2'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message2 }}</strong>
        </div>
  @endif
  @if ($message3 = Session::get('success3'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message3 }}</strong>
        </div>
  @endif

  <form method="post" action="{{ route('store.karyawan_config') }}" class="text-center border border-light p-5">
    @csrf
    <div class="form-group">
      <label for="nama_department">Name Department:</label>
      <input type="text" class="form-control" id="nama_department" placeholder="Enter Nama Department" name="nama_department">

      <label for="nama_leveling">Name Leveling:</label>
      <input type="text" class="form-control" id="nama_leveling" placeholder="Enter Nama Leveling" name="nama_leveling">

      <label for="nama_status">Name Status Employee:</label>
      <input type="text" class="form-control" id="nama_status" placeholder="Enter Nama Status Karyawan" name="nama_status">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
