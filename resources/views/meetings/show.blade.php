<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Notulensi
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Lihat catatan rapat, hasil AI, action items, dan informasi meeting.
                </p>
            </div>

            <a href="{{ route('meetings.index') }}"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $meeting->title }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            {{ $meeting->meeting_date ?? 'Tanggal belum diisi' }} ·
                            {{ $meeting->location ?? 'Lokasi belum diisi' }}
                        </p>

                        <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            {{ $meeting->status }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <form action="{{ route('meetings.generate-ai', $meeting) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                                Generate AI
                            </button>
                        </form>

                        <a href="{{ route('meetings.edit', $meeting) }}"
                           class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200">
                            Edit
                        </a>

                        <form action="{{ route('meetings.destroy', $meeting) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus notulensi ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm hover:bg-red-200">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-sm text-gray-500">Peserta</p>
                    <p class="font-semibold text-gray-900 mt-1">
                        {{ $meeting->participants ?? 'Belum diisi' }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-sm text-gray-500">Meeting Health Score</p>
                    <p class="font-semibold text-gray-900 mt-1">
                        {{ $meeting->health_score ?? '-' }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-sm text-gray-500">Dibuat pada</p>
                    <p class="font-semibold text-gray-900 mt-1">
                        {{ $meeting->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">
                    Catatan Mentah Rapat
                </h4>

                <div class="bg-gray-50 rounded-lg p-4 text-gray-700 whitespace-pre-line">
                    {{ $meeting->raw_notes }}
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">
                    Hasil Notulensi AI
                </h4>

                @if ($meeting->ai_summary)
                    <div class="bg-indigo-50 rounded-lg p-4 text-gray-700 whitespace-pre-line">
                        {{ $meeting->ai_summary }}
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-500">
                        Hasil AI belum dibuat. Klik Generate AI untuk merapikan catatan rapat.
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">
                    Action Items
                </h4>

                @if ($meeting->actionItems->isEmpty())
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-500">
                        Action item belum dibuat. Klik Generate AI untuk membuat tindak lanjut rapat.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($meeting->actionItems as $item)
                            <div class="border rounded-lg p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $item->task }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        PIC: {{ $item->pic ?? '-' }} ·
                                        Deadline: {{ $item->deadline ?? '-' }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 w-fit">
                                    {{ $item->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">
                    Follow-up Message
                </h4>

                @if ($meeting->follow_up_message)
                    <div class="bg-green-50 rounded-lg p-4 text-gray-700 whitespace-pre-line">
                        {{ $meeting->follow_up_message }}
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-500">
                        Pesan follow-up belum dibuat.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>