<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->categoryService->all();

        return view('categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:50'
        ]);

        DB::beginTransaction();

        try {
            $item = $this->categoryService->create($validated);

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Membuat kategori baru",
                'action' => 'Create',
                'ip_address' => $request->ip(),
            ];

            AuditLogs::create($log);

            DB::commit();

            return redirect()->route('categories.show', $item->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->categoryService->find($id);

        return view('categories.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = $this->categoryService->find($id);

        return view('categories.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string|max:50'
        ]);

        DB::beginTransaction();

        try {
            $item = $this->categoryService->update($data, $id);

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Mengedit kategori",
                'action' => 'Edit',
                'ip_address' => $request->ip(),
            ];
            AuditLogs::create($log);

            DB::commit();
            return redirect()->route('categories.show', $item->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->categoryService->delete($id);
            $item->delete();

            $log = [
                'user_id' => $request->user()->id,
                'description' => $request->user()->name . " Menghapus kategori",
                'action' => 'Delete',
                'ip_address' => $request->ip(),
            ];

            AuditLogs::create($log);

            DB::commit();

            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data'.$e->getMessage()]);
        }
    }
}
