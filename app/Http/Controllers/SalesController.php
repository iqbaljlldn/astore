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
        $items = $this->salesService->all();

        return view('sales.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'payment_method' => 'sometimes|string',
            'payment_status' => 'required|string|in:pending',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['total_price'] = 0;

        DB::beginTransaction();
        try {
            $sale = $this->salesService->create($validated);
            $log = [
            'user_id' => $request->user()->id,
            'description' => $request->user()->name . " Menambahkan sales baru",
            'action' => 'Create',
            'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sale-items.show', ['sale' => $sale->id]);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->salesService->with('saleItems')->find($id);

        return view('sales.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = $this->salesService->with('saleItems')->find($id);

        return view('sales.edit', compact('item'));
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
            'user_id' => $request->user()->id,
            'description' => $request->user()->name . " Mengedit sales",
            'action' => 'Edit',
            'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('sales.show', $item->id);
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data: '.$e->getMessage()]);
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
                'user_id' => $request->user()->id,
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
