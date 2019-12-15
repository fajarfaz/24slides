@extends('layouts.app')
@section('content')

<div class="container">
<div class="container-fluid">
 <h4 class="bd-title">Shift Report</h4>
  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
<form method="GET" id="form-report">
	<div class="bd-example" style="margin-bottom: 30px;">
	  	<div class="form-group col-md-8">
	  	<label for="nama">Karyawan</label>
		<select class="form-control" name="id" id="karyawan" onchange="form = document.getElementById('form-report').submit();">
			<option value="semua">Choose one</option>
			@foreach($karyawans as $data)
			  <option value="{{ $data->id }}" @if(request()->get('id') == $data->id) selected @endif>{{ $data->nama }}</option>
			@endforeach
		</select>
		</div>
	</div>	
</form>
<div class="bd-example">
    <div class="table-responsive">
    	 <div id="toolbar">

            </div>
		<table
            id="table"
            data-locale="en-US"
            class="table table-striped"
            data-show-refresh="true"
            data-show-toggle="true"               
            data-show-columns="true"
            data-show-export="true"
            data-click-to-select="true"
            data-toggle="table"
            data-search="true"
            data-page-list="[10, 25, 50, 100, all]"
            data-show-pagination-switch="true"
            data-pagination="true"
            data-minimum-count-columns="2"
            data-response-handler="responseHandler"  
            data-export-options='{"fileName": "24Slides- Salary Report"}'
            data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
		<th class="text-center col-md-1" data-sortable="true">No</th>
		<th class="text-center">Nama Shift</th>
		<th class="text-center">Tanggal</th>
		<th class="text-center">Status</th>
	</thead>
	<tbody>
		@php $i = 1 @endphp
		@if($karyawan != null)
			@foreach($karyawan->jadwal as $jadwal)
			<tr>
				<td>{{$i++}}</td>
				<td>{{$jadwal->aktif->name}}</td>
				<td>{{$jadwal->tanggal}}</td>
				<td>@if($jadwal->absen != null && $jadwal->absen->kode != 'L') Sesuai @else Tidak sesuai @endif</td>
			</tr>
			@endforeach
		@else
			<!-- <tr><td colspan="4">Empty data</td></tr> -->
		@endif
	</tbody>
</table>
</div></div>
</div></div>
@endsection