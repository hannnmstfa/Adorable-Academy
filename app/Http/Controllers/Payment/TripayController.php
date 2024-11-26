<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Http;

class TripayController extends Controller
{
    public function ambilpayment()
    {
        // Mendapatkan API Key dari file config/tripay.php atau dari .env
        $apiKey = config("tripay.api_key");

        // Mengirim request ke API Tripay
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get('https://tripay.co.id/api-sandbox/merchant/payment-channel');

        // Memeriksa apakah request berhasil
        if ($response->successful()) {
            // Mengembalikan response dalam bentuk JSON
            return response()->json($response->json());
        } else {
            // Menangani error dan mengembalikan pesan error
            return response()->json(['error' => 'Gagal menghubungi API Tripay'], 500);
        }
    }

    public function requestTrx($method, $kelas, $user)
    {
        $apiKey       = config("tripay.api_key");
        $privateKey   = config("tripay.private_key");
        $merchantCode = config("tripay.merchant_code");
        $merchantRef  = 'TRX' . time();
        // dd($apiKey, $privateKey, $merchantCode, $merchantRef, $kelas->nama, $method, $user);

        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $kelas->harga,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone,
            'order_items'    => [
                [
                    'name'        => $kelas->nama,
                    'price'       => $kelas->harga,
                    'quantity'    => 1
                ]
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $kelas->harga, $privateKey)
        ];

        // dd($data);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        // dd($response);

        curl_close($curl);
        // Decode JSON response dari API
        $response = json_decode($response, true);  // Ubah menjadi array PHP

        // Kembalikan response dalam bentuk array
        return $response;
    }
}
