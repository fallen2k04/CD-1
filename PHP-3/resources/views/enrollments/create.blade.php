@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Đăng Ký Môn Học Cho Sinh Viên</h5>
            </div>
            <div class="card-body p-4">

                <!-- @if($errors->any()) 
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif -->

                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf 

                    <div class="mb-4">
                        <label for="student_id" class="form-label fw-semibold">Chọn Sinh Viên</label>
                        <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror">
                            <option value="">-- Chọn Sinh Viên --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->student_code ? $student->student_code . ' - ' : '' }}{{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="course_id" class="form-label fw-semibold">Chọn Môn Học Cần Đăng Ký</label>
                        <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror">
                            <option value="">-- Chọn Môn Học --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }} ({{ $course->credits }} Tín chỉ)
                                </option>
                            @endforeach
                        </select>
                        <!-- Khu vực này hiển thị lỗi trùng môn hoặc quá tín chỉ -->
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Thực hiện Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
