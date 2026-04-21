@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Đầu việc (Đơn hàng)</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        + Tạo đơn hàng
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Tên khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td><strong>{{ $order->customer_name }}</strong></td>
                        <td class="text-danger fw-bold">{{ number_format($order->total_price) }} đ</td>
                        <td>
                            @php
                                $statusClass = match($order->status) {
                                    'pending' => 'bg-pending',
                                    'processing' => 'bg-processing',
                                    'completed' => 'bg-completed',
                                    default => 'bg-secondary'
                                };
                                $statusText = match($order->status) {
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang xử lý',
                                    'completed' => 'Hoàn thành',
                                    default => ucfirst($order->status)
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} p-2">{{ $statusText }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info text-white">Xem chi tiết</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Chưa có đơn hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $orders->links('pagination::bootstrap-5') }}
</div>
@endsection
