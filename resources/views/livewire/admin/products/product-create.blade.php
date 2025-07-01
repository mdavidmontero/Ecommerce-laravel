<div>
    <figure class="relative mb-4">
        <div class="absolute top-8 right-8">
            <label class="flex items-center px-4 py-2 text-gray-700 bg-white rounded-lg cursor-pointer">
                <i class="mr-2 fas fa-camera"></i>
                Actualizar Imagen
            </label>
        </div>
        <img class="object-cover aspect-[16/9] object-center w-full" src="{{ asset('img/no-image.png') }}" alt="No image">
    </figure>



    <div class="card">
        <div class="mb-4">
            <x-label>
                <x-label class="mb-1">Código</x-label>
            </x-label>
            <x-input placeholder='Por favor ingrese el código del producto' wire:model='product.sku' class="w-full" />
        </div>
        <div class="mb-4">
            <x-label>
                <x-label class="mb-1">Nombre</x-label>
            </x-label>
            <x-input placeholder='Por favor ingrese el nombre del producto' wire:model='product.name' class="w-full" />
        </div>
        <div class="mb-4">
            <x-label>
                <x-label class="mb-1">Descripción</x-label>
            </x-label>
            <x-textarea placeholder='Por favor ingrese la descripción del producto' wire:model='product.description'
                class="w-full"></x-textarea>
        </div>

        <div class="mb-4">
            <x-label>
                Familias
            </x-label>
            <x-select class="w-full" wire:model.live="family_id">
                <option value="" disabled>Seleccione una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}">{{ $family->name }}</option>
                @endforeach
            </x-select>

        </div>
        <div class="mb-4">
            <x-label>
                Categorias
            </x-label>
            <x-select class="w-full" wire:model.live="category_id">
                <option value="" disabled>Seleccione una categoria</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">
            <x-label>
                SubCategorias
            </x-label>
            <x-select class="w-full" wire:model.live="product.subcategory_id">
                <option value="" disabled>Seleccione una subcategoria</option>
                @foreach ($this->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </x-select>
        </div>
    </div>
</div>
