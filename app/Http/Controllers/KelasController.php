<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Kelas;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    public function index()
    {
        //Ambil semua kelas
        $kelas = Kelas::all();
        // Jika user login, ambil kelas yang sudah dibeli oleh user
        if (Auth::check()) {
            $id = Auth::User()->id;
            $dibeli = Transaksi::where('users_id', $id)
                ->where('status', 'PAID')->get();
        } else {
            // Jika user belum login, set $dibeli sebagai koleksi kosong
            $dibeli = collect();
        }
        return view('kelas.index', compact('kelas', 'dibeli'));
    }
    public function store(Request $request)
    {
        // dd($request->file('foto'));
        $request->validate([
            'nama' => ['required', 'string', 'max:225', Rule::unique('kelas')],
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'kategori' => ['required', 'string', 'max:225'],
            'harga' => ['required', 'integer', 'min:1'],
            'fakeharga' => ['integer', 'nullable'],
        ]);

        // Pastikan file ada sebelum memproses lebih lanjut
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // Membuat nama file berdasarkan nama kelas dan ekstensi file asli
            $filename = $request->nama . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('/storage/fotokelas');

            // move foto ke storage
            $file->move($destinationPath, $filename);

            // Menyimpan data kelas ke database
            Kelas::create([
                'kodekelas' => Str::random(10),
                'nama' => $request->nama,
                'foto' => $filename, // Simpan nama file di database
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'fakeharga' => $request->fakeharga,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Kelas Berhasil ditambah');
        }

        return redirect()->back()->withErrors('File foto tidak ditemukan.');
    }

    public function show($kodekelas)
    {
        $kelas = Kelas::where('kodekelas', $kodekelas)->firstOrFail();
        return view('kelas.detail', compact('kelas'));
    }

    public function checkout($kodekelas)
    {
        // Ambil id User
        $id = Auth::User()->id;
        // Cek Kelas
        // Ambil kelas
        $kelas = Kelas::where('kodekelas', $kodekelas)->first();
        $namakelas = $kelas->nama;
        $kelas = $kelas->id;
        $punya = Transaksi::where('users_id', $id)
            ->where('kelas_id', $kelas)
            ->where('status', 'PAID')
            ->exists();
        $unpaid = Transaksi::where('users_id', $id)
            ->where('kelas_id', $kelas)
            ->where('status', 'UNPAID')
            ->exists();

        if ($punya) {
            return redirect()->back()->withErrors('Anda Sudah Membeli Kelas ' . $namakelas);
        } else {
            if ($unpaid) {
                return redirect()->back()->withErrors('Anda Sudah memiliki Pemesanan ' . $namakelas . ' Dengan status UNPAID');
            } else {
                $tripay = new TripayController();
                $respon = $tripay->ambilpayment();
                // Ubah response menjadi array
                $channels = $respon->getData(true);
                // dd($channels);
                $kelas = Kelas::where('kodekelas', $kodekelas)->firstOrFail();
                return view('kelas.checkout', compact('kelas', 'channels'));
            }
        }
    }
    public function destroy($kodekelas)
    {
        // Cari kelas berdasarkan kodekelas
        $kelas = Kelas::where('kodekelas', $kodekelas)->firstOrFail();

        // Path file gambar
        $filePath = public_path('storage/fotokelas/' . $kelas->foto);

        // Hapus file dari penyimpanan jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data kelas dari database
        $kelas->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
    public function update($id, Request $request)
    {
        // Cari kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama' => ['required', 'string', 'max:225', Rule::unique('kelas')->ignore($kelas->id)],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'kategori' => ['required', 'string', 'max:225'],
            'harga' => ['required', 'integer', 'min:1'],
            'fakeharga' => ['nullable', 'integer'],
        ]);

        // Cek apakah ada file foto baru yang diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // Path file lama
            $oldFilePath = public_path('storage/fotokelas/' . $kelas->foto);

            // Hapus file lama jika ada
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Buat nama file baru berdasarkan nama kelas dan ekstensi file asli
            $newFileName = Str::slug($request->nama, '_') . '.' . $file->getClientOriginalExtension();

            // Simpan file baru
            $file->move(public_path('storage/fotokelas'), $newFileName);

            // Update nama file di database
            $kelas->foto = $newFileName;
        }

        // Update data lainnya
        $kelas->nama = $request->nama;
        $kelas->kategori = $request->kategori;
        $kelas->deskripsi = $request->deskripsi;
        $kelas->harga = $request->harga;
        $kelas->fakeharga = $request->fakeharga;

        // Simpan perubahan ke database
        $kelas->save();

        // Redirect dengan pesan sukses
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui!');
    }
}
