<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image_path);
        $product->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Producto eliminado',
            'text' => 'El producto ha sido eliminado correctamente',
        ]);
        return redirect()->route('admin.products.index');
    }

    public function variants(Product $product, Variant $variant)
    {
        // return $variant;
        return view('admin.products.variants', compact('product', 'variant'));
    }

    public function variantsUpdate(Request $request, Product $product, Variant $variant)
    {
        $data =  $request->validate([
            'image' => 'nullable|image|max:1024',
            'sku' => 'required',
            'stock' => 'required|numeric|min:0',
        ]);
        if ($request->image) {
            if ($variant->image_path) {
                Storage::delete($variant->image_path);
            }
            $data['image_path'] = $request->image->store('products');
        }
        $variant->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'El producto se ha actualizado exitosamente',
        ]);
        return redirect()->route('admin.products.variants', [$product, $variant]);
    }
}
