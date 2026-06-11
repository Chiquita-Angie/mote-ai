<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Notulensi
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Perbarui data rapat dan catatan mentah notulensi.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <form action="{{ route('meetings.update', $meeting) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Rapat
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $meeting->title) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
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
                                value="{{ old('meeting_date', $meeting->meeting_date) }}"
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
                                value="{{ old('location', $meeting->location) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
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
                            value="{{ old('participants', $meeting->participants) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('participants')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select
                            name="status"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="Draft" {{ old('status', $meeting->status) == 'Draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="Final" {{ old('status', $meeting->status) == 'Final' ? 'selected' : '' }}>
                                Final
                            </option>
                        </select>

                        @error('status')
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
                        >{{ old('raw_notes', $meeting->raw_notes) }}</textarea>

                        @error('raw_notes')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a
                            href="{{ route('meetings.show', $meeting) }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>