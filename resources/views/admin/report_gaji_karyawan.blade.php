@extends('layouts.app')
@section('content')
<style type="text/css">
	p{
		font-size: .9em;
		font-weight: 500;
		color: black;
		margin-bottom: 0px;
	}
	.card-pt{

	}
</style>
@php
	$get_bulan = app('request')->input('bulan');
	$get_tahun = app('request')->input('tahun');
	if($get_bulan == null || $get_bulan == 'semua'){
		$get_bulan = Carbon\Carbon::now()->month;
	}
	if($get_tahun == null || $get_tahun == 'semua'){
		$get_tahun = Carbon\Carbon::now()->year;
	}
	if($gaji != null){
	$salary_role = $gaji->penambahan_gaji->where('detail','Salary Role')->first();
	}
	else{
	$salary_role = null;
	}
@endphp
<div class="container">
	@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="container-fluid">
	<h4 class="bd-title">Pelaporan Gaji per Karyawan </h4>
  	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
  	<form method="GET" id="form-report">
  	<div class="bd-example" style="margin-bottom: 30px;">
	  	<div class="form-group col-md-8">
	  	<label for="nama">Employee Name</label>
		<select class="form-control" name="id" id="karyawan" onchange="getKaryawan()">
			<option value="semua">Choose one</option>
			@foreach($karyawans as $data)
			  <option value="{{ $data->id }}" @if(request()->get('id') == $data->id) selected @endif>{{ $data->nama }}</option>
			@endforeach
		</select>
	  	<label for="nama">Month</label>
		<select class="form-control" name="bulan" id="bulan" onchange="getKaryawan()">
			<option value="semua">Choose one</option>
			@foreach(range(Carbon\Carbon::now()->month, 1) as $bulan)
			  <option value="{{ $bulan }}" @if(request()->get('bulan') == $bulan) selected @endif>{{ date("F", mktime(0, 0, 0, $bulan, 1)) }}</option>
			@endforeach
		</select>
	  	<label for="tahun">Year</label>
		<select class="form-control" name="tahun" id="tahun" onchange="getKaryawan()">
			<option value="semua">Choose one</option>
			@foreach(range(Carbon\Carbon::now()->year, 2010) as $tahun)
			  <option value="{{ $tahun }}" @if(request()->get('tahun') == $tahun) selected @endif>{{$tahun}}</option>
			@endforeach
		</select>
		</div>
	</div>	
  	</form>
  <div class="card" >
  <div class="card-body">
    <h5 class="card-title">Salary Slip - {{Carbon\Carbon::create()->month($get_bulan)->format('F')}} {{Carbon\Carbon::create()->year($get_tahun)->format('Y')}}</h5>
    @if($karyawan != null)
    <h6 class="card-subtitle mb-2 text-muted">{{$karyawan->nama}} - {{$karyawan->jabatan}}</h6>
    <br>
    <p class="card-text" >Base Salary : @rupiah($karyawan->base_salary)</p>
    <p class="card-text" >Kota Malang Umr : @rupiah(2100000)</p>
    <p class="card-text" >Salary Role : @unless($salary_role == null)@rupiah($salary_role->nominal) @endunless</p>
    <p class="card-text" >Total : @unless($gaji == null) @rupiah($gaji->total) @endunless</p><br>

   
    <p class="card-text card-pt">Penambahan Gaji </p>  
    <p class="card-text" style="margin-left: 10px;">@unless($gaji == null) @foreach($gaji->penambahan_gaji as $tambah)
				{{$tambah->detail}}  : @rupiah($tambah->nominal)<br>
			@endforeach @endunless</p><br>
    <p class="card-text card-pt">Pengurangan Gaji </p>   
    <p class="card-text" style="margin-left: 10px;">@unless($gaji == null) @foreach($gaji->pengurangan_gaji as $kurang)
				{{$kurang->detail}} : @rupiah($kurang->nominal)<br>
			@endforeach @endunless</p><br>
	<p class="card-text card-pt" >Traser Amount : @unless($gaji == null) {{$gaji->created_at->format('d F Y')}} @endunless</p>
    <p class="card-text" >Transfer to {{$karyawan->no_rek}}</p>
   	@endif
  </div>
	</div>

</div>

</div>
<script type="text/javascript">
	function getKaryawan(){
		var form = document.getElementById("form-report");
	    var pilih = document.getElementById('karyawan').value;
	    if (pilih != 'semua') {
	      form.submit();
	    }
	    else{
	      window.location = '{{route("admin.report.gaji_karyawan")}}';
	    }
	  }
</script>
@endsection