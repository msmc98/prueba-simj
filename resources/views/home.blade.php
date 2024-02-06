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
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Create Event</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <form action="{{ route('events.create') }}" method="POST" id="event-form">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start">Start Date/Time</label>
                                            <input type="datetime-local" class="form-control" id="start" name="start"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end">End Date/Time</label>
                                            <input type="datetime-local" class="form-control" id="end" name="end"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type">Type</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="event_type_id" id="type">
                                                @foreach ($data['types'] as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Event</button>
                                        </div>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3" id='calendar'></div>
            </div>

        </div>
    </body>

    {{-- importar js-year-calendar --}}
    {{-- <script src="./../../node_modules/js-year-calendar/dist/js-year-calendar.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/js-year-calendar@latest/locales/js-year-calendar.es.js"></script> --}}
    <script>
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

            // let days = await fetchFest()

            let calendar = new Calendar('#calendar', {
                language: 'es',
                enableContextMenu: true,
                // dataSource: days,
                yearChanged: async function(e) {
                    let days = await fetchFest(e.currentYear)
                    calendar.setDataSource(days)
                },

            })
        })
    </script>
@endsection
