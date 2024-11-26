<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-3 table-responsive rounded">
                    <table class="table table-striped table-bordered text-white" width="100%">
                        <thead class="bg bg-secondary">
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th colspan="2">Aksi</th>
                        </thead>
                        @if ($keranjang->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Belum ada Pesanan</td>
                        </tr>
                        @endif
                        @foreach ($keranjang as $index => $keranjang)
                        <tr class="text-dark">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $keranjang->kelas->nama }}
                                <div class="text-sm">{{ $keranjang->kelas->kategori }}</div>
                            </td>
                            <td>Rp {{ number_format($keranjang->harga) }}</td>
                            <td>{{ $keranjang->status }}</td>
                            <td>
                                <a class="btn btn-success" href="{{$keranjang->urlpayment}}">Detail</a>
                            </td>
                            <td>
                                <form action="{{route('transaksi.destroy', $keranjang->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Kelas {{$keranjang->kelas->nama}} ?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>