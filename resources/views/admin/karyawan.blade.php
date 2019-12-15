 
<!-- Modal -->
<div class="modal fade" id="photoget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
    
      <div class="modal-body">
        <div class="row"><div class="col ml-auto">
          <img id="imageModal" src="#" style="width: 100%;">
          </div></div>
      </div>

      <div class="modal-footer">
        <a id="imageDl" href="#" download="#" target="_blank">
        <button class="btn btn-success" style="background-color: #5d88b3;">Download</button></a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    
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
<div class="container">
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
  @endif
  @if($message1 = Session::get('add'))
    <div class="alert alert-info alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message1 }}</strong>
    </div>
  @endif
<div class="container-fluid">
	<h4 class="bd-title">Employee Data</h4>
	<small id="emailHelp" class="form-text text-muted">Data for all employees.</small><br>
	<div class="bd-example">
		<div class="table-responsive">
		    <div id="toolbar">
              
               <a href="{{ route('create.karyawan') }}"><button type="button" class="btn btn-primary btn-table" data-toggle="modal" ><i class="fa fa-plus"></i> Employee</button></a>

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
        data-detail-formatter="detailFormatter"
        data-page-list="[10, 25, 50, 100, all]"
        data-show-pagination-switch="true"
        data-pagination="true"
        data-minimum-count-columns="2"      
        data-response-handler="responseHandler"
        data-export-options='{"fileName": "24Slides-Employee Data"}'
        data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th class="text-center col-md-1 " data-sortable="true">No.</th>
            <th class="text-center" data-sortable="true">Name</th>
            <th class="text-center">Role</th>
            <th class="text-center" data-sortable="true">Join Date</th>
            <th class="text-center" data-visible="false">Department</th>
            <th class="text-center" data-visible="false">ID Card Number</th>
            <th class="text-center" data-visible="false">ID Card Employee</th>
            <th class="text-center" data-visible="false">Employee Status</th>
            <th class="text-center" data-visible="false">Address</th>
            <th class="text-center" data-visible="false">Gender</th>
            <th class="text-center" data-visible="false">Phone Number</th>
            <th class="text-center" data-visible="false">Birth Date</th>
            <th class="text-center" data-visible="false">Age</th>
            <th class="text-center" data-visible="false">NPWP</th>
            <th class="text-center" data-visible="false">Tax Classification</th>
            <th class="text-center" data-visible="false">KPJ BPJS</th>
            <th class="text-center" data-visible="false">Account Number</th>
            <th class="text-center" data-visible="false">Marital Status</th>
            <th class="text-center" data-visible="false">Children</th>
            <th class="text-center" data-visible="false">Education</th>
            <th class="text-center" data-visible="false">Relatives Name</th>
            <th class="text-center" data-visible="false">Relative Number</th>
            <th class="text-center" data-visible="false">Base Salary</th>
            <th class="text-center" data-visible="false">Leave Quota</th>
            <th class="text-center" data-visible="true">Photo</th>
            <th class="text-center col-md-2"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;  ?>
          @foreach($karyawan as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{ $data->nama }}</td>
            <td>{{$data->jabatan}}</td>
            <td>{{$data->created_at->format('d F Y')}}</td>
            <td>{{$data->department->name}}</td>
            <td>{{ $data->no_ktp }}</td>
            <td>{{$data->nik}}</td>
            <td>{{$data->status_karyawan->name}}</td>
            <td>{{$data->alamat_ktp}}</td>
            <td>{{ $data->jenis_kelamin }}</td>
            <td>{{$data->no_telp}}</td>
            <td>{{$data->tanggal_lahir}}</td>
            <td>{{$data->usia}}</td>
            <td>{{ $data->npwp }}</td>
            <td>{{$data->klasifikasi_pajak}}</td>
            <td>{{$data->kpj_bpjs}}</td>
            <td>{{$data->no_rek}}</td>
            <td>{{ $data->status_nikah }}</td>
            <td>{{$data->jumlah_anak}}</td>
            <td>{{$data->jenjang_pendidikan}}</td>
            <td>{{$data->nama_kerabat}}</td>
            <td>{{ $data->notelp_kerabat }}</td>
            <td>{{$data->base_salary}}</td>
            <td>{{$data->quota_cuti}}</td>
            <td><button type="button" class="btn btn-secondary btn-req" data-toggle="modal" data-target="#photoget" data-whatever="" onclick="passImg('{{$data->photo_profile}}')">Preview</button>
                    <!-- <img width="100px" src="{{asset('resources/images/photo_profile/'.$data->photo_profile)}}"> --></td>
            <td>
                <div class="button-space">
                    <a class="edit" href="{{route('edit.karyawan',$data->id)}}" title="Edit">
                <button class="btn btn-warning" title="Edit"> <i class="fa fa-pencil-square-o"></i></button>  </a>
                
                <button class="remove btn btn-danger" title="Remove" onclick="if(confirm('Delete Karyawan {{ $data->id }} ?')){window.location='{{route('delete.karyawan',$data->id)}}'}">
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
function passImg(image){
  $("#imageModal").attr('src',"{{asset('resources/images/photo_profile')}}/"+image);
  $("#imageDl").attr('href',"{{asset('resources/images/photo_profile')}}/"+image);
  $("#imageDl").attr('download',image);


}
$(document).ready(function(){

    $(".check").click(function(){

        $("#myCheck").prop("checked", true);

    });

    $(".uncheck").click(function(){

        $("#myCheck").prop("checked", false);

    });

});

</script>

@endsection