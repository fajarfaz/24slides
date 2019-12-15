@extends('layouts.app2')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<style type="text/css">
  .py-4{
    background:none;
}
.card{
    background: #3e445b7d;
}
.modal-footer{
  justify-content: flex-start;
}
.card-title{
	font-size: 1.4em;
}
</style>

<div class="container">
    <div class="row justify-content-center">
       <div class="col-sm-4">
        <div class="card" >
         <div class="card-header "> <h5 class="jdl" style="text-align: center;">PROFILE</h5></div>
        <img class="card-img-top" src="{{ asset('resources/image/1499894492198.png') }}" alt="Card image cap">
        
        <div class="card-body " style="background: #ceceff80;border-radius: 0px 0px 14px 14px;">

            <h5 class="card-title-b"> <i class="fa fa-money" aria-hidden="true"></i> BASE SALARY</h5>
              <p class="card-text text-color" style="margin-left: 18px;">Rp. {{$karyawan->base_salary}}</p>
            <h5 class="card-title-b"><i class="fa fa-etsy" aria-hidden="true"></i> employee benefits</h5>
              <p class="card-text text-color" style="margin-left: 18px;">{{$karyawan->benefit_karyawan}}</p>           
            <h5 class="card-title-b"><i class="fa fa-book" aria-hidden="true"></i> leave quota</h5>
              <p class="card-text text-color" style="margin-left: 18px;">{{$karyawan->quota_cuti}}</p>
            <h5 class="card-title-b"><i class="fa fa-clock-o" aria-hidden="true"></i> account creation</h5>
              <p class="card-text text-color" style="margin-left: 18px;">{{$karyawan->created_at}}</p>           
        </div>
      </div>
    
       </div>
        <div class="col-md-8">
           <div class="card" >
            <div class="card-header "><h5 class="jdl">detail information</h5></div>

            <div class="card-body " style="background: #a2a2a280;border-radius: 0px 0px 14px 14px;">
            	 <div class="row">
            	 	 <div class="col" style="margin-bottom: 10px;">
            	 	 	 <h5 class="card-title" style="margin-bottom: 14px;">{{$karyawan->nama}}</h5>
            	 	 	  <h5 class="card-title-work">{{$karyawan->jabatan}}</h5>
            	 	 </div>
            	 </div>
               <div class="row">
	            <div class="col" style="margin-bottom: 10px;margin-left: 14px;">
	           	<h5 class="card-title-b">NICKNAME</h5>
	              <p class="card-text">{{$karyawan->nickname}}</p>
	            <h5 class="card-title-b">Department</h5>
	              <p class="card-text">{{$karyawan->department_id}}</p>
	            <h5 class="card-title-b">Levels</h5>
	              <p class="card-text">{{$karyawan->level_id}}</p>	           	           
	            <h5 class="card-title-b">ADDRESS</h5>
	              <p class="card-text">{{$karyawan->alamat_tinggal}}</p>   
	            <h5 class="card-title-b">PHONE</h5>
	              <p class="card-text">{{$karyawan->no_telp}}</p>   
	            <h5 class="card-title-b">Email</h5>
	              <p class="card-text">{{$karyawan->no_telp}}</p>
	            <h5 class="card-title-b">BORN</h5>
	              <p class="card-text">{{$karyawan->tanggal_lahir}}</p>
	            <h5 class="card-title-b">Email</h5>
	              <p class="card-text">{{$karyawan->users->email}}</p>
	           	
	          	</div>

	          	 <div class="col" style="margin-left: 14px">	   
	          	<h5 class="card-title-b">STATUS</h5>
	              <p class="card-text">{{$karyawan->status_id}}</p>       
	            <h5 class="card-title-b">POSITION</h5>
	              <p class="card-text">{{$karyawan->jabatan}}</p>
	            <h5 class="card-title-b">gender</h5>
	              <p class="card-text">{{$karyawan->jenis_kelamin}}</p>
	            <h5 class="card-title-b">training date</h5>
	              <p class="card-text">{{$karyawan->tanggal_training}}</p>           
	            <h5 class="card-title-b">join date</h5>
	                <p class="card-text">{{$karyawan->created_at->format('d F Y')}}</p>
	            <h5 class="card-title-b">out date</h5>
	              <p class="card-text">{{$karyawan->tanggal_keluar}}</p>
	            <h5 class="card-title-b">Date of birth</h5>
	              <p class="card-text">{{$karyawan->tanggal_lahir}}</p>	          
	          	<h5 class="card-title-b">Age</h5>
	              <p class="card-text">{{$karyawan->usia}}</p>
	          	</div>
	          </div>
       		 </div>

          </div>
                
        </div>
               


             
	</div>

</div>
@endsection
