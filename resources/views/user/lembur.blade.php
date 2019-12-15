@extends('layouts.app2')
@section('content')
<style type="text/css">
  .dropdown-menu{
    color: #f4f4f4;
  }
  .datetimepicker table tr td.day:hover{
    color:black;
    font-weight: 600;
  }
  .datetimepicker thead tr:first-child th:hover, .datetimepicker tfoot th:hover{
    background:#eee;
    color:#140560;
    font-weight: 600;
  }
  .datetimepicker table tr td span:hover{
    background:#eee;
    color:#140560;
    font-weight: 600;
  }
  .datetimepicker{
    padding: 10px;
  }
  .datetimepicker td, .datetimepicker th{
    font-weight: 600;
  }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Overtime</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('storek.lembur') }}" method="POST">

      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="mulai_lembur" class="col-form-label">Start Overtime</label>
            <div class="input-append date form_datetime" data-date="2019-02-21T15:25:00Z">
              <input size="16" class="form-control" type="text" name="mulai_lembur" id="mulai_lembur" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}" readonly required="required" onchange="getDurasi()">
              <span class="add-on"><i class="icon-remove"></i></span>
              <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
          </div>
          <div class="form-group">
            <label for="selesai_lembur" class="col-form-label">End Overtime</label>
            <div class="input-append date form_datetime" data-date="2019-02-21T15:25:00Z">
              <input size="16" class="form-control" type="text" name="selesai_lembur" id="selesai_lembur" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}" readonly required="required" onchange="getDurasi()">
              <span class="add-on"><i class="icon-remove"></i></span>
              <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
          </div>
          <div class="form-group">
            <label for="durasi" class="col-form-label">How Many Hours (Hours / Use Decimal)</label>
            <input type="text" name="durasi" class="form-control" id="durasi" required="required" readonly>
          </div>
          <div class="form-group">
            <label for="detail" class="col-form-label">Details</label>
            <input type="text" name="detail" class="form-control" id="detail" required="required">
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Overtime Status</label>
            <input type="text" name="status" class="form-control" id="status" required="required" value="New Entry" readonly>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Overtime Submit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('karyawan.lembur.update') }}" method="POST">
      <div class="modal-body">
          @csrf
          @method('PUT')
          <input type="hidden" name="lembur_id" id="lembur_id">
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
            <label for="durasi" class="col-form-label">How Many Hours (Hours/Use Decimal)</label>
            <input type="text" name="durasi" class="form-control" id="E_durasi" required="required" readonly>
          </div>
          <div class="form-group">
            <label for="detail" class="col-form-label">Details</label>
            <input type="text" name="detail" class="form-control" id="E_detail" required="required">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>

 <!-- Table -->
 <link href="{{ asset('bootstrap/table/bootstrap-table.min.css') }}"  rel="stylesheet">
  <script src="{{ asset('bootstrap/table/tableExport.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table-locale-all.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table-export.min.js') }}"></script>

  <script type="text/javascript">document.getElementById('fixed-table-container fixed-height has-footer').setAttribute("style","width:500px");</script>
   <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "dd MM yyyy - hh:ii",
            autoclose: true,
            todayBtn: true,
            startDate: "2013-02-14 10:00",
            minuteStep: 10
        });
    </script> 
    <link href="{{ asset('bootstrap/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap-datetimepicker.fr.js') }}" charset="UTF-8"></script>

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>     
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
    <div class="container-fluid">
     
    	<h5 class="jdl-c">Overtime List</h5>
    	
    	<div class="bd-example">
    		<div class="table-responsive">   		  
    			
        <div class="table-responsive text-nowrap">    
           <div id="toolbar">
             <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-plus"></i><b> Overtime</b></button>

          </div>  
    			<table
    			  id="table"
            class="table-striped"
            data-locale="en-US"
            data-show-refresh="true"
            data-show-toggle="true"
            data-show-fullscreen="true"
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
            data-export-options='{"fileName": "24Slides-list Overtime "}'
            data-export-types= "['excel','doc', 'txt']">
            <thead class="thead-dark" style="height: 40px;">
              <tr>
                <th data-sortable="true" class="col-md-1 text-center">No.</th>
                <th class="text-center col-md-2">Start Overtime</th>
                <th class="text-center col-md-2">End Overtime</th>
                <th class="text-center">Duration</th>
                <th class="text-center col-md-2" data-visible="false">Details</th>
                <th class="text-center">Status</th>
                <th class="text-center" >Submit Date</th>
                <th class="col-md-2"></th>
              </tr>
            </thead>
            <tbody >
              <?php $i = 1; ?>
              @foreach($lembur as $data)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $data->mulai_lembur->format('H:i, d F Y') }}</td>
                  <td>{{ $data->selesai_lembur->format('H:i, d F Y') }}</td>
                  <td>{{ $data->durasi }} Jam</td>
                  <td style="white-space: normal;">{{ $data->detail }}</td>
                  <td><b> {{ $data->status }}</td>
                  <td class="text-right">{{ $data->created_at->format('H:i, d F Y') }}</td>
                  <td>
                    <div class="button-space">
                    <form class="form-inline" id="delete-form" action="{{ route('karyawan.lembur.destroy',$data->id) }}" method="POST">
                    @csrf  
                    @method('DELETE')
                    @unless($data->status != 'New Entry') 
                      <button type="button" onclick="getEdit('{{$data->id}}','{{$data->mulai_lembur}}','{{$data->selesai_lembur}}','{{$data->durasi}}','{{$data->detail}}')" class="btn btn-warning " data-toggle="modal" data-target="#edit-modal" data-whatever="@getbootstrap" style="margin-right: 4px;"><i class="fa fa-pencil-square-o"></i></button>
                    @endunless
                    <button type="submit" class="btn btn-danger" name="destroy" onclick="return confirm('Delete Pengajuan Lembur Tanggal {{ $data->created_at->format('d F Y') }} ?');"><i class="fa fa-trash"></i></button>
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
</div>


<script>
  function getDurasi() {
    var mulai = new Date(document.getElementById('mulai_lembur').value);
    alert
    var selesai = new Date(document.getElementById('selesai_lembur').value);
    var durasi = (selesai.getTime() - mulai.getTime()) / 1000;
    durasi /= (60 * 60);
    
    document.getElementById('durasi').value = durasi.toFixed(2);
  }
  function EditgetDurasi() {
    var mulai = new Date(document.getElementById('E_mulai_lembur').value);
    alert
    var selesai = new Date(document.getElementById('E_selesai_lembur').value);
    var durasi = (selesai.getTime() - mulai.getTime()) / 1000;
    durasi /= (60 * 60);
    
    document.getElementById('E_durasi').value = durasi.toFixed(2);
  }
  function getEdit(id,mulai,selesai,durasi,detail){
    $('#lembur_id').val(id);
    $('#E_mulai_lembur').val(mulai);
    $('#E_selesai_lembur').val(selesai);
    $('#E_durasi').val(durasi);
    $('#E_detail').val(detail);
  }
</script>
@endsection