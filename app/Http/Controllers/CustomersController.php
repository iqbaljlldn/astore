<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use Illuminate\Http\Request;
use App\Services\CustomersService;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function __construct(protected CustomersService $customerService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->customerService->all();

        return view('customer', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required|string|max:20',
            'points' => 'sometimes|integer'
        ]);

        DB::beginTransaction();
        try {
            $item = $this->customerService->create($validated);

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menambahkan customer baru",
                'action' => 'Create',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('customers.create', $item->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memasukan data'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->customerService->find($id);

        return view('customers.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = $this->customerService->find($id);

        return view('customers.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required|string|max:20',
            'points' => 'sometimes|integer'
        ]);

        DB::beginTransaction();
        try {
            $item = $this->customerService->find($id);
            $item->update($data);

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menambahkan customer baru",
                'action' => 'Update',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('customers.show', $item->id);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->customerService->find($id);
            $item->delete();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menghapus customer",
                'action' => 'Delete',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('customers.index');
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data'.$e->getMessage()]);
        }
    }
}
