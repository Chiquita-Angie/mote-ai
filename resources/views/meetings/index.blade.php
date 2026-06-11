<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    MOTE AI
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Minutes Organizer and Task Extractor AI
                </p>
            </div>

            <a href="{{ route('meetings.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                + Buat Notulensi
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-5 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Total Notulensi</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $meetings->count() }}</h3>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Status Draft</p>
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ $meetings->where('status', 'Draft')->count() }}
                    </h3>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">AI Ready</p>
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ $meetings->whereNotNull('ai_summary')->count() }}
                    </h3>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Notulensi</h3>
                        <p class="text-sm text-gray-500">Kelola catatan rapat dan hasil notulensi AI.</p>
                    </div>
                </div>

                @if ($meetings->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 mb-4">Belum ada notulensi.</p>
                        <a href="{{ route('meetings.create') }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                            Buat Notulensi Pertama
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($meetings as $meeting)
                            <div class="border rounded-xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $meeting->title }}</h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $meeting->meeting_date ?? 'Tanggal belum diisi' }} ·
                                        {{ $meeting->location ?? 'Lokasi belum diisi' }}
                                    </p>
                                    <span class="inline-block mt-2 px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        {{ $meeting->status }}
                                    </span>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('meetings.show', $meeting) }}"
                                       class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                                        Detail
                                    </a>

                                    <a href="{{ route('meetings.edit', $meeting) }}"
                                       class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200">
                                        Edit
                                    </a>

                                    <form action="{{ route('meetings.destroy', $meeting) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus notulensi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-2 bg-red-100 text-red-700 rounded-lg text-sm hover:bg-red-200">
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