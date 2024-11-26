<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{route('kelas.show', $kelas->kodekelas)}}">
                    <button class="btn btn-primary">Kembali</button>
                </a>
                <div class="container p-6">
                    <div class="p-6 text-center">
                        <h2>Pilih Metode Pembayaran</h2>
                    </div>
                    <div class="col-md-5 mb-2 d-flex" style="width:100%">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/fotokelas/' . $kelas->foto) }}" class="card-img-top" alt="{{ $kelas->nama }}">
                            <div class="body">
                                <p>{{$kelas->nama}}</p>
                                <p>Harga : Rp {{$kelas->harga}}</p>
                            </div>
                        </div>
                        <div class="ml-5 overflow-hidden shadow-sm sm:rounded-lg d-flex">
                            <div class="row">
                                @foreach($channels['data'] as $channel)
                                <form action="{{route('transaksi.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
                                    <input type="hidden" name="merchant_code" value="{{$channel['code']}}">
                                    <button type="submit" class="col-md-3 mb-5" style="width:30%">
                                        <div class="card">
                                            <img src="{{$channel['icon_url']}}" class="card-img-top" alt="{{ $channel['name']}}">
                                        </div>
                                        <div class="card-body">
                                            <p class="card-title">{{ $channel['name']}}</p>
                                        </div>
                                    </button>
                                </form>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>