<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-xl p-8 mb-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Selamat Datang di Sistem SPK Beasiswa</h1>
                        <p class="text-blue-100 text-lg">Multi-Objective Optimization on the basis of Ratio Analysis
                            (MOORA)</p>
                        <p class="text-blue-200 mt-2">Program Beasiswa untuk Siswa SMA Berprestasi</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-32 h-32 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Total Siswa</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $jumlahAlternatif ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Total Kriteria</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalKriteria ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Total Sub Kriteria</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalSubKriteria ?? 0 }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Actions & Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Quick Actions -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Menu Akses Cepat
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#"
                            class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg hover:shadow-md transition duration-200 group">
                            <div class="bg-blue-500 rounded-lg p-3 mr-4 group-hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Data Siswa</p>
                                <p class="text-xs text-gray-600">Kelola data calon penerima</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg hover:shadow-md transition duration-200 group">
                            <div class="bg-green-500 rounded-lg p-3 mr-4 group-hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Kriteria</p>
                                <p class="text-xs text-gray-600">Setting kriteria penilaian</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg hover:shadow-md transition duration-200 group">
                            <div
                                class="bg-yellow-500 rounded-lg p-3 mr-4 group-hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Penilaian</p>
                                <p class="text-xs text-gray-600">Input nilai siswa</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg hover:shadow-md transition duration-200 group">
                            <div
                                class="bg-purple-500 rounded-lg p-3 mr-4 group-hover:scale-110 transition duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Hitung MOORA</p>
                                <p class="text-xs text-gray-600">Proses perhitungan SPK</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Info Metode MOORA -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Tentang Metode MOORA
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <p>MOORA adalah metode pengambilan keputusan multi-kriteria yang mengoptimalkan beberapa tujuan
                            secara bersamaan.</p>
                        <div class="bg-indigo-50 p-3 rounded-lg">
                            <p class="font-semibold text-indigo-800 mb-2">Langkah Perhitungan:</p>
                            <ol class="list-decimal list-inside space-y-1 text-indigo-700">
                                <li>Normalisasi matriks</li>
                                <li>Optimasi atribut</li>
                                <li>Perangkingan alternatif</li>
                            </ol>
                        </div>
                        <p class="text-xs italic">Metode ini objektif dan sederhana dalam implementasi untuk seleksi
                            beasiswa.</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity / Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Sistem
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="text-sm font-semibold text-gray-700">Periode Pendaftaran</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $periodeAktif ?? 'Belum ditentukan' }}</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="text-sm font-semibold text-gray-700">Status Sistem</p>
                        <p class="text-xs text-gray-500 mt-1"><span
                                class="inline-block w-2 h-2 bg-green-500 rounded-full mr-1"></span>Aktif & Berjalan</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-4">
                        <p class="text-sm font-semibold text-gray-700">Versi Aplikasi</p>
                        <p class="text-xs text-gray-500 mt-1">SPK MOORA v1.0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
