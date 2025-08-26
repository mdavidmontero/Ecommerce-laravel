<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button class="text-blue-500 underline hover:no-underline" wire:click='markAsProcessing({{ $order->id }})'>
                Listo para despachar
            </button>
        @break

        @case(\App\Enums\OrderStatus::Processing)
            <button wire:click='assignDriver({{ $order->id }})' class="text-blue-500 underline hover:no-underline">
                Asignar repartidor
            </button>
        @break

        @case(\App\Enums\OrderStatus::Failed)
            <button wire:click='markAsRefunded({{ $order->id }})' class="text-blue-500 underline hover:no-underline">
                Marcar como devuelto
            </button>
        @break

        @case(\App\Enums\OrderStatus::Refunded)
            <button wire:click='assignDriver({{ $order->id }})' class="text-blue-500 underline hover:no-underline">
                Asignar repartidor
            </button>
        @break

        @default
    @endswitch
    @if ($order->status != \App\Enums\OrderStatus::Cancelled)
        <button class="text-blue-500 underline hover:no-underline" wire:click='cancelOrder({{ $order->id }})'>
            Cancelar
        </button>
    @endif

</div>
