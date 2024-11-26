<x-app-layout>
    @guest
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container p-6">
                    <div class="p-6 text-center">
                        <h2>Daftar Kelas Ditawarkan</h2>
                    </div>
                    <div class="row">
                        @if($kelas->isEmpty())
                        <div class="p-6 text-center text-gray-900">
                            {{ __("Kelas masih kosong") }}
                        </div>
                        @else
                        @foreach($kelas as $kelasItem)
                        <div class="col-md-3 mb-4">
                            <div class="card" style="width: 100%;">
                                <img src="{{ asset('storage/fotokelas/' . $kelasItem->foto) }}" class="card-img-top" alt="{{ $kelasItem->nama }}">
                                <div class="card-body">
                                    <p class="card-text underline">{{ $kelasItem->kategori }}</p>
                                    <h5 class="card-title">{{ $kelasItem->nama }}</h5>
                                    <p class="card-text">{{ $kelasItem->deskripsi }}</p>
                                    @if(isset($kelasItem->fakeharga))
                                    <p><s>Rp {{ $kelasItem->fakeharga }}</s></p>
                                    @endif
                                    <p class="card-text">Rp {{ $kelasItem->harga }}</p>
                                    <a href="{{route('kelas.show', $kelasItem->kodekelas)}}" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endguest

    @auth
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(Auth::User()->role == 'member')
                <div class="container p-6">
                    <div class="p-6 text-center text-gray-900">
                        {{ __("Daftar Kelas Anda") }}
                    </div>
                    <div class="row">
                        @if($kelas->isEmpty())
                        <div class="p-6 text-center text-gray-900">
                            {{ __("Kelas masih kosong") }}
                        </div>
                        @else
                        @foreach($dibeli as $dibeli)
                        <div class="col-md-3 mb-4">
                            <div class="card" style="width: 100%;">
                                <img src="{{ asset('storage/fotokelas/' . $dibeli->kelas->foto) }}" class="card-img-top" alt="{{ $dibeli->nama }}">
                                <div class="card-body">
                                    <p class="card-text underline">{{ $dibeli->kelas->kategori }}</p>
                                    <h5 class="card-title">{{ $dibeli->kelas->nama }}</h5>
                                    <p class="card-text">{{ $dibeli->kelas->deskripsi }}</p>
                                    @if(isset($dibeli->kelas->fakeharga))
                                    <p><s>Rp {{ $dibeli->kelas->fakeharga }}</s></p>
                                    @endif
                                    <p class="card-text">Rp {{ $dibeli->kelas->harga }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif

                <div class="container p-6">
                    <div class="p-6 text-center">
                        <h2>Daftar Kelas Ditawarkan</h2>
                    </div>
                    <div class="row">
                        @if($kelas->isEmpty())
                        <div class="p-6 text-center text-gray-900">
                            {{ __("Kelas masih kosong") }}
                        </div>
                        @else
                        @foreach($kelas as $kelasItem)
                        <div class="col-md-3 mb-4">
                            <div class="card" style="width: 100%;">
                                <img src="{{ asset('storage/fotokelas/' . $kelasItem->foto) }}" class="card-img-top" alt="{{ $kelasItem->nama }}">
                                <div class="card-body">
                                    <p class="card-text underline">{{ $kelasItem->kategori }}</p>
                                    <h5 class="card-title">{{ $kelasItem->nama }}</h5>
                                    <p class="card-text">{{ $kelasItem->deskripsi }}</p>
                                    @if(isset($kelasItem->fakeharga))
                                    <p><s>Rp {{ $kelasItem->fakeharga }}</s></p>
                                    @endif
                                    <p class="card-text">Rp {{ $kelasItem->harga }}</p>
                                    @if (Auth::User()->role == 'admin' || Auth::user()->role == 'superadmin')
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#edit"
                                            nama="{{$kelasItem->nama}}"
                                            kategori="{{ $kelasItem->kategori }}"
                                            deskripsi="{{ $kelasItem->deskripsi }}"
                                            fakeharga="{{ $kelasItem->fakeharga }}"
                                            data-foto="{{ asset('storage/fotokelas/' . $kelasItem->foto) }}"
                                            data-route="{{route('kelas.update', $kelasItem->id)}}"
                                            harga="{{$kelasItem->harga}}"><i class="fa-solid fa-pen-to-square"></i></button>

                                        <form action="{{route('kelas.destroy', $kelasItem->kodekelas)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Kelas {{$kelasItem->nama}} ?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    @else
                                    <form action="{{route('kelas.show', $kelasItem->kodekelas)}}" method="get">
                                        @csrf
                                        <button class="btn btn-primary">Detail Kelas</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        <!-- Card untuk admin/superadmin menambahkan kelas -->
                        @if(Auth::User()->role == 'admin' || Auth::user()->role == 'superadmin')
                        <div class="col-md-3 mb-4 d-flex align-items-center justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                                <div class="card justify-center p-3" style="height:20vh;">
                                    <div class="text-center">
                                        <button class="btn btn-secondary">+</button>
                                        <label class="form-label">Tambahkan Kelas</label>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal --->
    @include('kelas.modal.tambah')
    @include('kelas.modal.edit')
    @endauth
</x-app-layout>