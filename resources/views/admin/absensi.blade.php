<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Working Hours From Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('import.absen') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
          
            <div class="col-md-12">
                <input type="file" name="file" class="form-control" style="padding:0px;margin-top: 20px;"> <br>
                Excel format for import Working Hours
                  <a href="{{ asset('format/jamkerja.xlsx') }}" class="badge badge-info">Download Format</a>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-success">Import</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Working Hours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('store.absen') }}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="form-group">
    
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Name Employee</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">
                    @foreach($karyawan as $kary)
                      <option value="{{ $kary->id }}">{{ $kary->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Date</label>
                  <select name="tanggal" class="form-control" id="exampleFormControlSelect1">
                    @for ($i = 1; $i <= Carbon\Carbon::now()->daysInMonth; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Check-in</label>
                  <input type="time" name="jam_masuk" class="form-control" format='hh:mm'>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Check-out</label>
                  <input type="time" name="jam_keluar" class="form-control" format='hh:mm'>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Working Hours</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('admin.update.absen')}}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-body">
          <div class="form-group">
          <input type="hidden" name="id_absensi" id="id_absensi">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Name</label>
                  <input type="text" id="nama_karyawan" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Shift</label>
                  <input type="text" id="shift" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Date</label>
                  <input type="text" id="tanggal" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Status</label>
                  <select name="kode" class="form-control" id="kode">
                    <option value="E">Early</option>
                    <option value="V">Ontime</option>
                    <option value="L">Late</option>
                    <option value="A">Absent</option>
                    <option value="Vr">Remote work</option>
                    <option value="I">Ijin</option>
                  </select>
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
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="container">
<div class="container-fluid">
    <h4 class="bd-title">Working Hours Recapitulation</h4>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
    <div class="bd-example">
        <div class="table-responsive">
    

             <div id="toolbar">
               <button type="button" class="btn btn-success btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever=""><i class="fa fa-plus"></i> Import Data</button>
               <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#adddata" data-whatever=""><i class="fa fa-plus"></i> Add Data</button>

            </div>
            <table
            id="table"
            class="table table-stripe"
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
            data-export-options='{"fileName": "24Slides-Working Hours Recapitulation "}'
            data-export-types= "['excel','doc', 'txt']">
              <thead class="thead-dark">
                    <tr>
                      <th data-sortable="true" class="col-md-1 text-center">No.</th>
                      <th class="text-center" data-sortable="true">Employee</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Shift</th>
                      <th class="text-center">Status</th>
                      <th class="text-center col-md-2"></th>
                    </tr>
              </thead>
                <tbody>
                  <?php $i = 1;  ?>
                   @foreach($absensi as $absen)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $absen->karyawan->nama }}</td>
                      <td>{{ $absen->jadwal->tanggal }}</td>
                      <td>{{ $absen->jadwal->aktif->name }}</td>
                      <td>
                        @if($absen->kode == 'E')
                          Early
                        @elseif($absen->kode == 'V')
                          Ontime
                        @elseif($absen->kode == 'L')
                          Late
                        @elseif($absen->kode == 'A')
                          Absent
                        @elseif($absen->kode == 'Vr')
                          Remote work
                        @elseif($absen->kode == 'I')
                          Ijin
                        @endif
                      </td>
                       <td>
                         <div class="button-space">
                            <a class="edit btn btn-warning" href="#" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{$absen->id}}','{{$absen->karyawan->nama}}','{{$absen->jadwal->tanggal}}','{{ $absen->jadwal->aktif->name }}','{{$absen->kode}}')">
                            <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a class="remove btn btn-danger" href="{{route('admin.delete.absen',$absen->id)}}" title="Remove" onclick="">
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
 function passData(id,nama,tanggal,shift,kode){
  $('#id_absensi').val(id);
  $('#nama_karyawan').val(nama);
  $('#tanggal').val(tanggal);
  $('#shift').val(shift);
  $('#kode').val(kode);
 }
</script>
@endsection