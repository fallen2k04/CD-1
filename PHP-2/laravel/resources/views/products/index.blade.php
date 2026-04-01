@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-stack me-2 text-primary"></i> DANH SÁCH SẢN PHẨM</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle me-2"></i> Thêm Sản Phẩm
    </a>
</div>

<div class="card border-0 mb-4 bg-white p-4">
    <form action="{{ route('products.index') }}" method="GET" class="row g-3">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Tìm kiếm theo tên sản phẩm..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">Tất cả danh mục</option>
                <option value="Đồ gia dụng" {{ request('category') == 'Đồ gia dụng' ? 'selected' : '' }}>Đồ gia dụng</option>
                <option value="Đồ điện" {{ request('category') == 'Đồ điện' ? 'selected' : '' }}>Đồ điện</option>
                <option value="Phụ kiện điện thoại" {{ request('category') == 'Phụ kiện điện thoại' ? 'selected' : '' }}>Phụ kiện điện thoại</option>
                <option value="Đồ ăn vặt" {{ request('category') == 'Đồ ăn vặt' ? 'selected' : '' }}>Đồ ăn vặt</option>
                <option value="Khác" {{ request('category') == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-secondary rounded-3">Tìm kiếm</button>
        </div>
    </form>
</div>

@if($products->isEmpty())
    <div class="alert alert-info border-0 shadow-sm text-center py-5 rounded-4">
        <i class="bi bi-info-circle fs-1 d-block mb-3"></i>
        Không tìm thấy sản phẩm nào!
    </div>
@else
    <div class="table-responsive bg-white rounded-4 shadow-sm p-2">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small fw-bold">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá (VNĐ)</th>
                    <th>Số Lượng</th>
                    <th>Danh Mục</th>
                    <th>Trạng Thái</th>
                    <th class="text-end pe-4">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                <tr>
                    <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge @if($product->quantity == 0) bg-danger @elseif($product->quantity < 5) bg-warning text-dark @else bg-light text-dark border @endif px-2 py-1 rounded-pill">
                            {{ $product->quantity }}
                        </span>
                    </td>
                    <td><span class="text-secondary">{{ $product->category }}</span></td>
                    <td>
                        @if($product->quantity == 0)
                            <span class="text-danger fw-600 small"><i class="bi bi-exclamation-triangle-fill"></i> Hết hàng</span>
                        @elseif($product->quantity < 5)
                            <span class="text-warning fw-600 small"><i class="bi bi-exclamation-circle-fill"></i> Sắp hết hàng</span>
                        @else
                            <span class="text-success fw-600 small"><i class="bi bi-check-circle-fill"></i> Còn hàng</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group shadow-sm rounded-3">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-info" title="Sửa">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
