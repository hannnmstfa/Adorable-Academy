<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container p-6">
                    <div class="p-6 text-center">
                        <h2>{{ $data->kelas->nama }}</h2>
                    </div>
                    <div class="col-md-5 mb-2 d-flex w-full">
                        <div class="card" style="width: 40%;">
                            <img src="{{ asset('storage/fotokelas/' . $data->kelas->foto) }}" class="card-img-top" alt="{{ $data->kelas->nama }}">
                        </div>
                        <div class="m-3">
                            <p>No Invoice : {{$data->merchant_ref}}</p>
                            <p>Metode Pembayaran : {{$data->method}}</p>
                            <p>Harga : Rp {{number_format($data->harga)}}</p>
                            <p>Fee : Rp {{number_format($data->fee)}}</p>
                            <p>Total : Rp {{number_format($data->harga + $data->fee)}}</p>
                            <p>Status : {{$data->status}}</p>
                        </div>
                        <div class="m-5 d-flex justify-content-center align-items-center">
                            <a href="{{$data->urlpayment}}" class="justify-center">
                                <button class="btn btn-warning">Bayar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>