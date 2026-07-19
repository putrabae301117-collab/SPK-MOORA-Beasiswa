<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Penilaian - {{ $periode->nama_periode }}
            </h2>

            <button @click="open = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Penilaian
            </button>

            <div x-show="open" x-transition
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div @click.away="open = false"
                    class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 max-h-screen overflow-y-auto">
                    <h3 class="text-lg font-semibold mb-4">
                        Tambah Penilaian Beasiswa
                    </h3>

                    <form action="{{ route('periode.penilaian.store', $periode->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Alternatif <span class="text-red-500">*</span>
                            </label>
                            <select name="id_alternatif" id="selectAlternatif"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                required>
                                <option value="">-- Pilih Alternatif --</option>
                                @foreach ($alternatifs as $alt)
                                    <option value="{{ $alt->id }}">{{ $alt->nama_alternatif }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="kriteriaSection">
                            @foreach ($kriterias as $kriteria)
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ $kriteria->nama_kriteria }} <span class="text-red-500">*</span>
                                    </label>
                                    <select name="penilaian[{{ $kriteria->id }}]"
                                        class="kriteria-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                        <option value="">-- Pilih Nilai --</option>
                                        @foreach ($kriteria->subkriteria as $sub)
                                            <option value="{{ $sub->id }}">
                                                {{ $sub->nama_sub_kriteria }} (Bobot: {{ $sub->bobot_sub_kriteria }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end space-x-2 mt-6">
                            <button type="button" @click="open = false"
                                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Alternatif
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kriteria
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sub Kriteria
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nilai
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penilaians as $index => $penilaian)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $penilaian->alternatif->nama_alternatif }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $penilaian->kriteria->nama_kriteria }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $penilaian->subkriteria->nama_sub_kriteria }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $penilaian->nilai }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('periode.penilaian.edit', [$periode->id, $penilaian->id]) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded inline-flex items-center text-xs transition duration-150">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form
                                                    action="{{ route('periode.penilaian.destroy', [$periode->id, $penilaian->id]) }}"
                                                    method="POST" class="inline-block"
                                                    onsubmit="return confirm('Yakin ingin menghapus penilaian ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded inline-flex items-center text-xs transition duration-150">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="mt-2">Belum ada data penilaian</p>
                                            <p class="text-sm">Klik tombol "Tambah Penilaian" untuk menambah data</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $penilaians->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const selectAlternatif = document.getElementById('selectAlternatif');
                const kriteriaSection = document.getElementById('kriteriaSection');
                const kriteriaSelects = document.querySelectorAll('.kriteria-select');

                selectAlternatif.addEventListener('change', () => {
                    if (selectAlternatif.value) {
                        kriteriaSection.classList.remove('hidden');
                        kriteriaSelects.forEach(s => s.setAttribute('required', true));
                    } else {
                        kriteriaSection.classList.add('hidden');
                        kriteriaSelects.forEach(s => {
                            s.removeAttribute('required');
                            s.value = '';
                        });
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
