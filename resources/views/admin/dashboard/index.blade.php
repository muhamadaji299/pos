@extends('admin.layout')
 @section('header')
   <div class="container mt-4">
        <h1>Welcome, Admin</h1>
        <p>Ini adalah halaman dashboard admin.</p>
    </div>  
 
 @endsection    
@section('content')

<div class="row g-4">
    <!-- Produk Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body bg-info text-white rounded">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <h3>Produk</h3>
                        <p>Pengelolan Product</p>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-box-open fa-3x"></i>
                    </div>
                </div>
            </div>
            <a href="/products" class="card-footer text-center text-primary bg-light text-decoration-none">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Kategori Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body bg-success text-white rounded">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <h3>Kategori</h3>
                        <p>Pengelolaan Kategori</p>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-list-alt fa-3x"></i>
                    </div>
                </div>
            </div>
            <a href="/category" class="card-footer text-center text-primary bg-light text-decoration-none">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body bg-primary text-white rounded">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <h3>Transaksi</h3>
                        <p>Pengelolaan Transaksi</p>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-list-alt fa-3x"></i>
                    </div>
                </div>
            </div>
            <a href="/admin/transaksi/index" class="card-footer text-center text-primary bg-light text-decoration-none">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body bg-warning text-white rounded">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <h3>Laporan</h3>
                        <p>Pengelolaan Laporan</p>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-list-alt fa-3x"></i>
                    </div>
                </div>
            </div>
            <a href="/admin/laporan/index" class="card-footer text-center text-primary bg-light text-decoration-none">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>


@endsection
