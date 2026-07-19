<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Penilaian - {{ $penilaian->alternatif->nama_alternatif }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('periode.penilaian.update', [$periode->id, $penilaian->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Periode
                            </label>
                            <input type="text" value="{{ $periode->nama_periode }}"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alternatif
                            </label>
                            <input type="text" value="{{ $penilaian->alternatif->nama_alternatif }}"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kriteria
                            </label>
                            <input type="text" value="{{ $penilaian->kriteria->nama_kriteria }}"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Sub Kriteria <span class="text-red-500">*</span>
                            </label>
                            <select name="id_subkriteria"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                required>
                                <option value="">Pilih Sub Kriteria</option>
                                @foreach ($penilaian->kriteria->subkriteria as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ $penilaian->id_subkriteria == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->nama_sub_kriteria }} (Bobot: {{ $sub->bobot_sub_kriteria }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-2 mt-6">
                            <a href="{{ route('periode.penilaian.index', $periode->id) }}"
                                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
