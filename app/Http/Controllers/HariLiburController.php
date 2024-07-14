<?php

namespace App\Http\Controllers;

use App\Models\HariLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\HariLiburRequest;

class HariLiburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('start') && request()->has('end')) {
            $hariLibur = HariLibur::active()->get()->map(function($item) {
                return [
                    'id'=> $item->id,
                    'start'=> $item->tanggal_awal,
                    'end'=> $item->tanggal_akhir->addDay(),
                    'title' => $item->nama,
                    'textColor' => '#842029',
                    'backgroundColor' => '#f8d7da',
                    'borderColor' => '#f5c2c7',
                    'allDay' => true,
                ];
            });
            return response()->json($hariLibur);
        }
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
        return view('pages.hari-libur-form', [
            'action' => route('hari-libur.update', $hariLibur->id),
            'data'=> $hariLibur
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HariLiburRequest $request, HariLibur $hariLibur)
    {
        if($request->has('delete')) {
            $hariLibur->delete();
        } else {
            if ($request->ref == 'modify') {
                $request->tanggal_akhir = Carbon::create($request->tanggal_akhir)->subDay()->format('Y-m-d');
            }
            $request->fillData($hariLibur);
            $hariLibur->save();
        }

        return responseSuccess();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HariLibur $hariLibur)
    {
        //
    }
}
