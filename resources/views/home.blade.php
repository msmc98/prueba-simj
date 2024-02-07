@extends('app')

@section('content')

    <head>
        <style>
            .fc-scroller {
                overflow-y: hidden !important;
            }
        </style>
    </head>

    <body style="">
        <div class="container" class="">
            <div class="row">
                <div class="col-md-12 mt-5">
                    {{-- <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal"
                        data-bs-target="#myModal">Create Event</button> --}}
                </div>
            </div>
            <div class="mt-3" id='calendar'></div>
        </div>
    </body>

    {{-- importar js-year-calendar --}}
    {{-- <script src="./../../node_modules/js-year-calendar/dist/js-year-calendar.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/js-year-calendar@latest/locales/js-year-calendar.es.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('[data-toggle="tooltip"]').tooltip()
        })

        async function fetchFest(year = new Date().getFullYear()) {
            const res = await fetch(`/api/dias-festivos?año=${year}`)
            const data = await res.json()
            let parser = data.map(day => {
                return {
                    id: day.id,
                    name: day.nombre,
                    // location: 'New Orleans, LA',
                    startDate: new Date(year, day.mes - 1, day.dia),
                    endDate: new Date(year, day.mes - 1, day.dia),
                    color: day.color,
                    recurrent: day.recurrente,
                }
            })
            return parser
        }

        document.addEventListener('DOMContentLoaded', async function() {

            function mostrarEvento(elemento, evento) {
                // Utiliza Bootstrap Tooltip para mostrar el evento
                $(elemento).tooltip({
                    title: evento,
                    placement: 'top',
                    trigger: 'manual'
                }).tooltip('show');
            }

            function ocultarEvento(elemento) {
                // Oculta el tooltip al quitar el mouse
                $(elemento).tooltip('hide');
            }

            let calendar = new Calendar('#calendar', {
                language: 'es',
                enableContextMenu: true,
                // dataSource: days,
                yearChanged: async function(e) {
                    let days = await fetchFest(e.currentYear)
                    calendar.setDataSource(days)
                },
                mouseOnDay: function(e) {
                    if (e.events.length > 0) {
                        evento = e.events.map(event => [new Date(event.startDate)
                            .toLocaleDateString(), event.name
                        ].join(' → ')).join('<br>')
                        mostrarEvento(e.element, evento);
                    }
                },
                mouseOutDay: function(e) {
                    ocultarEvento(e.element);
                },
            })
        })
    </script>
@endsection
