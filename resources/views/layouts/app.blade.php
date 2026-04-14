<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 3000); // 3 segundos
</script>
<body>


@include('layouts.header')

<div class="d-flex" style="min-height: 100vh;">

    {{-- SIDEBAR ADMIN --}}
    @if(auth()->user()->role == 'admin')
        @include('layouts.sidebar')
    @endif

    {{-- SIDEBAR USER --}}
    @if(auth()->user()->role == 'user')
        @include('layouts.user-sidebar')
    @endif

    <div class="flex-grow-1 p-4">

        {{-- ALERTAS --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')

    </div>
</div>