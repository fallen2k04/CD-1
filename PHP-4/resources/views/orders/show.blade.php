@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Đơn hàng: #{{ $order->id }}</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    <!-- Thông tin chung -->
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-dark text-white fw-bold">
                Thông Tin Khách Hàng
            </div>
            <div class="card-body">
                <p><strong>Khách hàng: </strong> {{ $order->customer_name }}</p>
                <p><strong>Ngày tạo: </strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                <p><strong>Tổng tiền: </strong> <span class="text-danger fw-bold fs-5">{{ number_format($order->total_price) }} đ</span></p>
                
                <hr>

                <!-- Form cập nhật trạng thái -->
                <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cập nhật trạng thái</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Cập nhật ngay</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Chi tiết giỏ hàng -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-info text-white fw-bold">
                Chi Tiết Sản Phẩm
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped align-middle text-center m-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $idx => $item)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td class="text-start">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                                <td>{{ number_format($item->price) }} đ</td>
                                <td><strong>x{{ $item->quantity }}</strong></td>
                                <td class="fw-bold">{{ number_format($item->price * $item->quantity) }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary">
                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="fw-bold text-danger">{{ number_format($order->total_price) }} đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
