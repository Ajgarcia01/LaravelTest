@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content"
            <div class="row" style="margin:0px;">
                <h2> <i class="fas fa-calendar" style="color: black; margin-right: 10px; margin-bottom: 10px; margin: 10px" aria-hidden="true"></i>Dias Festivos</h2>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/days/create') }}" class="btn btn-success btn-sm" title="Add New Day">
                                Añadir Nuevo
                            </a>
                            <br/>
                            <br/>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-3">
                                    <form method="GET" action="{{ url('/days') }}" class="form-inline mb-3">
                                        <label for="records_per_page" style="margin-right: 5px">Mostrar:</label>
                                        <select name="records_per_page" id="records_per_page" class="form-control mr-2" onchange="this.form.submit()">
                                            <option value="10" {{ request()->input('records_per_page') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ request()->input('records_per_page') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request()->input('records_per_page') == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ request()->input('records_per_page') == 100 ? 'selected' : '' }}>100</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="mb-3">
                                    <form action="{{ url('/days') }}" method="GET" class="form-inline mb-3">
                                        <label style="margin-right: 5px" for="search">Buscar:</label>
                                        <input type="text" name="search" id="search" class="form-control mr-2" value="{{ request()->input('search') }}">
                                        <button type="submit" class="btn btn sidemenu-bg">Buscar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive width-color">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Dia</th>
                                            <th scope="col">Mes</th>
                                            <th scope="col">Año</th>
                                            <th scope="col">Recurrente</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($days as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td style="background-color:{{ $item->color }}"> </td>
                                            <td>{{ $item->day }}</td>
                                            <td>
                                                @php
                                                    // Array asociativo para mapear números de mes a nombres de mes
                                                    $meses = [
                                                        '01' => 'Enero',
                                                        '02' => 'Febrero',
                                                        '03' => 'Marzo',
                                                        '04' => 'Abril',
                                                        '05' => 'Mayo',
                                                        '06' => 'Junio',
                                                        '07' => 'Julio',
                                                        '08' => 'Agosto',
                                                        '09' => 'Septiembre',
                                                        '10' => 'Octubre',
                                                        '11' => 'Noviembre',
                                                        '12' => 'Diciembre',
                                                    ];
                                                @endphp

                                                {{ $meses[$item->month] ?? '' }}
                                            </td>
                                            <td>{{ $item->year }}</td>
                                            <td> @if($item->recurrent == 1)
                                                Sí
                                            @else
                                                No
                                            @endif</td>
                                            <td>

                                                <a href="{{ url('/days/' . $item->id . '/edit') }}" title="Editar Día"><button class="btn btn-success btn-sm"><i class="fas fa-edit" aria-hidden="true"></i> </button></a>

                                                <form method="POST" action="{{ url('/days' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm("Confirm delete?")"><i class="far fa-trash-alt" aria-hidden="true"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mb-3">
                                        Mostrando {{ $days->firstItem() }} - {{ $days->lastItem() }} de {{ $days->total() }} resultados
                                    </div>
                                    <div class="mb-3">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end mb-0">
                                                <li class="page-item {{ $days->previousPageUrl() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $days->previousPageUrl() }}">Anterior</a>
                                                </li>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Página {{ $days->currentPage() }} de {{ $days->lastPage() }}</a>
                                                </li>
                                                <li class="page-item {{ $days->nextPageUrl() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $days->nextPageUrl() }}">Siguiente</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
      </section>
      <!-- /.content -->
    </div>

  </div>
</body>
@endsection
