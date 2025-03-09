<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 12px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color:rgb(206, 206, 206);
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: fixed;
                display: none; /* Disembunyikan di mobile */
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
 @include('kasir.navbar')
<!-- Sidebar -->
@include('kasir.sidebar')

<!-- Konten Utama -->
<div class="content">
<div class="container mt-4">
        <!-- Header -->
         @yield('header')
        </div>

        <!-- Tabel CRUD -->
        <div class="card">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Script Toggle Sidebar -->
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        if (sidebar.style.display === "block") {
            sidebar.style.display = "none";
        } else {
            sidebar.style.display = "block";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
