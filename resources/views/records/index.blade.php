<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Participantes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Participa con el carro de tus sueños</h1>
        <!-- Botón para redireccionar al formulario de registro -->
        <a href="{{ route('records.create') }}" class="btn btn-primary">Participar</a>
        <br><br>
        @if($winner)
        <!-- Tarjeta verde para mostrar al ganador -->
        <div class="card text-white bg-success mb-3 mx-auto" style="max-width: 18rem;">
            <div class="card-header">Ganador</div>
            <div class="card-body">
                <h5 class="card-title">{{ $winner->name }}</h5>
                <p class="card-text">Número de cédula: {{ $winner->id_number }}</p>
            </div>
        </div>
        @else
        <!-- Mensaje en letras amarillas si no hay ganador -->
        <div class="alert alert-warning text-center" role="alert">
            ¡Aún estamos a tiempo para ganar!
        </div>
        @endif
        <!-- Aquí puedes agregar el listado de participantes si lo deseas -->
    </div>
</body>
</html>
