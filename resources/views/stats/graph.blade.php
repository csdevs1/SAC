@extends('layouts.app')
@section('title','Sistema de Tickets')
@section('content')
    @section('nav-title','Reporte')
    @section('icon','pie_chart')
    @include('layouts.nav')

    <!--Main layout-->
    <main class="z-depth-3 white lighten-5">
        <div class="row">
            <div class="col s12 m6">
                <h4 class="comfortaa center-align">Resumen Ticket por Via de atencion</h4>
                <div style="max-width: 450px; max-height: 450px;margin:auto">
                    <canvas id="container-attention"></canvas>
                </div>
            </div>
            <div class="col s12 m6">
                <h4 class="comfortaa center-align">Resumen Ticket por Tecnico</h4>
                <div style="max-width: 450px; max-height: 450px;margin:auto">
                    <canvas id="container-tech"></canvas>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col s12">
                <h4 class="comfortaa center-align">Resumen Ticket por Origen</h4>
                <div style="max-width: 850px; max-height: 850px;margin:auto">
                    <canvas id="container-device"></canvas>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        var get_data=function(path,date_init,date_end){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{date_init:date_init,date_end:date_end},
                url: '/graph/get/'+path+'/'
            });
        }

        var ticket_by_attention=function(date_init,date_end){
            try{
                var a=get_data('attention',date_init,date_end);
                a.done(function(data){
                    var canvas = document.getElementById("container-attention");
                    var ctx = canvas.getContext("2d");
                    console.log(data['email'].length);
                    $chart1 = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: [data['email'].length, data['phone'].length, data['on_site'].length],
                                backgroundColor: [
                                    "#F7464A",
                                    "#46BFBD",
                                    "#EEEE51"
                                ],

                            }],
                            labels: [
                                "Email",
                                "Telefono",
                                "Presencial"
                            ]
                        },options: {
                            legend: {
                                position: 'bottom'
                            },
                        }

                    });
                });
                /*canvas.onclick = function (evt) {
                                var activePoints = $chart1.getElementsAtEvent(evt);
                                var chartData = activePoints[0]['_chart'].config.data;
                                var idx = activePoints[0]['_index'];
                                var label = 'Documentos '+chartData.labels[idx];
                                var key = chartData.datasets[0].keys[idx];
                                var value = chartData.datasets[0].values[key];
                                $('#modal').modal('toggle');
                                $('.modal-title').text(label);
                                var table='<table class="table table-hover"><thead><tr><th>Documento</th><th>Patente</th><th>Status</th></tr></thead><tbody>';
                                $('.modal-body').html('');
                                $('.modal-body').append(table);
                                for(var i in value){
                                    var doc=get_document_info(value[i]);
                                    doc.done(function(r){
                                        r=JSON.parse(r);
                                        var table_body='<tr><td>'+r.document+'</td><td>'+r.plate_number+'</td><td>'+r.status+'</td></tr>';
                                        $('.modal-body .table.table-hover tbody').append(table_body);
                                    });
                                }
                                var table_end='</tbody></table>';
                                $('.modal-body').append(table_end);
                            }*/
            } catch(e){
                console.log(e);
            }
        }

        var ticket_by_device=function(date_init,date_end){
            try{
                var d=get_data('device',date_init,date_end);
                d.done(function(response){
                    var data=[],
                        labels=[];
                    for(var i in response){
                        data.push(response[i]['tickets'].length);
                        labels.push(response[i]['name']);
                    }
                    console.log(labels);
                    var canvas = document.getElementById("container-device");
                    var ctx = canvas.getContext("2d");
                    $chart2 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            datasets: [{
                                data: data,
                                backgroundColor: [
                                    "#F7464A",
                                    "#46BFBD",
                                    "#EEEE51",
                                    "#551A8B",
                                    "#49FF00",
                                    "#3B80DF",
                                    "#ACDF3B",
                                    "#4B0000",
                                    "#D55E00",
                                    "#4D6A8A",
                                    "#000"
                                ]
                            }],
                            labels: labels
                        },options: {
                            legend: {
                                display:false,
                                position: 'bottom'
                            },
                        }

                    });
                });
                /*canvas.onclick = function (evt) {
                                var activePoints = $chart1.getElementsAtEvent(evt);
                                var chartData = activePoints[0]['_chart'].config.data;
                                var idx = activePoints[0]['_index'];
                                var label = 'Documentos '+chartData.labels[idx];
                                var key = chartData.datasets[0].keys[idx];
                                var value = chartData.datasets[0].values[key];
                                $('#modal').modal('toggle');
                                $('.modal-title').text(label);
                                var table='<table class="table table-hover"><thead><tr><th>Documento</th><th>Patente</th><th>Status</th></tr></thead><tbody>';
                                $('.modal-body').html('');
                                $('.modal-body').append(table);
                                for(var i in value){
                                    var doc=get_document_info(value[i]);
                                    doc.done(function(r){
                                        r=JSON.parse(r);
                                        var table_body='<tr><td>'+r.document+'</td><td>'+r.plate_number+'</td><td>'+r.status+'</td></tr>';
                                        $('.modal-body .table.table-hover tbody').append(table_body);
                                    });
                                }
                                var table_end='</tbody></table>';
                                $('.modal-body').append(table_end);
                            }*/
            } catch(e){
                console.log(e);
            }
        }

        $(document).ready(function(){
            var today = new Date(),
                date_end= today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' '+today.getHours()+':'+today.getMinutes()+':'+today.getSeconds();
            today.setDate(today.getDate() - 7);
            var date_init = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' '+today.getHours()+':'+today.getMinutes()+':'+today.getSeconds();

            console.log(date_end);
            console.log(date_init);
            ticket_by_attention(date_init,date_end);
            ticket_by_device(date_init,date_end);
        });
    </script>
    @include('layouts.scripts')
@endsection
