@extends('admin.layout')

@section('header')
<div class="container mt-4">
    <h2>Kelola Kategori</h2>
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
</div>
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
