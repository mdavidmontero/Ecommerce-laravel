<x-app-layout>
    <div class="-mb-16 text-gray-700">
        <div class="grid grid-cols-1 lg:grid-cols-2" x-data="{
            pago: 1
        }">
            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40-rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="mb-2 text-2xl font-semibold">Pago</h1>
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow">
                        <ul class="border border-gray-400 divide-y divide-gray-400">
                            <li>
                                <label for="" class="flex items-center p-4">
                                    <input type="radio" value="1" x-model="pago">
                                    <span class="ml-2">
                                        Tarjeta de Debito / Credito
                                    </span>
                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png"
                                        alt="">
                                </label>
                                <div class="p-4 text-center bg-gray-100 border-t border-gray-400" x-show="pago == 1">
                                    <i class="text-9xl fa-regular fa-credit-card"></i>
                                    <p class="mt-2">Luego de hacer click en pagar Ahora, se abrira el checkout en
                                        Niubiz para
                                        completar tu compra</p>
                                </div>
                            </li>
                            <li>
                                <label for="" class="flex items-center p-4">
                                    <input type="radio" value="2" x-model="pago">
                                    <span class="ml-2">Deposito bancario o yape</span>
                                </label>
                                <div class="flex justify-center p-4 bg-gray-100 border-t border-gray-400" x-cloak
                                    x-show="pago == 2">
                                    <div>
                                        <p>1. Pago por deposito o trasferencia bancaria</p>
                                        <p>- Bancolombia: 91228104731</p>
                                        <p>CCI: 002</p>
                                        <p>- Razón social: Ecommerce SA</p>
                                        <p>RUT: 2837373</p>
                                        <p>2. Pago por Yape</p>
                                        <p>- Yape al numero 2837373</p>
                                        <p>Enviar el comprobante a 3104956725</p>

                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="lg:max-w-[40-rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <ul class="mb-4 space-y-4">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="flex items-center space-x-4">
                                <div class="relative flex-shrink-0">
                                    <img class="h-16 aspect-square" src="{{ $item->options->image }}" alt="">
                                    <div
                                        class="absolute flex items-center justify-center w-6 h-6 bg-gray-900 rounded-full bg-opacity-70 -right-2 -top-2">
                                        <span class="font-semibold text-white">
                                            {{ $item->qty }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p>
                                        {{ $item->name }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p>
                                        COP {{ $item->price }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-between">
                        <p>
                            Subtotal
                        </p>
                        <p>
                            COP {{ Cart::instance('shopping')->subtotal() }}
                            <i class="fa-solid fa-info-circle"
                                title="El precio de envio es de 10.000 pesos colombianos"></i>
                        </p>
                        <p>
                            Precio de envío
                        </p>
                        <p>
                            COP 10.000
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">
                            Total
                        </p>
                        <p>
                            COP {{ Cart::instance('shopping')->subtotal() }}
                        </p>
                    </div>
                    <div class="">
                        <button class="w-full btn btn-purple" onclick="VisanetCheckout.open()">Finalizar
                            Pedido</button>
                    </div>

                    @if (session('niubiz'))
                        @php
                            $niubiz = session('niubiz');
                            $response = $niubiz['response'];
                            $purchaseNumber = $niubiz['purchaseNumber'];
                        @endphp
                        @isset($response['data'])
                            <div class="p-4 mt-8 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <p class="mb-4">
                                    {{ $response['data']['ACTION_DESCRIPTION'] }}
                                </p>
                                <p>
                                    <b>Número de Pedido: </b>
                                    {{ $purchaseNumber }}
                                </p>
                                <p>
                                    <b>Fecha y Hora del Pedido</b>
                                    {{ now()->createFromFormat('ymdHis', $response['data']['TRANSACTION_DATE'])->format('d-m-Y H:i:s') }}
                                </p>
                                @isset($response['data']['CARD'])
                                    <p>
                                        <b>Tarjeta:</b>
                                        {{ $response['data']['CARD'] }} ({{ $response['data']['BRAND'] }})
                                    </p>
                                @endisset
                            </div>
                        @endisset
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                let purchasenumber = Math.floor(Math.random() * 1000000000);
                let amount = {{ (float) Cart::instance('shopping')->subtotal() + 10 }};

                VisanetCheckout.configure({
                    sessiontoken: '{{ $session_token }}',
                    channel: 'web',
                    merchantid: '{{ config('services.niubiz.merchant_id') }}',
                    purchasenumber: purchasenumber,
                    amount: amount,
                    expirationminutes: '20',
                    timeouturl: 'about:blank',
                    merchantlogo: 'img/comercio.png',
                    formbuttoncolor: '#000000',
                    action: "{{ route('checkout.paid') }}?amount=" + amount + "&purchaseNumber=" +
                        purchasenumber,
                    complete: function(params) {
                        alert(JSON.stringify(params));
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
