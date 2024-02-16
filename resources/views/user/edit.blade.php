@extends('user.layout')
@section('content')
<div class="card" style="margin:20px;">
  <div class="card-header">Editar Usuario</div>
  <div class="card-body">

      <form action="{{ url('user/' .$user->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$user->id}}" id="id" />
        <label>Nombre</label></br>
        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control"></br>
        <label>Apellidos</label></br>
        <input type="text" name="surname" id="surname" value="{{$user->surname}}" class="form-control"></br>
        <label>Email</label></br>
        <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control"></br>
        <input type="submit" value="Actualizar" class="btn btn-success"></br>
    </form>

  </div>
</div>

@stop
