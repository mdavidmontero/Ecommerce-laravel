<x-app-layout>

    <div class="max-w-2xl pt-12 mx-auto">
        <img class="w-full" src="https://i.pinimg.com/736x/30/27/bb/3027bb63aa7e82fe11e7268179820b70.jpg" alt="">
        @if (session('niubiz'))
            @php
                $response = session('niubiz')['response'];
            @endphp
            <div class="p-4 mt-8 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <p class="mb-4">
                    {{ $response['dataMap']['ACTION_DESCRIPTION'] }}
                </p>
                <p>
                    <b>
                        Número de Pedido:
                    </b>
                    {{ $response['order']['purchaseNumber'] }}
                <p>
                <p>

                    <b>Fecha y Hora del Pedido:</b>
                    {{ now()->createFromFormat('ymdHis', $response['dataMap']['TRANSACTION_DATE'])->format('d-m-Y H:i:s') }}
                </p>
                <p>
                    <b>Tarjeta:</b>
                    {{ $response['dataMap']['CARD'] }} ({{ $response['dataMap']['BRAND'] }})
                </p>
                <p>
                    <b>Importe:</b>
                    {{ $response['order']['amount'] }} {{ $response['order']['currency'] }}
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
