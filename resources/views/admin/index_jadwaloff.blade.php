<div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update.jadwal_off')}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="modal-body">
          <div class="form-group">
    
          <div class="col-md-12">
                <input type="hidden" id="id" name="id" class="form-control">
                <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control" >
                <div class="form-group">
                  <label>Employee Name</label>
                  <input type="text" id="nama" name="nama" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <input type="text" id="status" name="status" class="form-control">
                </div>
                <div class="form-group">
                  <label>Type</label>
                  <input type="text" id="jenis" name="jenis" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                    <label>Start Date</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" readonly="readonly">
                    </div>
                    <div class="col-md-6">
                    <label>End Date</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" readonly="readonly">
                    </div>
                  </div>
                </div>
               
                <div class="form-group">
                  <label>Duration (Days)</label>
                  <input type="number" id="durasi" name="durasi" class="form-control">
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
  <h4 class="bd-title">{{$judul}}</h4>
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
                data-export-options='{"fileName": "24Slides-Schedule Off"}'
                data-export-types= "['excel','doc', 'txt']">
        <thead  class="thead-dark">
          <tr>
            <th data-sortable="true" class="text-center col-md-1">No.</th>
            <th data-sortable="true" class="text-center">Employee</th>
            <th class="text-center">Start Date</th>
            <th class="text-center">Duration</th>
            <th class="text-center" data-visible="false">End Date</th>
            <th class="text-center">Status</th>
            <th class="text-center" data-sortable="true">Type</th>            
            <th class="text-center" data-visible="false">Filling Date</th>
            <th class="text-center col-md-2"></th>

          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          @foreach($jadwal_offs as $jadwal_off)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $jadwal_off->karyawan->nama }}</td>
              <td>{{ $jadwal_off->tanggal_mulai->format('d F Y') }}</td>
              <td>{{ $jadwal_off->durasi }}</td>
              <td>{{ $jadwal_off->tanggal_selesai->format('d F Y') }}</td>
              <td>{{ $jadwal_off->status }}</td>
              <td>{{ $jadwal_off->jenis }}</td>              
              <td>{{ $jadwal_off->created_at->format('d F Y') }}</td>
              <td>
                @unless($jadwal_off->status != "New Entry")
                <a class="edit btn btn-warning" href="#" title="Edit" data-toggle="modal" data-target="#editdata" onclick="passData('{{ $jadwal_off->id }}','{{ $jadwal_off->karyawan->nama }}','{{ $jadwal_off->status }}','{{ $jadwal_off->jenis }}','{{ $jadwal_off->tanggal_mulai->format("Y-m-d") }}','{{ $jadwal_off->tanggal_selesai->format("Y-m-d") }}','{{ $jadwal_off->karyawan->id }}','{{ $jadwal_off->durasi }}')">
                <i class="fa fa-pencil-square-o"></i>
                </a>
                @endunless
                <a class="remove btn btn-danger" href="{{ route('delete.jadwal_off',$jadwal_off->id) }}" title="Remove" onclick="return confirm('Delete Mutasi ini?')">
                <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
                <?php $i++; ?>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  </div>
</div>


<script>
  function passData(id,nama,status,jenis,tanggal_mulai,tanggal_selesai,id_karyawan,durasi){
    document.getElementById('id').value = id;
    document.getElementById('id_karyawan').value = id_karyawan;
    document.getElementById('nama').value = nama;
    document.getElementById('status').value = status;
    document.getElementById('jenis').value = jenis;
    document.getElementById('tanggal_mulai').value = tanggal_mulai;
    document.getElementById('tanggal_selesai').value = tanggal_selesai;
    document.getElementById('durasi').value = durasi;
  }
</script>

@endsection