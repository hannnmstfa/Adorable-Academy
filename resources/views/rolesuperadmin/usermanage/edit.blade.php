<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Container for both cards -->
        <div class="flex justify-center space-x-2 items-start">
            <!-- First Card -->
            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto">
                <div class="mb-4 text-left">
                    <a href="{{ route('usersmanage.index') }}">
                        <button class="btn btn-primary">Kembali</button>
                    </a>
                </div>

                <!-- Form for editing user details -->
                <form action="{{ route('usersmanage.update', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input type="text" class="block mt-1 w-full" id="nama" name="nama" value="{{ $users->name }}" required autofocus autocomplete="name" placeholder="Masukkan Nama" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $users->email }}" required autocomplete="username" placeholder="name@example.com" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="phone" :value="__('Nomor Telepon')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $users->phone }}" required autocomplete="tel" placeholder="08xxxxxxxxxx" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="role" :value="__('Role')" />
                        <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="superadmin" {{ $users->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="member" {{ $users->role == 'member' ? 'selected' : '' }}>Member</option>
                        </select>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <!-- Second Card -->
            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto">
                <h2 class="text-center font-bold mb-3">Reset Password</h2>

                <!-- Second form or additional content -->
                <form action="{{ route('usersmanage.resetpass', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <x-input-label class="text-center" :value="__('Gunakan ini untuk mereset ulang password ke default.')" />
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin mengatur ulang password?')">Reset Password to Default</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
