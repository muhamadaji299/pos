<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Tombol Toggle Sidebar -->
        <button class="btn btn-secondary d-lg-none me-2" type="button" onclick="toggleSidebar()">
            ☰
        </button>
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="ms-auto">
            <span class="navbar-text me-3">Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf   
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>