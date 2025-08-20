<x-app-layout>

    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2 gap-6">
                @livewire('shipping-addresses')
            </div>

            <div class="col-span-1">
                <div class="mb-4 overflow-hidden bg-white rounded-lg shadow">

                    <div class="flex items-center justify-between p-4 text-white bg-purple-600">
                        <p class="font-semibold">
                            Resumen de Compra ({{ Cart::instance('shopping')->count() }} Productos)
                        </p>
                        <a href="{{ route('cart.index') }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>
                    <div class="p-4 text-gray-600">
                        <ul>
                            @foreach (Cart::content() as $item)
                                <li class="flex items-center space-x-4">
                                    <figure class="shrink-0">
                                        <img class="h-12 aspect-square" src="{{ $item->options->image }}"
                                            alt="">
                                    </figure>
                                    <div class="flex-1">
                                        <p class="text-sm">
                                            {{ $item->name }}
                                        </p>
                                        <p>
                                            COP {{ $item->price }}
                                        </p>
                                    </div>
                                    <div class="shrink-0">
                                        <p>
                                            {{ $item->qty }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <hr class="my-4">
                        <div class="flex justify-between">
                            <p class="text-lg">Total </p>
                            <p>
                                COP {{ Cart::total() }}
                            </p>
                        </div>
                    </div>

                </div>
                <a href="" class="block w-full text-center btn btn-purple">Siguiente</a>
            </div>
        </div>
    </x-container>

</x-app-layout>
