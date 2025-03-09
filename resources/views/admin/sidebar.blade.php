@php
    $menus = [
        (object)[
            "title" => "Dashboard",
            "path" => "admin/dashboard/index",
        ],
        (object)[
            "title" => "Kelola Produk",
            "path" => "products",
        ],
        (object)[
            "title" => "Kelola Kategori",
            "path" => "category",
        ],
        (object)[
            "title" => "Kelola Transaksi",
            "path" => "admin/transaksi/index",
        ],
        (object)[
            "title" => "Kelola Laporan",
            "path" => "admin/laporan/index",
        ]
    ];
@endphp

<div class="sidebar bg-dark d-none d-lg-block" id="sidebar">
    <h4 class="text-center text-light">{{ Auth::user()->name }}</h4>
    <hr style="border: 2px solid white;">  

    @foreach ($menus as $menu)
        <a href="{{ url($menu->path) }}" class="d-flex align-items-center px-3 py-2 text-white 
            {{ request()->is($menu->path) ? 'bg-primary' : '' }}">
            {{ $menu->title }}
        </a>
    @endforeach
</div>
