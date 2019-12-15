<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Schedule From Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('import.jadwal') }}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <div class="col-md-12">

                <input type="file" name="file" class="form-control" style="padding:0px;margin-top: 20px;"> <br>
                 Format excel for import Employee Schedule
                  <a href="{{ asset('format/importjadwal.xlsx') }}" class="badge badge-info">Download Format</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('store.jadwal') }}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="form-group">
    
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Employee Name</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">
                    @foreach($karyawan as $kary)
                      <option value="{{ $kary->id }}">{{ $kary->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Date</label>
                  <select name="tanggal" class="form-control" id="exampleFormControlSelect1">
                    @for ($i = Carbon\Carbon::now()->format('j'); $i <= Carbon\Carbon::now()->daysInMonth; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Shift</label>
                  <select name="id_jadwal" class="form-control" id="exampleFormControlSelect1">
                   @foreach($shift as $sh)
                    <option value="{{ $sh->id }}">{{ $sh->name }}</option>
                   @endforeach
                  </select>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update.jadwal')}}" method="POST">
      @csrf
      @method("PATCH")
      <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id" id="id">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Employee Name</label>
                  <input type="text" name="nama" class="form-control" id="nama">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Initial Shift</label>
                  <input type="text" name="shift_lama" readonly="readonly" id="shift_lama" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">New Shift</label>
                  <select name="shift_baru" class="form-control" id="exampleFormControlSelect1">
                    @foreach($shift as $sh)
                      <option value="{{ $sh->id }}">{{ $sh->name }}</option>
                    @endforeach
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
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


<div class="container-fluid">
    <h4 class="bd-title">Employee Active Schedule</h4>
    <small id="emailHelp" class="form-text text-muted">Schedule for active employees.</small><br>
    <div class="bd-example">
        <div class="table-responsive">

            <div id="toolbar">
               <button type="button" class="btn btn-success btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever=""><i class="fa fa-plus"></i> Import Data</button>
               <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#adddata" data-whatever=""><i class="fa fa-plus"></i> Add Data</button>

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
                data-export-options='{"fileName": "24Slides-Employee Active Schedule"}'
                data-export-types= "['excel','doc', 'txt']">
                <thead class="thead-dark">
                    <tr>
                      <th class="text-center col-md-1 " data-sortable="true" >No.</th>
                      <th class="text-center">Date</th>
                      <th class="text-center" data-sortable="true">Employee</th>
                      <th class="text-center">Shift</th>
                      <th class="text-center" data-visible="false">Start Shift</th>
                      <th class="text-center" data-visible="false">End Shift</th>
                      <th class="text-center" data-visible="false">Detail Meal</th>
                      <th class="text-center" data-visible="false">Take Meal</th>
                      <th class="text-center col-md-2"></th>
                    </tr>
                </thead>
                <tbody>
                   <?php $i = 1;  ?>
                    @foreach($jadwal as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->karyawan->nama }}</td>
                            <td>{{ $item->aktif->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->aktif->jam_mulai)->format('H:i')}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->aktif->jam_selesai)->format('H:i')}}</td>
                            <td>@if($item->take_meal == 1) {{$item->aktif->meal->name}}  @else - @endif</td>
                            <td>@if($item->take_meal == 1) Ya  @else Tidak @endif</td>
                            <td>
                            <div class="button-space">                              
                            <button class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{ $item->id }}','{{ $item->karyawan->nama }}','{{ $item->aktif->name }}')"> <i class="fa fa-pencil-square-o"></i></button>                              
                             <button class="remove btn btn-danger" title="Remove" onclick="if(confirm('Delete Jadwal {{ $item->id }} ?')){window.location='{{route('delete.jadwal',$item->id)}}'}">
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

<script type="text/javascript">
 $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
})

 function passData(id,nama,shift){
    document.getElementById('id').value = id;
    document.getElementById('nama').value = nama;
    document.getElementById('shift_lama').value = shift;
  }
</script>
@endsection