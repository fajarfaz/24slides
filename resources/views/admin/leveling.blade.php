<!-- Modal -->
<div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Levelling</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update.leveling')}}" id="form-edit" method="post">
          @csrf
          @method('PATCH')
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Levelling:</label>
            <input type="hidden" name="id" id="leveling-id">
            <input type="text" name="name" class="form-control" id="leveling-name" required="required" >
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-warning" name="submit" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Data Levelling</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('store.leveling') }}" method="POST">
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Levelling name:</label>
            <input type="text" name="name" class="form-control" id="recipient-name" required="required">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" value="Add new Leveling">
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
<div class="container-fluid">
	<h4 class="bd-title">Leveling Data</h4>
	<small id="emailHelp" class="form-text text-muted">for edit or adding levelling in office.</small><br>
	<div class="bd-example">
		<div class="table-responsive">		
		  <div id="toolbar">              
               <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever=""><i class="fa fa-plus"></i> Leveling</button>

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
        data-show-columns="true"
        data-response-handler="responseHandler"
        data-export-options='{"fileName": "24Slides-Leveling Data"}'
        data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th data-sortable="true" class="text-center col-md-1">No.</th>
            <th data-sortable="true" class="text-center">Code</th>
            <th data-sortable="true" class="text-center ">Leveling List</th>
            <th class="col-md-2"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($leveling as $data)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $data->id }}</td>
              <td>{{ $data->name }}</td>
              <td>
                <div class="button-space">
                <button class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{ $data->name }}','{{ $data->id }}')"> <i class="fa fa-pencil-square-o"></i></button>  
                
                <button class="remove btn btn-danger" title="Remove" onclick="if(confirm('Delete Leveling {{ $data->name }} ?')){window.location='{{route('delete.leveling',$data->id)}}'}">
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
  function passData(nama,id){
    document.getElementById('leveling-name').value = nama;
    document.getElementById('leveling-id').value = id;
  }

</script>

@endsection