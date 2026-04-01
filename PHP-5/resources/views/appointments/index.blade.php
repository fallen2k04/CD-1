@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Danh sách lịch hẹn</h2>
        <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">
            {{ $appointments->count() }} Lịch hẹn
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover border-light align-middle">
            <thead>
                <tr class="text-muted border-0">
                    <th>#</th>
                    <th>Tên khách</th>
                    <th>Ngày hẹn</th>
                    <th>Giờ hẹn</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr class="border-light">
                        <td class="text-muted small">{{ $loop->iteration }}</td>
                        <td>
                            <strong class="text-dark">{{ $appointment->customer->name }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark px-3 py-2 border">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-white text-primary border-primary px-3 py-2 border" style="border-style: dashed !important;">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                            </span>
                        </td>
                        <td>
                            @if($appointment->status === 'active')
                                <span class="badge bg-success bg-opacity-75 px-3 py-2">Đang chờ</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($appointment->status === 'active')
                                <form action="{{ route('appointments.cancel', $appointment) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-danger btn-sm border-0">
                                        <i class="bi bi-x-circle"></i> Hủy lịch
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small italic">Không khả dụng</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/1157/1157000.png" alt="No data" width="60" class="mb-3 opacity-50">
                            <p class="text-muted">Chưa có lịch hẹn nào.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
