<div>
    <header class="bg-purple-600">
        <x-container class="px-4 py-4">
            <div class="flex justify-between space-x-8">
                <button class="text-xl md:text-3xl">
                    <i class="text-white fas fa-bars"></i>
                </button>
                <h1 class="text-white">
                    <a href="" class="inline-flex flex-col items-end">
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
                    <button class="text-xl md:text-3xl">
                        <i class="text-white fas fa-user"></i>
                    </button>
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
</div>
