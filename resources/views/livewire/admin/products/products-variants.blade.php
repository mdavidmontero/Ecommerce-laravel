<div>
    <section class="bg-white border border-gray-100 rounded-lg shadow-lg">
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
                @foreach ($product->options as $option)
                    <div wire:key='product-option-{{ $option->id }}'
                        class="relative p-6 border border-gray-200 rounded-lg">
                        <div class="absolute px-4 bg-white -top-3">
                            <button>
                                <i class="text-red-500 fa-solid fa-trash-can hover:text-red-600"></i>
                            </button>
                            <span class="ml-2">
                                {{ $option->name }}
                            </span>
                        </div>
                        <div class="flex flex-wrap">
                            @foreach ($option->pivot->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium ml-2 pl-2.5 pr-1.5 py-0.5 rounded-sm  dark:text-gray-400 border border-gray-500">{{ $feature['description'] }}
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
                                            <button onclick="confirmDeleteFeature({{ $option->id }}, {{ $feature['id'] }})"
                                                class="absolute z-10 flex items-center justify-center w-4 h-4 bg-red-500 rounded-full hover:bg-red-600 left-3 -top-2">
                                                <i class="text-xs text-white fa-solid fa-xmark "></i>
                                            </button>
                                        </div>
                                    @break

                                    @case(3)
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                            {{ $feature->description }}</span>
                                    @break

                                    @default
                                @endswitch
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>




        </div>

    </section>

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
        </script>
    @endpush

</div>
