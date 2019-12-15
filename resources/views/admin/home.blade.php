@extends('layouts.app')
@section('content')
<style>
  .py-4{
    background: none;
}
#myInput {
  background-image: url(http://localhost/slide/resources/image/searchicon.png);
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 19px 12px 47px;
    border:2px solid #c6c6c6;
    margin-bottom: 12px;
    border-radius: 10px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
li{
  transition: 0.8s;
}
.card {
   
    border-radius: 15px;

  }
.card:hover{
    box-shadow: 5px 5px 10px #aaaaaa;
   border: 1px solid#2980b9;
  transition: 0.5s;
}
.i-color{
  color: #2980b9;
    font-size: 40px;
    padding: 10px;
  
  }
.icon-fa{
  background: #fff;
    width: 60px;
    height: 60px;
    margin: 0px auto;
    border-radius: 8px;
}
p{
  font-size: .9em;
  text-align: justify;
}

  h5{
    text-align: center;
  }
  
</style>
<div class="container-fluid">
  <input type="text" id="myInput" onkeyup="AutoSearchHome()" placeholder="Search for pages.." title="Type in a name">
                  
                  <div class="card-columns">
                    <ul id="myUL">                   
                    <li><a href="{{route('index.karyawan')}}">
                      <div class="card" >
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-user"></i></div>
                        <h5 class="card-title">Employee Page </h5>
                        <p class="card-text">You can do employee management using this menu. additions, subtractions, and changes to employee data.</p>
                      </div>
                    </div></a></li>
                    <li><a href="{{route('index.mutasi')}}">
                      <div class="card" >
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-address-card-o"></i></div>
                        <h5 class="card-title">Mutation Page</h5>
                        <p class="card-text">All employee mutation data you can record and create. You can also make changes to the data that has been made.</p>
                      </div>
                    </div></a></li>
                    <li><a href="{{route('index.department')}}">
                      <div class="card">                    
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-building"></i></div>
                        <h5 class="card-title">Department Config Page</h5>
                        <p class="card-text">On this menu the office contains all departments and can be updated according to the needs of the office.</p>
                      </div>
                    </div></a></li>
                    <li><a href="{{route('index.leveling')}}">
                      <div class="card" >                    
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-connectdevelop"></i></div>
                        <h5 class="card-title">Levelling Config Page</h5>
                        <p class="card-text">Can modify levels in each division and create new levels if needed.</p>                      
                      </div>
                    </div></a></li>
                    <li><a href="{{route('index.status')}}">
                      <div class="card">
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-id-badge"></i></div>
                        <h5 class="card-title">Status Config Page</h5>
                        <p class="card-text">Display staffing status in all divisions and make changes to the data in accordance with the applicable status.</p>                        
                      </div> 
                    </div></a></li>                  
                      <li> <a href="{{route('index.gaji')}}">
                      <div class="card">
                      <div class="card-body">                       
                        <div class="icon-fa">
                        <i class="i-color fa fa-money"></i></div>
                        <h5 class="card-title">Salary Page</h5>
                        <p class="card-text">Overall salary calculation. along with addition or subtraction for each employee.</p>                     
                      </div>
                    </div></a></li>
                      <li><a href="{{route('importer.jadwal')}}"> 
                      <div class="card">                        
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-calendar"></i></div>
                        <h5 class="card-title">Schedule Page </h5>
                        <p class="card-text">Determine shifts for each employee using data import or adding new data based on the current month.</p>                       
                      </div>
                    </div></a></li>
                     <li><a href="{{route('index.lembur')}}"> 
                      <div class="card">                        
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-stack-overflow"></i></div>
                        <h5 class="card-title">Overtime Page</h5>
                        <p class="card-text">All overtime data can be viewed here. to provide status for each overtime entry from each employee in all divisions.</p>                       
                      </div>
                    </div></a></li>                   
                     <li><a href="{{route('index.jatah_makan')}}"> 
                      <div class="card">                        
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-cutlery "></i></div>
                        <h5 class="card-title">Food Amount Page</h5>
                        <p class="card-text">View meal status per day according to employee shift schedule and requests not to take meals.</p>                       
                      </div>
                    </div></a></li>
                    <li><a href="{{route('index.absen')}}"> 
                      <div class="card">                        
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-clock-o"></i></div>
                        <h5 class="card-title">Working Hours Page</h5>
                        <p class="card-text">displays shift details on each employee, can also confirm shift requests from employees.</p>                       
                      </div>
                     
                    </div></a></li>
                     <li><a href="{{route('index.tambah_gaji')}}"> 
                      <div class="card">                        
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-sticky-note-o"></i></div>
                        <h5 class="card-title">Allowance Page</h5>
                        <p class="card-text">Calculate salary addition data for each employee to add to the base salary.</p>                       
                      </div>
                    </div></a></li>
                    <li><a href="{{route('index.kurang_gaji')}}"> 
                      <div class="card">                        
                      <div class="card-body">
                        <div class="icon-fa">
                        <i class="i-color fa fa-sticky-note"></i></div>
                        <h5 class="card-title">Deduction Page</h5>
                        <p class="card-text">Calculating salary reduction data for each employee to reduce the basic salary.</p>                       
                      </div>
                    </div></a></li>
                </ul>
        </div>
    </div> 



@endsection
