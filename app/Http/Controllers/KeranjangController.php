<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $user_id = Auth()->user()->id;
        $keranjang = Transaksi::where("users_id", $user_id)->get();
        // dd($keranjang->kelas_id);
        return view("keranjang", compact("keranjang"));
    }
}
