<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{route('kelas.index')}}">
                    <button class="btn btn-primary">Kembali</button>
                </a>
                <div class="container p-6">
                    <div class="p-6 text-center">
                        <h2>{{ $kelas->nama }}</h2>
                    </div>
                    <div class="col-md-5 mb-2 d-flex w-full">
                        <div class="card" style="width: 40%;">
                            <img src="{{ asset('storage/fotokelas/' . $kelas->foto) }}" class="card-img-top" alt="{{ $kelas->nama }}">
                        </div>
                        <div class="m-3">
                            <p>Kategori : {{$kelas->kategori}}</p>
                            <p>Deskripsi : {{$kelas->deskripsi}}</p>
                            <p>Harga : Rp {{$kelas->harga}}</p>
                        </div>
                        <div class="m-5 d-flex justify-content-center align-items-center">
                            <a href="{{route('kelas.checkout', $kelas->kodekelas)}}" class="justify-center">
                                <button class="btn btn-warning">Beli Kelas</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>