<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),
    ],
    [
        'name' => 'Editar',
    ],
]">


    <form action="{{ route('admin.covers.update', $cover) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <figure class="relative mb-4">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 text-gray-700 bg-white rounded-lg cursor-pointer">
                    <i class="mr-2 fas fa-camera"></i>
                    Actualizar Imagen
                    <input type="file" class="hidden" accept="image/*" name="image"
                        onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
            <img src="{{ $cover->image }}" class="aspect-[3/1] object-cover w-full object-center" id="imgPreview">
        </figure>
        <x-validation-errors class="mb-4" />
        <div class="mb-4">
            <x-label>
                Titulo
            </x-label>
            <x-input name="title" placeholder="Por Favor ingrese el titulo de la portada" class="w-full"
                value="{{ old('title', $cover->title) }}" />
        </div>

        <div class="mb-4">
            <x-label>
                Fecha de Inicio
            </x-label>
            <x-input type="date" name="start_at" class="w-full"
                value="{{ old('start_at', $cover->start_at->format('Y-m-d')) }}" />
        </div>
        <div class="mb-4">
            <x-label>
                Fecha Fin (opcional)
            </x-label>
            <x-input type="date" name="end_at" class="w-full"
                value="{{ old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-d') : '') }}" />
        </div>

        <div class="flex mb-4 space-x-2">
            <label>
                <x-input type="radio" name="is_active" value="1" :checked="$cover->is_active == 1" />
                Activo
            </label>
            <label>
                <x-input type="radio" name="is_active" value="0" :checked="$cover->is_active == 0" />
                Inactivo
            </label>
        </div>

        <div class="flex justify-end">
            <x-button>Actualizar</x-button>
        </div>
    </form>



    @push('js')
        <script>
            function previewImage(event, querySelector) {

                let input = event.target;

                let imgPreview = document.querySelector(querySelector);

                if (!input.files.length) return

                let file = input.files[0];

                let objectURL = URL.createObjectURL(file);

                imgPreview.src = objectURL;

            }
        </script>
    @endpush
</x-admin-layout>
