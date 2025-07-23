<div x-data="{ open: false }">
    <header class="bg-purple-600">
        <x-container class="px-4 py-4">
            <div class="flex justify-between space-x-8">
                <button class="text-xl md:text-3xl" x-on:click="open = true">
                    <i class="text-white fas fa-bars"></i>
                </button>
                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-xl font-semibold leading-4 md:leading-6 md:text-3xl">
                            Eccomerce
                        </span>
                        <span class="text-xs">
                            Tienda Online
                        </span>
                    </a>
                </h1>
                <div class="flex-1 hidden md:block">
                    <x-input class="w-full" placeholder="Buscar por producto, tienda o marca" />
                </div>

                <div class="flex items-center space-x-4 md:space-x-8">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-xl md:text-3xl">
                                <i class="text-white fas fa-user"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @guest
                                <div class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <a href="{{ route('login') }}">
                                            <button class="btn btn-purple">
                                                <i class="fas fa-user"></i>
                                                Iniciar Sesión
                                            </button>
                                        </a>
                                    </div>
                                    <p class="mt-2 text-sm text-center">
                                        ¿No tienes cuenta?
                                        <a href="{{ route('register') }}" class="text-purple-600 underline ">
                                            Registrate
                                        </a>
                                    </p>

                                </div>
                            @else
                                <x-dropdown-link href="{{ route('profile.show') }}"> Mi Perfil </x-dropdown-link>
                            @endguest
                        </x-slot>
                    </x-dropdown>

                    <button class="text-xl md:text-3xl">
                        <i class="text-white fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <div class="mt-4 md:hidden">
                <x-input class="w-full" placeholder="Buscar por producto, tienda o marca" />
            </div>
        </x-container>
    </header>
    <div x-show="open" x-transition.opacity x-on:click="open = false"
        class="fixed inset-0 z-10 bg-black bg-opacity-25">
    </div>

    <div x-show="open" style="display: none" class="fixed top-0 left-0 z-20">
        <div class="flex h-full">
            <!-- Sidebar -->
            <div class="w-full h-full bg-white md:w-80">
                <!-- Encabezado -->
                <div class="px-4 py-3 font-semibold text-white bg-purple-600">
                    <div class="flex items-center justify-between">
                        <span class="text-lg">Hola</span>
                        <button x-on:click="open = false">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Lista de familias -->
                <div class="h-[calc(100vh-52px)] overflow-y-auto">
                    <ul>
                        @foreach ($families as $family)
                            <li wire:mouseover="$set('family_id',{{ $family->id }})">
                                <a href="#"
                                    class="flex items-center justify-between px-4 py-4 text-gray-700 transition-colors hover:bg-purple-200">
                                    {{ $family->name }}
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Panel derecho de categorías -->
            <div class="hidden h-full md:block w-full xl:w-[57rem] pt-[52px] overflow-y-auto bg-white px-6 py-8 pb-1">
                <div class="flex items-center justify-between mb-8">
                    <p class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1">
                        {{ $this->familyName }}
                    </p>
                    <a href="#" class="btn btn-purple">Ver todo</a>
                </div>

                <ul class="grid grid-cols-1 gap-8 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($this->categories as $category)
                        <li>
                            <a href="#" class="text-lg font-semibold text-purple-600 hover:underline">
                                {{ $category->name }}
                            </a>
                            <ul class="mt-4 space-y-2">
                                @foreach ($category->subcategories as $subcategory)
                                    <li>
                                        <a href="#"
                                            class="text-sm text-gray-700 transition hover:text-purple-600">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
