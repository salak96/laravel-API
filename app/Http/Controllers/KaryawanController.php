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
    public function edit(Karyawan $karyawan)
    {

        return view('edit_karyawan', compact('karyawan'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // //valiasi
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'jabatan' => 'required',
            'status' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
        ]);
        
        // // //simpan
       
       Karyawan::create([
           'nama' => $request->nama,
           'jabatan' => $request->jabatan,
           'status' => $request->status,
           'email' => $request->email,
           'no_hp' => $request->no_hp,
       ]);
       
       return redirect('/karyawans')->with('status', 'Data Berhasil');
    
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //validasi
        $request->validate([
            'nama' => 'required|min:3|max:20',
            'jabatan' => 'required|min:3|max:10',
            'status' => 'required',
            'email' => 'required',
            'no_hp' => 'required|min:8|max:14',
        ]);
        //update database
        $karyawan->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
   
        return redirect('/karyawans')->with('status', 'Data Berhasil');
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