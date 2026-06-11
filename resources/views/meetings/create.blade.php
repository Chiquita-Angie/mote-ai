<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Buat Notulensi Baru
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Masukkan catatan rapat mentah untuk disimpan di MOTE AI.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <form action="{{ route('meetings.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Rapat
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            value="{{ old('title') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: Rapat Persiapan FKBM-IK"
                        >

                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Rapat
                            </label>
                            <input 
                                type="date" 
                                name="meeting_date" 
                                value="{{ old('meeting_date') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('meeting_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi atau Media
                            </label>
                            <input 
                                type="text" 
                                name="location" 
                                value="{{ old('location') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: Google Meet / Ruang Rapat"
                            >

                            @error('location')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Peserta Rapat
                        </label>
                        <input 
                            type="text" 
                            name="participants" 
                            value="{{ old('participants') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: BEM, HDK, LOU-GREE"
                        >

                        @error('participants')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Catatan Mentah Rapat
                        </label>
                        <textarea 
                            name="raw_notes" 
                            rows="8"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Tulis catatan rapat mentah di sini..."
                        >{{ old('raw_notes') }}</textarea>

                        @error('raw_notes')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a 
                            href="{{ route('meetings.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200"
                        >
                            Kembali
                        </a>

                        <button 
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700"
                        >
                            Simpan Notulensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>