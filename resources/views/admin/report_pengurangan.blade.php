@extends('layouts.app')
@section('content')

<div class="container">
<div class="container-fluid">
<h4 class="bd-title">Deduction Report</h4>
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
  	   <h5 class="card-title">Deduction Report - {{Carbon\Carbon::now()->format('F Y')}}</h5>
	@unless($karyawan == null)
		<div class="col-md-6">
			Deduction Salary <br>
			@foreach($gaji->pengurangan_gaji as $kurang)
				{{$kurang->detail}} : @rupiah($kurang->nominal)<br>
			@endforeach
		</div>
	</div>
	@endunless
</div>
</div></div>
<script type="text/javascript">
	function getKaryawan(){
	    var pilih = document.getElementById('karyawan').value;
	    if (pilih != 'semua') {
	      window.location = '{{route("admin.report.pengurangan")}}?id='+pilih;
	    }
	    else{
	      window.location = '{{route("admin.report.pengurangan")}}';
	    }
	  }
</script>
@endsection