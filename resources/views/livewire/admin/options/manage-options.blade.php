<div>
    <section class="bg-white rounded-lg shadow-lg ">

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
                @foreach ($options as $option)
                    <div class="relative p-6 border border-gray-200 rounded-lg">
                        <div class="absolute px-4 bg-white -top-3">
                            <span>
                                {{ $option->name }}
                            </span>
                        </div>

                        {{-- Valores --}}
                        <div class="flex flex-wrap">
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-400 border border-gray-500">{{ $feature->description }}</span>
                                    @break

                                    @case(2)
                                        <span class="inline-block w-6 h-6 mr-4 border-2 border-gray-300 rounded-full shadow-lg"
                                            style="background-color: {{ $feature->value }}">
                                        </span>
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
            Crear Nueva Opción
        </x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4" />
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    <x-input wire:model='newOption.name' class="w-full" placeholder="Por ejemplo: Tamaño, Color" />
                </div>
                <div>
                    <x-label class="mb-1">Tipo</x-label>
                    <x-select wire:model.live='newOption.type' class="w-full" name="type">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-4">
                    Valores
                </span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption['features'] as $index => $feature)
                    <div class="relative p-6 border border-gray-200 rounded-lg" wire:key='features-{{ $index }}'>
                        <div class="absolute px-4 bg-white -top-3">
                            <button wire:click='removeFeature({{ $index }})'
                                class="text-red-500 fa-solid fa-trash-can hover:bg-red-600"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label class="mb-1">Valor</x-label>
                                @switch($newOption['type'])
                                    @case(1)
                                        <x-input wire:model='newOption.features.{{ $index }}.value' class="w-full"
                                            placeholder="Ingrese el valor de la opción" />
                                    @break

                                    @case(2)
                                        <div
                                            class="border px-3 rounded-md flex justify-between items-center border-gray-300 h-[42px]">
                                            {{ $newOption['features'][$index]['value'] ?: 'Seleccione un color' }}
                                            <input type="color"
                                                wire:model.live='newOption.features.{{ $index }}.value'>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            </div>
                            <div>
                                <x-label class="mb-1">Descripción</x-label>
                                <x-input wire:model='newOption.features.{{ $index }}.description' class="w-full"
                                    placeholder="Ingrese una descripción" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end">
                <x-button wire:click='addFeature'>
                    Agregar Valor
                </x-button>
            </div>

        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-blue" wire:click='addOption'>
                Agregar
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
