<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_code' => 'required|string|max:50|unique:students,student_code',
            'name' => 'required|string|max:255',
        ], [
            'student_code.required' => 'Mã sinh viên không được bỏ trống.',
            'student_code.unique' => 'Mã sinh viên này đã tồn tại.',
            'name.required' => 'Tên sinh viên không được bỏ trống.',
        ]);

        Student::create($validated);
        return redirect()->route('enrollments.index')->with('success', 'Đã thêm sinh viên thành công.');
    }
}
