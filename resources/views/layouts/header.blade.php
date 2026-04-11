<nav class="navbar navbar-dark bg-dark px-4">
    
    <span class="navbar-brand">
        <i class="fas fa-graduation-cap me-2"></i> Sistema
    </span>

    <div class="d-flex align-items-center text-white">

        <span class="me-3">
            <i class="fas fa-user me-1"></i> {{ auth()->user()->name }}
        </span>

        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>

    </div>

</nav>