@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 p-4">
            <h2 class="fw-bold mb-4"><i class="bi bi-plus-square text-primary me-2"></i> Thêm Sản Phẩm Mới</h2>
            
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-600 small">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-600 small">Giá gốc (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" value="{{ old('price') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-600 small">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control" placeholder="0" value="{{ old('quantity') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-600 small">Danh mục <span class="text-danger">*</span></label>
                    <select name="category" class="form-select">
                        <option value="Đồ gia dụng" {{ old('category') == 'Đồ gia dụng' ? 'selected' : '' }}>Đồ gia dụng</option>
                        <option value="Đồ điện" {{ old('category') == 'Đồ điện' ? 'selected' : '' }}>Đồ điện</option>
                        <option value="Phụ kiện điện thoại" {{ old('category') == 'Phụ kiện điện thoại' ? 'selected' : '' }}>Phụ kiện điện thoại</option>
                        <option value="Đồ ăn vặt" {{ old('category') == 'Đồ ăn vặt' ? 'selected' : '' }}>Đồ ăn vặt</option>
                        <option value="Khác" {{ old('category') == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5">Thêm ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
