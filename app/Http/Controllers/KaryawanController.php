<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // get all karyawan
        $chef = User::where('role', 'chef')->get();

        $waiter = User::where('role', 'waiter')->get();

        // return view
        return view('pages.admin.karyawan.index', [
            'chef' => $chef,
            'waiter' => $waiter,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // jika params role bukan chef atau waiter maka return 404
        if (!in_array(request()->role, ['chef', 'waiter'])) {
            abort(404);
        }

        // return view
        return view('pages.admin.karyawan.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // jika params role bukan chef atau waiter maka return 404
        if (!in_array($request->role, ['chef', 'waiter'])) {
            abort(404);
        }

        // validasi request termasuk gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:chef,waiter',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // masukan gambar ke public/assets/images/sesuai kategori material atau product
        $image = $request->file('image');

        // ganti nama sesuai tanggal atau timestamp
        $image_name = date('YmdHis') . "." . $image->getClientOriginalExtension();

        // pindahkan file ke folder public/assets/images/sesuai kategori material atau product
        $image->move(public_path('/images/' . $request->role . '/'), $image_name);

        // masukan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'profile' => '/images/'.$request->role . '/'. $image_name,
        ]);

        // redirect back
        return redirect()->route('karyawan.index')->with('add', 'Berhasil menambahkan karyawan baru');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        // get karyawan by id
        $karyawan = User::findOrFail($id);

        // return view
        return view('pages.admin.karyawan.edit', [
            'karyawan' => $karyawan,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // get karyawan by id
        $karyawan = User::findOrFail($id);

        // validasi request termasuk gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $karyawan->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:chef,waiter',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // jika password tidak kosong maka update password
        if ($request->password) {
            $karyawan->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // jika ada gambar maka update gambar
        if ($request->file('image')) {

            // masukan gambar ke public/assets/images/sesuai kategori material atau product
            $image = $request->file('image');

            // hapus gambar lama
            if (file_exists(public_path($karyawan->profile))) {
                unlink(public_path($karyawan->profile));
            }

            // ganti nama sesuai tanggal atau timestamp
            $image_name = date('YmdHis') . "." . $image->getClientOriginalExtension();

            // pindahkan file ke folder public/assets/images/sesuai kategori material atau product
            $image->move(public_path('/images/' . $request->role . '/'), $image_name);

            // update data ke database
            $karyawan->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'profile' => '/images/'.$request->role . '/'. $image_name,
            ]);

        } else {

            // update data ke database
            $karyawan->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

        }

        // redirect back
        return redirect()->route('karyawan.index')->with('edit', 'Berhasil mengubah data karyawan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // get karyawan by id
        $karyawan = User::findOrFail($id);

        // hapus gambar lama
        if (file_exists(public_path($karyawan->profile))) {
            unlink(public_path($karyawan->profile));
        }

        // delete data
        $karyawan->delete();

        // redirect back
        return redirect()->route('karyawan.index')->with('delete', 'Berhasil menghapus karyawan');

    }
}
