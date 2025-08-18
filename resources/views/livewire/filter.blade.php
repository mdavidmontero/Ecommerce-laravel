<div class="py-12 bg-white">
    <x-container class="px-4 md:flex">
        @if (count($options))
            <aside class="mb-8 md:mr-8 md:flex-shrink-0 md:w-52 md:mb-0">
                <ul class="space-y-4">
                    @foreach ($options as $option)
                        <li x-data="{ open: true }">
                            <button x-on:click="open = !open"
                                class="flex items-center justify-between w-full px-4 py-2 text-left text-gray-700 bg-gray-200">{{ $option['name'] }}
                                <i class="fa-solid fa-angle-down"
                                    x-bind:class="{
                                        'fa-angle-dowm': open,
                                        'fa-angle-up': !open,
                                    }"></i>
                            </button>
                            <ul class="mt-2 space-y-2" x-show="open">
                                @foreach ($option['features'] as $feature)
                                    <li><label class="inline-flex items-center">
                                            <x-checkbox class="mr-2" value="{{ $feature['id'] }}"
                                                wire:model.live='selected_features' />
                                            {{ $feature['description'] }}</label></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
        @endif
        <div class="md:flex-1">
            <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:
                </span>
                <x-select wire:model.live='orderBy'>
                    <option value="1">Relevancia</option>
                    <option value="2">Precio: Mayor a Menor</option>
                    <option value="3">Precio: Menor a Mayor</option>
                </x-select>
            </div>
            <hr class="my-4">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    <article class="overflow-hidden bg-white rounded shadow">
                        <img src="{{ $product->image }}" class="object-cover object-center w-full h-48" />
                        <div class="p-4">
                            <h1 class="mb-2 text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px]">
                                {{ $product->name }}
                            </h1>
                            <p class="mb-4 text-gray-600"$>{{ $product->price }}</p>
                            <a href="{{ route('products.show', $product) }}"
                                class="block w-full text-center btn btn-purple">Ver más</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </x-container>
</div>
