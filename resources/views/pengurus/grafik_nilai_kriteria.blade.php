@extends('layouts.app')
@section('title','Grafik Nilai Kriteria')

@section('content')
    <main class="app-content">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ml-3">{{$data_pendaftaran->user->name}} ({{$data_pendaftaran->user->nim}}) <br>
                Semester {{$data_pendaftaran->semester}} <br>
                </h3>

                <div class="embed-responsive embed-responsive-16by9 mt-4 ml-4">
                    <canvas class="embed-responsive-item" id="radarChartDemo"></canvas>
                </div>
            </div>
        </div>
    </main>
@endsection
@section("js")

    <script>
        var array =[];
        var array2 =[];
    </script>

    @foreach ($nama_kriteria as $data)

    <script type="text/javascript">
        //Memasukkan data tabel nama kriteria ke array
        array.push(['<?php echo $data?>']);
    </script> 

    @endforeach

    @foreach ($nilai_kriteria as $data)
    <script type="text/javascript">
        //Memasukkan data tabel nama kriteria ke array
        array2.push([<?php echo $data?>]);
    </script> 
    @endforeach

    <script type="text/javascript">
        var data = {

            labels: array,
            datasets: [
                {
                    label: "Data Kriteria",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",    
                    data: array2
                }
            ]
        };
        var pdata = [{
                value: 20,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Complete"
            },
            {
                value: 10,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "In-Progress"
            }
        ]

        var ctxr = $("#radarChartDemo").get(0).getContext("2d");

        var radarChart = new Chart(ctxr).Radar(data);
        
    </script>

@endsection