<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-3 table-responsive rounded">
                    <table class="table table-striped table-bordered text-white" width="100%">
                        <thead class="bg bg-secondary">
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Harga</th>
                            <th>Telepon</th>
                            <th>Status</th>
                        </thead>
                        @if($data->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
                        </tr>
                        @endif
                        @foreach ($data as $index => $data)
                        <tr class="text-dark">
                            <td>{{$index + 1}}</td>
                            <td>{{$data->merchant_ref}}</td>
                            <td>{{$data->users->name}}</td>
                            <td>{{$data->kelas->nama}}</td>
                            <td>Rp {{number_format($data->harga)}}</td>
                            <td>{{$data->users->phone}}</td>
                            <td>{{$data->status}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>