@extends('layouts.app')
@section('content')
<div class="container">
<div class="container-fluid">
<h4 class="bd-title">Allowances Report</h4>
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
<div class="bd-example" style="margin-bottom: 30px;">
	 <div class="form-group col-md-8">
	  	<label for="nama">Karyawan</label>
		<select class="form-control" name="karyawan_id" id="karyawan" onchange="getKaryawan()">
			<option value="semua">Choose one</option>
			@foreach($karyawans as $data)
			  <option value="{{ $data->id }}" @if(request()->get('id') == $data->id) selected @endif>{{ $data->nama }}</option>
			@endforeach
		</select>
</div></div>
  <div class="card" >
  <div class="card-body">
    <h5 class="card-title">Allowances Report - {{Carbon\Carbon::now()->format('F Y')}}</h5>

	@unless($karyawan == null)
	<div class="row">
		<div class="col-md-6">
			Allowances Salary <br>
			@foreach($gaji->penambahan_gaji as $tambah)
				{{$tambah->detail}} : @rupiah($tambah->nominal)<br>
			@endforeach
		</div>
	</div>
	@endunless
</div></div>
</div></div>
<script type="text/javascript">
	function getKaryawan(){
	    var pilih = document.getElementById('karyawan').value;
	    if (pilih != 'semua') {
	      window.location = '{{route("admin.report.penambahan")}}?id='+pilih;
	    }
	    else{
	      window.location = '{{route("admin.report.penambahan")}}';
	    }
	  }
</script>
@endsection