<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">
        
        <h3 class="text-center mb-4">
            <i class="fas fa-user-circle me-2"></i> Iniciar Sesión
        </h3>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

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
            <button class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt me-2"></i> Entrar
            </button>

        </form>

        <div class="text-center mt-3">
            <a href="/register">
                <i class="fas fa-user-plus me-1"></i> Crear cuenta
            </a>
        </div>

    </div>

</div>

</body>
</html>