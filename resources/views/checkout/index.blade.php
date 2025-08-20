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
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis, ipsa! Alias, eos fugit pariatur
                    tempora
                    molestiae, velit animi nobis dolores voluptatum amet assumenda voluptates reprehenderit nemo. Optio
                    provident velit dolorem.
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
