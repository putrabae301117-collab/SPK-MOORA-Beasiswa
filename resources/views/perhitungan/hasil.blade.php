<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Hasil Perhitungan MOORA
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Periode: {{ $periode->nama_periode }}
                </p>
            </div>
            <a href="{{ route('periode.perhitungan.index', $periode->id) }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Langkah 1: Matrix Keputusan -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 rounded-full p-2 mr-3">
                        <span class="text-blue-600 font-bold text-lg">1</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Matrix Keputusan</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase border">No
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase border">
                                    Alternatif</th>
                                @foreach ($kriterias as $k)
                                    <th
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase border">
                                        {{ $k->nama_kriteria }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($matrix as $altId => $nilaiKriteria)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 border font-medium">
                                        {{ $alternatifs->firstWhere('id', $altId)->nama_alternatif }}
                                    </td>
                                    @foreach ($kriterias as $k)
                                        <td class="px-4 py-3 text-center border">
                                            {{ $nilaiKriteria[$k->id] ?? '-' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Langkah 2: Normalisasi -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 rounded-full p-2 mr-3">
                        <span class="text-green-600 font-bold text-lg">2</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Normalisasi Matrix</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Rumus: r<sub>ij</sub> = x<sub>ij</sub> / √(Σx<sub>ij</sub>²)
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase border">No
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase border">
                                    Alternatif</th>
                                @foreach ($kriterias as $k)
                                    <th
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase border">
                                        {{ $k->nama_kriteria }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($normalisasi as $altId => $nilaiNorm)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 border font-medium">
                                        {{ $alternatifs->firstWhere('id', $altId)->nama_alternatif }}
                                    </td>
                                    @foreach ($kriterias as $k)
                                        <td class="px-4 py-3 text-center border font-mono">
                                            {{ number_format($nilaiNorm[$k->id] ?? 0, 4) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Langkah 3: Normalisasi Terbobot -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-purple-100 rounded-full p-2 mr-3">
                        <span class="text-purple-600 font-bold text-lg">3</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Normalisasi Terbobot</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Hasil normalisasi dikali bobot masing-masing kriteria
                        </p>
                    </div>
                </div>

                <!-- Info Bobot -->
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Bobot Kriteria:</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2">
                        @foreach ($kriterias as $k)
                            <div class="text-xs">
                                <span class="font-medium">{{ $k->nama_kriteria }}:</span>
                                <span class="text-blue-600 font-bold">
                                    {{ $k->bobot > 1 ? $k->bobot : $k->bobot * 100 }}%
                                </span>
                                <span class="text-gray-500">({{ ucfirst($k->jenis) }})</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase border">No
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase border">
                                    Alternatif</th>
                                @foreach ($kriterias as $k)
                                    <th
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase border">
                                        {{ $k->nama_kriteria }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($terbobot as $altId => $nilaiTerbobot)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 border font-medium">
                                        {{ $alternatifs->firstWhere('id', $altId)->nama_alternatif }}
                                    </td>
                                    @foreach ($kriterias as $k)
                                        <td class="px-4 py-3 text-center border font-mono">
                                            {{ number_format($nilaiTerbobot[$k->id] ?? 0, 4) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Langkah 4: Perhitungan Yi -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-yellow-100 rounded-full p-2 mr-3">
                        <span class="text-yellow-600 font-bold text-lg">4</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Perhitungan Nilai Yi</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Yi = Σ(Benefit) - Σ(Cost)
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border">No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border">
                                    Alternatif</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase border">
                                    Benefit (Max)</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase border">
                                    Cost (Min)</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase border">Yi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($optimasi as $altId => $nilai)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 border">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border font-medium">
                                        {{ $alternatifs->firstWhere('id', $altId)->nama_alternatif }}
                                    </td>
                                    <td class="px-6 py-4 text-center border font-mono text-green-600">
                                        {{ number_format($nilai['benefit'], 4) }}
                                    </td>
                                    <td class="px-6 py-4 text-center border font-mono text-red-600">
                                        {{ number_format($nilai['cost'], 4) }}
                                    </td>
                                    <td class="px-6 py-4 text-center border font-mono font-bold text-blue-600">
                                        {{ number_format($nilai['yi'], 4) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Langkah 5: Hasil Perangkingan -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 rounded-full p-2 mr-3">
                        <span class="text-red-600 font-bold text-lg">5</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Hasil Perangkingan Final</h3>
                </div>

                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase border w-20">
                                Ranking
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border">
                                Alternatif
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase border w-32">
                                Nilai Yi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($hasil as $h)
                            <tr class="{{ $h->peringkat == 1 ? 'bg-green-50' : 'hover:bg-gray-50' }}">
                                <td class="px-6 py-4 text-center border">
                                    <div
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full 
                                        {{ (($h->peringkat == 1
                                                    ? 'bg-yellow-400 text-white'
                                                    : $h->peringkat == 2)
                                                ? 'bg-gray-300 text-gray-700'
                                                : $h->peringkat == 3)
                                            ? 'bg-orange-300 text-gray-700'
                                            : 'bg-gray-100 text-gray-600' }} font-bold">
                                        {{ $h->peringkat }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 border">
                                    <div class="flex items-center">
                                        @if ($h->peringkat <= 3)
                                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                        <span class="font-semibold text-gray-900">
                                            {{ $h->alternatif->nama_alternatif }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center border font-mono text-lg font-bold text-blue-600">
                                    {{ number_format($h->nilai_yi, 4) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Keterangan -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Keterangan:</strong><br>
                            Nilai Yi diperoleh dari selisih total kriteria <strong>Benefit (Max)</strong> dan
                            <strong>Cost (Min)</strong>
                            menggunakan metode <strong>MOORA (Multi-Objective Optimization on the basis of Ratio
                                Analysis)</strong>.
                            Alternatif dengan nilai Yi <strong>tertinggi</strong> merupakan alternatif terbaik.
                        </p>
                    </div>
                </div>
            </div>

            @php
                $top3 = $hasil->sortBy('peringkat')->take(3);
            @endphp

            @if ($top3->count() > 0)
                <div class="bg-green-50 border-l-4 border-green-600 p-5 rounded-lg">
                    <h4 class="text-md font-semibold text-green-800 mb-2">
                        Keputusan Penerima Beasiswa
                    </h4>

                    <p class="text-sm text-green-700 mb-3">
                        Berdasarkan hasil perhitungan menggunakan metode
                        <strong>MOORA (Multi-Objective Optimization on the basis of Ratio Analysis)</strong>,
                        maka peserta didik berikut dinyatakan <strong>LAYAK</strong> menerima beasiswa:
                    </p>

                    <ol class="list-decimal list-inside text-sm text-gray-800 space-y-1">
                        @foreach ($top3 as $item)
                            <li>
                                <strong>{{ $item->alternatif->nama_alternatif }}</strong>
                                <span class="text-gray-600">
                                    (Peringkat {{ $item->peringkat }},
                                    Nilai Yi: {{ number_format($item->nilai_yi, 4) }})
                                </span>
                            </li>
                        @endforeach
                    </ol>

                    <p class="text-xs text-gray-600 mt-4 italic">
                        Catatan: Penetapan penerima beasiswa ini didasarkan pada nilai Yi tertinggi
                        sebagai hasil akhir proses perangkingan.
                    </p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('periode.perhitungan.index', $periode->id) }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg inline-flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <a target="_blank" href="{{ route('periode.perhitungan.laporan', $periode->id) }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg inline-flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Laporan
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
