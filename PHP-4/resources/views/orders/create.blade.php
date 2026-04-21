@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tạo Đơn Hàng Mới</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên Khách Hàng</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Nhập tên khách hàng" value="{{ old('customer_name') }}" required>
                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3">Danh sách sản phẩm</h5>
                    
                    <div id="product-list">
                        <!-- Mặc định có 1 sản phẩm -->
                        <div class="row product-row align-items-center mb-3">
                            <div class="col-md-7">
                                <label class="form-label">Chọn sản phẩm</label>
                                <select name="product_id[]" class="form-select" required>
                                    <option value="" selected disabled>-- Chọn sản phẩm --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} - {{ number_format($product->price) }} đ</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Số lượng</label>
                                <input type="number" name="quantity[]" class="form-control" value="1" min="1" required>
                            </div>
                            <div class="col-md-2 mt-4 text-end">
                                <button type="button" class="btn btn-danger remove-product-btn" disabled>Xóa</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success mb-4" id="addProductBtn">+ Thêm sản phẩm</button>

                    <div class="text-end">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu Đơn Hàng</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const minRows = 1;
    const productList = document.getElementById('product-list');
    const addProductBtn = document.getElementById('addProductBtn');

    // Mẫu HTML cho 1 dòng sản phẩm
    const productRowTemplate = `
        <div class="col-md-7">
            <label class="form-label">Chọn sản phẩm</label>
            <select name="product_id[]" class="form-select" required>
                <option value="" selected disabled>-- Chọn sản phẩm --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - {{ number_format($product->price) }} đ</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Số lượng</label>
            <input type="number" name="quantity[]" class="form-control" value="1" min="1" required>
        </div>
        <div class="col-md-2 mt-4 text-end">
            <button type="button" class="btn btn-danger remove-product-btn">Xóa</button>
        </div>
    `;

    // Cập nhật trạng thái nút xóa (nếu chỉ còn 1 dòng thì disable nút xóa)
    function updateRemoveButtons() {
        const rows = productList.querySelectorAll('.product-row');
        const defaultRemoveBtn = rows[0].querySelector('.remove-product-btn');
        if (rows.length <= minRows) {
            if(defaultRemoveBtn) defaultRemoveBtn.disabled = true;
        } else {
            if(defaultRemoveBtn) defaultRemoveBtn.disabled = false;
        }
    }

    // Xử lý thêm mới
    addProductBtn.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'row product-row align-items-center mb-3';
        row.innerHTML = productRowTemplate;
        productList.appendChild(row);
        updateRemoveButtons();

        // Thêm sự kiện bỏ dòng cho dòng mới
        row.querySelector('.remove-product-btn').addEventListener('click', function() {
            row.remove();
            updateRemoveButtons();
        });
    });

});
</script>
@endsection
