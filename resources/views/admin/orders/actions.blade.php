<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button class="text-blue-500 underline hover:no-underline" wire:click='markAsProcessing({{ $order->id }})'>
                Listo para despachar
            </button>
        @break

        @case(\App\Enums\OrderStatus::Processing)
            <button class="text-blue-500 underline hover:no-underline">
                Asignar repartidor
            </button>
        @break

        @default
    @endswitch
    <button class="text-blue-500 underline hover:no-underline">
        Cancelar
    </button>

</div>
