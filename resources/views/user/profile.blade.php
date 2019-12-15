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
	color: #2c3e50;
	line-height: 37px;
	margin: 22px 10px;
	font-size: 2.4em;
	margin-bottom: 0px;
	line-height: none;
}
.card-title-b{
	color:#2c3e50;
	font-size: 18px;
	text-transform: none;
	margin: 5px;
	/*max-width: 77%;*/
}
.card-title-work{
	margin: 10px;
}
.card-title-b{
	font-weight: 700;
}
.t-text{
	font-weight: 600;
}
.card-box-profile{
	box-shadow: 2px 2px 12px 2px rgba(0, 0, 0, 0.42) !important;
	margin-bottom: 40px;
}
.card-img-top{
	border-radius: 0px;
	width: 100%;
	height: 100%;
	object-fit: cover;
	margin:0px;
}
.profile-box{
	border: 0px;
}
.col-sm-4{
margin:0px;
}
.jdl{
	font-size: 40px; 
	margin: 70px 0px 40px 0px;
}
  .bk-card {
 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;

}
  .bk-card::before {
    content: "";
	position: absolute;
	top: 0;
	left: 15px;
	width: 63%;
	height: 5%;	
	background-image: linear-gradient(120deg,#170739,#0097c4);
	opacity: .7;
	border-bottom: 3px solid #dbaf00;
}
.img-border
{
	border: 3px solid
#e6c74d;

height: 91%;

position: absolute;

width: 78%;

margin: 20px;
}
</style>

<div class="container">
    <div class="row justify-content-center">
       <div class="col-sm-11">
       	<div class="card profile-box " style="box-shadow: 2px 2px 12px 2px rgba(0, 0, 0, 0.42) !important;">
       	
       	<div class="row">
       		<div class="col-sm-4">    <div class="img-border"></div>    
	       <img class="card-img-top" src="{{ asset('resources/image/photo.jpg') }}" alt="Card image cap" style="width: 100%">
	        </div>

	        <div class="col-sm-8">
	        <div class="card-body">
	        <h5 class="card-title">{{$karyawan->nama}}</h5>
	        <h5 class="card-title-work">{{$karyawan->jabatan}}</h5>
	        <div style="border-bottom: 1px solid #a6a3a3;"></div>
	        <div class="col-sm-12" style="overflow-x:auto;padding-bottom: 12px;">
		        <table style="width: 100%;" >
		        <tr><td>
	            <h5 class="card-title-b" style="margin-top: 15px;">Age</h5></td>
	            <td> <p class="card-title-b t-text" style="margin-top: 15px;">{{$karyawan->usia}}</p>
	            </td></tr>
	             <tr><td>
	            <h5 class="card-title-b">Address</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->alamat_tinggal}}</p>
	            </td></tr>
	             <tr><td>
	            <h5 class="card-title-b">Email</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->users->email}}</p>
	            </td></tr>
	             <tr><td>
	            <h5 class="card-title-b">Phone</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->no_telp}}</p>
	            </td></tr>
	             <tr><td>
	            <h5 class="card-title-b">Join Date</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->created_at->format('d F Y')}}</p>
	            </td> </tr>          
	            </table>   
        	</div>            
	        </div>

	         <div class="card-body " 
	         style="background-image: linear-gradient(120deg,#170739,#0097c4); 
	      
	         border-radius: 0px;
	        
	         border-top: 5px solid #f1c40f;">
	         	<div class="bk-card">
	         	<div class="row">
	         		<div class="col-sm-4">
	         		<h5 class="card-title-b" style="color:#e1e1e1;font-size: 13px;">Account Create</h5>
	         		<p class="card-title-b t-text" style="color:#f1c40f;font-size: 16px;">{{$karyawan->created_at}}</p>
	         		</div>
	         		<div class="col-sm-4">
	         		<h5 class="card-title-b" style="color:#e1e1e1;font-size: 13px;">Last Update</h5>
	         		<p class="card-title-b t-text" style="color:#f1c40f;font-size: 16px;">{{$karyawan->updated_at}}</p>
	         		</div>
	         	</div>
	         	<!-- 	  <img src="{{ asset('resources/image/logo2.png') }}" style="height: 30px;margin:5px;"> -->
	         	</div>

            	 </div>
	        </div>

      	</div> </div>
      </div>
      
 		<h5 class="jdl">Detail Information</h5>
 		<div class="col-sm-12">              	
       	<div class="row">
       		
       		<div class="col-sm-6">
       		 <div class="row">

       		  <div class="col-sm-12">
	       		<div class="card profile-box card-box-profile" style="background: linear-gradient(120deg,#170739,#18333c)!important;">      				
		        <div class="card-body">
	        	<div class="card-box-profile-jdl">ROLE</div>
		      
		        <div style="border-bottom: 1px solid #a6a3a3;margin-bottom: 30px;"></div>
		        <div class="col-sm-12" style="overflow-x:auto;padding-bottom: 12px;">
		        <table style="width: 100%;" >
		        <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Department</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;" >{{$karyawan->department->name}}</p>
	         	</td></tr>
	             <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Position</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->jabatan}}</p>
	         	</td></tr>
	            <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Level</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->leveling->name}}</p>
	         	</td></tr>
	            <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Status</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->status_karyawan->name}}</p>
	         	</td></tr>
	            <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Training Date</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->tanggal_training->format('d F Y	')}}</p>
	         	</td></tr>  
	            <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Join Date</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->created_at->format('d F Y')}}</p>
	         	</td></tr>
	            <tr><td><div style="background-color: #d0a90a;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Out Date</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->tanggal_keluar}}</p>
	         	</td></tr>   
	            </table>   
	      	  </div>
	          </div>	            
		      </div>
		      </div>
		 

		       <div class="col-sm-12">
	       		<div class="card profile-box card-box-profile" style="background: linear-gradient(120deg,#530c04,#18333c) !important;">      				
		        <div class="card-body">
	        	<div class="card-box-profile-jdl" style="color: #fff;">INFORMATION</div>
		      
		        <div style="border-bottom: 1px solid #a6a3a3;margin-bottom: 30px;"></div>
		        <div class="col-sm-12" style="overflow-x:auto;padding-bottom: 12px;">
		        <table style="width: 100%;" >
		        <tr><td><div style="background-color: #fdfdfd;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">BASE SALARY</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;" >Rp. {{$karyawan->base_salary}}</p>
	         	</td></tr>	
	             <tr><td><div style="background-color: #fdfdfd;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Employee Benefits</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->benefit_karyawan}}</p>
	         	</td></tr>
	            <tr><td><div style="background-color: #fdfdfd;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" style="color: #8a8a8a;">Leave Quota</h5></td>
	            <td> <p class="card-title-b t-text" style="color: #fff;">{{$karyawan->quota_cuti}}</p>
	         	</td></tr>	              
	            </table>   
	      	  </div>
	          </div>	            
		      </div>
		      </div>

      		 </div> 
      		</div>
      		
      		<div class="col-sm-6">
       		<div class="card profile-box " style="box-shadow: 2px 2px 12px 2px rgba(0, 0, 0, 0.42) !important;">      			
	        <div class="card-body">
		      <div class="card-box-profile-jdl" style="color: #27ae60;">PERSONAL</div>
		        <div style="border-bottom: 1px solid #a6a3a3;margin-bottom: 30px;"></div>
		        <div class="col-sm-12" style="overflow-x:auto;padding-bottom: 12px;">
		        <table style="width: 100%;" >
		        <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b" >Nickname</h5></td>
	            <td> <p class="card-title-b t-text" >{{$karyawan->nickname}}</p>
	            </td></tr>
	             <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Gender</h5></td>
	            @if($karyawan->jenis_kelamin == 'L')
	            <td> <p class="card-title-b t-text"> <p class="card-title-b t-text"> Male </p>
	            	@else 
	            	 <p class="card-title-b t-text"> <p class="card-title-b t-text">Female</p> @endif
	            </p></p>
	             <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>	              
	            <h5 class="card-title-b">Date of birth</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->tanggal_lahir->format('d F Y')}}</p>
	            </td></tr>
	             <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Address (KTP)</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->alamat_ktp}}</p>
	            </td></tr>
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">KTP Number</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->no_ktp}}</p>
	            </td></tr> 	            
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">NPWP Number</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->no_npwp}}</p>
	            </td></tr>
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Tax Classification</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->klasifikasi_pajak}}</p>
	            </td></tr>  
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">KPJ BPJS</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->kpj_bpjs}}</p>
	            </td></tr>  
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">BPJS</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->bpjs_kesehatan}}</p>
	            </td></tr>  
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Account Number</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->no_rek}}</p>
	            </td></tr>  
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Status</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->status_nikah}}</p>
	            </td></tr> 
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Childern</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->jumlah_anak}}</p>
	            </td></tr> 
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Education</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->jenjang_pendidikan}}</p>
	            </td></tr>   
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">School</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->asal_sekolah}}</p>
	            </td></tr>  
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Major</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->jurusan}}</p>
	            </td></tr>     
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Year Of Education</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->tahun_masuk_pendidikan}}</p>
	            </td></tr> 
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Year Of Graduation</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->tahun_keluar_pendidikan}}</p>
	            </td></tr> 
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Blood Type</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->golongan_darah}}</p>
	            </td></tr> 
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Relatives Name</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->nama_kerabat}}</p>
	            </td></tr>   
	            <tr><td><div style="background-color: #27ae60;width: 4px;height: 32px;"></div></td><td>
	            <h5 class="card-title-b">Relatives Phone</h5></td>
	            <td> <p class="card-title-b t-text">{{$karyawan->notelp_kerabat}}</p>
	            </td></tr>	              
	            </table>
	        </div>
	        </div>
      


	        </div>

	    </div>



     	 </div>


	</div>

</div>
@endsection
