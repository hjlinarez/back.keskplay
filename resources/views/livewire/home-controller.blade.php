<div>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Resumen de venta</h1>
        <form action="">
            <label for="desde">Desde</label>
            <input type="date" id="desde" class="form-control" wire:model="desde">
            <label for="hasta">Hasta</label>
            <input type="date" id="hasta" class="form-control" wire:model="hasta">
        </form>
        <hr>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card  mb-4">
                    <div class="card-header bg-primary text-white">Ventas</div>
                    <div class="card-body fs-1 text-center">{{ number_format($ventas, 2, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">Premios</div>
                    <div class="card-body fs-1 text-center">{{ number_format($premios, 2, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card  mb-4">
                    <div class="card-header bg-success text-white">Utilidad</div>
                    <div class="card-body fs-1 text-center">{{ number_format($utilidad, 2, ',', '.') }}</div>
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
            <div class="card-header bg-success text-white">
                <i class="fas fa-table me-1"></i>
                Venta (Cajas)
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables_venta" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-end">Ventas</th>
                                <th class="text-end">Premios</th>
                                <th class="text-end">Utilidad</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($venta_cajas as $caja)
                                <tr>
                                    <td class="text-start">{{ $caja->name }}</td>
                                    <td class="text-end">{{ number_format($caja->ventas, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($caja->premios, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($caja->ventas - $caja->premios, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Venta (Operadores)
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
</div>
