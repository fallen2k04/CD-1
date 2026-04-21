<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Tìm kiếm theo tên hoặc số thứ tự (ID)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
                if (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }
            });
        }

        // Sắp xếp theo tên
        $sort = $request->get('sort', 'asc');
        $query->orderBy('name', $sort);

        // Phân trang
        $students = $query->paginate(5);

        return view('students.index', compact('students', 'sort'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'major' => 'required',
            'email' => 'required|email|unique:students,email',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'major' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
