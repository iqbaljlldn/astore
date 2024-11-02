<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use App\Models\ProductGalleries;
use Illuminate\Http\Request;
use App\Services\ProductsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct(protected ProductsService $productService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->productService->all();

        return view('products.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'sometimes|string|max:2550',
            'barcode' => 'required|string|max:10',
            'cost_price' => 'required|integer',
            'photos' => 'sometimes|file|mimes:jpg,png,jpeg,svg|max:16384'
        ]);

        DB::beginTransaction();
        try {
            $item = $this->productService->create($validated);
            if ($request->hasFile('photos')) {
                $gallery = [
                    'product_id' => $item->id,
                    'url_path' => $request->file('photos')->store('assets/products', 'public'),
                ];
                ProductGalleries::create($gallery);
            }

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menambahkan Product baru",
                'action' => 'Create',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('products.show', $item->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->productService->find($id);

        return view('products.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = $this->productService->find($id);

        return view('products.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'sometimes|string|max:2550',
            'barcode' => 'required|string|max:10',
            'cost_price' => 'required|integer',
            'photos' => 'sometimes|file|mimes:jpg,png,jpeg,svg,mov|max:16384'
        ]);

        DB::beginTransaction();
        try {
            $item = $this->productService->update($validated, $id);
            if ($request->hasFile('photos')) {
                $exists = $item->gallery->first();
                if ($exists) {
                    Storage::disk('public')->delete($exists->url_path);
                    $exists->delete();
                }
                $gallery = [
                    'product_id' => $item->id,
                    'url_path' => $request->file('photos')->store('assets/products', 'public'),
                ];
                ProductGalleries::create($gallery);
            }

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Mengedit Product",
                'action' => 'Edit',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('products.show', $item->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->productService->find($id);
            $galleries = $item->gallery;
            foreach ($galleries as $gallery) {
                Storage::disk('public')->delete($gallery->url_path);
                $gallery->delete();
            }
            $item->delete();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menghapus produk",
                'action' => 'Delete',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'terjadi kesalahan saat menghapus data'.$e->getMessage()]);
        }
    }
}
