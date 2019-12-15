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
</style>

<!-- Modal Gaji -->
<div class="modal fade" id="req-gaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Print Out Salary Slip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('import.absen') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
                  <label for="exampleFormControlSelect1">Month</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">                 
                      <option value="1">Januari</option>
                      <option value="1">Februari</option>
                      <option value="1">Maret</option>     
                      <option value="...">....</option>                
                  </select>
                </div>
            <div class="form-group">
                  <label for="exampleFormControlSelect1">Year</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">                 
                      <option value="1">2019</option>
                      <option value="1">2020</option>
                      <option value="1">2021</option>     
                      <option value="...">....</option>                
                  </select>
                </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" style="background-color: #5d88b3;">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Certificate-->
<div class="modal fade" id="req-cer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Print Out Salary Slip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('import.absen') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
                  <label for="exampleFormControlSelect1">Month</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">                 
                      <option value="1">Januari</option>
                      <option value="1">Februari</option>
                      <option value="1">Maret</option>     
                      <option value="...">....</option>                
                  </select>
                </div>
            <div class="form-group">
                  <label for="exampleFormControlSelect1">Year</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">                 
                      <option value="1">2019</option>
                      <option value="1">2020</option>
                      <option value="1">2021</option>     
                      <option value="...">....</option>                
                  </select>
                </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" style="background-color: #5db391;">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Experience-->
<div class="modal fade" id="req-exp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Print Out Salary Slip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('import.absen') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
                  <label for="exampleFormControlSelect1">Month</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">                 
                      <option value="1">Januari</option>
                      <option value="1">Februari</option>
                      <option value="1">Maret</option>     
                      <option value="...">....</option>                
                  </select>
                </div>
            <div class="form-group">
                  <label for="exampleFormControlSelect1">Year</label>
                  <select name="id_karyawan" class="form-control" id="exampleFormControlSelect1">                 
                      <option value="1">2019</option>
                      <option value="1">2020</option>
                      <option value="1">2021</option>     
                      <option value="...">....</option>                
                  </select>
                </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" style="background-color: #b38e5d;">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
    <div class="row justify-content-center">
       <div class="col-sm-4">
        <div class="card" >
         <div class="card-header "> <h5 class="jdl">Your Profile</h5></div>
        <img class="card-img-top" src="{{ asset('resources/image/1499894492198.png') }}" alt="Card image cap" height="240px" width="100px">
          
        <div class="card-body" style="background: #a2a2a280;border-radius: 0px 0px 14px 14px;">
            <h5 class="card-title mb-3">{{$karyawan->nama}}</h5>
            <h5 class="card-title-work mb-3">{{$karyawan->jabatan}}</h5>
            <h5 class="card-title-b mt-n1">BORN</h5>
              <p class="card-text">{{$karyawan->tanggal_lahir->format('d F Y')}}</p>
            <h5 class="card-title-b mt-n1">ADDRESS</h5>
              <p class="card-text">{{$karyawan->alamat_tinggal}}</p>           
            <h5 class="card-title-b mt-n1">PHONE</h5>
              <p class="card-text">{{$karyawan->no_telp}}</p>
            <h5 class="card-title-b mt-n1">Email</h5>
              <p class="card-text">{{$karyawan->users->email}}</p>
            <h5 class="card-title-b mt-n1">JOIN DATE</h5>
              <p class="card-text">{{$karyawan->created_at->format('d F Y')}}</p>
            <a href="{{route('profile.karyawan')}}" style="all: unset;"><button class="btn btn-info" style="width: 100%;">Look Detail</button>            </a>
        </div>
      </div>
    
       </div>
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header "><h5 class="jdl">Statistics</h5></div>

                <div class="card-body" style="background: #cacaca;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 <canvas id="line-chart" width="800" height="450"></canvas>
                    <script>
                     new Chart(document.getElementById("line-chart"), {
                      type: 'line',
                      data: {
                        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
                        datasets: [{ 
                            data: [86,114,106,106,107,111,133,221,783,133,221,783],
                            label: "Ch1",
                            borderColor: "#3e95cd",
                            fill: false
                          }, { 
                            data: [282,350,411,502,635,809,947,1402,3700,133,221,783],
                            label: "Ch2",
                            borderColor: "#8e5ea2",
                            fill: false
                          }, { 
                            data: [168,170,178,190,203,276,408,547,675,133,221,783],
                            label: "Ch3",
                            borderColor: "#3cba9f",
                            fill: false
                          }, { 
                            data: [40,20,10,16,24,38,74,167,508,133,221,783],
                            label: "Ch4",
                            borderColor: "#e8c3b9",
                            fill: false
                          }, { 
                            data: [6,3,2,2,7,26,82,172,24,38,74,167  ],
                            label: "C5",
                            borderColor: "#c45850",
                            fill: false
                          }
                        ]
                      },
                      options: {
                        title: {
                          display: false,
                          text: ''
                        }
                      }
                    });

                    </script>
                   </div>
                </div>
                <div class="row" style="margin-top: 17px;">
                <div class="col-md-4">
                   <div class="card mb-3" >
                   <div class="card-header "><h5 class="jdl" style="text-align: center;">Salary Slip</h5></div>
                  <div class="card-body" style="background: #5d88b3;">
                    
                    <p class="card-text">Your salary slip with details.</p>   
                    <button type="button" class="btn btn-secondary btn-req" data-toggle="modal" data-target="#req-gaji" data-whatever=""><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    Send Request</button>            
                  </div>
                    
                </div></div>
                <div class="col-md-4">
                   <div class="card mb-3" >
                   <div class="card-header "><h5 class="jdl" style="text-align: center;">Working Certificate</h5></div>
                  <div class="card-body" style="background: #5db391;">
                    
                    <p class="card-text">Based on joining date.</p>
                     <!-- <button type="button" class="btn btn-secondary btn-req"><i class="fa fa-print" aria-hidden="true"></i>
                    Print Out</button>  --> 
                     <button type="button" class="btn btn-secondary btn-req" data-toggle="modal" data-target="#req-cer" data-whatever=""><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    Send Request</button>
                  </div>
                 
                </div></div>
                <div class="col-md-4">
                   <div class="card mb-3" >
                    <div class="card-header "><h5 class="jdl" style="text-align: center;">Working Experience</h5></div>
                  <div class="card-body" style="background: #b38e5d;">
                    
                    <p class="card-text">with promotion, demotion, and warning detail</p>
                     <!-- <button type="button" class="btn btn-secondary btn-req"><i class="fa fa-print" aria-hidden="true"></i>
                    Print Out</button>   -->
                     <button type="button" class="btn btn-secondary btn-req" data-toggle="modal" data-target="#req-exp" data-whatever=""><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    Send Request</button>
                  </div>
                 
                </div></div>
                    </div>
              </div>
                </div>

            </div>
@endsection
