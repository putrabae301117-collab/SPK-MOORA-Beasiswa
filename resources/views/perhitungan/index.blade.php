<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Perhitungan MOORA - {{ $periode->nama_periode }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Multi-Objective Optimization on the basis of Ratio Analysis</p>
            </div>
            <a href="{{ route('periode.show', $periode->id) }}"
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
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Status Info -->
            @php
                $hasResult = \App\Models\ProsesPerhitungan::where('id_periode', $periode->id)->exists();
            @endphp

            @if ($hasResult)
                <div class="mb-4 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-blue-700">
                            <strong>Perhitungan sudah dilakukan.</strong>
                            Klik "Lihat Hasil" untuk melihat detail atau "Hitung Ulang" untuk memproses ulang.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Alternatif</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $alternatifs->count() }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Kriteria</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $kriterias->count() }}</p>
                        </div>
                        <div class="bg-green-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Penilaian</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $penilaians->count() }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-lg shadow-md p-6 border-l-4 {{ $hasResult ? 'border-green-500' : 'border-yellow-500' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Status</p>
                            <p class="text-lg font-bold text-gray-800 mt-1">
                                {{ $hasResult ? 'Selesai' : 'Belum Dihitung' }}
                            </p>
                        </div>
                        <div class="bg-{{ $hasResult ? 'green' : 'yellow' }}-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-{{ $hasResult ? 'green' : 'yellow' }}-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                @if ($hasResult)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @endif
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Matrix Keputusan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Matrix Keputusan</h3>
                        <span class="text-sm text-gray-500">Data penilaian untuk setiap alternatif</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                        Alternatif
                                    </th>
                                    @foreach ($kriterias as $k)
                                        <th
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                            {{ $k->nama_kriteria }}
                                            <div class="text-xs text-gray-400 normal-case mt-1">
                                                ({{ ucfirst($k->jenis) }})
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($alternatifs as $alt)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border">
                                            {{ $alt->nama_alternatif }}
                                        </td>
                                        @foreach ($kriterias as $k)
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 border">
                                                {{ $matrix[$alt->id][$k->id] ?? '-' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center gap-4">
                @if ($hasResult)
                    <a href="{{ route('periode.perhitungan.hasil', $periode->id) }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow inline-flex items-center transition duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        Lihat Hasil Perhitungan
                    </a>

                    <form action="{{ route('periode.perhitungan.hitung', $periode->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghitung ulang? Data hasil sebelumnya akan diganti.')">
                        @csrf
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow inline-flex items-center transition duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Hitung Ulang
                        </button>
                    </form>
                @else
                    <div></div>
                    <form action="{{ route('periode.perhitungan.hitung', $periode->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow inline-flex items-center transition duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Proses Perhitungan
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
