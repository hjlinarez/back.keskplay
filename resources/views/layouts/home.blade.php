<div class="container-fluid px-4">
    <h1 class="mt-4">Inicio</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Actividad del dia</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card  mb-4">
                <div class="card-header bg-primary text-white">Ventas</div>
                <div class="card-body fs-1 text-center">{{ $ventas }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-warning text-white">Comision</div>
                <div class="card-body fs-1 text-center">{{ $comision }}</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">Premios</div>
                <div class="card-body fs-1 text-center">{{ $premios }}</div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card  mb-4">
                <div class="card-header bg-success text-white">Utilidad</div>
                <div class="card-body fs-1 text-center">{{ $utilidad }}</div>
            </div>
        </div>
        
    </div>

    <div class="row visually-hidden">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Ultimos 7 dias
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Ultimos seis meses
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Venta del dia.
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="datatables_venta" class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th class="text-start">Taquilla</th>
                        <th class="text-end">Ventas</th>                            
                        <th class="text-end">Comision</th>
                        <th class="text-end">Premios</th>
                        <th class="text-end">Utilidad</th>
                        
                    </tr>
                </thead>                   
                <tbody>
                    
                
                    
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>


<script>
    function saludar(mensaje)
    {
        console.log(mensaje);
    }

    function graficar(data)
    {
    
        
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data["labels"],
            datasets: [{
            label: "Sessions",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: data["data"],
            }],
        },
        options: {
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                min: 0,
                max: data["max"],
                maxTicksLimit: 5
                },
                gridLines: {
                color: "rgba(0, 0, 0, .125)",
                }
            }],
            },
            legend: {
            display: false
            }
        }
        });

    }
    window.addEventListener('DOMContentLoaded', event => {
            // Simple-DataTables
            // https://github.com/fiduswriter/Simple-DataTables/wiki

            /*const datatablesSimple = document.getElementById('datatables_venta');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }

            fetch('DataGrafico')
            .then(response => response.json())
            .then(data => graficar(data));*/
        });
</script>