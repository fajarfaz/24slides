<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Change Shift Date Request </b><span id="tanggal_modal"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('karyawan.update.ganti_shift') }}" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="id_aktif">
      <input type="hidden" name="id_ganti" id="id_ganti">
      <div class="modal-body">
          <div class="form-group">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Choose Shift</label>
                  <select id="shift" name="id_jadwal" class="form-control" onchange="getKaryawan()">
                    <option>Select Here</option>                 
                    @foreach($shifts as $shift)
                      <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                    @endforeach
                  </select>  
                </div>
                <input type="hidden" name="tanggal" id="tanggal">
                <div class="form-group">
                  <label>Karyawan</label>
                  <select id="karyawan" name="karyawans_id" class="form-control">
                    <option value="null">Select Here</option>             
                  </select>
                </div>
            </div>
            <br>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Send">
      </div>
      </form>
    </div>
  </div>
</div>
@extends('layouts.app2')
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
<div class="container-fluid">
      <h5 class="jdl-c">Shift Request</h5>
      <div class="bd-example">
		<div class="table-responsive">
			<table
    			  id="table"
            class="table table-striped"
            data-locale="en-US"
            data-show-refresh="true"
            data-show-toggle="true"
            data-show-fullscreen="false"
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
            <thead class="thead-dark">
          <tr>
            <th data-sortable="true" class="text-center col-md-1">No</th>
            <th class="text-center">Main Schedule</th>
            <th class="text-center">Replacement Schedule</th>
            <th class="text-center">Date</th>
            <th class="text-center col-md-1">Substitute Employees</th>
            <th class="text-center ">Status</th>
            <th class="text-center col-md-2"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;  ?>
          @foreach($ganti_shift as $data)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $data->jadwal_awal->name }}</td>
              <td>{{ $data->jadwal_baru->name }}</td>
              <td>  {{ $data->tanggal }}</td>
              <td>@if($data->id_pengganti == null) Without Replacement @elseif($data->karyawans_id == auth()->user()->karyawan->id){{ $data->karyawan_pengganti->nama }} @elseif($data->id_pengganti == auth()->user()->karyawan->id) Anda @endif </td>
              <td><b>
                @if($data->id_pengganti == null)
                   <center style="color: green;"> Approve </center>
                @elseif(is_null($data->approve) && $data->karyawans_id == auth()->user()->karyawan->id)
                  Menunggu Persetujuan {{ $data->karyawan_pengganti->nama }}
                @elseif(is_null($data->approve) && $data->id_pengganti == auth()->user()->karyawan->id)
                  {{ $data->karyawan->nama }} Waiting for your Approval 
                @elseif($data->approve == 1)
                 <center style="color: green;"> Approve </center>
                @else
                   <center style="color: red;"> Ditolak </center>
                @endif </b>
              </td>
              <td>
                <div class="button-space">
                @if($data->approve == null && $data->id_pengganti != auth()->user()->karyawan->id)
                  <button type="button" onclick="getEdit('{{$data->jadwal_awal->id}}','{{$data->jadwal_baru->id}}','{{$data->tanggal}}','{{$data->id}}')" class="btn btn-warning" data-toggle="modal" data-target="#edit-modal" data-whatever="@getbootstrap"><i class="fa fa-pencil-square-o"></i></button>
                @endif
                @if($data->id_pengganti == null)
                  <a id="button" class="btn btn-danger"  href="{{ url('karyawan/konfirm/ganti-shift?id='.$data->id.'&status=cancel') }}"><i class="fa fa-trash"></i></a>
                @elseif(is_null($data->approve) && $data->id_pengganti == auth()->user()->karyawan->id)
                  <a id="button" class="btn btn-success" href="{{ url('karyawan/konfirm/ganti-shift?id='.$data->id.'&status=accept') }}"><i class="fa fa-check-circle" aria-hidden="true"></i></a>

                  <a id="button" class="btn btn-danger" href="{{ url('karyawan/konfirm/ganti-shift?id='.$data->id.'&status=decline') }}"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                @elseif(!is_null($data->approve) && $data->karyawans_id == auth()->user()->karyawan->id)
                  <a id="button" href="" class="btn btn-warning"  href="{{ url('karyawan/konfirm/ganti-shift?id='.$data->id.'&status=cancel') }}">Hapus</a>
                @elseif(!is_null($data->approve) && $data->id_pengganti == auth()->user()->karyawan->id)
                  Sudah anda Konfirmasi
                @elseif(is_null($data->approve) && $data->karyawans_id == auth()->user()->karyawan->id)
                  <a id="button" href="" class="btn btn-danger"  href="{{ url('karyawan/konfirm/ganti-shift?id='.$data->id.'&status=cancel') }}">Cancel</a>
                @else
                  Sudah di Konfirmasi
                @endif
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
  function getEdit(id_jadwal,jadwal,tanggal,id){
    $('#id_aktif').val(id_jadwal);
    $('#id_ganti').val(id);
    $('#tanggal').val(tanggal);
    $('#shift').val(jadwal);
    getKaryawan();
  }
  function getKaryawan(){
    var id = $('#id_aktif').val();
    var tanggal = $('#tanggal').val();
    var shift = $('#shift').children("option:selected").val();
    $.ajax({
      url: '{{ url('get-karyawan/ganti-shift') }}?shift='+shift+'&tanggal='+tanggal+'&id='+id,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#karyawan')
          .find('option')
          .remove()
          .end();

        $('<option>').val('null').text('Tanpa Pengganti').appendTo('#karyawan');
        $.each( data, function(k, v) {
            
            $('<option>').val(v.id).text(v.nama).appendTo('#karyawan');
        });
      },
      error: function()
      {
        //handle errors
        alert('error...');
      }
    });
  }
</script>

@endsection