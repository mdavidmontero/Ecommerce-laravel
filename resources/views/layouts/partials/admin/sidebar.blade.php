@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Administrar Página',
        ],
        [
            'name' => 'Opciones',
            'icon' => 'fa-solid fa-sliders',
            'route' => route('admin.options.index'),
            'active' => request()->routeIs('admin.options.*'),
        ],
        [
            // Familia de productos
            'icon' => 'fa-solid fa-box-open',
            'name' => 'Familias',
            'route' => route('admin.families.index'),
            'active' => request()->routeIs('admin.families.*'),
        ],
        [
            'name' => 'Categorias',
            'icon' => 'fa-solid fa-tags',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
        ],
        [
            'name' => 'SubCategorias',
            'icon' => 'fa-solid fa-tag',
            'route' => route('admin.subcategories.index'),
            'active' => request()->routeIs('admin.subcategories.*'),
        ],
        [
            'name' => 'Productos',
            'icon' => 'fa-solid fa-box',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ],
        [
            'name' => 'Portadas',
            'icon' => 'fa-solid fa-image',
            'route' => route('admin.covers.index'),
            'active' => request()->routeIs('admin.covers.*'),
        ],
        [
            'header' => 'Ordenes y Envios',
        ],
        [
            'name' => 'Conductores',
            'icon' => 'fa-solid fa-truck',
            'route' => route('admin.drivers.index'),
            'active' => request()->routeIs('admin.drivers.*'),
        ],
        [
            'name' => 'Ordenes',
            'icon' => 'fa-solid fa-shopping-cart',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*'),
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase ">
                            {{ $link['header'] }}
                        </div>
                    @else
                        <a href="{{ $link['route'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                            <span class="inline-flex items-center justify-center w-6 h-6">
                                <i class="{{ $link['icon'] }} text-gray-500"></i>
                            </span>
                            <span class="ml-2 ms-3">{{ $link['name'] }}</span>
                        </a>
                    @endisset
                </li>
            @endforeach

        </ul>
    </div>
</aside>
