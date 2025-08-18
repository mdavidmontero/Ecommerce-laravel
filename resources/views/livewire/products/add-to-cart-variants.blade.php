<x-container>
    <div class="card">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="cols-span-1">
                <figure>
                    <img src="{{ $this->variant->image }}" alt=""
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
                <div class="flex flex-wrap">
                    @foreach ($product->options as $option)
                        <div class="mb-4 mr-4">
                            <p class="mb-2 text-lg font-semibold">{{ $option->name }}</p>
                            <ul class="flex items-center space-x-4">
                                @foreach ($option->pivot->features as $feature)
                                    <li>
                                        @switch($option->type)
                                            @case(1)
                                                <button
                                                    class="w-20 h-8 text-sm font-semibold  uppercase  rounded-lg {{ $selectedFeatures[$option->id] == $feature['id'] ? 'bg-purple-600 text-white' : 'border border-gray-200 text-gray-700' }}"
                                                    wire:click="$set('selectedFeatures.{{ $option->id }}', {{ $feature['id'] }})">
                                                    {{ $feature['value'] }}
                                                </button>
                                            @break

                                            @case(2)
                                                <div
                                                    class="p-0.5 border-2 rounded-lg flex items-center -mt-1.5 {{ $selectedFeatures[$option->id] == $feature['id'] ? 'border-purple-600' : 'border-transparent' }}">
                                                    <button class="w-20 h-8 border border-gray-200 rounded-lg"
                                                        style="background-color: {{ $feature['value'] }}"
                                                        wire:click="$set('selectedFeatures.{{ $option->id }}', {{ $feature['id'] }})">
                                                    </button>
                                                </div>
                                            @break

                                            @default
                                        @endswitch

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    {{-- @dump($selectedFeatures) --}}
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
