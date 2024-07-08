<?php

namespace App\Http\Controllers;

use App\DataTables\ListAtasanDataTable;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use DateTime;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('pages.user');
    }

    public function listAtasan(ListAtasanDataTable $listAtasanDataTable)
    {
        return $listAtasanDataTable->with(['except' => request('except')])->render('pages.user-list-atasan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.user-form',[
            'action' => route('users.store'),
            'data' => new User(),
            'jenisKelamin' => ['Laki laki' => 'L', 'Perempuan' => 'P'],
            'divisi' => Divisi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User($request->validated());
            $user->password = bcrypt($request->password);
            $user->save();

            foreach ($request->atasan as $key => $value) {
                $atasan[$key] = ['level' => $value];
            }
            if (isset($atasan)) {
                $user->atasan()->attach($atasan);

            }

            $divisi = Divisi::find($request->divisi);
            $user->karyawan()->create([
                'nama' => $user->nama,
                'divisi_id' => $request->divisi,
                'nama_divisi' => $divisi->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_karyawan' => $request->status_karyawan,
                'tanggal_masuk' => (new DateTime($request->tanggal_masuk))->format('Y-m-d'),
                
            ]);

            DB::commit();
            return response()->json([
                'status'=> 'success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'=> 'error',
                'message' => $th->getMessage()
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.user-form', [
            'action' => route('users.update', $user->id),
            'data'=> $user,
            'jenisKelamin' => ['Laki laki' => 'L', 'Perempuan' => 'P'],
            'divisi' => Divisi::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $validate = $request->validated();
            if (!$validate['password']) {
                unset($validate['password']);
            }
            $user->fill($validate);
            $user->save();

            foreach ($request->atasan as $key => $value) {
                $atasan[$key] = ['level' => $value];
            }
            if (isset($atasan)) {
                $user->atasan()->sync($atasan);

            }

            $divisi = Divisi::find($request->divisi);
            $karyawan = $user->karyawan;
            $karyawan->fill([
                'divisi_id' => $request->divisi,
                'nama_divisi' => $divisi->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_karyawan' => $request->status_karyawan,
                'tanggal_masuk' => (new DateTime($request->tanggal_masuk))->format('Y-m-d'),

            ]);

            $karyawan->save();

            DB::commit();
            return response()->json([
                'status'=> 'success',
                'message' => 'Berhasil menyimpan data'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'=> 'error',
                'message' => $th->getMessage()
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
