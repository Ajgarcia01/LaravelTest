@extends('days.layout')
@section('content')
<!doctype html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
</head>
<body>
<div class="card" style="margin:20px;">
  <div class="card-header">Crear Dias Festivos Nuevos</div>
  <div class="card-body">

      <form action="{{ url('days') }}" method="post">
        {!! csrf_field() !!}
        <label>Nombre</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Color</label></br>
        <input type="color" id="color" name="color" class="" value="#ff0000"><br><br>
        <label>Fecha</label></br>
        <div class='input-group date' id='datetimepicker1' data-target-input="nearest">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <input type='text' name="fecha" id="fecha" class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="Introduce una fecha" class="form-control" />
        </div>
        <br>
        <div>
            <label for="recurrent">Este festivo es recurrente año tras año?</label>
            <div style="margin: 10px">
                <input id="recurrent_yes" type="checkbox" name="recurrent" value="1">
                <label for="recurrent_yes">Sí</label>
                <input id="recurrent_no" type="checkbox" name="recurrent" value="0">
                <label for="recurrent_no">No</label>
            </div>
        </div>

        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
  </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format:'L',
            viewMode: 'years',
        });
    });

    $(document).ready(function() {
        $('#recurrent_yes').change(function() {
            if ($(this).is(':checked')) {
                $('#recurrent_no').prop('checked', false);
            }
        });

        $('#recurrent_no').change(function() {
            if ($(this).is(':checked')) {
                $('#recurrent_yes').prop('checked', false);
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
