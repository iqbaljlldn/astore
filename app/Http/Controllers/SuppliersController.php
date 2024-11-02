<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\AuditLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Suppliers::all()->paginate(10);

        return view('suppliers.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'contact_info' => 'sometimes|string|max:20',
            'address' => 'required|string|max:100'
        ]);

        DB::beginTransaction();
        try {
            $item = Suppliers::create($validated);

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menambahkan supplier baru",
                'action' => 'Create',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('suppliers.show', ['item' => $item->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Suppliers::findOrFail($id);

        return view('suppliers.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Suppliers::findOrFail($id);

        return view('suppliers.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'contact_info' => 'sometimes|string|max:20',
            'address' => 'required|string|max:100'
        ]);

        DB::beginTransaction();
        try {
            $item = Suppliers::findOrFail($id);
            $item->update($validated);

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Mengedit supplier",
                'action' => 'Update',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('suppliers.show', ['item' => $item->id]);
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
            $item = Suppliers::findOrFail($id);
            $item->delete();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menghapus supplier baru",
                'action' => 'Delete',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('suppliers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
    }
    }
}
