<?php

namespace App\Http\Controllers;

use App\DataTables\CutiDataTable;
use App\Models\Cuti;
use App\Services\CutiService;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function __construct(private CutiService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CutiDataTable $cutiDataTable)
    {
        return $cutiDataTable->render('pages.pengajuan.cuti');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengajuan.cuti-form', [
            'action' => route('pengajuan.cuti.store'),
            'data' => new Cuti(),
            'hmin' => $this->service->hmin(setupAplikasi('hmin_cuti')),
            'sisaCuti' => user()->cutiTahunanActive->sisa_cuti
        ]);
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
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuti $cuti)
    {
        //
    }
}
