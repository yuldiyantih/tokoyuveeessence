<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SettingProfileController extends Controller
{
    /**
     * Halaman Edit Profil Manager
     */
    public function index()
    {
        $manager = User::where('role', 'manager')->first();

        return view('admin.profile.index', compact('manager'));
    }

    /**
     * Halaman Lihat Profil Manager
     */
    public function show()
    {
        $manager = User::where('role', 'manager')->first();

        return view('admin.profile.show', compact('manager'));
    }

    /**
     * Update Profil Manager
     */
    public function update(Request $request)
    {
        $manager = User::where('role', 'manager')->first();

        if (!$manager) {
            return back()->with('error', 'Manager tidak ditemukan!');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email," . $manager->id,
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
            'foto'  => 'nullable|image|max:2048',
        ]);

        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->no_hp = $request->no_hp;
        $manager->status = $request->status;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $manager->foto = $filename;
        }

        $manager->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profil manager berhasil diperbarui!');
    }
}
