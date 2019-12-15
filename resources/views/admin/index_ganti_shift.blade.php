@extends('layouts.app')
@section('content')
 <!-- Table -->
  <link href="{{ asset('bootstrap/table/bootstrap-table.min.css') }}"  rel="stylesheet">
  <script src="{{ asset('bootstrap/table/tableExport.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table-export.min.js') }}"></script>

  <script type="text/javascript">document.getElementById('fixed-table-container fixed-height has-footer').setAttribute("style","width:500px");</script>
<style>
  .select,
  #locale {
    width: 100%;
  }
  .like {
    margin-right: 10px;
  }
 
 
</style>
<div class="container">
@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
@endif
<div class="container-fluid">
  <h4 class="bd-title">Mutasi</h4>
  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
  <div class="bd-example">
    <div class="table-responsive">
      <table
                id="table"
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
                data-export-options='{"fileName": "24Slides-Employee Active Schedule"}'
                data-export-types= "['excel','doc', 'txt']">
        <thead>
          <tr>
            <th data-sortable="true">No</th>
            <th>Karyawan</th>
            <th>Karyawan Pengganti</th>
            <th data-sortable="true">Tanggal</th>
            <th>Shift awal</th>
            <th>Shift ganti</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          @foreach($ganti_shift as $data)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $data->karyawan->nama }}</td>
              <td>
                @if($data->id_pengganti == null)
                  Tanpa Pengganti
                @else
                  {{$data->karyawan_pengganti->nama}}
                @endif
              </td>
              <td>{{ $data->tanggal }}</td>
              <td>{{ $data->jadwal_awal->name }}</td>
              <td>{{ $data->jadwal_baru->name }}</td>
            </tr>
                <?php $i++; ?>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  </div>
</div>

@endsection