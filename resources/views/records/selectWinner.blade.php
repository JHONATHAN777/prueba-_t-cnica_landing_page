<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Ganador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Seleccionar Ganador</h1>
        <form action="{{ route('records.selectWinner') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Seleccionar Ganador</button>
        </form>
    </div>
</body>
</html>
