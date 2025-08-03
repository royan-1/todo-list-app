<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi To do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
            color: #fff;
            border-left: 4px solid #0d6efd;
        }

        .content {
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .logout-btn {
            padding: 10px 20px;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: #fff;
        }

        .logout-btn:hover {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                Semua Tugas
            </a>
            <a href="{{ route('tasks.create') }}" class="{{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                Buat Tugas
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>

        <!-- Content -->
        <div class="col-md-10 content">
            <nav class="navbar navbar-light bg-white shadow-sm mb-3">
                <div class="container-fluid">
                    <span class="navbar-brand">Aplikasi To do List</span>
                </div>
            </nav>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
