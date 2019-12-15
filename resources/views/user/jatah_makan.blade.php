 
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
	<h5 class="jdl-c" style="">Food Quota <br> <p class="jdl-c1">{{ Carbon\Carbon::now()->format('F Y') }}</p></h5>

	<div class="bd-example">
		<div class="table-responsive">
		 <div class="table-responsive text-nowrap">    
			<table 			  
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
        data-export-options='{"fileName": "24Slides-list Food Quota "}'
        data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th  data-sortable="true" class="col-md-1 text-center">No.</th>
            <th  data-sortable="true" class="text-center">Date</th>
            <th  class="text-center">Food Type</th>          
          </tr>
        </thead>
        <tbody>
        <?php  $i = 1; ?>
          @foreach($meal as $data)
            <tr>
              <th >{{ $i }}</th>
              <td>{{ $data->tanggal }}</td>
              <td>{{ $data->name }}</td>
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



@endsection