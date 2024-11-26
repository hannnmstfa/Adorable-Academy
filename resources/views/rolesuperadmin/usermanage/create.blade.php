<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto">
            <div class="mb-4 text-left">
                <a href="{{ route('usersmanage.index') }}">
                    <button class="btn btn-primary">Kembali</button>
                </a>
            </div>
            <form action="{{route('usersmanage.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input type="text" class="block mt-1 w-full" id="nama" name="nama" :value="old('nama')" required autofocus autocomplete="name" placeholder="Masukkan Nama" />
                </div>
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
                </div>
                <div class="mb-3">
                    <x-input-label for="phone" :value="__('Nomor Telepon')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="08xxxxxxxxxx" />
                </div>
                <div class="mb-3">
                    <x-input-label for="role" :value="__('Role')" />
                    <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="" selected>Silahkan Pilih Role</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                </div>
                <div class="mb-3">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" name="password" value="password123" id="check">
                        <label for="check" class="form-check-label">Gunakan Password Default (password123)</label>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
<script>
    document.getElementById('check').addEventListener('change', function() {
        var passwordField = document.getElementById('password');
        if (this.checked) {
            passwordField.disabled = true;
            passwordField.value = 'password123'; // Mengisi dengan password default
        } else {
            passwordField.disabled = false;
            passwordField.value = ''; // Kosongkan kembali password jika checkbox tidak dicentang
        }
    });
</script>