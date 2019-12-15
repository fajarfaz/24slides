@extends('layouts.app2')
@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Form Submit for Schedule Off </b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('store.jadwal_off') }}" method="POST">
      @csrf
      <input type="hidden" name="id_jadwaloff" id="id_jadwaloff">
      <div class="modal-body">
          <div class="form-group">
            <label for="durasi" class="col-form-label">Type:</label>
            <select name="jenis" id="jenis" class="form-control" onchange="changeJenis()">
              <option value="cuti">Leave ( Take Leave Quota )</option>
              <option value="izin">Permit</option>
              <option value="sakit">Sick</option>
              @unless(Auth::user()->karyawan->jenis_kelamin != 'P')
              <option value="cuti_haid">Leave Period</option>
              @endunless
            </select>
          </div>
          <div class="form-group">
            <label for="mulai_lembur" class="col-form-label">Permission Start Date:</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" required="required" onchange="getDurasi('{{ $karyawan->sisa_quota_cuti }}')" >
 
          </div>
          <div class="form-group">
            <label for="selesai_lembur" class="col-form-label">Permission End Date:</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" required="required" onchange="getDurasi('{{ $karyawan->sisa_quota_cuti }}')">
          </div>
          <div class="form-group">
            <div class="row">
            <div class="col-md-6">
            <label for="durasi" class="col-form-label">How Many (Days):</label>
            <input type="text" name="durasi" class="form-control" id="durasi" required="required" readonly>
            </div>
             <div class="col-md-6">
            <label for="detail" class="col-form-label">Remaining Days Off</label>
            <input type="number" name="quota_cuti" class="form-control" id="quota_cuti" required="required" readonly>
            </div>
            </div>
            </div>
          <div class="form-group">

          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status:</label>
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
  .dropdown-toggle::after {
    display: inline-block;
   position: inherit;
   transform: unset;
   right: 0px;

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
      <h5 class="jdl-c">list Schedule Off </h4>
    	<div class="bd-example">
    		<div class="table-responsive">
    		
    			 <div id="toolbar">
             <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-plus"></i><b> Submit</b></button>
          </div>

    			<table
    			  id="table"
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
            data-export-options='{"fileName": "24Slides-list Schedule Off "}'
            data-export-types= "['excel','doc', 'txt']">
            <thead class="thead-dark">
              <tr>
                <th data-sortable="true" class="text-center col-md-1">No.</th>
                <th class="text-center">Start Date</th>
                <th class="text-center">End Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Type</th>
                <th class="text-center">Duration </th>
                <th class="text-center">Filling Date</th>
                <th class="col-md-1 text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              @foreach($jadwal_off as $data)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $data->tanggal_mulai->format('d F Y') }}</td>
                  <td>{{ $data->tanggal_selesai->format('d F Y') }}</td>
                  <td><b>{{ $data->status }}</td>
                  <td>{{ $data->jenis }}</td>
                  <td>{{ $data->durasi }} Days</td>
                  <td>{{ $data->created_at->format('d F Y, H:i') }}</td>
                  <td>
                    @if($data->status == 'New Entry')
                      <a id="button" href="" class="btn btn-warning" class="edit" href="#" title="Change Shift" data-toggle="modal" data-target="#exampleModal" onclick="passData('{{ $data->tanggal_mulai->format("Y-m-d") }}','{{ $data->tanggal_selesai->format("Y-m-d") }}','{{$data->id}}','{{$data->jenis}}','{{$data->durasi}}')"> <i class="fa fa-pencil-square-o"></i></a>
                    @else
                    <a href="#">Delete</a>
                    @endif
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

  function passData(tgl_mulai,tgl_selesai,id,jenis,durasi){
    if (jenis != 'cuti') {
      document.getElementById('quota_cuti').disabled = true;
    }
    document.getElementById('tanggal_mulai').value = tgl_mulai;
    document.getElementById('tanggal_selesai').value = tgl_selesai;
    document.getElementById('durasi').value = durasi;
    document.getElementById('id_jadwaloff').value = id;
    document.getElementById('jenis').value=jenis;
  }
  function changeJenis(){
    var jenis = document.getElementById('jenis');
    var pilih = jenis.options[jenis.selectedIndex].value;
    if (pilih != 'cuti') {
      document.getElementById('quota_cuti').disabled = true;
    }else{

      document.getElementById('quota_cuti').disabled = false;
    }
    return pilih;
  }
  function getDurasi(quota) {
    var mulai = new Date(document.getElementById('tanggal_mulai').value);
    var selesai = new Date(document.getElementById('tanggal_selesai').value);
    var durasi = (selesai.getTime() - mulai.getTime()) / (1000 * 3600 * 24);
    
    document.getElementById('durasi').value = Math.trunc(durasi+1);
    if(changeJenis() == 'cuti'){
      document.getElementById('quota_cuti').value = quota - durasi;
    }
  }
  
</script>
@endsection