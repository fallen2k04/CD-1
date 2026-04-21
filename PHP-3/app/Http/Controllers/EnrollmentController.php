<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Lấy danh sách đăng ký gộp theo sinh viên (kèm theo tổng tín chỉ)
        // Đây là ví dụ hiển thị logic kết hợp từ Relationships
        $students = Student::with('enrollments.course')->get();

        // Không viết HTML ở đây, đẩy qua view
        return view('enrollments.index', compact('students'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        // Validation cơ bản đầu vào
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ], [
            'student_id.required' => 'Vui lòng chọn Sinh viên.',
            'course_id.required' => 'Vui lòng chọn Môn học.',
        ]);

        $studentId = $validated['student_id'];
        $courseId = $validated['course_id'];

        // Lấy thông tin sinh viên và môn học
        $student = Student::with('enrollments.course')->findOrFail($studentId);
        $courseToRegister = Course::findOrFail($courseId);

        // Quy tắc 1: Không cho đăng ký trùng môn
        $alreadyEnrolled = Enrollment::where('student_id', $studentId)
                                     ->where('course_id', $courseId)
                                     ->exists();
        if ($alreadyEnrolled) {
            return back()->withErrors(['course_id' => 'Sinh viên này đã đăng ký môn học này rồi!'])->withInput();
        }

        // Quy tắc 2: Tổng số tín chỉ tối đa không quá 18
        $currentCredits = 0;
        foreach ($student->enrollments as $enrollment) {
            $currentCredits += $enrollment->course->credits;
        }

        if ($currentCredits + $courseToRegister->credits > 18) {
            return back()->withErrors([
                'course_id' => 'Không thể đăng ký! Tổng tín chỉ tối đa cho phép là 18. (Hiện tại: ' . $currentCredits . ' TC, Tổng nếu đăng ký: ' . ($currentCredits + $courseToRegister->credits) . ' TC).'
            ])->withInput();
        }

        // Tạo dữ liệu
        Enrollment::create($validated);

        return redirect()->route('enrollments.index')->with('success', 'Đăng ký thành công môn ' . $courseToRegister->name . ' cho sinh viên ' . $student->name);
    }
}
