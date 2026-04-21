@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Thêm Sinh Viên Mới</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf 

                    <div class="mb-4">
                        <label for="student_code" class="form-label fw-semibold">Mã Sinh Viên</label>
                        <input type="text" 
                               name="student_code" 
                               id="student_code" 
                               class="form-control @error('student_code') is-invalid @enderror" 
                               value="{{ old('student_code') }}"
                               placeholder="VD: SV001">
                               
                        @error('student_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Họ và Tên Sinh Viên</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}"
                               placeholder="VD: Nguyễn Văn A">
                               
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success fw-bold">Lưu Sinh Viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
