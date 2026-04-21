@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Danh Sách Theo Sinh Viên (Tổng Tín Chỉ)</h5>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" width="20%">Mã SV - Họ Tên</th>
                        <th width="50%">Các môn đã đăng ký (Giới hạn 18TC)</th>
                        <th class="text-center" width="30%">Tổng Số Tín Chỉ Học</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        @php
                            $totalCredits = 0;
                            foreach($student->enrollments as $enrollment) {
                                $totalCredits += $enrollment->course->credits;
                            }
                        @endphp
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $student->student_code ? $student->student_code . ' - ' : '' }}{{ $student->name }}</td>
                            <td>
                                @if($student->enrollments->count() > 0)
                                    <ul class="mb-0 ps-3">
                                        @foreach($student->enrollments as $enroll)
                                            <li>{{ $enroll->course->name }} <span class="text-muted">({{ $enroll->course->credits }} TC)</span></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted fst-italic">Chưa đăng ký môn nào</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($totalCredits >= 18)
                                    <span class="badge bg-danger fs-6">{{ $totalCredits }} / 18</span>
                                @elseif($totalCredits > 12)
                                    <span class="badge bg-warning text-dark fs-6">{{ $totalCredits }} / 18</span>
                                @else
                                    <span class="badge bg-success fs-6">{{ $totalCredits }} / 18</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Chưa có sinh viên nào trong hệ thống.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
