@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
            <div class="row" style="margin:0px;">
                <div class="col-12">
                    <h2> <i class="fas fa-users" style="color: black; margin-right: 10px; margin-bottom: 10px; margin: 10px" aria-hidden="true"></i>Listado de Usuarios</h2>
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/user/create') }}" class="btn btn-success btn-sm" title="Añade un nuevo usuario">
                                Añadir Nuevo
                            </a>
                            <br/>
                            <br/>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-3">
                                    <form method="GET" action="{{ url('/users') }}" class="form-inline mb-3">
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
                                    <form action="{{ url('/users') }}" method="GET" class="form-inline mb-3">
                                        <label style="margin-right: 5px" for="search">Buscar:</label>
                                        <input type="text" name="search" id="search" class="form-control mr-2" value="{{ request()->input('search') }}">
                                        <button type="submit" class="btn btn sidemenu-bg">Buscar</button>
                                    </form>
                                </div>
                            </div>
                        <div class="table-responsive">



                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->surname }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Editar Usuario"><button class="btn btn-success btn-sm"><i class="fas fa-edit" aria-hidden="true"></i> </button></a>
                                            <form method="POST" action="{{ url('/users' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Borrar Usuario" onclick="return confirm('¿Confirmar eliminación?')"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-3">
                                    Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }} resultados
                                </div>
                                <div class="mb-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end mb-0">
                                            <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}">Anterior</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Página {{ $users->currentPage() }} de {{ $users->lastPage() }}</a>
                                            </li>
                                            <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}">Siguiente</a>
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
@endsection
