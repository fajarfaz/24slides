@extends('layouts.app')
@section('content')
<style type="text/css">
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
  	@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
<h4 class="bd-title">Edit Employee</h4>
<small id="emailHelp" class="form-text text-muted">You can update Employee data here.</small><br>
    <form method="post" action="{{ route('update.karyawan',$karyawan->id) }}" enctype="multipart/form-data">
      @method('PATCH')
      @csrf
    <div class="bd-example">
      <div class="form-row">
        <div class="form-group col-md-8">
            <label for="nama">Full Name</label>
            <input type="text" class="form-control" id="nama" placeholder="Employe Full Name" name="nama" value="{{ $karyawan->nama }}" maxlength="80">
        </div>
          <div class="form-group col-md-4">
          <label for="nickname">Nikcname</label>
          <input type="text" class="form-control" id="nickname" placeholder="Nickname" name="nickname" value="{{ $karyawan->nickname }}" maxlength="30">
      </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6"> 
          <label for="department_id">Deparment</label>
          <select class="form-control" name="department_id">
              <option>
                Pilih disini
              </option>
              @foreach($departments as $department)
              <option @unless($department->id != $karyawan->department->id) selected @endunless value="{{ $department->id }}">
                {{ $department->name }}
              </option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-6"> 
        <label for="levelling">Leveling</label>
        <select class="form-control" name="leveling">
            <option>
              Select Here
            </option>
            @foreach($levelings as $leveling)
            <option @unless($leveling->id != $karyawan->leveling->id) selected @endunless value="{{ $leveling->id }}">
              {{ $leveling->name }}
            </option>
            @endforeach
        </select>
     </div>
    </div>

    <div class="form-group">
      <label for="jabatan">Position</label>
      <input type="text" class="form-control" id="jabatan" placeholder="Position" name="jabatan" value="{{ $karyawan->jabatan }}" maxlength="50">
    </div>
    <div class="form-group">
      <label for="email">Email Adress</label>
      <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{ $karyawan->users->email }}" maxlength="50">
    </div>
    <div class="form-group">
      <label for="nik">ID Card Employee</label>
      <input type="number" class="form-control" id="nik" placeholder="Employee ID Card" name="nik" min="11" value="{{ $karyawan->nik }}" maxlength="11">
    </div>
    <div class="form-group">
      <label for="status_karyawan">Employee Satus</label>
      <select class="form-control" name="status_karyawan">
          <option>
            Pilih disini
          </option>
          @foreach($status_karyawans as $status_karyawan)
          <option @unless($status_karyawan->id != $karyawan->status_karyawan->id) selected @endunless value="{{ $status_karyawan->id }}">
            {{ $status_karyawan->name }}
          </option>
          @endforeach
      </select>
    </div>
  <div class="form-row">
    <div class="form-group col-md-4"> 
      <label for="tanggal_training">Training Date</label>
      <input type="date" class="form-control" id="tanggal_training" placeholder="Training Date" name="tanggal_training" value="{{ $karyawan->tanggal_training }}">
    </div>
    <div class="form-group col-md-4"> 
      <label for="tanggal_masuk">Joining Date</label>
      <input type="date" class="form-control" id="tanggal_masuk" placeholder="Employee Joining Date" name="tanggal_masuk" value="{{ $karyawan->tanggal_masuk }}">
    </div>
    <div class="form-group col-md-4"> 
      <label for="tanggal_keluar">Off Date</label>
      <input type="date" class="form-control" id="tanggal_keluar" placeholder="Employee Off Date" name="tanggal_keluar" value="{{ $karyawan->tanggal_keluar }}">
    </div>
  </div>
      <div class="form-group">
        <label for="alamat_ktp">Address (Based On ID Card)</label>
        <input type="text" class="form-control" id="alamat_ktp" placeholder="Address according to ID card" name="alamat_ktp" value="{{ $karyawan->alamat_ktp }}">
    </div>
      <div class="form-group">
        <label for="alamat_tinggal">Current Address</label>
        <input type="text" class="form-control" id="alamat_tinggal" placeholder="Enter Current Address" name="alamat_tinggal" value="{{ $karyawan->alamat_tinggal }}">
    </div>
      <div class="form-group">
        <label for="no_telp">Phone Number</label>
        <input type="number" class="form-control" id="no_telp" placeholder="Enter Phone Number" name="no_telp" maxlength="16" value="{{ $karyawan->no_telp }}">
    </div>

    <div class="form-row">
      <div class="form-group col-md-8"> 
        <label for="tanggal_lahir">Date of Birth</label>
        <input type="date" class="form-control" id="tanggal_lahir" placeholder="Date of Birth" name="tanggal_lahir" onchange="getUmur()" value="{{ $karyawan->tanggal_lahir }}">
    </div>
      <div class="form-group col-md-4"> 
        <label for="usia">Age</label>
        <input type="number" class="form-control" id="usia" placeholder="Enter Employee Age" name="usia" min="1" max="100" value="{{ $karyawan->usia }}">
      </div>
    </div>

      <div class="form-group">
        <label for="no_ktp">ID Card Number</label>
        <input type="text" class="form-control" id="no_ktp" placeholder="Enter ID Card Number" name="no_ktp" value="{{ $karyawan->no_ktp }}" maxlength="16">
    </div>
      <div class="form-group">
        <label for="no_npwp">NPWP Number</label>
        <input type="text" class="form-control" id="no_npwp" placeholder="Enter NPWP Number" name="no_npwp" value="{{ $karyawan->no_npwp }}" maxlength="20">
    </div>
      <div class="form-group">
        <label for="klasifikasi_pajak">Tax Classification</label>
        <select class="form-control" name="klasifikasi_pajak">
          <option value="TK">
            TK
          </option>
          <option @unless($karyawan->klasifikasi_pajak != 'K') selected @endunless value="K">
            K
          </option>
        </select>
    </div>
      <div class="form-group">
        <label for="kpj_bpjs">Membership Card BPJS-TK</label>
        <input type="text" class="form-control" id="kpj_bpjs" placeholder="Enter KPJ BPJS-TK" name="kpj_bpjs" value="{{ $karyawan->kpj_bpjs }}" maxlength="11">
    </div>
      <div class="form-group">
        <label for="bpjs_kesehatan">Health BPJS</label>
        <input type="text" class="form-control" id="bpjs_kesehatan" placeholder="Enter health BPJS" name="bpjs_kesehatan" value="{{ $karyawan->bpjs_kesehatan }}" maxlength="11">
    </div>
      <div class="form-group">
        <label for="no_rek">Mandiri Account Number</label>
        <input type="text" class="form-control" id="no_rek" placeholder="Enter Account Number" name="no_rek" value="{{ $karyawan->no_rek }}" maxlength="13">
    </div>
      <div class="form-group">
        <label for="jenis_kelamin">Gender</label>
          <select class="form-control" name="jenis_kelamin"  id="jenis_kelamin">         
            <option value="L">
             Male
            </option>
             <option @unless($karyawan->jenis_kelamin != 'P') selected @endunless value="P">
             Female
            </option>
          </select>
    </div>
      <div class="form-group">
        <label for="status_nikah">Maritial</label>
        <select class="form-control" name="status_nikah"  id="status_nikah">        
          <option value="K">
           Married
          </option>
           <option @unless($karyawan->status_nikah != 'BK') selected @endunless value="BK">
           Single
          </option>
        </select>
    </div>
      <div class="form-group">
        <label for="jumlah_anak">Number of Children</label>
        <input type="number" class="form-control" id="jumlah_anak" placeholder="Enter Number of Children" name="jumlah_anak" value="{{ $karyawan->jumlah_anak }}">
    </div>
      <div class="form-group">
        <label for="jenjang_pendidikan">Last Education Level</label>
        <input type="text" class="form-control" id="jenjang_pendidikan" placeholder="Enter Last Education Level" name="jenjang_pendidikan" value="{{ $karyawan->jenjang_pendidikan }}">
    </div>
      <div class="form-group">
        <label for="asal_sekolah">School Name</label>
        <input type="text" class="form-control" id="asal_sekolah" placeholder="Enter School Name" name="asal_sekolah" value="{{ $karyawan->asal_sekolah }}">
    </div>
      <div class="form-group">
        <label for="jurusan">Majors</label>
        <input type="text" class="form-control" id="jurusan" placeholder="Enter Majors" name="jurusan" value="{{ $karyawan->jurusan }}">
    </div>
      <div class="form-group">
        <label for="tahun_masuk_pendidikan">Year of Education</label>
        <input type="text" class="form-control" id="tahun_masuk_pendidikan" placeholder="Enter Year of Education" name="tahun_masuk_pendidikan" value="{{ $karyawan->tahun_masuk_pendidikan }}" maxlength="4">
    </div>
      <div class="form-group">
        <label for="tahun_keluar_pendidikan">Year of Graduation</label>
        <input type="text" class="form-control" id="tahun_keluar_pendidikan" placeholder="Enter Year of Graduation" name="tahun_keluar_pendidikan" value="{{ $karyawan->tahun_keluar_pendidikan }}" maxlength="4">
    </div>
      <div class="form-group">
        <label for="golongan_darah">Blood Type</label>
        <input type="text" class="form-control" id="golongan_darah" placeholder="Enter Blood Type" name="golongan_darah" value="{{ $karyawan->golongan_darah }}" maxlength="2">
    </div>
     <div class="row">
      <div class="col">
      <div class="form-group">
        <label for="nama_kerabat">Relatives Name</label>
        <input type="text" class="form-control" id="nama_kerabat" placeholder="Enter Relative Name" name="nama_kerabat" value="{{ $karyawan->nama_kerabat }}" maxlength="80">
    </div>
    
      <div class="form-group">
        <label for="notelp_kerabat">Relative Number</label>
        <input type="text" class="form-control" id="notelp_kerabat" placeholder="Enter Emergency Contact" name="notelp_kerabat" value="{{ $karyawan->notelp_kerabat }}" maxlength="16">
    </div>
      <div class="form-group">
        <label for="benefit_karyawan">Employee Benefit</label>
        <input type="text" class="form-control" id="benefit_karyawan" placeholder="Enter Employee Benefit" name="benefit_karyawan" value="{{ $karyawan->benefit_karyawan }}">
    </div>
      <div class="form-group">
        <label for="base_salary">Base Salary</label>
        <input type="number" class="form-control" id="base_salary" placeholder="Enter Base Salary" name="base_salary" value="{{ $karyawan->base_salary }}">
    </div>
      <div class="form-group">
        <label for="quota_cuti">Leave Quota Annual</label>
        <input type="number" class="form-control" id="quota_cuti" placeholder="Enter Leave Quota Annual" name="quota_cuti" value="{{ $karyawan->quota_cuti }}">
      </div>
    </div>
    <div class="col">
    <div class="form-group">
       
    <div class="col-sm-10 imgUp center" >
       <label for="photo" >Employee Photo</label>
        <div class="imagePreview" style="background-image: url({{asset('resources/images/photo_profile/'.$karyawan->photo_profile)}});"></div>

        <label class="btn btn-primary btn-primary-up">Upload
      <input type="file" class="uploadFile img" name="photo_profile" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
         </label>
      </div>
    </div>
    </div>

    </div>
      <button type="submit" class="btn btn-warning" style="padding: 7px 50px;width: 100%;margin-top: 20px;">Update</button>
      </div>
    </form>

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
