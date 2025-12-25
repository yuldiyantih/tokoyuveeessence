<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // akses tabel produk

class PageController extends Controller
{
    /**
     * Halaman utama (Home)
     */
    public function home()
    {

        $products = Product::take(3)->get();

        return view('frontend.home', [
            'judul' => 'Home | Yuvee Essence',
            'products' => $products,
        ]);
    }

    /**
     * Halaman Tentang Kami
     */

    public function tentang()
    {
        return view('frontend.tentang');
    }

    public function kontak()
    {
        return view('frontend.kontak');
    }

    public function aboutus()
    {
        return view('frontend.aboutus');
    }

    public function kebijakanPrivasi()
    {
        return view('frontend.kebijakan-privasi');
    }

    public function syaratKetentuan()
    {
        return view('frontend.syarat-ketentuan');
    }
}
