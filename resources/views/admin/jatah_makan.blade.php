<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form (Not Take Lunch)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('refuse.meal') }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="modal-body">
          <div class="form-group">
            <label for="karyawans_id" class="col-form-label">Employee :</label>
            <select name="karyawans_id" class="form-control" id="karyawans_id" required="required">
              @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="tanggal" class="col-form-label">Date :</label>
            <select name="tanggal" class="form-control" id="tanggal" required="required">
              @foreach($tanggals as $tanggal)
                <option>{{ $tanggal->tanggal }}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-warning" name="submit" value="Not Take Lunch">
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
	<h4 class="bd-title">Data Employee Food For : {{ Carbon\Carbon::now()->format('F Y') }}</h4>
	<small id="emailHelp" class="form-text text-muted">Food base for employees.</small><br>
	<div class="bd-example">
		<div class="table-responsive">
        <div id="toolbar">
              
               <button type="button" class="btn btn-warning btn-table" data-toggle="modal" data-target="#exampleModal" data-whatever="" ><i class="fa fa-minus"></i> Not Take Lunch</button>

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
        data-export-options='{"fileName": "24Slides-Employee Food"}'
        data-export-types= "['excel','doc', 'txt']">
        <thead class="thead-dark">
          <tr>
            <th data-sortable="true" class="text-center col-md-1">No.</th>
            <th class="text-center col-md-2" data-sortable="true">Date</th>
            <th class="text-center">Total Meal A</th>
            <th class="text-center">Total Meal B</th>
            <th class="text-center" data-sortable="true">Total Fee</th>
          </tr>
        </thead>
        <tbody>
          @foreach($datas as $meal)
            <tr>
              <td>{{ $num }}</td>
              <td>{{ $meal->tanggal }}</td>
              <td>{{ $meal->mealA }}</td>
              <td>{{ $meal->mealB }}</td>
              <td>{{ $meal->total }}</td>
              
            </tr>
          <?php $num++; ?>
          @endforeach
        </tbody>
			</table>

		</div>
	</div>
	</div>
</div>

@endsection