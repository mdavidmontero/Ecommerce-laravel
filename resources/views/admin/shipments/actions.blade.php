@if ($shipment->status == \App\Enums\ShipmentStatus::Pending)
    <button class="text-blue-500 underline hover:text-blue-700 hover:no-underline"
        wire:click='markAsCompleted({{ $shipment->id }})'>

        Marcar como entregado
    </button>
    <br>
    <button wire:click='markAsFailed({{ $shipment->id }})'
        class="text-blue-500 underline hover:text-blue-700 hover:no-underline">
        Marcar como error en la entrega
    </button>
@endif
