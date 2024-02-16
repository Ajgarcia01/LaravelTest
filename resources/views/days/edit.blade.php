@extends('days.layout')
@section('content')

<div class="card" style="margin:20px;">
  <div class="card-header">Editar Dia Festivo</div>
  <div class="card-body">

      <form action="{{ url('days/' .$days->id) }}" method="post">
        {!! csrf_field() !!}
        @csrf
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$days->id}}" id="id" />
        <label>Nombre</label></br>
        <input type="text" name="name" id="name" value="{{$days->name}}" class="form-control"></br>
        <label>Color</label></br>
        <input type="color" id="color" name="color" class="" value="{{$days->color}}"><br><br>
        <label>Día</label></br>
        <input type="text" name="day" id="day" value="{{$days->day}}" class="form-control"></br>
        <label>Mes</label></br>
        <input type="text" name="month" id="month" value="{{$days->month}}" class="form-control"></br>
        <label>Año</label></br>
        <input type="text" name="year" id="year" value="{{$days->year}}" class="form-control"></br>
        <div>
            <label for="recurrent">Este festivo es recurrente año tras año?</label>
            <div style="margin: 10px">
                <input id="recurrent_yes" type="checkbox" name="recurrent" value="1" {{ $days->recurrent == 1 ? 'checked' : '' }}>
                <label for="recurrent_yes">Sí</label>
                <input id="recurrent_no" type="checkbox" name="recurrent" value="0" {{ $days->recurrent == 0 ? 'checked' : '' }}>
                <label for="recurrent_no">No</label>
            </div>
        </div>
        <input type="submit" value="Editar" class="btn btn-success"></br>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#recurrent_yes').change(function() {
            if ($(this).is(':checked')) {
                $('#recurrent_no').prop('checked', false);
                $('[name="recurrent"]').val(1);
            }
        });

        $('#recurrent_no').change(function() {
            if ($(this).is(':checked')) {
                $('#recurrent_yes').prop('checked', false);
                $('[name="recurrent"]').val(0);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#colorPicker').spectrum({
            color: $('#color').val(),
            change: function(color) {
                $('#color').val(color.toHexString());
            }
        });
    });
</script>
@stop






