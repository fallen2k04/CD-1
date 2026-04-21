<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Đăng ký Môn Học</title>
    <!-- Tránh viết HTML trong Controller, mọi file UI đều dùng Blade -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4 text-primary">Hệ Thống Đăng Ký Môn Học (Tối đa 18 TC)</h2>

        <!-- Navigation Menu -->
        <div class="mb-4 text-center">
            <a href="{{ route('enrollments.index') }}" class="btn btn-outline-primary shadow-sm mx-1">Danh sách Đăng ký</a>
            <a href="{{ route('students.create') }}" class="btn btn-outline-success shadow-sm mx-1">Thêm Sinh Viên</a>
            <a href="{{ route('courses.create') }}" class="btn btn-outline-info shadow-sm mx-1">Thêm Môn Học</a>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary shadow-sm mx-1">Đăng Ký Môn Mới</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
