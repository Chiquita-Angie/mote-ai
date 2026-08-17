<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-tight">
                    Detail Notulensi
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Lihat catatan rapat, hasil perbaikan, catatan tindak lanjut, dan informasi rapat.
                </p>
            </div>

            <a href="{{ route('meetings.index') }}"
               class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 rounded-xl text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-xl font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <div class="flex flex-wrap items-center gap-3">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ $meeting->title }}
                            </h3>

                            @if ($meeting->status === 'Final')
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300 text-xs font-semibold">
                                    Final
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/60 dark:text-yellow-300 text-xs font-semibold">
                                    Draft
                                </span>
                            @endif
                        </div>

                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                            {{ $meeting->meeting_date ?? 'Tanggal belum diisi' }} ·
                            {{ $meeting->location ?? 'Lokasi belum diisi' }}
                        </p>

                        <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                            Status: {{ $meeting->status }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <form action="{{ route('meetings.generate-ai', $meeting) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 hover:-translate-y-0.5 transition duration-300">
                                @if ($meeting->status === 'Final')
                                    Perbaiki Ulang
                                @else
                                    Perbaiki Catatan
                                @endif
                            </button>
                        </form>

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
            </div>

            @if ($meeting->status === 'Final')
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/60 text-green-700 dark:text-green-300 flex items-center justify-center font-bold shrink-0">
                            ✓
                        </div>

                        <div>
                            <h4 class="font-semibold text-green-800 dark:text-green-300">
                                Notulensi ini sudah berstatus final.
                            </h4>
                            <p class="text-sm text-green-700 dark:text-green-400 mt-1">
                                Catatan rapat sudah diperbaiki dan dapat digunakan sebagai hasil notulensi akhir.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/60 text-yellow-700 dark:text-yellow-300 flex items-center justify-center font-bold shrink-0">
                            !
                        </div>

                        <div>
                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-300">
                                Notulensi ini masih berstatus draft.
                            </h4>
                            <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">
                                Klik tombol Perbaiki Catatan untuk merapikan typo, ejaan, dan struktur catatan rapat.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-5 border border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Notulis Rapat</p>
                    <p class="font-semibold text-slate-900 dark:text-white mt-1">
                        {{ $meeting->participants ?? 'Belum diisi' }}
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-5 border border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Agenda Rapat</p>
                    <p class="font-semibold text-slate-900 dark:text-white mt-1">
                        {{ $meeting->agenda ?? 'Belum diisi' }}
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-5 border border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Dibuat pada</p>
                    <p class="font-semibold text-slate-900 dark:text-white mt-1">
                        {{ $meeting->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700">
                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">
                    Catatan Mentah Rapat
                </h4>

                <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-slate-700 dark:text-slate-300 whitespace-pre-line border border-slate-100 dark:border-slate-700">
                    {{ $meeting->raw_notes }}
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <h4 class="text-lg font-semibold text-slate-900 dark:text-white">
                        Hasil Perbaikan Catatan
                    </h4>

                    @if ($meeting->ai_summary)
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300 text-xs font-semibold">
                            Tersedia
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300 text-xs font-semibold">
                            Belum Ada
                        </span>
                    @endif
                </div>

                @if ($meeting->ai_summary)
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 text-slate-700 dark:text-slate-300 whitespace-pre-line border border-blue-100 dark:border-blue-900/60">
                        {{ $meeting->ai_summary }}
                    </div>
                @else
                    <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-slate-500 dark:text-slate-400 border border-slate-100 dark:border-slate-700">
                        Hasil perbaikan belum dibuat. Klik Perbaiki Catatan untuk merapikan catatan rapat.
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <h4 class="text-lg font-semibold text-slate-900 dark:text-white">
                        Catatan Tindak Lanjut
                    </h4>

                    @if (!$meeting->actionItems->isEmpty())
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300 text-xs font-semibold">
                            {{ $meeting->actionItems->count() }} Catatan
                        </span>
                    @endif
                </div>

                <form action="{{ route('action-items.store', $meeting) }}" method="POST" class="mb-5">
                    @csrf

                    <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 border border-slate-100 dark:border-slate-700 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                                Tambah Catatan Tindak Lanjut
                            </label>

                            <textarea
                                name="task"
                                rows="3"
                                class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Tulis note, arahan, atau hal penting yang perlu dilakukan setelah rapat."
                                required
                            ></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                                    PIC
                                </label>

                                <input
                                    type="text"
                                    name="pic"
                                    class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Masukkan PIC jika ada"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">
                                    Deadline
                                </label>

                                <input
                                    type="date"
                                    name="deadline"
                                    class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition"
                            >
                                Tambah Catatan
                            </button>
                        </div>
                    </div>
                </form>

                @if ($meeting->actionItems->isEmpty())
                    <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-slate-500 dark:text-slate-400 border border-slate-100 dark:border-slate-700">
                        Catatan tindak lanjut belum ditambahkan.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($meeting->actionItems as $item)
                            <div class="border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3 bg-slate-50 dark:bg-slate-900">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">
                                        {{ $item->task }}
                                    </p>

                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                        PIC: {{ $item->pic ?? '-' }} ·
                                        Deadline: {{ $item->deadline ?? '-' }}
                                    </p>
                                </div>

                                <form action="{{ route('action-items.toggle-status', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        class="text-xs font-semibold rounded-full border-0 pl-4 pr-8 py-2 min-w-[105px]
                                        {{ $item->status === 'Done'
                                            ? 'bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300'
                                            : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/60 dark:text-yellow-300' }}
                                        focus:ring-2 focus:ring-blue-500 cursor-pointer"
                                    >
                                        <option value="Pending" {{ $item->status === 'Pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="Done" {{ $item->status === 'Done' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                    </select>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <h4 class="text-lg font-semibold text-slate-900 dark:text-white">
                        Follow-up Message
                    </h4>

                    <div class="flex items-center gap-2">
                        @if ($meeting->follow_up_message)
                            <button type="button"
                                    onclick="copyFollowUpMessage()"
                                    class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/60 dark:text-blue-300 text-xs font-semibold hover:bg-blue-200 dark:hover:bg-blue-900 transition">
                                Copy Message
                            </button>

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300 text-xs font-semibold">
                                Tersedia
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300 text-xs font-semibold">
                                Belum Ada
                            </span>
                        @endif
                    </div>
                </div>

                @if ($meeting->follow_up_message)
                    <div id="followUpMessage"
                         class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 text-slate-700 dark:text-slate-300 whitespace-pre-line border border-green-100 dark:border-green-900/60">{{ $meeting->follow_up_message }}</div>

                    <p id="copyStatus" class="hidden text-sm text-green-600 dark:text-green-400 mt-3 font-medium">
                        Follow-up message berhasil disalin.
                    </p>
                @else
                    <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-4 text-slate-500 dark:text-slate-400 border border-slate-100 dark:border-slate-700">
                        Pesan follow-up belum dibuat.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function copyFollowUpMessage() {
            const message = document.getElementById('followUpMessage')?.innerText;
            const status = document.getElementById('copyStatus');

            if (!message) {
                return;
            }

            navigator.clipboard.writeText(message).then(function () {
                if (status) {
                    status.classList.remove('hidden');

                    setTimeout(function () {
                        status.classList.add('hidden');
                    }, 2000);
                }
            });
        }
    </script>
</x-app-layout>