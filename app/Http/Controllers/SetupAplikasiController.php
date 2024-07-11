<?php

namespace App\Http\Controllers;

use App\DataTables\SetupAplikasiDataTable;
use App\Http\Requests\SetupAplikasiRequest;
use App\Models\SetupAplikasi;
use Illuminate\Http\Request;

class SetupAplikasiController extends Controller
{
    protected $hariKerja =[
        'Senin'=> 'Mon',
        'Selasa'=> 'Tue',
        'Rabu'=> 'Wed',
        'Kamis'=> 'Thu',
        'Jumat'=> 'Fri',
        'Sabtu'=> 'Sat',
        'Minggu' => 'Sun'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index(SetupAplikasiDataTable $setupAplikasiDataTable)    
    {
        return $setupAplikasiDataTable->render('pages.setup-aplikasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.setup-aplikasi-form', [
            'action' => route('setup-aplikasi.store'),
            'data' => new SetupAplikasi(),
            'hariKerja' => $this->hariKerja
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SetupAplikasiRequest $request, SetupAplikasi $setupAplikasi)
    {
        if (SetupAplikasi::first()) {
            return responseError('Setup aplikasi sudah ada');
        }

        $request->fillData($setupAplikasi);

        $setupAplikasi->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(SetupAplikasi $setupAplikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SetupAplikasi $setupAplikasi)
    {
        return view('pages.setup-aplikasi-form', [
            'action' => route('setup-aplikasi.update', $setupAplikasi),
            'data' => $setupAplikasi,
            'hariKerja' => $this->hariKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SetupAplikasiRequest $request, SetupAplikasi $setupAplikasi)
    {
        $request->fillData($setupAplikasi);
        $setupAplikasi->save();

        return responseSuccess();
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(SetupAplikasi $setupAplikasi)
    // {
    //     //
    // }
}
