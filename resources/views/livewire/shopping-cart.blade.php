<div>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-7">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2">
                <h1 class="text-lg">Carrito de Compras ({{ Cart::count() }} productos) </h1>
                <button class="font-semibold text-gray-600 underline hover:no-underline hover:text-purple-500"
                    wire:click='destroy'>Limpiar
                    Carrito</button>
            </div>
            <div class="card">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        <li class="lg:flex">
                            <img class="w-full lg:w-36 aspect-[16/9] object-cover object-center mr-2"
                                src="{{ $item->options->image }}" alt="">
                            <div class="w-80">
                                <p class="text-sm">
                                    <a href="{{ route('products.show', $item->id) }}"
                                        class="font-semibold text-gray-700">
                                        {{ $item->name }}
                                    </a>
                                </p>
                                <button
                                    class="text-sm font-semibold text-red-800 bg-red-100 rounded hover:bg-red-200 px-2.5 py-0.5"
                                    wire:click='remove("{{ $item->rowId }}")'>
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>
                            <p>COP {{ $item->price }}</p>
                            <div class="ml-auto space-x-3">
                                <button class="btn btn-gray" wire:click="decrease('{{ $item->rowId }}')">
                                    -
                                </button>
                                <span class="inline-block w-2 text-center ">
                                    {{ $item->qty }}
                                </span>
                                <button class="btn btn-gray" wire:click="increase('{{ $item->rowId }}')">
                                    +
                                </button>

                            </div>
                        </li>
                    @empty
                        <p class="text-center">No hay productos en el carrito</p>
                    @endforelse
                </ul>

            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="card">
                <div class="flex justify-between mb-2 font-semibold">
                    <p>Total: </p>
                    <p>
                        COP {{ Cart::total() }}
                    </p>
                </div>
                <a href="" class="block w-full text-center btn btn-purple">
                    Continuar Compra

                </a>
            </div>
        </div>

    </div>
</div>
