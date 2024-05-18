<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengambbil data semua karyawan
        $karyawans = Karyawan::all();
        return view('karyawans', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form_create_karyawan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       Karyawan::create([
           'nama' => $request->nama,
           'jabatan' => $request->jabatan,
           'status' => $request->status,
           'email' => $request->email,
           'no_hp' => $request->no_hp,
       ]);
       //cek
   // Cek apakah data berhasil dimasukkan
      
       return redirect('/karyawans');
    
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        $karyawan = Karyawan::find($karyawan->id);
        return view('edit_karyawan', [
            'karyawan' => $karyawan
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //valiasi
        $request->validate([
            'nama' => 'required|min:3|max10',
            'jabatan' => 'required',
            'status' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
        ]);
        //update database
        $karyawan->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        return redirect('karyawans');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //hapus karyawn
        $karyawan->delete();
        return redirect('/karyawans');
    }
}