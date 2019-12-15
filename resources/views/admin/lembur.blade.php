
<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Submit Overtime</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.lembur.update') }}" method="POST">
      <div class="modal-body">
          @csrf
          @method('PUT')
          <input type="hidden" name="lembur_id" id="lembur_id">
          <input type="hidden" name="karyawans_id" id="karyawans_id">
          <div class="form-group">
            <label for="detail" class="col-form-label">Name Employee</label>
            <input type="text" name="karyawan" class="form-control" id="E_karyawan" required="required" readonly>
          </div>
          <div class="form-group">
            <label for="mulai_lembur" class="col-form-label">Start Overtime</label>
            <div class="input-append date form_datetime" data-date="2019-02-21T15:25:00Z">
              <input size="16" class="form-control" type="text" name="mulai_lembur" id="E_mulai_lembur" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}" readonly required="required" onchange="EditgetDurasi()">
              <span class="add-on"><i class="icon-remove"></i></span>
              <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
          </div>
          <div class="form-group">
            <label for="selesai_lembur" class="col-form-label">End Overtime</label>
            <div class="input-append date form_datetime" data-date="2019-02-21T15:25:00Z">
              <input size="16" class="form-control" type="text" name="selesai_lembur" id="E_selesai_lembur" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}" readonly required="required" onchange="EditgetDurasi()">
              <span class="add-on"><i class="icon-remove"></i></span>
              <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
          </div>
          <div class="form-group">
            <label for="durasi" class="col-form-label">Duration of incoming overtime (Hours)</label>
            <input type="text" name="durasi" class="form-control" id="E_durasi" required="required">
          </div>
          <div class="form-group">
            <label for="approve" class="col-form-label">Approve :</label>
            <select id="status" name="status" class="form-control">
              <option>Approved</option>
              <option>Overuled</option>
              <option>Denied</option>
              <option>Listed</option>
              <option>Paid</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>


@extends('layouts.app')
@section('content')
<!-- Modal -->


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
    	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
  @endif
  @if ($message = Session::get('error_lembur'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
      </div>
  @endif
  <div class="container-fluid">
    	<h4 class="bd-title">Overtime Data</h4>
    	<small id="emailHelp" class="form-text text-muted">Overtime list that has been submitted.</small><br>
    	<div class="bd-example">
    		<div class="table-responsive">
    			 <div id="toolbar">
          </div>
    			
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
                data-response-handler="responseHandler"
                data-export-options='{"fileName": "24Slides-Overtime Data"}'
                data-export-types= "['excel','doc', 'txt']">
         <thead class="thead-dark">
            <tr>
              <th class="text-center col-md-1" data-sortable="true">No.</th>
              <th class="text-center ">Name</th>
              <th class="text-center ">Start Overtime</th>
              <th class="text-center "  data-visible="false">End Overtime</th>
              <th class="text-center ">Duration</th>
              <th class="text-center " data-visible="false">Detail</th>
              <th class="text-center ">Status</th>
              <th class="text-center ">Submit Date</th>
              <th class="text-center col-md-2"></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @foreach($lemburs as $lembur)
            <tr>
              <td>{{$i}}</td>
              <td>{{$lembur->karyawan->nama}}</td>
              <td>{{$lembur->mulai_lembur->format('d F Y')}}</td>
              <td>{{$lembur->selesai_lembur->format('d F Y')}}</td>
              <td>{{$lembur->durasi}} Jam/Hours</td>
              <td>{{$lembur->detail}}</td>
              <td>{{$lembur->status}}</td>
              <td>{{$lembur->created_at->format('d F Y')}}</td>
              <td>
                <div class="button-space">
                <form class="form-inline" id="delete-form" action="{{ route('admin.lembur.destroy',$lembur->id) }}" method="POST">
                @csrf  
                @method('DELETE')
                @unless($lembur->approve == 1) 
                  <button type="button" onclick="getEdit('{{$lembur->id}}','{{$lembur->karyawan->id}}','{{$lembur->karyawan->nama}}','{{$lembur->mulai_lembur}}','{{$lembur->selesai_lembur}}','{{$lembur->durasi}}','{{$lembur->detail}}')" class="btn btn-warning" data-toggle="modal" data-target="#edit-modal" data-whatever="@getbootstrap" style="margin-right: 4px;"><i class="fa fa-pencil-square-o"></i></button>
                @endunless
                <button type="submit" class="btn btn-danger" name="destroy" onclick="return confirm('Delete Pengajuan Lembur Tanggal {{ $lembur->created_at->format('d F Y') }} ?');"> <i class="fa fa-trash"></i></button>
                </form>
              </div>
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
  function getDurasi() {
    var mulai = document.getElementById('mulai_lembur').value.substr(11, 5);
    var selesai = document.getElementById('selesai_lembur').value.substr(11, 5);
    var durasi = parseInt(selesai) - parseInt(mulai);

    document.getElementById('durasi').value = durasi;
  }
  function EditgetDurasi() {
    var mulai = new Date(document.getElementById('E_mulai_lembur').value);
    alert
    var selesai = new Date(document.getElementById('E_selesai_lembur').value);
    var durasi = (selesai.getTime() - mulai.getTime()) / 1000;
    durasi /= (60 * 60);
    
    document.getElementById('E_durasi').value = durasi.toFixed(2);
  }
  function getEdit(id,id_karyawan,karyawan,mulai,selesai,durasi,detail){
    $('#lembur_id').val(id);
    $('#karyawans_id').val(id_karyawan);
    $('#E_karyawan').val(karyawan);
    $('#E_mulai_lembur').val(mulai);
    $('#E_selesai_lembur').val(selesai);
    $('#E_durasi').val(durasi);
    $('#E_detail').val(detail);
  }
</script>
@endsection