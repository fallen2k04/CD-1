<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:10',
        ], [
            'name.required' => 'Tên môn học không được bỏ trống.',
            'credits.required' => 'Số tín chỉ không được bỏ trống.',
            'credits.integer' => 'Số tín chỉ phải là số.',
            'credits.min' => 'Số lượng ít nhất là 1 tín chỉ.',
        ]);

        Course::create($validated);
        return redirect()->route('enrollments.index')->with('success', 'Đã thêm môn học thành công.');
    }
}
