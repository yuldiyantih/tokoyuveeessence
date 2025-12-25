<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ProfileCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCustomerController extends Controller
{
    /**
     * ===============================
     * HALAMAN ACCOUNT (LIST PROFILE)
     * ===============================
     */
    public function account()
    {
        $profiles = ProfileCustomer::where('user_id', Auth::id())->get();

        return view('frontend.customer.account', compact('profiles'));
    }

    /**
     * ===============================
     * FORM TAMBAH / EDIT PROFILE
     * ===============================
     * ?id= ada  → edit
     * ?id= null → tambah
     */
    public function index(Request $request)
    {
        $profile = null;

        if ($request->has('id')) {
            $profile = ProfileCustomer::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        return view('frontend.customer.profile', compact('profile'));
    }

    /**
     * ===============================
     * SIMPAN PROFILE BARU
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'required|string',
            'province'    => 'required|string|max:100',
            'city'        => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
        ]);

        ProfileCustomer::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'email'       => Auth::user()->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'province'    => strtoupper($request->province),
            'city'        => strtoupper($request->city),
            'postal_code' => $request->postal_code,
        ]);

        return redirect()
            ->route('customer.account')
            ->with('success', 'Profil berhasil ditambahkan');
    }

    /**
     * ===============================
     * UPDATE PROFILE
     * ===============================
     * ID DIAMBIL DARI HIDDEN INPUT
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'          => 'required|exists:profile_customers,id',
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'required|string',
            'province'    => 'required|string|max:100',
            'city'        => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
        ]);

        $profile = ProfileCustomer::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $profile->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'province'    => strtoupper($request->province),
            'city'        => strtoupper($request->city),
            'postal_code' => $request->postal_code,
        ]);

        return redirect()
            ->route('customer.account')
            ->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * ===============================
     * HAPUS PROFILE
     * ===============================
     */
    public function destroy($id)
    {
        ProfileCustomer::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()
            ->route('customer.account')
            ->with('success', 'Profil berhasil dihapus');
    }
}
