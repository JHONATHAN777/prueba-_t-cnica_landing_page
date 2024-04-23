<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Registro de Cliente</h1>
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('records.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="last_name">Apellido:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}">
            </div>
            <div class="form-group">
                <label for="id_number">Número de Identificación:</label>
                <input type="text" id="id_number" name="id_number" class="form-control" value="{{ old('id_number') }}">
            </div>
            <div class="form-group">
                <label for="department">Departamento:</label>
                <input type="text" id="department" name="department" class="form-control" value="{{ old('department') }}">
            </div>
            <div class="form-group">
                <label for="city">Ciudad:</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label for="cellphone">Teléfono Celular:</label>
                <input type="text" id="cellphone" name="cellphone" class="form-control" value="{{ old('cellphone') }}">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" id="habeas_data" name="habeas_data" class="form-check-input" value="1">
                <label for="habeas_data" class="form-check-label">Acepto Habeas Data</label>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <div class="container">
            <!-- Tu formulario aquí -->
            
            <div class="mt-3">
                <a href="{{ route('export.records') }}" class="btn btn-success">Descargar Registros</a>
            </div>
        </div>
    </div>
    <br><br>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
