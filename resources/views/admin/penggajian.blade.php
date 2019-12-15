@extends('layouts.app')
@section('content')
<div class="container-fluid">
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
  <form action="{{ route('store.gaji') }}" method="POST">
  @csrf
  <h4 class="bd-title">Penggajian bulan {{$now->format('F')}} {{$now->format('Y')}} </h4>
  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
  <div class="bd-example">
    <div class="form-group">
      <label>Nama Karyawan</label>
      <select class="form-control" name="karyawan_id" id="karyawan" onchange="getKaryawan()">
        <option value="semua">Choose one</option>
        @foreach($karyawans as $data)
          <option value="{{ $data->id }}" @if(request()->get('id') == $data->id) selected @endif>{{ $data->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Base Salary</label>
      <input type="hidden" name="base_salary" @if($karyawan != null)value="{{$karyawan->base_salary}}"@endif>
      <input type="text" class="form-control" id="base_salary" readonly @if($karyawan != null)value="@rupiah($karyawan->base_salary)"@endif>
    </div>
    <div class="form-group">
      <label>Penambahan Pendapatan</label>
      @if(isset($tambah_gaji))
        <input type="hidden" name="penambahan" value="{{$tambah_gaji->sum('nominal')}}">
        @foreach($tambah_gaji as $tambah)
          <br>
          <label>{{$tambah->detail}}</label>
          <input type="text" class="form-control" readonly value="{{$tambah->nominal}}">
        @endforeach
      @endif
    </div>
    <div class="form-group">
      <label>Pengurangan Pendapatan</label>
       @if(isset($kurang_gaji))
        <input type="hidden" name="pengurangan" value="{{$kurang_gaji->sum('nominal')}}">
        @foreach($kurang_gaji as $kurang)
          <br>
          <label>{{$kurang->detail}}</label>
          <input type="text" class="form-control" readonly value="{{$kurang->nominal}}">
        @endforeach
      @endif
    </div>
    <div class="form-group">
      <label>Total Pendapatan</label>
      <input type="text" class="form-control" @if(isset($tambah_gaji) && isset($kurang_gaji)) value="{{$tambah_gaji->sum('nominal') - $kurang_gaji->sum('nominal') + $karyawan->base_salary}}"  @endif id="total" name="total" placeholder="isi disini" readonly="readonly">
    </div>
    <div class="form-group">
      <input type="submit" name="submit" value="Simpan Gaji" @if($tambah_gaji == null) ||($kurang_gaji == null) disabled="true" style="cursor: not-allowed;" @elseif(count($tambah_gaji) <= 0 || count($kurang_gaji) <= 0) disabled="true" style="cursor: not-allowed;" @endif class="btn btn-info">
    </div>
  </form>  
</div>
</div>
@endsection
<script type="text/javascript">
  function getTotal() {
    var gaji = document.getElementById('base_salary').value;
    var tambah = document.getElementById('penambahan').value;
    var kurang = document.getElementById('pengurangan').value;

    var total = parseInt(gaji)+parseInt(tambah);
    total = total - kurang;
    document.getElementById('total').value = total;
  }
  function getKaryawan(){
    var pilih = document.getElementById('karyawan').value;
    if (pilih != 'semua') {
      window.location = '{{route("index.gaji")}}?id='+pilih;
    }
    else{
      window.location = '{{route("index.gaji")}}';
    }
  }
</script>
