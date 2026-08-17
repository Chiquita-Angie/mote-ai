<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-tight">
                    MOTE AI
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola daftar notulensi, status dokumen, dan catatan tindak lanjut rapat.
                </p>
            </div>

            <a href="{{ route('meetings.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 hover:-translate-y-0.5 transition duration-300">
                + Buat Notulensi
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-xl font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Total Notulensi</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">
                        {{ $meetings->count() }}
                    </h3>
                </div>

                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Draft</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">
                        {{ $meetings->where('status', 'Draft')->count() }}
                    </h3>
                </div>

                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Final</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">
                        {{ $meetings->where('status', 'Final')->count() }}
                    </h3>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                            Daftar Notulensi
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Lihat dan ubah status dokumen notulensi menjadi Draft atau Final.
                        </p>
                    </div>
                </div>

                @if ($meetings->isEmpty())
                    <div class="text-center py-14 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700">
                        <p class="text-slate-500 dark:text-slate-400 mb-4">
                            Belum ada notulensi yang dibuat.
                        </p>

                        <a href="{{ route('meetings.create') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                            Buat Notulensi Pertama
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($meetings as $meeting)
                            <div class="border border-slate-200 dark:border-slate-700 rounded-2xl p-5 bg-slate-50 dark:bg-slate-900 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:shadow-md hover:-translate-y-0.5 transition duration-300">
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h4 class="font-semibold text-slate-900 dark:text-white text-lg">
                                            {{ $meeting->title }}
                                        </h4>

                                        <form action="{{ route('meetings.update-status', $meeting) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                           <select
                                           name="status"
                                           onchange="this.form.submit()"
                                           class="text-xs font-semibold rounded-full border-0 pl-4 pr-8 py-2 min-w-[65px]
                                               {{ $meeting->status === 'Final'
                                                 ? 'bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300'
                                                   : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/60 dark:text-yellow-300' }}
                                                      focus:ring-2 focus:ring-blue-500 cursor-pointer"
>
                                          <option value="Draft" {{ $meeting->status === 'Draft' ? 'selected' : '' }}>
                                             Draft
                                           </option>
                                           <option value="Final" {{ $meeting->status === 'Final' ? 'selected' : '' }}>
                                                Final
                                          </option>
                                            </select>
                                        </form>
                                    </div>

                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                                        {{ $meeting->meeting_date ?? 'Tanggal belum diisi' }} ·
                                        {{ $meeting->location ?? 'Lokasi belum diisi' }}
                                    </p>

                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @if ($meeting->ai_summary)
                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/60 dark:text-blue-300">
                                                Hasil Perbaikan Tersedia
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                                Belum Ada Hasil
                                            </span>
                                        @endif

                                        @if ($meeting->actionItems->count() > 0)
                                            <span class="px-3 py-1 text-xs rounded-full bg-cyan-100 text-cyan-700 dark:bg-cyan-900/60 dark:text-cyan-300">
                                                {{ $meeting->actionItems->count() }} Catatan Tindak Lanjut
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                                Belum Ada Catatan Tindak Lanjut
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-2 md:justify-end">
                                    <a href="{{ route('meetings.show', $meeting) }}"
                                       class="px-4 py-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-xl text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                                        Detail
                                    </a>

                                    <a href="{{ route('meetings.edit', $meeting) }}"
                                       class="px-4 py-2 bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300 rounded-xl text-sm font-semibold hover:bg-blue-200 dark:hover:bg-blue-900 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('meetings.destroy', $meeting) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus notulensi ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-4 py-2 bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300 rounded-xl text-sm font-semibold hover:bg-red-200 dark:hover:bg-red-900 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>