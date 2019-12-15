
@extends('layouts.app')
@section('content')
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
<style type="text/css">
    #toolbar{
   float: inherit;
  }
  .btn-secondary {
    padding: 10px;
   }
   .btn-primary
  {
    display:block;
    border-radius:0px;
    box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
    margin-top:-5px;
  }
</style>
<div class="container">
<div class="container-fluid">
<h4 class="bd-title">Employee Registration</h4>
<small id="emailHelp" class="form-text text-muted">Please register for new employees.</small><br>
    <form method="post" action="{{ route('store.karyawan') }}" enctype="multipart/form-data">
      @csrf
    <div class="bd-example">

      <div class="form-row">
        <div class="form-group col-md-8">
            <label for="nama">Full Name</label>
            <input maxlength="80" required type="text" class="form-control" id="nama" placeholder="Employee Full Name" name="nama">
        </div>
          <div class="form-group col-md-4">
          <label for="nickname">Nickname</label>
          <input maxlength="30" required type="text" class="form-control" id="nickname" placeholder="Nickname" name="nickname">
      </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-5"> 
          <label for="department_id">Department</label>
          <select class="form-control" name="department_id" >
              <option>
                Select Here
              </option>
              @foreach($departments as $department)
              <option value="{{ $department->id }}">
                {{ $department->name }}
              </option>
              @endforeach
          </select>

      </div>
         <div class="form-group col-md-1"> 
           <label for="department_id" style="color:#fff;"> a</label>
          <div id="toolbar">
          <a href="{{route('index.department')}}" class="btn btn-secondary mb-4"><i class="fa fa-cog"></i></a>
        </div>
        </div>
        <div class="form-group col-md-5"> 
          <label for="leveling">Levelling</label>
          <select class="form-control" name="leveling">
              <option>
                Select Here
              </option>
              @foreach($levelings as $leveling)
              <option value="{{ $leveling->id }}">
                {{ $leveling->name }}
              </option>
              @endforeach
          </select>
       </div>
        <div class="form-group col-md-1"> 
           <label for="department_id" style="color:#fff;"> a</label>
          <div id="toolbar">
          <a href="{{route('index.leveling')}}" class="btn btn-secondary mb-4"><i class="fa fa-cog"></i></a>
        </div>
        </div>
      </div>

      <div class="form-group">
        <label for="jabatan">Position</label>
        <input required type="text" class="form-control" id="jabatan" placeholder="Ex : Designer Manager / Project Manager" name="jabatan" maxlength="50">
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
      <input required type="text" class="form-control" id="email" placeholder="Email Adress" name="email" value="{{ old('email') }}" maxlength="50">
    </div>
      <div class="form-group">
        <label for="nik">ID Card Employee</label>
        <input required type="number" class="form-control" id="nik" placeholder="Employee ID Card" name="nik" maxlength="11">
    </div>
     <div class="form-row">
        <div class="form-group col-md-11"> 
        <label for="status_karyawan">Employee Status</label>
        <select class="form-control" name="status_karyawan">
            <option>
              Select Here
            </option>
            @foreach($status_karyawans as $status_karyawan)
            <option value="{{ $status_karyawan->id }}">
              {{ $status_karyawan->name }}
            </option>
            @endforeach
        </select>
       </div>
       <div class="form-group col-md-1"> 
         <label for="department_id" style="color:#fff;"> a</label>
        <div id="toolbar">
        <a href="{{route('index.status')}}" class="btn btn-secondary mb-4"><i class="fa fa-cog"></i></a>
      </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4"> 
        <label for="tanggal_training">Training Date</label>
        <input required type="date" class="form-control" id="tanggal_training" placeholder="Training Date" name="tanggal_training">
    </div>
      <div class="form-group col-md-4"> 
        <label for="tanggal_masuk">Joining Date</label>
        <input required type="date" class="form-control" id="tanggal_masuk" placeholder="Employee Joining Date" name="tanggal_masuk">
    </div>
      <div class="form-group col-md-4"> 
        <label for="tanggal_keluar">Off Date</label>
        <input required type="date" class="form-control" id="tanggal_keluar" placeholder="Employee Off Date" name="tanggal_keluar">
    </div>
  </div>
      <div class="form-group">
        <label for="alamat_ktp">Address (Based On ID Card)</label>
        <input required type="text" class="form-control" id="alamat_ktp" placeholder="Address according to ID card" name="alamat_ktp">
    </div>
      <div class="form-group">
        <label for="alamat_tinggal">Current Address</label>
        <input required type="text" class="form-control" id="alamat_tinggal" placeholder="Current Address" name="alamat_tinggal">
    </div>
      <div class="form-group">
        <label for="no_telp">Phone Number</label>
        <input required type="text" class="form-control" id="no_telp" placeholder="Employee Phone Number" name="no_telp" maxlength="16">
    </div>

    <div class="form-row">
      <div class="form-group col-md-8"> 
        <label for="tanggal_lahir">Date of Birth</label>
        <input required type="date" class="form-control" id="tanggal_lahir" placeholder="Date of Birth" name="tanggal_lahir" onchange="getUmur()">
    </div>
      <div class="form-group col-md-4"> 
        <label for="usia">Age</label>
        <input required type="number" class="form-control" id="usia" placeholder="Employee Age" name="usia" min="1" max="100">
      </div>
    </div>

      <div class="form-group">
        <label for="no_ktp">ID Card Number</label>
        <input required type="text" class="form-control" id="no_ktp" placeholder="ID Card Number" name="no_ktp" maxlength="16">
    </div>
      <div class="form-group">
        <label for="no_npwp">NPWP Number</label>
        <input required type="text" class="form-control" id="no_npwp" placeholder="NPWP Number" name="no_npwp" maxlength="15">
    </div>
      <div class="form-group">
        <label for="klasifikasi_pajak">Tax Classification</label>
        <select class="form-control" name="klasifikasi_pajak">
          <option value="TK">
            TK
          </option>
          <option value="K">
            K
          </option>
        </select>
    </div>
      <div class="form-group">
        <label for="kpj_bpjs">Membership Card BPJS-TK</label>
        <input required type="text" class="form-control" id="kpj_bpjs" placeholder="KPJ BPJS-TK" name="kpj_bpjs" maxlength="11">
    </div>
      <div class="form-group">
        <label for="bpjs_kesehatan">Health BPJS</label>
        <input required type="text" class="form-control" id="bpjs_kesehatan" placeholder="Health BPJS" name="bpjs_kesehatan" maxlength="11">
    </div>
      <div class="form-group">
        <label for="no_rek">Mandiri Account Number</label>
        <input required type="text" class="form-control" id="no_rek" placeholder="Account Number Mandiri" name="no_rek" maxlength="13">
    </div>
      <div class="form-group">
        <label for="jenis_kelamin">Gender</label>
          <select class="form-control" name="jenis_kelamin"  id="jenis_kelamin">
            <option>
              Select Here
            </option>           
            <option value="L">
             Male
            </option>
             <option value="P">
             Female
            </option>
          </select>
    </div>
      <div class="form-group">
        <label for="status_nikah">Marital Status</label>
        <select class="form-control" name="status_nikah"  id="status_nikah">
          <option>
            Select Here
          </option>           
          <option value="K">
           Married
          </option>
           <option value="BK">
           Single
          </option>
        </select>
    </div>
      <div class="form-group">
        <label for="jumlah_anak">Number of Children</label>
        <input required type="number" class="form-control" id="jumlah_anak" placeholder="Number of Children" name="jumlah_anak" value="0">
    </div>
      <div class="form-group">
        <label for="jenjang_pendidikan">Last Education Level</label>
        <input required type="text" class="form-control" id="jenjang_pendidikan" placeholder="Last Education Level" name="jenjang_pendidikan" >
    </div>
      <div class="form-group">
        <label for="asal_sekolah">School Name</label>
        <input required type="text" class="form-control" id="asal_sekolah" placeholder="School Name" name="asal_sekolah">
    </div>
      <div class="form-group">
        <label for="jurusan">Majors</label>
        <input required type="text" class="form-control" id="jurusan" placeholder="Majors" name="jurusan">
    </div>
      <div class="form-group">
        <label for="tahun_masuk_pendidikan">Year Of Education</label>
        <input required type="text" class="form-control" id="tahun_masuk_pendidikan" placeholder="Year of Education" name="tahun_masuk_pendidikan" maxlength="4">
    </div>
      <div class="form-group">
        <label for="tahun_keluar_pendidikan">Year Of Graduation</label>
        <input required type="text" class="form-control" id="tahun_keluar_pendidikan" placeholder="Year of Graduation" name="tahun_keluar_pendidikan" maxlength="4">
    </div>
      <div class="form-group">
        <label for="golongan_darah">Blood Type</label>
        <input required type="text" class="form-control" id="golongan_darah" placeholder="Blood Type" name="golongan_darah"maxlength="2">
    </div>

    <div class="row">
      <div class="col">
      <div class="form-group">
        <label for="nama_kerabat">Relatives Name</label>
        <input required type="text" class="form-control" id="nama_kerabat" placeholder="Relative Name" name="nama_kerabat" maxlength="80">
    </div>
      <div class="form-group">
        <label for="notelp_kerabat">Relatives Number</label>
        <input required type="text" class="form-control" id="notelp_kerabat" placeholder="Relative Number" name="notelp_kerabat" maxlength="16">
    </div>
      <div class="form-group">
        <label for="benefit_karyawan">Employee Benefit</label>
        <input required type="text" class="form-control" id="benefit_karyawan" placeholder="Employee Benefit" name="benefit_karyawan">
    </div>
      <div class="form-group">
        <label for="base_salary">Base Salary</label>
        <input required type="number" class="form-control" id="base_salary" placeholder="Base Salary" name="base_salary">
    </div>
      <div class="form-group">
        <label for="quota_cuti">Leave Quota Annual</label>
        <input required type="number" class="form-control" id="quota_cuti" placeholder="leave Quota Annual" name="quota_cuti" value="0">
    </div>
    </div>

    <div class="col">
    <div class="form-group">

    <div class="col-sm-10 imgUp center" >
        <label for="photo" >Employee Photo</label>
        <div class="imagePreview"></div>
        <label class="btn btn-primary btn-primary-up">Upload
      <input type="file" class="uploadFile img" name="photo_profile" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
         </label>
      </div>
    </div>
    </div>

    </div>
   <button type="submit" class="btn btn-success" style="padding: 7px 50px;width: 100%;margin-top: 20px;">Save</button>


      </div>
    </form>

 
 
</div>
</div>

 
 


<script type="text/javascript">
  $(".imgAdd").click(function(){
  $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
$(document).on("click", "i.del" , function() {
  $(this).parent().remove();
});
$(function() {
    $(document).on("change",".uploadFile", function()
    {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }
      
    });
});
</script>
<script type="text/javascript">
  function getUmur() {
    var date = document.getElementById('tanggal_lahir').value;

    if(date === ""){
        alert("Please complete the required field!");
    }else{
        var today = new Date();
        var birthdate = new Date(date);
        var year = 0;
        if (today.getMonth() < birthdate.getMonth()) {
            year = 1;
        } else if ((today.getMonth() == birthdate.getMonth()) && today.getDate() < birthdate.getDate()) {
            year = 1;
        }
        var age = today.getFullYear() - birthdate.getFullYear() - year;

        if(age < 0){
            age = 0;
        }
        document.getElementById('usia').value = age;
    }
  }
</script>
@endsection
