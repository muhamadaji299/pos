@extends('kasir.layout')
 @section('header')
   <div class="container mt-4">
        <h1>Welcome, Kasir</h1>
        <p>Ini adalah halaman dashboard kasir anda bisa memesan product yg anda inginkan.</p>
    </div>  
 
 @endsection    
@section('content')

<div class="row g-4">
    <!-- Produk Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body bg-success text-white rounded">
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
            <a href="/kasir/products/index" class="card-footer text-center text-primary bg-light text-decoration-none">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    </div>
  

@endsection
