<x-guest-layout>
    {{-- 
        Alpine.js x-data: 
        Mengambil 'role' dari input sebelumnya (old) agar tab tidak pindah saat error.
    --}}
    <div x-data="{ role: '{{ old('role', 'siswa') }}' }">

        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Login <span x-text="role.charAt(0).toUpperCase() + role.slice(1)"></span>
            </h2>
            <p class="text-sm text-gray-600">
                Masuk untuk 
                <span x-text="role === 'siswa' ? 'melaporkan pengaduan' : 'mengelola laporan'"></span>.
            </p>
        </div>

        <div class="flex justify-center mb-6 bg-gray-100 p-1 rounded-lg">
            <button
                type="button"
                @click="role = 'siswa'"
                :class="{ 'bg-white shadow-sm text-red-600': role === 'siswa' }"
                class="flex-1 py-2 px-2 rounded-md text-xs font-medium transition">
                Siswa
            </button>

            <button
                type="button"
                @click="role = 'admin'"
                :class="{ 'bg-white shadow-sm text-red-600': role === 'admin' }"
                class="flex-1 py-2 px-2 rounded-md text-xs font-medium transition">
                Admin
            </button>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="hidden" name="role" x-bind:value="role">

            <div>
                <x-input-label for="login">
                    <span x-text="role === 'siswa' ? 'NISN' : 'Username'"></span>
                </x-input-label>

                <x-text-input
                    id="login"
                    name="login"
                    type="text"
                    class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                    x-bind:placeholder="role === 'siswa' ? 'Masukkan NISN' : 'Masukkan Username'"
                    :value="old('login')"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('login')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Password" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                    required
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" 
                           class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" 
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500 w-full justify-center">
                    Masuk sebagai <span class="ml-1" x-text="role"></span>
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>