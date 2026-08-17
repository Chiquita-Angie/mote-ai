<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-tight">
                Buat Notulensi Baru
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Isi informasi dasar rapat dan catatan rapat yang ingin diperbaiki.
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700 transition-colors">
                <form action="{{ route('meetings.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                            Judul Rapat
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan judul rapat"
                        >

                        @error('title')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                                Tanggal Rapat
                            </label>

                            <input
                                type="date"
                                name="meeting_date"
                                value="{{ old('meeting_date') }}"
                                class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                            >

                            @error('meeting_date')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                                Lokasi atau Media
                            </label>

                            <input
                                type="text"
                                name="location"
                                value="{{ old('location') }}"
                                class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan lokasi atau media rapat"
                            >

                            @error('location')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                            Notulis Rapat
                        </label>

                        <input
                            type="text"
                            name="participants"
                            value="{{ old('participants') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan nama notulis rapat"
                        >

                        @error('participants')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                            Agenda Rapat
                        </label>

                        <input
                            type="text"
                            name="agenda"
                            value="{{ old('agenda') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan agenda utama rapat"
                        >

                        @error('agenda')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                            Catatan Rapat
                        </label>

                        <textarea
                            name="raw_notes"
                            rows="9"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Tulis catatan rapat mentah, hasil rapat, keputusan, atau catatan tambahan yang ingin diperbaiki"
                        >{{ old('raw_notes') }}</textarea>

                        @error('raw_notes')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a
                            href="{{ route('meetings.index') }}"
                            class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-600 transition"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition"
                        >
                            Simpan Notulensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>