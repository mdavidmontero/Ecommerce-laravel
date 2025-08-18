<x-container>
    <div class="card">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="cols-span-1">
                <figure>
                    <img src="{{ $product->image }}" alt=""
                        class="w-full aspect-[1/1] object-cover object-center" />
                </figure>
            </div>
            <div class="cols-span-1">
                <h1 class="mb-2 text-xl text-gray-600">
                    {{ $product->name }}
                </h1>
                <div class="flex items-center mb-4 space-x-2">
                    <ul class="flex space-x-1 text-sm">
                        <li>
                            <i class="text-yellow-400 fa-solid fa-star"></i>
                        </li>
                        <li>
                            <i class="text-yellow-400 fa-solid fa-star"></i>
                        </li>
                        <li>
                            <i class="text-yellow-400 fa-solid fa-star"></i>
                        </li>
                        <li>
                            <i class="text-yellow-400 fa-solid fa-star"></i>
                        </li>
                        <li>
                            <i class="text-yellow-400 fa-solid fa-star"></i>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-700">4.7 (55)</p>
                </div>
                <p class="mb-4 text-2xl font-semibold text-gray-600">
                    COP {{ $product->price }}
                </p>
                <div class="flex items-center mb-6 space-x-6" x-data="{
                    qty: @entangle('qty')
                }">
                    <button class="btn btn-gray" x-on:click="qty = qty - 1" x-bind:disabled="qty == 1">
                        -
                    </button>
                    <span x-text="qty" class="inline-block w-2 text-center "></span>
                    <button class="btn btn-gray" x-on:click="qty = qty + 1">
                        +
                    </button>
                </div>

                <button class="w-full mb-6 btn btn-purple" wire:click='add_to_cart' wire:loading.attr='disabled'>
                    Agregar al Carrito
                </button>
                <div class="mb-4 text-sm">
                    {{ $product->description }}
                </div>
                <div class="flex items-center space-x-4 text-gray-700">
                    <i class="text-2xl fa-solid fa-truck-fast"></i>
                    <p>Despacho a domicilio</p>
                </div>
            </div>
        </div>
    </div>
</x-container>
