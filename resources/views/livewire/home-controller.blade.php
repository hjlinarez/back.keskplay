<div>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Resumen de ventas</h1>
        
        <form action="">

            <div class="row">
                <div class="col">
                    <label for="desde">Desde</label>
                    <input type="date" name="desde" id="desde" class="form-control" wire:model="desde">
                </div>
                <div class="col">
                    <label for="hasta">Hasta</label>
                    <input type="date" id="hasta" class="form-control" wire:model="hasta">
                </div>
            </div>
            
            
            
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
            <div class="card-header fs-4">
                <i class="fas fa-table me-1"></i>
                Operadores
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables_venta" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-start">Operador</th>
                                <th class="text-end">Ventas</th>
                                
                                <th class="text-end">Premios</th>
                                <th class="text-end">Utilidad</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($venta_operadores as $operador)
                                <tr>
                                    <td class="text-start">{{ $operador->name }}</td>
                                    <td class="text-end">{{ number_format($operador->ventas, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($operador->premios, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($operador->ventas - $operador->premios, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header fs-4">
                <i class="fas fa-table me-1"></i>
                Cajas
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
                                    <td class="text-end">{{ number_format($caja->ventas - $caja->premios, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="text-start">Totales</td>
                                <td class="text-end">{{ number_format($venta_cajas->sum('ventas'), 2, ',', '.') }}</td>
                                <td class="text-end">{{ number_format($venta_cajas->sum('premios'), 2, ',', '.') }}</td>
                                <td class="text-end">{{ number_format($venta_cajas->sum('ventas') - $venta_cajas->sum('premios'), 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>




        



    </div>
</div>

