@extends('admin.layout')
@section('content')
<div class="container">
    <h2>Tambah Kategori</h2>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
