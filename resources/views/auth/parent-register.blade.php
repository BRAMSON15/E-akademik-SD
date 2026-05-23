<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Daftar sebagai Orang Tua') }}
    </div>

    <form method="POST" action="{{ route('parent.register.store') }}">
        @csrf

        <!-- Student Name -->
        <div>
            <x-input-label for="student_name" :value="__('Nama Lengkap Siswa')" />
            <x-text-input id="student_name" class="block mt-1 w-full" type="text" name="student_name" :value="old('student_name')" required autofocus />
            <x-input-error :messages="$errors->get('student_name')" class="mt-2" />
        </div>

        <!-- NIS -->
        <div class="mt-4">
            <x-input-label for="nis" :value="__('NIS (Nomor Induk Siswa)')" />
            <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis" :value="old('nis')" required />
            <x-input-error :messages="$errors->get('nis')" class="mt-2" />
        </div>

        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Informasi:</strong> Akun Anda akan dibuat otomatis dengan username dan password default. Anda dapat mengubahnya di pengaturan profil setelah login.
            </p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
