<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endpush
    <!-- Slider main container -->
    <div class="mb-12 swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach ($covers as $cover)
                <div class="swiper-slide">
                    <img src="{{ $cover->image }}" alt="" class="w-full aspect-[3/1] object-cover object-center" />
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <x-container>
        <h1 class="mb-4 text-2xl font-bold text-gray-700">Ultimos Productos</h1>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($lastProducts as $product)
                <article class="overflow-hidden bg-white rounded shadow">
                    <img src="{{ $product->image }}" class="object-cover object-center w-full h-48" />
                    <div class="p-4">
                        <h1 class="mb-2 text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px]">{{ $product->name }}
                        </h1>
                        <p class="mb-4 text-gray-600"$>{{ $product->price }}</p>
                        <a href="" class="block w-full text-center btn btn-blue">Ver más</a>
                    </div>
                </article>
            @endforeach
        </div>
    </x-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                loop: true,
                autoplay: {
                    delay: 8000,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
        </script>
    @endpush
</x-app-layout>
