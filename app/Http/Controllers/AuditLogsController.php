<?php

namespace App\Http\Controllers;

use App\Services\LogService;

class AuditLogsController extends Controller
{
    public function __construct(protected LogService $logService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->logService->all();

        return view('log', compact('items'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->logService->find($id);

        return view('log', compact('item'));
    }
}
