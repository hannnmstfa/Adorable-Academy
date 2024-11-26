<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3">
                    <a href="{{route('usersmanage.create')}}">
                        <button class="btn btn-primary">Tambah User</button>
                    </a>
                </div>
                <div class="m-3 table-responsive rounded">
                    <table class="table table-striped table-bordered text-white" width="100%">
                        <thead class="bg bg-secondary">
                            <th>No</th>
                            <th>Nama</th>
                            <th>E-Mail</th>
                            <th>Telepon</th>
                            <th>Role</th>
                            <th colspan="3">Actions</th>
                        </thead>
                        @if($users->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Data Tidak Ditemukan</td>
                        </tr>
                        @endif
                        @foreach ($users as $index => $user)
                        <tr class="text-dark">
                            <td>{{$index + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->role}}</td>
                            <td class="text-center">
                                <form action="{{route('usersmanage.edit', $user->id)}}" method="get">
                                    @csrf
                                    <button class="btn btn-warning">Edit</button>
                                </form>

                            </td>
                            <td class="text-center">
                                <form action="{{route('usersmanage.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus User {{$user->name}} ?')">Delete</button>
                                </form>
                            </td>
                            <!-- <td>
                                <a href="">
                                    <button class="btn btn-info">Reset Password</button>
                                </a> -->
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>