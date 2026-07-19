<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Periode: {{ $periode->nama_periode }}
            </h2>
            <a href="{{ route('periode.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Sukses -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Info Periode Terpilih -->
            <div class="mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Periode Aktif Terpilih</h3>
                        <p class="text-blue-100">Menu SPK sekarang dapat diakses melalui navigasi atas</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-20 h-20 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Info Periode -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center border-b pb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Periode
                    </h3>

                    <div class="space-y-4">
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Nama Periode</div>
                            <div class="w-2/3 text-sm text-gray-900 font-semibold">{{ $periode->nama_periode }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Tanggal</div>
                            <div class="w-2/3 text-sm text-gray-900">{{ $periode->tanggal }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Tanggal Mulai</div>
                            <div class="w-2/3 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d F Y') }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Tanggal Selesai</div>
                            <div class="w-2/3 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d F Y') }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Durasi</div>
                            <div class="w-2/3 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($periode->tanggal_selesai)) }}
                                hari
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Keterangan</div>
                            <div class="w-2/3 text-sm text-gray-900 font-semibold ">
                                {{ $periode->keterangan }} </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-sm font-medium text-gray-500">Status</div>
                            <div class="w-2/3">
                                @if ($periode->status == 'aktif')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Non-Aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <div class="flex space-x-3">
                            <a href="{{ route('periode.edit', $periode->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Periode
                            </a>
                            {{-- <form action="{{ route('periode.clear') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Tutup Periode
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>

                <!-- Menu SPK Quick Access -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center border-b pb-3">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Menu SPK
                    </h3>

                    <div class="space-y-2">
                        <a href="{{ route('periode.alternatif.index', $periode->id) }}"
                            class="block p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-150 group">
                            <div class="flex items-center">
                                <div
                                    class="bg-blue-500 rounded-lg p-2 mr-3 group-hover:scale-110 transition duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Alternatif (Siswa)</p>
                                    <p class="text-xs text-gray-600">Data calon penerima</p>
                                </div>
                            </div>
                        </a>

                        {{-- <a href="{{ route('penilaian.index', $periode->id) }}"
                            class="block p-3 bg-green-50 hover:bg-green-100 rounded-lg transition duration-150 group">
                            <div class="flex items-center">
                                <div
                                    class="bg-green-500 rounded-lg p-2 mr-3 group-hover:scale-110 transition duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Penilaian</p>
                                    <p class="text-xs text-gray-600">Input nilai kriteria</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('perhitungan.index', $periode->id) }}"
                            class="block p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-150 group">
                            <div class="flex items-center">
                                <div
                                    class="bg-yellow-500 rounded-lg p-2 mr-3 group-hover:scale-110 transition duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Perhitungan</p>
                                    <p class="text-xs text-gray-600">Proses MOORA</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('hasil.index', $periode->id) }}"
                            class="block p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-150 group">
                            <div class="flex items-center">
                                <div
                                    class="bg-purple-500 rounded-lg p-2 mr-3 group-hover:scale-110 transition duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Hasil</p>
                                    <p class="text-xs text-gray-600">Ranking penerima</p>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>

            <!-- Statistik Periode -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Alternatif</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">0</p>
                        </div>
                        <div class="bg-blue-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Sudah Dinilai</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">0</p>
                        </div>
                        <div class="bg-green-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Belum Dinilai</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">0</p>
                        </div>
                        <div class="bg-yellow-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Kuota Tersedia</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $periode->kuota_beasiswa }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
