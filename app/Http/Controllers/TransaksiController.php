<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Controllers\Payment\TripayController;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Container\Attributes\Auth;
use App\Models\User;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Transaksi Tripay
        // Validasi input
        $request->validate([
            'kelas_id' => 'required|integer',
            'merchant_code' => 'required|string',
        ]);
        // Ambil kelas berdasarkan ID
        $kelasId = $request->input('kelas_id');
        $kelas = Kelas::find($kelasId);
        $user = Auth()->user();
        // Jika kelas tidak ditemukan
        if (!$kelas) {
            return redirect()->back()->withErrors('Kelas tidak ditemukan.');
        }
        // Ambil kode merchant
        $merchant = $request->merchant_code;
        // Panggil TripayController untuk request transaksi
        $tripay = new TripayController();
        $data = $tripay->requestTrx($merchant, $kelas, $user);
        $data = json_decode(json_encode($data));
        $transaksi = $data->data;
        // dd($response);
        // Dapatkan URL untuk redirect ke checkout dari Tripay
        $url = $transaksi->checkout_url;
        // dd($transaksi);
        //Store ke DataBase
        Transaksi::create([
            'users_id' => $user->id,
            'kelas_id' => $kelas->id,
            'reference' => $transaksi->reference,
            'merchant_ref' => $transaksi->merchant_ref,
            'method'=> $transaksi->payment_method,
            'harga' => $transaksi->amount_received,
            'fee' => $transaksi->total_fee,
            'status' => $transaksi->status,
            'urlpayment'=> $url
        ]);

        $trx = $transaksi->reference;
        // Redirect ke halaman checkout atau tampilkan URL
        return redirect()->route('transaksi.show', $trx)->with('message', 'Redirecting to payment gateway.');
    }

    public function index() {
        $data = Transaksi::latest()->get();
        // dd($data);
        return view('transaksi', compact('data'));
    }

    public function show($trx){
        $data = Transaksi::where('reference', $trx)->first();
        return view('transaksi.detail', compact('data'));
    }

    public function destroy($id){
        $transaksi = Transaksi::find($id);
        // dd($transaksi); 
        $transaksi->delete();
        return redirect()->back()->with('success', 'Kelas Berhasil Dihapus');   
    }
}
