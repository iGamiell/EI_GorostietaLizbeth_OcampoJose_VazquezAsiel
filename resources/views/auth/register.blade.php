<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">
        
        <h3 class="text-center mb-4">
            <i class="fas fa-user-plus me-2"></i> Crear Cuenta
        </h3>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <!-- NOMBRE -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Tu nombre" required>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="correo@gmail.com" required>
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="********" required>
                </div>
            </div>

            <!-- BOTÓN -->
            <button class="btn btn-success w-100">
                <i class="fas fa-user-check me-2"></i> Registrarse
            </button>

        </form>

        <div class="text-center mt-3">
            <a href="/login">
                <i class="fas fa-arrow-left me-1"></i> Volver al login
            </a>
        </div>

    </div>

</div>

</body>
</html>