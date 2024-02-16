@extends('user.layout')
@section('content')
<div class="card" style="margin:20px;">
  <div class="card-header">Crear un nuevo usuario</div>
  <div class="card-body">

      <form action="{{ url('users') }}" method="post">
        {!! csrf_field() !!}
        <label>Nombre</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Apellidos</label></br>
        <input type="text" name="surname" id="surname" class="form-control"></br>
        <label>Email</label></br>
        <input type="email" name="email" id="email" class="form-control"></br>
        <label>Contraseña</label></br>
        <input type="password" name="password" id="password" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>

  </div>
</div>
@stop
