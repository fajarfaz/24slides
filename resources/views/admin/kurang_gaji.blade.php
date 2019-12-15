<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Import data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('store.kurang_gaji') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            
            <div class="col-md-12">
                   <input type="file" name="file" class="form-control" style="padding:0px;margin-top: 20px;"> <br>
                  Format excel for import Deductions Salary Employee
                  <a href="{{ asset('format/pengurangangaji.xlsx') }}" class="badge badge-info">Download Format</a>
            </div>
            <br>
          
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success">Import Data</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Deductions Salary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('store.kurang_gaji')}}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="form-group">
    
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Name Employee</label>
                  <select class="form-control" id="nama_karyawan" name="karyawans_id">
                    @foreach($karyawans as $karyawan)
                      <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Detail</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="detail">
                    <option value="Loant">Loant</option>
                    <option value="Absent">Absent</option>
                    <option value="BPJS TK">BPJS TK</option>
                    <option value="BPJS Kesehatan">Health BPJS</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Nominal</label>
                  <input type="text" name="nominal" class="form-control" id="formGroupExampleInput2" placeholder="Format Rupiah/IDR">
                </div>
            </div>
            <br>
          
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Deductions Salary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update.kurang_gaji')}}" method="POST">
      @csrf
      @method('PATCH')
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
          <div class="form-group">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Employee Name </label>
                  <input type="hidden" name="karyawans_id" id="karyawan">
                  <input type="text" name="nama-karyawan" id="nama" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Detail</label>
                  <select class="form-control" id="detail" name="detail">
                    <option value="Loant">Loant</option>
                    <option value="Absent">Absent</option>
                    <option value="BPJS TK">BPJS TK</option>
                    <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Nominal(Rp/IDR)</label>
                  <input type="text" class="form-control" placeholder="Format Rupiah/IDR" id="nominal" name="nominal">
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
<div class="container-fluid">
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
    <h4 class="bd-title">Deductions Salary For : {{ Carbon\Carbon::now()->format('F Y') }}</h4>
    <small id="emailHelp" class="form-text text-muted">List detail deductions salary employee.</small><br>
    <div class="bd-example">
        <div class="table-responsive">
             <div id="toolbar">
               <button type="button" class="btn btn-success btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever=""><i class="fa fa-plus"></i> Import Data</button>
               <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#adddata" data-whatever=""><i class="fa fa-plus"></i> Add Data</button>

            </div>
            <table
                id="table"
                data-show-refresh="true"
                data-show-toggle="true"
                class="table table-stripe"
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
                data-export-options='{"fileName": "24Slides-Deductions Salary"}'
                data-export-types= "['excel','doc', 'txt']">
                <thead class="thead-dark">
                    <tr>
                      <th data-sortable="true" class="col-md-1 text-center">No.</th>
                      <th data-sortable="true" class="text-center">Employee</th>
                      <th class="text-center">Detail</th>
                      <th class="text-center">Nominal</th>
                      <th class="text-center col-md-2"></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i = 1;  ?>
                   @foreach($gajis as $gaji)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $gaji->karyawan->nama }}</td>
                      <td>{{ $gaji->detail }}</td>
                      <td>@rupiah($gaji->nominal)</td>
                      <td>
                         <div class="button-space">
                            <a class="edit btn btn-warning" href="#" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{ $gaji->id }}' ,'{{ $gaji->karyawan->id }}','{{ $gaji->nominal }}','{{ $gaji->karyawan->nama }}','{{ $gaji->detail }}')">
                            <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a class="remove btn btn-danger" href="{{route('delete.kurang_gaji',$gaji->id)}}" title="Remove" onclick=" return confirm('Delete this item?')">
                            <i class="fa fa-trash"></i>
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


<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body input').val(recipient)
  })

  function passData(id,karyawan,nominal,nama,detail){
    $('#id').val(id);
    $('#karyawan').val(karyawan);
    $('#nominal').val(nominal);
    $('#nama').val(nama);
    $('#detail').val(detail);
  }
</script>
@endsection