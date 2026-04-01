@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card p-5 border-0 shadow-lg">
            <h2 class="fw-bold mb-4 text-center">Đặt lịch mới</h2>
            <hr class="mb-5 opacity-25">

            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="customer_name" class="form-label text-muted small fw-bold text-uppercase">Tên khách hàng</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nhập tên khách hàng..." required>
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="appointment_date" class="form-label text-muted small fw-bold text-uppercase">Ngày đặt lịch</label>
                        <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required>
                        @error('appointment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="appointment_time" class="form-label text-muted small fw-bold text-uppercase">Giờ đặt lịch</label>
                        <input type="time" class="form-control @error('appointment_time') is-invalid @enderror" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" required>
                        @error('appointment_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary py-3 fw-bold">
                        🚀 Xác nhận đặt lịch
                    </button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-link mt-3 text-muted">
                        Quay lại danh sách
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
