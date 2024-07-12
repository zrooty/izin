<?php

namespace App\Http\Controllers;

use App\Http\Requests\HariLiburRequest;
use App\Models\HariLibur;
use Illuminate\Http\Request;

class HariLiburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.hari-libur');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.hari-libur-form', [
            'action'=> route('hari-libur.store'),
            'data' => new HariLibur([
                'tanggal_awal' => date_create(request('tanggal_awal'))->format('d-m-Y'),
                'tanggal_akhir' => date_create(request('tanggal_akhir'))->format('d-m-Y'),
            ])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HariLiburRequest $request, HariLibur $hariLibur)
    {
        $request->fillData($hariLibur);
        $hariLibur->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(HariLibur $hariLibur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HariLibur $hariLibur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HariLibur $hariLibur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HariLibur $hariLibur)
    {
        //
    }
}
