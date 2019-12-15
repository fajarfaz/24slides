
<div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make a Mutation Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="POST">
  
      <div class="modal-body">
          <div class="form-group">
    
            <div class="col-md-12">
                
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Employee</label>
                  <select id="name" name="name" class="form-control" onchange="getMutasi(this)">
                  <option>Select Here</option>
                  @foreach($karyawan as $kary)
                    <option value="{{ $kary->id }}">{{ $kary->nama }}</option>
                  @endforeach
                </select>  
                </div>
            </div>
            <br>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a id="button" href="" class="btn btn-primary">Make a Mutation Letter</a>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Mutation Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update.mutasi')}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="modal-body">
          <div class="form-group">
    
            <div class="col-md-12">
                <input type="hidden" id="id" name="id" class="form-control">
                <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control">
                <div class="form-group">
                  <label>Employee Name</label>
                  <input type="text" id="nama" name="nama" class="form-control">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <input type="text" id="status" name="status" class="form-control">
                </div>
                <div class="form-group">
                  <label>Date</label>
                  <input type="date" id="tanggal" name="tanggal" class="form-control">
                </div>
              
            </div>
            <br>
          
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-warning">Update</button>
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
<script>
$(function () {
  var nua = navigator.userAgent
  var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
  if (isAndroid) {
    $('select.form-control').removeClass('form-control').css('width', '100%')
  }
})
</script>
<div class="container">
  @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="container-fluid">
  <h4 class="bd-title">Mutation</h4>
  <small id="emailHelp" class="form-text text-muted">Mutation letter for employee.</small><br>
  <div class="bd-example">
    <div class="table-responsive">

        <div id="toolbar">
              
               <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#adddata" data-whatever=""><i class="fa fa-plus"></i> Create Mutation Letter</button>

            </div>
        <table
        id="table"
        class="table table-striped "
        data-locale="en-US"
        data-show-refresh="true"
        data-show-toggle="true"        
        data-show-columns="true"        
        data-show-export="true"
        data-click-to-select="true"
        data-toggle="table"
        data-search="true"
        data-detail-formatter="detailFormatter"
        data-page-list="[10, 25, 50, 100, all]"
        data-show-pagination-switch="true"
        data-pagination="true"
        data-minimum-count-columns="3"
        data-response-handler="responseHandler"
        data-export-options='{"fileName": "24Slides-Mutation Data"}'
        data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th data-sortable="true" class="col-md-1 text-center">No.</th>
            <th data-sortable="true" class="text-center">Employee</th>
            <th class="text-center">Status</th>
            <th data-sortable="true" class="text-center">Date</th>
            <th class="text-center col-md-1"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;  ?>
          @foreach($mutasi as $data)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $data->karyawan->nama }}</td>
              <td>{{ $data->status }}</td>
              <td>{{ $data->tanggal }}</td>
              <td>
                  <div class="button-space">
                <button class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{ $data->id }}','{{ $data->karyawan->nama }}','{{ $data->status }}','{{ $data->tanggal }}','{{ $data->karyawan->id }}')"> <i class="fa fa-pencil-square-o"></i></button>  
                
                <button class="remove btn btn-danger" title="Remove" onclick="if(confirm('Delete Mutasi {{ $data->id }} ?')){window.location='{{route('delete.status',$data->id)}}'}">
                  <i class="fa fa-trash"></i>
                </button>
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


<script>
  function getMutasi(cek) {
    var button = document.getElementById('button');
    var name = document.getElementById('name');      
      button.href = "mutasi/"+name.value;
  }
  function passData(id,nama,status,tanggal,id_karyawan){
    document.getElementById('id').value = id;
    document.getElementById('id_karyawan').value = id_karyawan;
    document.getElementById('nama').value = nama;
    document.getElementById('status').value = status;
    document.getElementById('tanggal').value = tanggal;
  }

</script>

@endsection