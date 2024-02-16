@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Calendario</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div data-provide="calendar"></div>

    </section>
    <!-- /.content -->
  </div>

</div>
<!-- ./wrapper -->

</body>
</html>
<script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
<script src="https://unpkg.com/js-year-calendar@latest/locales/js-year-calendar.es.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentYear = new Date().getFullYear();
        let Color = (str) => {
            let data = {
                tof: "#ffae44",
                genshin: "#69e0ff",
                default: "#456"
            };
            return data.hasOwnProperty(str) ? data[str] : data["default"];
        };
        let calDate = (y, m, d) => new Date(y, m - 1, d);

        let events = [
            @foreach($days as $day)
                @if($day->recurrent)
                    // Si el día es recurrente, agregarlo para todos los años
                    @for($year = date('Y'); $year <= date('Y') + 10; $year++)
                        {
                            name: "{{ $day->day }}/{{ $day->month }}/{{ $year }}",
                            details: "{{ $day->name }}",
                            color: "{{ $day->color }}",
                            startDate: calDate({{ $year }}, {{ $day->month }}, {{ $day->day }}),
                            endDate: calDate({{ $year }}, {{ $day->month }}, {{ $day->day }})
                        },
                    @endfor
                @else
                    // Si el día no es recurrente, agregarlo solo para el año registrado
                    {
                        name: "{{ $day->day }}/{{ $day->month }}/{{ $day->year }}",
                        details: "{{ $day->name }}",
                        color: "{{ $day->color }}",
                        startDate: calDate({{ $day->year }}, {{ $day->month }}, {{ $day->day }}),
                        endDate: calDate({{ $day->year }}, {{ $day->month }}, {{ $day->day }})
                    },
                @endif
            @endforeach
        ];

        new Calendar(".calendar", {
            displayHeader: true,
            style: "border",
            language: "es",
            dataSource: events,
            mouseOnDay: function(e) {
                if (e.events.length > 0) {
                    var content = "";
                    for (var i in e.events) {
                        content +=
                            '<div class="event-tooltip-content">' +
                            '<div class="event-name" style="color:' +
                            e.events[i].color +
                            ';font-weight:bold">' +
                            e.events[i].name +
                            "</div>" +
                            '<div class="event-details" style="color:#bbb">' +
                            e.events[i].details +
                            "</div>" +
                            "</div>";
                    }
                    tippy(e.element, {
                        content: content,
                        allowHTML: true,
                        animation: "scale-extreme",
                        placement: "bottom",
                        followCursor: true,
                    });
                }
            }
        });
    });
</script>

@endsection
