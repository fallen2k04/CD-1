@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Thêm Môn Học Mới</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf 

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Tên Môn Học</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}"
                               placeholder="VD: Toán Cao Cấp">
                               
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="credits" class="form-label fw-semibold">Số Tín Chỉ</label>
                        <input type="number" 
                               name="credits" 
                               id="credits" 
                               class="form-control @error('credits') is-invalid @enderror" 
                               value="{{ old('credits') }}"
                               placeholder="VD: 3">
                               
                        @error('credits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info text-white fw-bold">Lưu Môn Học</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
