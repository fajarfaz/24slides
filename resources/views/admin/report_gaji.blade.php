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
  <h4 class="bd-title">Salary Report</h4>
  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
  <div class="bd-example">
    <div class="table-responsive">

        <div id="toolbar">

            </div>
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
            data-export-options='{"fileName": "24Slides- Salary Report"}'
            data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th class="text-center col-md-1 " data-sortable="true">No</th>
            <th class="text-center">Nama karyawan</th>
            <th class="text-center" data-sortable="true">Jabatan</th>
            <th class="text-center">Gaji</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          @foreach($reports as $report)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$report->karyawan->nama}}</td>
              <td>{{$report->karyawan->jabatan}}</td>
              <td>@rupiah($report->total)</td>
            </tr>
          @endforeach
        </tbody>
        
        <tfoot>
          <tr>
            <th colspan="3">
              
            </th>
            <th>
              {{$total}}
            </th>
          </tr>
        </tfoot>
      </table>

    </div>
  </div>
  </div>
</div>
@endsection