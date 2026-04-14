<!DOCTYPE html>
<html>
<head>
<style>
.container{
    font-family: Arial;
    background:#f4f4f4;
    padding: 20px;
    text-align: center;
}
.content{
    background:#fff;
    padding: 20px;
    border-radius:10px;
}
.btn{
    background: blue;
    color: white;
    padding: 10px 20px;
    text-decoration:none;
    border-radius:7px;
}
</style>
</head>

<body>

<div class="container">
    <div class="content">

        <h2>Nuevo inicio de sesión</h2>

        <p>Hola {{ $user->name }}, se detectó un inicio de sesión en tu cuenta.</p>

        <a href="{{ url('/dashboard') }}" class="btn">
            Ir al sistema
        </a>

        <p style="margin-top:20px;">
            Si no fuiste tú, cambia tu contraseña inmediatamente.
        </p>

    </div>
</div>

</body>
</html>