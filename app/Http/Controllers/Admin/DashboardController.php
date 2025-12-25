<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'products' => Product::latest()->take(20)->get(),
            'usersCount' => User::count(),
            'transactionsCount' => Transaction::count(),
            'transactionsLatest' => Transaction::latest()->take(10)->get(),
        ]);
    }
}
