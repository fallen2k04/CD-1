<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm - Kho Hàng</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-bg: #f8f9fa;
            --sidebar-bg: #212529;
            --accent-color: #0d6efd;
            --text-main: #333;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .container {
            max-width: 1200px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">
            <i class="bi bi-box-seam me-2"></i> QUẢN LÝ KHO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Danh sách</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.create') }}">Thêm mới</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
