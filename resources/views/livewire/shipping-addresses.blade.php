<div>
    <section class="overflow-hidden bg-white rounded-lg shadow">
        <header class="px-4 py-2 bg-gray-900">
            <h2 class="text-lg text-white">
                Direcciones de Envio guardadas
            </h2>
        </header>
        <div class="p-4">
            @if ($newAddress)
                <x-validation-errors class="mb-4" />
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <x-select wire:model='createAddress.type'>
                            <option value="">Tipo de dirección</option>
                            <option value="1">Domicilio</option>
                            <option value="2">Oficina</option>
                        </x-select>
                    </div>
                    <div class="col-span-3">
                        <x-input wire:model='createAddress.description' class="w-full" type="text"
                            placeholder="Nombre de la dirección" />
                    </div>
                    <div class="col-span-2">
                        <x-input wire:model='createAddress.district' class="w-full" type="text"
                            placeholder="Distrito" />
                    </div>
                    <div class="col-span-2">
                        <x-input wire:model='createAddress.reference' class="w-full" type="text"
                            placeholder="Referencia" />
                    </div>
                    <div class="col-span-2">
                        <x-input wire:model='createAddress.city' class="w-full" type="text" placeholder="Ciudad" />
                    </div>
                </div>
                <hr class="my-4" />
                <div x-data="{
                    receiver: @entangle('createAddress.receiver'),
                    receiver_info: @entangle('createAddress.receiver_info'),
                }" x-init="$watch('receiver', value => {
                    if (value == 1) {
                        receiver_info.name = '{{ auth()->user()->name }}';
                        receiver_info.last_name = '{{ auth()->user()->last_name }}';
                        receiver_info.document_type = '{{ auth()->user()->document_type }}';
                        receiver_info.document_number = '{{ auth()->user()->document_number }}';
                        receiver_info.phone = '{{ auth()->user()->phone }}';
                    } else {
                        receiver_info.name = '';
                        receiver_info.last_name = '';
                        receiver_info.document_number = '';
                        receiver_info.phone = '';
                    }
                })">
                    <p class="mb-2 font-semibold">¿Quién recibira el pedido?</p>
                    <div class="flex mb-4 space-x-2">
                        <label class="flex items-center">
                            <input x-model='receiver' type="radio" value="1" class="mr-1">
                            Seré yo
                        </label>
                        <label class="flex items-center">
                            <input x-model='receiver' type="radio" value="2" class="mr-1">
                            Otra Persona
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-input x-bind:disabled='receiver == 1' x-model='receiver_info.name' placeholder='Nombres'
                                class="w-full" />
                        </div>
                        <div>
                            <x-input x-bind:disabled='receiver == 1' x-model='receiver_info.last_name'
                                placeholder='Apellidos' class="w-full" />
                        </div>
                        <div>
                            <div class="flex space-x-2">
                                <x-select x-model='receiver_info.document_type'>
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{ $item->value }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input x-model='receiver_info.document_number' placeholder='Número de documento'
                                    class="w-full" />
                            </div>
                        </div>
                        <div>
                            <x-input x-model='receiver_info.phone' placeholder='Telefono' class="w-full" />
                        </div>
                        <div>
                            <button wire:click="$set('newAddress', false)" class="w-full btn btn-outline-gray">
                                Cancelar
                            </button>
                        </div>
                        <div>
                            <button wire:click='store' class="w-full btn btn-purple">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            @else
                @if ($editAddress->id)
                    <x-validation-errors class="mb-4" />
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <x-select wire:model='editAddress.type'>
                                <option value="">Tipo de dirección</option>
                                <option value="1">Domicilio</option>
                                <option value="2">Oficina</option>
                            </x-select>
                        </div>
                        <div class="col-span-3">
                            <x-input wire:model='editAddress.description' class="w-full" type="text"
                                placeholder="Nombre de la dirección" />
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model='editAddress.district' class="w-full" type="text"
                                placeholder="Distrito" />
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model='editAddress.reference' class="w-full" type="text"
                                placeholder="Referencia" />
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model='editAddress.city' class="w-full" type="text" placeholder="Ciudad" />
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div x-data="{
                        receiver: @entangle('editAddress.receiver'),
                        receiver_info: @entangle('editAddress.receiver_info'),
                    }" x-init="$watch('receiver', value => {
                        if (value == 1) {
                            receiver_info.name = '{{ auth()->user()->name }}';
                            receiver_info.last_name = '{{ auth()->user()->last_name }}';
                            receiver_info.document_type = '{{ auth()->user()->document_type }}';
                            receiver_info.document_number = '{{ auth()->user()->document_number }}';
                            receiver_info.phone = '{{ auth()->user()->phone }}';
                        } else {
                            receiver_info.name = '';
                            receiver_info.last_name = '';
                            receiver_info.document_number = '';
                            receiver_info.phone = '';
                        }
                    })">
                        <p class="mb-2 font-semibold">¿Quién recibira el pedido?</p>
                        <div class="flex mb-4 space-x-2">
                            <label class="flex items-center">
                                <input x-model='receiver' type="radio" value="1" class="mr-1">
                                Seré yo
                            </label>
                            <label class="flex items-center">
                                <input x-model='receiver' type="radio" value="2" class="mr-1">
                                Otra Persona
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <x-input x-bind:disabled='receiver == 1' x-model='receiver_info.name'
                                    placeholder='Nombres' class="w-full" />
                            </div>
                            <div>
                                <x-input x-bind:disabled='receiver == 1' x-model='receiver_info.last_name'
                                    placeholder='Apellidos' class="w-full" />
                            </div>
                            <div>
                                <div class="flex space-x-2">
                                    <x-select x-model='receiver_info.document_type'>
                                        @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                            <option value="{{ $item->value }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-input x-model='receiver_info.document_number' placeholder='Número de documento'
                                        class="w-full" />
                                </div>
                            </div>
                            <div>
                                <x-input x-model='receiver_info.phone' placeholder='Telefono' class="w-full" />
                            </div>
                            <div>
                                <button wire:click="$set('editAddress.id', null)" class="w-full btn btn-outline-gray">
                                    Cancelar
                                </button>
                            </div>
                            <div>
                                <button wire:click='update()' class="w-full btn btn-purple">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    @if ($addresses->count())
                        <ul class="grid grid-cols-3 gap-4">
                            @foreach ($addresses as $address)
                                <li class="{{ $address->default ? 'bg-purple-200' : 'bg-white' }}  rounded-lg shadow"
                                    wire:key="addresses-{{ $address->id }}">
                                    <div class="flex items-center p-4">
                                        <div>
                                            <i class="text-2xl text-purple-500 fa-solid fa-house">
                                            </i>
                                        </div>
                                        <div class="flex-1 mx-4 text-xs">
                                            <p class="text-purple-600">
                                                {{ $address->type == 1 ? 'Domicilio' : 'Oficina' }}
                                            </p>
                                            <p class="font-semibold text-gray-700">
                                                {{ $address->district }}
                                            </p>
                                            <p class="font-semibold text-gray-700">
                                                {{ $address->description }}
                                            </p>
                                            <p class="font-semibold text-gray-700">
                                                {{ $address->city }}
                                            </p>
                                            <p class="font-semibold text-gray-700">
                                                {{ $address->receiver_info['name'] }}
                                            </p>
                                        </div>
                                        <div class="flex flex-col text-xs text-gray-800 ">
                                            <button wire:click='setDefaultAddress({{ $address->id }})' <i
                                                class="fa-solid fa-star"></i>
                                            </button>
                                            <button wire:click='edit({{ $address->id }})'>
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button wire:click='deleteAddress({{ $address->id }})'>
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">No se ha encontrado direcciones</p>
                    @endif
                    <button wire:click='$set("newAddress", true)'
                        class="flex items-center justify-center w-full mt-4 btn btn-outline-gray">
                        Agregar <i class="ml-2 fa-solid fa-plus"></i>
                    </button>

                @endif
            @endif
        </div>
    </section>
</div>
