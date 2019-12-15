<!-- Modal -->
<div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="editdata" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" id="form-edit" method="post">
          @csrf
          @method('PATCH')
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Department:</label>
            <input type="hidden" name="id" id="department-id">
            <input type="text" name="name" class="form-control" id="department-name" required="required" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Department Leader:</label>
            <select name="users_id" id="users_id" class="form-control">
              <option value="">Select...</option>
              @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->users_id }}">{{ $karyawan->nama }}</option>
              @endforeach
            </select>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('store.department') }}" method="POST">
         @csrf
      <div class="modal-body">
      
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Department Name</label>
          <input type="text" name="name" class="form-control" id="recipient-name" required="required">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="submit" value="Add new Department">
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
   .btn-secondary{
    padding: 10px 14.5px;
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
  	<h4 class="bd-title">Departement Data</h4>
	<small id="emailHelp" class="form-text text-muted">For edit or adding new department in office.</small><br>
	<div class="bd-example">
	<div class="table-responsive">
  	  <div id="toolbar">
              
               <button type="button" class="btn btn-primary btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever=""><i class="fa fa-plus"></i> Department</button>

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
        data-response-handler="responseHandler">
        <thead class="thead-dark">
          <tr>
            <th data-sortable="true" class="text-center col-md-1">No.</th>
            <th data-sortable="true" class="text-center">Department Name</th>
            <th class="text-center">Department Leader</th>
            <th class="text-center col-md-2">
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($departments as $data)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $data->name }}</td>
              <td>@unless($data->leader == null){{ $data->leader->karyawan->nama }}@endunless</td>
              <td >
                <div class="button-space">
                <button class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#editdata" data-whatever="" onclick="passData('{{ $data->name }}','{{ $data->id }}','@unless($data->leader == null){{ $data->leader->id }}@endunless')"> <i class="fa fa-pencil-square-o"></i></button>  
                
                <button class="remove btn btn-danger" title="Remove" onclick="if(confirm('Delete Department {{ $data->name }} ?')){window.location='{{route('delete.department',$data->id)}}'}">
                  <i class="fa fa-trash"></i>
                </button>
                </div>
                
                </a>
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
 function passData(nama,id,user){
    document.getElementById('department-name').value = nama;
    document.getElementById('department-id').value = id;
    document.getElementById('users_id').value = user;
  }
</script>

@endsection