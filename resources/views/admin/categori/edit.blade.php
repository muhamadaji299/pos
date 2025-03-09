@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Kategori</h2>
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Tambahkan method PUT untuk update data -->
        
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
