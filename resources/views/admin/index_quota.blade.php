 <!-- Modal -->
<div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Quota </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('admin.update.quota')}}" id="form-edit" method="post">
      @csrf
      <div class="modal-body">
        <input type="hidden" name="id_karyawan" id="id_karyawan">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Leave Quota (Old) :</label>
          <input type="text" name="quota_cuti_lama" class="form-control" id="quota_cuti_lama" readonly>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Leave Quota (New):</label>
          <input type="number" name="quota_cuti" class="form-control" id="quota_cuti" required="required">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-warning" name="submit" value="Update">
        </div>
        
      </div>
      </form>
    </div>
  </div>
</div>
@extends('layouts.app')
@section('content')
 <!-- Table -->
  <link href="{{ asset('bootstrap/table/bootstrap-table.min.css') }}"  rel="stylesheet">
  <script src="{{ asset('bootstrap/table/tableExport.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table-locale-all.min.js') }}"></script>
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
          <button type="button" class="close" data-dismiss="alert">×</button>s
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="container-fluid">
  <h4 class="bd-title">Leave Quota</h4>
  <small id="emailHelp" class="form-text text-muted">Annual leave quota.</small><br>
  <div class="bd-example">
    <div class="table-responsive">
    
      <table
        id="table"
        class="table table-striped"
        data-locale="en-US"
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
        data-show-columns="true"
        data-response-handler="responseHandler"
        data-export-options='{"fileName": "24Slides-Leave Quota"}'
        data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th data-sortable="true" class="text-center col-md-1" >No.</th>
            <th data-sortable="true" class="text-center">Name</th>
            <th data-sortable="true" class="text-center">Leave Quota</th>
            <th data-sortable="true" class="text-center">Remaining Leave Quota</th>
            <th class="text-center col-md-1">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;  ?>
          @foreach($karyawans as $karyawan)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $karyawan->nama }}</td>
              <td>{{ $karyawan->quota_cuti }}</td>
              <td>{{ $karyawan->sisa_quota_cuti }}</td>
              <td>
                <div class="button-space">
                <a class="btn btn-warning" href="#" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{ $karyawan->id }}','{{ $karyawan->nama }}','{{ $karyawan->quota_cuti }}')"> <i class="fa fa-pencil-square-o"></i>
                </a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  </div>
</div>
<div id="txtHint"></div>
<script>
  function passData(id,nama,quota){
    document.getElementById('exampleModalLabel').textContent = "Quota Cuti "+nama;
    document.getElementById('id_karyawan').value = id;
    document.getElementById('quota_cuti_lama').value = quota;
  }

</script>
@endsection