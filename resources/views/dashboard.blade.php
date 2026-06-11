<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard MOTE AI
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    Selamat datang di MOTE AI
                </h1>

                <p class="text-gray-600 mb-6">
                    MOTE AI membantu kamu menyimpan catatan rapat, merapikan notulensi, dan membuat tindak lanjut rapat dengan bantuan AI.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="p-5 rounded-xl bg-indigo-50">
                        <p class="text-sm text-indigo-600">Fitur Utama</p>
                        <h3 class="font-semibold text-gray-900 mt-1">CRUD Notulensi</h3>
                    </div>

                    <div class="p-5 rounded-xl bg-green-50">
                        <p class="text-sm text-green-600">AI Feature</p>
                        <h3 class="font-semibold text-gray-900 mt-1">Rapikan Catatan Rapat</h3>
                    </div>

                    <div class="p-5 rounded-xl bg-yellow-50">
                        <p class="text-sm text-yellow-600">Output</p>
                        <h3 class="font-semibold text-gray-900 mt-1">Follow-up Message</h3>
                    </div>
                </div>

                <a href="{{ route('meetings.index') }}"
                   class="inline-block px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Masuk ke MOTE AI
                </a>
            </div>
        </div>
    </div>
</x-app-layout>