<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .input-with-icon {
            padding-left: 2.5rem;
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl w-full">
            <div class="grid md:grid-cols-2 gap-8 items-center">

                <div class="hidden md:block text-white space-y-6">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="bg-white p-3 rounded-lg shadow-lg">
                            <img src="{{ asset('assets/img/sekolah.png') }}" alt="Logo" class="w-12 h-12">
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">SPK MOORA</h1>
                            <p class="text-sm text-purple-200">SMAN 11 Merangin</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold mb-4">Sistem Pendukung Keputusan</h2>
                        <p class="text-lg text-purple-100 mb-2">
                            Pemilihan Siswa Berprestasi Program Beasiswa
                        </p>
                        <p class="text-purple-200">
                            Menggunakan metode <span class="font-semibold text-white">MOORA</span>
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-4 pt-6">
                        <div class="text-center bg-white/10 backdrop-blur rounded-lg p-4">
                            <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            <p class="text-sm font-semibold">Kelola Data</p>
                        </div>
                        <div class="text-center bg-white/10 backdrop-blur rounded-lg p-4">
                            <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm font-semibold">Penilaian</p>
                        </div>
                        <div class="text-center bg-white/10 backdrop-blur rounded-lg p-4">
                            <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                            </svg>
                            <p class="text-sm font-semibold">Ranking</p>
                        </div>
                    </div>
                </div>

                <div class="auth-card p-8 md:p-10">

                    <div class="md:hidden text-center mb-6">
                        <img src="{{ asset('assets/img/sekolah.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-3">
                        <h2 class="text-xl font-bold text-gray-800">SPK MOORA</h2>
                        <p class="text-sm text-gray-600">SMAN 11 Merangin</p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang! 👋</h3>
                        <p class="text-gray-600">Silakan login untuk melanjutkan</p>
                    </div>

                    <x-validation-errors class="mb-4" />

                    @session('status')
                        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                            <p class="text-sm text-green-700">{{ $value }}</p>
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-label for="email" value="Email" class="font-semibold" />
                            <div class="relative mt-2">
                                <span class="input-icon">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </span>
                                <x-input id="email"
                                    class="input-with-icon block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" placeholder="nama@email.com" />
                            </div>
                        </div>

                        <div>
                            <x-label for="password" value="Password" class="font-semibold" />
                            <div class="relative mt-2">
                                <span class="input-icon">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <x-input id="password"
                                    class="input-with-icon block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="••••••••" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-purple-600 hover:text-purple-700"
                                    href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <x-button
                            class="w-full justify-center bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-lg shadow-lg transform transition hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            {{ __('Masuk') }}
                        </x-button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-xs text-gray-500">
                            © 2026 SMAN 11 Merangin. All rights reserved.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
