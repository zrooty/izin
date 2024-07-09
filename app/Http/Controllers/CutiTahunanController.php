<?php

namespace App\Http\Controllers;

use App\DataTables\CutiTahunanDataTable;
use App\Models\CutiTahunan;
use Illuminate\Http\Request;

class CutiTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CutiTahunanDataTable $cutiTahunanDataTable)
    {
        return $cutiTahunanDataTable->render('pages.cuti-tahunan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.cuti-tahunan-form',[
            'action'=> route('cuti-tahunan.store'),
            'data'=> new CutiTahunan(),
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
    public function show(CutiTahunan $cutiTahunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CutiTahunan $cutiTahunan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CutiTahunan $cutiTahunan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CutiTahunan $cutiTahunan)
    {
        //
    }
}
