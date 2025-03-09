@php
    $menus = [
        (object)[
            "title" => "Dashboard",
            "path" => "kasir/dashboard/index",
        ],
        (object)[
            "title" => "Halaman Produk",
            "path" => "kasir/products/index",
        ]
    ];
@endphp

<div class="sidebar bg-success d-none d-lg-block" id="sidebar">
    <h4 class="text-center text-light">{{ Auth::user()->name }}</h4>
    <hr style="border: 2px solid white;">  

    @foreach ($menus as $menu)
        <a href="{{ url($menu->path) }}" class="d-flex align-items-center px-3 py-2 text-white 
            {{ request()->is($menu->path) ? 'bg-secondary' : '' }}">
            {{ $menu->title }}
        </a>
    @endforeach
</div>
