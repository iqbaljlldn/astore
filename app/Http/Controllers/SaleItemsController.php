<?php

namespace App\Http\Controllers;

use App\Models\SaleItems;
use App\Models\AuditLogs;
use App\Models\Sales;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaleItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = SaleItems::with('sale')->get();

        return view('sale-items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sale-items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $saleId)
    {
        $validated = $request->validate([
            'items.*.product_id'=> 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalAddedPrice = 0;

            foreach ($validated['items'] as $itemData) {

                $product = Products::where('id', $itemData['product_id'])->lockForUpdate()->firstOrFail();

                if ($product->stock < $itemData['quantity']) {
                    return redirect()->back()->withErrors(['error' => 'Stock tidak mencukupi']);
                }

                $product->stock -= $itemData['quantity'];
                $product->save();

                $itemData['subtotal'] = $itemData['quantity'] * $itemData['price'];
                $itemData['sale_id'] = $saleId;
                SaleItems::create($itemData);

                $totalAddedPrice += $itemData['subtotal'];
            }

            $sale = Sales::findOrFail($saleId);
            $sale->total_price += $totalAddedPrice;
            $sale->save();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menambahkan sale item baru",
                'action' => 'Create',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sales.show', $saleId);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = SaleItems::findOrFail($id);

        return view('sale-items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = SaleItems::findOrFail($id);

        return view('sale-items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $saleId)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $item = SaleItems::findOrFail($id);

            $oldProduct = Products::where('id',$item->product_id)->lockForUpdate()->firstOrFail();
            $newProduct = Products::where('id', $validated['product_id'])->lockForUpdate()->firstOrFail();

            $difference = $validated['quantity'] - $item->quantity;

            //jika produk berubah, kembalikan stok produk lama
            if ($item->product_id != $validated['product_id']) {
                $oldProduct->stock += $item->quantity;
                $oldProduct->save();

                //kurangi stok produk
                if ($newProduct->stock < $validated['quantity']) {
                    return redirect()->back()->withErrors(['error' => 'Stok produk baru tidak mencukupi.']);
                }
            } elseif ($difference < 0) {
                //tambah stok ika kurang
                $newProduct->stock += abs($difference);
            }
            $newProduct->save();

            $oldSubtotal = $item->subtotal;
            $item->quantity = $validated['quantity'];
            $item->price = $validated['price'];
            $item->product_id = $validated['product_id'];
            $item->subtotal = $validated['quantity'] * $validated['price'];
            $item->save();

            $newSubtotal = $item->subtotal;

            $sale = Sales::findOrFail($saleId);
            $sale->total_price = $sale->total_price - $oldSubtotal + $newSubtotal;
            $sale->save();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Mengedit sale item ".$item->id,
                'action' => 'Edit',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sales.show', $saleId);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id, $saleId)
    {
        DB::beginTransaction();
        try {
            $item = SaleItems::findOrFail($id);
            $subtotal = $item->subtotal;

            $product = Products::where('id', $item->product_id)->lockForUpdate()->firstOrFail();
            $product->stock += $item['quantity'];
            $product->save();

            $item->delete();

            $sales = Sales::findOrFail($saleId);
            $sales->total_price -= $subtotal;
            $sales->save();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menghapus sale item " . $item->id,
                'action' => 'Delete',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sales.show', $saleId);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
