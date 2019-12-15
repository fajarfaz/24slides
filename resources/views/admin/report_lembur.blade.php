@extends('layouts.app')

@section('content')

@php
	$get_bulan = app('request')->input('bulan');
	$get_tahun = app('request')->input('tahun');
	if($get_bulan == null || $get_bulan == 'semua'){
		$get_bulan = Carbon\Carbon::now()->month;
	}
	if($get_tahun == null || $get_tahun == 'semua'){
		$get_tahun = Carbon\Carbon::now()->year;
	}
@endphp
	<form method="GET" id="form-report">
  	<div class="bd-example" style="margin-bottom: 30px;">
	  	<div class="form-group col-md-8">
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
  	<h1>Jumlah Lembur Karyawan {{Carbon\Carbon::create()->month($get_bulan)->format('F')}} {{Carbon\Carbon::create()->year($get_tahun)->format('Y')}}</h1>
	<table>
		<thead>
			<th>No</th>
			<th>Nama Karyawan</th>
			<th>Jumlah Lembur</th>
		</thead>
		<tbody>
			@php $i = 1; @endphp
			@foreach($karyawan as $data)
			<tr>
				<td>{{$i++}}</td>
				<td>{{$data->nama}}</td>
				<td>{{$data->durasi_lembur($r_bulan,$r_tahun)->sum('durasi')}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

<script type="text/javascript">
	function getKaryawan(){
		var form = document.getElementById("form-report");
	    var bulan = document.getElementById('bulan').value;
	    var tahun = document.getElementById('tahun').value;
	    if (bulan != 'semua' || tahun != 'semua') {
	      form.submit();
	    }
	    else{
	      window.location = '{{route("admin.report.lembur")}}';
	    }
	  }
</script>
@endsection