<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Periode Beasiswa - Edit Periode
            </h2>

            <a href="{{ route('periode.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6">Form Edit Periode</h3>

                    <form action="{{ route('periode.update', $periode->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Periode
                            </label>
                            <input type="text" name="nama_periode"
                                value="{{ old('nama_periode', $periode->nama_periode) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-200"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Tanggal
                            </label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $periode->tanggal) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea name="keterangan" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-200" required>{{ old('keterangan', $periode->keterangan) }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('periode.index') }}"
                                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Update Periode
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
