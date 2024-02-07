@extends('app')

@section('content')
    <h1 class="mt-5">Días festivos </h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Día</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Recurrente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diasFestivos as $dia)
                <tr>
                    <td>{{ $dia->id }}</td>
                    <td>{{ $dia->nombre }}</td>
                    <td><input type="color" value="{{ $dia->color }}" disabled> {{ $dia->color }}</td>
                    <td>{{ $dia->dia }}</td>
                    <td>{{ $dia->mes }}</td>
                    <td>{{ $dia->año }}</td>
                    <td><input type="checkbox" {{ $dia->recurrente == 1 ? 'checked' : '' }} disabled="true" > <!--{{$dia->recurrente}}--></td>


                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editTypeModal{{ $dia->id }}">Editar</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteTypeModal{{ $dia->id }}">Borrar</button>
                    </td>
                </tr>
                <!-- Edit Type Modal -->
                <div class="modal fade" id="editTypeModal{{ $dia->id }}" tabindex="-1"
                    aria-labelledby="editTypeModal{{ $dia->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTypeModal{{ $dia->id }}Label">Editar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('dias-festivos.update', $dia->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Name:</label>
                                        <input type="text" name="nombre" id="nombre{{ $dia->id }}" value="{{ $dia->nombre }}"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text" class="form-label">Color:</label>
                                        <input type="color" name="color" id="color{{ $dia->id }}" value="{{ $dia->color }}"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="dia" class="form-label">Día:</label>
                                        <input type="number" name="dia" id="dia{{ $dia->id }}" value="{{ $dia->dia }}"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="mes" class="form-label">Mes:</label>
                                        <input type="number" name="mes" id="mes{{ $dia->id }}" value="{{ $dia->mes }}"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="año" class="form-label">Año:</label>
                                        <input type="number" name="año" id="año{{ $dia->id }}" value="{{ $dia->año }}" {{ $dia->recurrente == 1 ? 'disabled' : '' }}
                                            class="form-control">
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input class="form-check-input" type="checkbox" name="recurrente"
                                        value="{{ $dia->recurrente }}"  {{ $dia->recurrente == 1 ? 'checked' : '' }} id="recurrente{{$dia->id}}">
                                        <label class="form-check-label" for="recurrente{{$dia->id}}">
                                            Recurrente
                                        </label>
                                    </div>

                                    <script>
                                        document.getElementById('recurrente{{ $dia->id }}').addEventListener('click', function() {
                                            if (this.checked) {
                                                this.value = 1;
                                                document.getElementById('año{{ $dia->id }}').disabled = true;
                                            } else {
                                                this.value = 0;
                                                document.getElementById('año{{ $dia->id }}').disabled = false;
                                                document.getElementById('año{{ $dia->id }}').value = new Date().getFullYear();
                                            }
                                        });
                                    </script>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Type Modal -->
                <div class="modal fade" id="deleteTypeModal{{ $dia->id }}" tabindex="-1"
                    aria-labelledby="deleteTypeModal{{ $dia->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteTypeModal{{ $dia->id }}Label">Borrar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this Type?</p>
                                <p>ID: {{ $dia->id }}</p>
                                <p>Nombre: {{ $dia->nombre }}</p>
                                <p>Color: {{ $dia->color }}</p>
                                <p>Día: {{ $dia->dia }}</p>
                                <p>Mes: {{ $dia->mes }}</p>
                                <p>Año: {{ $dia->año }}</p>
                                <p>Recurrente: {{ $dia->recurrente }}</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('dias-festivos.destroy', $dia->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <!-- Button trigger modal -->
    <div style="text-align: center">
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createTypeModal">
            Crear dia festivo
        </button>
    </div>

    <!-- Type Create Modal -->
    <div class="modal fade" id="createTypeModal" tabindex="-1" aria-labelledby="createTypeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTypeModalLabel">Crear dia festivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dias-festivos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombreE" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Color:</label>
                            <input type="color" name="color" id="colorN" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="dia" class="form-label">Día:</label>
                            <input type="text" name="dia" id="diaN" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="mes" class="form-label">Mes:</label>
                            <input type="text" name="mes" id="mesN" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="año" class="form-label">Año:</label>
                            <input type="text" name="año" id="añoN" class="form-control">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="recurrenteN" name="recurrente">
                                <label class="form-check-label" for="recurrente">
                                Recurrente
                                </label>
                              </div>
                        </div>
                        <script>
                            document.getElementById('recurrenteN').addEventListener('click', function() {
                                if (this.checked) {
                                    this.value = 1;
                                    document.getElementById('añoN').disabled = true;
                                } else {
                                    this.value = 0;
                                    document.getElementById('añoN').disabled = false;
                                }
                            });
                        </script>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
