@extends('layouts.app')
@section('content')
<div class="container">
<div class="container-fluid">
  	@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
      	<button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
      </div>
    @endif
     @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<h4 class="bd-title">Mutation Form</h4>
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
    <form method="post" action="{{ route('store.mutasi',$karyawan->id) }}" >
      @csrf
    <div class="bd-example">
      <div class="form-group">
        <label for="nama">Employee Name</label>
        <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" readonly="readonly">
      </div>  
      
      <div class="form-group">
        <label for="role-before">Previous Role </label>
        <input type="text" name="role-before" class="form-control" value="{{ $karyawan->jabatan }}" readonly="readonly">
      </div>  
      <div class="form-group">
        <label for="level-before">Previous Lavel</label>
        <input type="text" name="level-before" class="form-control" value="{{ $karyawan->leveling->name }}" readonly="">
      </div>  
      <div class="form-group">
        <label for="status">Type</label>
        <select class="form-control" name="status">
          <option>Promotion</option>
          <option>Mutation</option>
          <option>Demotion</option>
        </select>
      </div>  
      <div class="form-group">
        <label for="jabatan">New Role</label>
        <input type="text" required name="jabatan" class="form-control" value="{{ old('jabatan') }}" placeholder="isi Jabatan baru">
      </div>  
      <div class="form-group">
        <label for="level_id">Level</label>
        <select name="level_id" class="form-control">
          @foreach($levelings as $level)
            <option value="{{ $level->id }}">{{ $level->name }}</option>
          @endforeach
        </select>
      </div>  
      <div class="form-group">
        <label for="tanggal_masuk">New Role Active</label>
        <input type="date" required name="tanggal_masuk" class="form-control" value="{{ $karyawan->tanggal_masuk }}">
      </div>  
      <div class="form-group">
        <label for="adjustments">Adjustments</label>
        <input type="text" required name="adjustments" class="form-control">
      </div>  
      <button type="submit" class="btn btn-success" style="padding: 7px 50px;margin-top: 15px;">Save</button>
    </div>
    </form>
    </div>
  </div>

@endsection
