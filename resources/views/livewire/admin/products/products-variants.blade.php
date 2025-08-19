<div>
    <section class="bg-white border border-gray-100 rounded-lg shadow-lg ">
        <header class="px-6 py-2 border-b border-gray-200">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">
                    Opciones
                </h1>
                <x-button wire:click="$set('openModal', true)">
                    Nuevo
                </x-button>
            </div>
        </header>

        <div class="p-6">
            <div class="space-y-6">
                @if ($product->options->count())
                    @foreach ($product->options as $option)
                        <div wire:key='product-option-{{ $option->id }}'
                            class="relative p-6 border border-gray-200 rounded-lg">
                            <div class="absolute px-4 bg-white -top-3">
                                <button onclick="confirmDeleteOption({{ $option->id }})" <i
                                    class="text-red-500 fa-solid fa-trash-can hover:text-red-600"></i>
                                </button>
                                <span class="ml-2">
                                    {{ $option->name }}
                                </span>
                            </div>
                            <div class="flex flex-wrap">
                                @foreach ($option->pivot->features as $feature)
                                    <div wire:click='option-{{ $option->id }}feature-{{ $feature['id'] }}'>
                                        @switch($option->type)
                                            @case(1)
                                                <span
                                                    class="bg-gray-100 text-gray-800 text-xs font-medium ml-2 pl-2.5 pr-1.5 py-0.5 rounded-sm   border border-gray-500">{{ $feature['description'] }}
                                                    <button class="ml-0.5"
                                                        onclick="confirmDeleteFeature({{ $option->id }}, {{ $feature['id'] }})"
                                                        {{-- wire:click='deleteFeature({{ $feature->id }})' --}}><i
                                                            class="fa-solid fa-xmark hover:text-red-500"></i></button>
                                                </span>
                                            @break

                                            @case(2)
                                                <div class="relative">
                                                    <span
                                                        class="inline-block w-6 h-6 mr-4 border-2 border-gray-300 rounded-full shadow-lg"
                                                        style="background-color: {{ $feature['value'] }}">
                                                    </span>
                                                    <button
                                                        onclick="confirmDeleteFeature({{ $option->id }}, {{ $feature['id'] }})"
                                                        class="absolute z-10 flex items-center justify-center w-4 h-4 bg-red-500 rounded-full hover:bg-red-600 left-3 -top-2">
                                                        <i class="text-xs text-white fa-solid fa-xmark "></i>
                                                    </button>
                                                </div>
                                            @break

                                            @case(3)
                                                <span
                                                    class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-gray-500">
                                                    {{ $feature['description'] }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                        <svg class="inline w-4 h-4 shrink-0 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Info alert!</span> No hay opciones para este producto
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>

    @if ($product->variants->count())
        <section class="mt-12 bg-white border border-gray-100 rounded-lg shadow-lg">
            <header class="px-6 py-2 border-b border-gray-200">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold text-gray-700">
                        Variantes
                    </h1>
                </div>
            </header>

            <div class="p-6">
                <ul class="-my-4 divide-y">
                    @foreach ($product->variants as $item)
                        <li class="flex items-center py-4">
                            <img class="object-cover object-center w-12 h-12" src="{{ $item->image }}" alt="">
                            <p class="divide-x">
                                @foreach ($item->features as $feature)
                                    <span class="px-3">
                                        {{ $feature->description }}
                                    </span>
                                @endforeach
                            </p>
                            <a href="{{ route('admin.products.variants', [$product, $item]) }}"
                                class="ml-auto btn btn-blue">Editar</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif


    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar Nueva Opción
        </x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-1">Opción</x-label>
                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="" disabled>Selecciona una opción</option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex items-center mb-6">
                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">


            </div>
            <ul class="mb-4 space-y-4">
                @foreach ($variant['features'] as $index => $feature)
                    <li wire:key='variant-feature-{{ $index }}'
                        class="relative p-6 border border-gray-200 rounded-lg">
                        <div class="absolute px-4 bg-white -top-3">
                            <button wire:click='removeFeature({{ $index }})'>
                                <i class="text-red-500 fa-solid fa-trash-can hover:text-red-600"></i>
                            </button>
                        </div>
                        <div>
                            <x-label class="mb-1">
                                Valores
                            </x-label>
                            <x-select class="w-full" wire:model='variant.features.{{ $index }}.id'
                                wire:change='feature_change({{ $index }})'>
                                <option value="" disabled>Selecciona un valor</option>
                                @foreach ($this->features as $feature)
                                    <option value="{{ $feature->id }}">{{ $feature->description }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-end">
                <x-button wire:click='addFeature'>
                    Agregar Valor
                </x-button>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModal', false)">
                Cancelar
            </x-danger-button>
            <x-button class="ml-2" wire:click='save'>
                Guardar
            </x-button>

        </x-slot>
    </x-dialog-modal>


    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id) {
                // document.getElementById('delete-form').submit();
                Swal.fire({
                    title: "Estas Seguro?",
                    text: "No podras revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteFeature', option_id, feature_id);

                    }
                });
            }

            function confirmDeleteOption(option_id) {
                Swal.fire({
                    title: "Estas Seguro?",
                    text: "No podras revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteOption', option_id);
                    }
                });

            }
        </script>
    @endpush

</div>
