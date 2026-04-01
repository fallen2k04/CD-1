@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Student List</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-between">
                <form action="{{ route('students.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search by name or ID..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info">Search</button>
                </form>
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create New Student</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered mt-2">
        <tr>
            <th>No</th>
            <th>
                <a href="{{ route('students.index', array_merge(request()->query(), ['sort' => $sort == 'asc' ? 'desc' : 'asc'])) }}" style="text-decoration: none; color: black;">
                    Name 
                    @if($sort == 'asc') ↑ @else ↓ @endif
                </a>
            </th>
            <th>Major</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->major }}</td>
            <td>{{ $student->email }}</td>
            <td>
                <form action="{{ route('students.destroy',$student->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {!! $students->appends(request()->query())->links('pagination::bootstrap-5') !!}
    </div>
@endsection
