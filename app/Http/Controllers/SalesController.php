<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use Illuminate\Http\Request;
use App\Services\SalesService;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function __construct(protected SalesService $salesService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'sales';
        $items = $this->salesService->all();

        return view('pages.sales.index', compact('items', 'type_menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = 'sales';
        return view('pages.sales.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'sometimes|string',
            'payment_status' => 'sometimes|string',
        ]);

        $validated['users_id'] = $request->user()->id;
        $validated['total_price'] = 0;

        
        DB::beginTransaction();
        try {
            $sale = $this->salesService->create($validated);
            
            $log = [
                'users_id' => $request->user()->id,
                'description' => $request->user()->name . " Menambahkan sales baru",
                'action' => 'Create',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();

            return redirect()->route('sale-item-create', ['saleId' => $sale->id]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type_menu = 'sales';
        $item = $this->salesService->with('saleItems')->find($id);

        return view('sales.show', compact('item', 'type_menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $type_menu = 'sales';
        $item = $this->salesService->with('saleItems')->find($id);

        return view('sales.edit', compact('item', 'type_menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'payment_method' => 'required|string|in:cash,card,e-wallet',
            'payment_status' => 'required|string|in:paid,unpaid,refund,pending',
        ]);

        DB::beginTransaction();
        try {
            $item = $this->salesService->find($id);
            $item->update($validated);

            $log = [
                'users_id' => $request->user()->id,
                'description' => $request->user()->name . " Mengedit sales",
                'action' => 'Edit',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sales.show', $item->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->salesService->find($id);
            $item->delete();

            $log = [
                'users_id' => $request->user()->id,
                'description' => $request->user()->name . " Menghapus sales",
                'action' => 'Delete',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sales.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'terjadi kesalahan saat menghapus data' . $e->getMessage()]);
        }
    }
}
