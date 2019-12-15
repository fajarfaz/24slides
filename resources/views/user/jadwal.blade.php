<div class="modal fade" id="gantishift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><b>Schedule Change Request</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('store.ganti_shift') }}" method="POST">
      @csrf
      <input type="hidden" name="id" id="id_aktif">
      <div class="modal-body">
          <div class="form-group">
    
            <div class="col-md-12">
                
                <div class="form-group">
                  <b style="border-bottom: 2px solid #ca5151;">Date :  
                    <span id="tanggal_modal"></span> {{ Carbon\Carbon::now()->format('F Y') }}</b><br><br>
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
                  <label>Employee Substitute</label>
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
        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
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
    	<h5 class="jdl-c">Shift Schedule<p class="jdl-c1"> {{ Carbon\Carbon::now()->format('F Y') }}</p></h5>
    	<div class="bd-example">

    		<div class="table-responsive text-nowrap"> 
    			<table
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
            data-export-options='{"fileName": "24Slides-list Schedule "}'
            data-export-types= "['excel','doc', 'txt']">
            <thead class="thead-dark">
              <tr>
                <th data-sortable="true" class="col-md-1 text-center">No.</th>
                <th class="text-center">Date</th>
                <th class="text-center">Shift Schedule</th>
                <th class="text-center">Start Shift</th>
                <th class="text-center">End Shift</th>
                <th class="text-center col-md-2" ></th>
              </tr>
            </thead>
            <tbody class="table-sm ">
              <?php $i = 1;  ?>
              @foreach($jadwal as $data)
                <tr >
                  <td>{{ $i++ }}</td>
                  <td>{{ $data->tanggal }}</td>
                  <td><div style="font-weight: 600;"> {{ $data->aktif->name }}</div></td>
                  <td><div style="color:#067334;">{{ Carbon\Carbon::createFromFormat('H:i:s',$data->aktif->jam_mulai)->format('H:i') }}</div></td>
                  <td><div style="color:#d35400"> {{ Carbon\Carbon::createFromFormat('H:i:s',$data->aktif->jam_selesai)->format('H:i') }}</div></td>
                  <td> <a id="button" href="" class="btn btn-warning" class="edit" href="#" title="Change Shift" data-toggle="modal" data-target="#gantishift" onclick="getId('{{ $data->id_jadwal }}','{{ $data->tanggal }}','{{$data->aktif->id}}')">Change Shift</a></td>
                </tr>
              @endforeach
            </tbody>
    			</table>

    		</div>
    	</div>
</div>
</div>
<script type="text/javascript">
  function getId(id,tanggal,shift){
    $('#id_aktif').val(id);
    $('#tanggal').val(tanggal);
    $('#tanggal_modal').text(tanggal);

    $('#shift option').each(function() {
        if ($(this).val() == shift ) {
            $(this).remove();
        }
    });
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

        $.each( data, function(k, v) {
            
            $('<option>').val(v.id).text(v.nama).appendTo('#karyawan');
        });
        if (!$.trim(data)){   
          $('<option>').val('null').text('Tanpa Pengganti').appendTo('#karyawan');
        }
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