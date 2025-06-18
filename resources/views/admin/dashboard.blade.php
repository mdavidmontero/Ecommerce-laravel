<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
]">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center">
                <img class="object-cover rounded-full size-8" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
                <div class="flex-1 ml-4">
                    <h2 class="text-lg font-semibold">Bienvenido, {{ auth()->user()->name }}</h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-sm hover:text-blue-500">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold">
                Seynekun
            </h2>
        </div>

    </div>
</x-admin-layout>
