@extends('layouts.app2')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<div class="container">
    <div class="row justify-content-center">
       <div class="col-sm-4">
        <div class="card" style="width: 20rem;">
        <img class="card-img-top" src="{{ asset('resources/image/1499894492198.png') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Nama user</h5>
          <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>


       </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
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
                    data: [86,114,106,106,107,111,133,221,783],
                    label: "Ch1",
                    borderColor: "#3e95cd",
                    fill: false
                  }, { 
                    data: [282,350,411,502,635,809,947,1402,3700],
                    label: "Ch2",
                    borderColor: "#8e5ea2",
                    fill: false
                  }, { 
                    data: [168,170,178,190,203,276,408,547,675],
                    label: "Ch3",
                    borderColor: "#3cba9f",
                    fill: false
                  }, { 
                    data: [40,20,10,16,24,38,74,167,508],
                    label: "Ch4",
                    borderColor: "#e8c3b9",
                    fill: false
                  }, { 
                    data: [6,3,2,2,7,26,82,172,312  ],
                    label: "C5",
                    borderColor: "#c45850",
                    fill: false
                  }
                ]
              },
              options: {
                title: {
                  display: true,
                  text: 'Statistik Kinerja Dalam Setahun'
                }
              }
            });

            </script>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
@endsection
