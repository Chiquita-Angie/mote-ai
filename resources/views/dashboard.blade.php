<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 animate-fade-up">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-tight">
                    Dashboard MOTE AI
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola catatan rapat dan tindak lanjut dalam satu tempat.
                </p>
            </div>

            <a href="{{ route('meetings.create') }}"
               class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 hover:-translate-y-0.5 transition duration-300 shadow-sm">
                + Buat Notulensi
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-blue-900 via-blue-700 to-sky-500 shadow-sm animate-fade-up min-h-[520px]">
                <div class="absolute inset-0">
                    <div class="absolute -top-28 -right-24 w-96 h-96 bg-white/20 rounded-full blur-3xl animate-float"></div>
                    <div class="absolute -bottom-28 -left-20 w-96 h-96 bg-cyan-300/30 rounded-full blur-3xl animate-float delay-200"></div>

                    <div class="absolute top-16 right-24 w-28 h-28 border border-white/25 rounded-full animate-spin-slow"></div>
                    <div class="absolute top-28 right-32 w-4 h-4 bg-white/70 rounded-full animate-orbit"></div>

                    <div class="absolute bottom-24 right-80 w-36 h-36 border border-cyan-200/30 rounded-full animate-spin-slow"></div>
                    <div class="absolute bottom-32 right-96 w-5 h-5 bg-cyan-100/80 rounded-full animate-orbit-reverse"></div>

                    <div class="absolute top-1/2 left-1/2 w-3 h-3 bg-white/50 rounded-full animate-float"></div>
                    <div class="absolute top-24 left-16 w-2 h-2 bg-cyan-100 rounded-full animate-float delay-300"></div>
                    <div class="absolute bottom-20 left-1/3 w-3 h-3 bg-white/60 rounded-full animate-float delay-400"></div>
                </div>

                <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-10 p-8 md:p-12 lg:p-14 items-center min-h-[520px]">
                    <div class="text-white animate-fade-up delay-100">
                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/15 border border-white/20 text-sm font-medium mb-6 backdrop-blur">
                            Meeting Documentation System
                        </span>

                        <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                            Catatan rapat lebih rapi, keputusan lebih mudah ditindaklanjuti.
                        </h1>

                        <p class="mt-6 text-blue-100 text-base md:text-lg max-w-2xl leading-relaxed">
                            MOTE AI membantu menyimpan catatan rapat, menyusun notulensi, membuat action items, dan menyiapkan pesan follow-up untuk peserta rapat.
                        </p>

                        <div class="mt-9 flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('meetings.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3 bg-white text-blue-700 rounded-xl text-sm font-bold hover:bg-blue-50 hover:-translate-y-0.5 transition duration-300 shadow-sm">
                                Lihat Daftar Notulensi
                            </a>

                            <a href="{{ route('meetings.create') }}"
                               class="inline-flex items-center justify-center px-6 py-3 bg-blue-950/35 text-white rounded-xl text-sm font-bold hover:bg-blue-950/50 hover:-translate-y-0.5 transition duration-300 border border-white/15">
                                Buat Catatan Baru
                            </a>
                        </div>
                    </div>

                    <div class="hidden lg:flex justify-center">
                        <div class="relative w-full max-w-md animate-float">
                            <div class="absolute -top-8 -left-8 w-24 h-24 rounded-full bg-white/15 border border-white/20 animate-spin-slow"></div>
                            <div class="absolute -bottom-8 -right-8 w-32 h-32 rounded-full bg-cyan-300/20 border border-cyan-100/30 animate-spin-slow"></div>

                            <div class="relative bg-white/95 dark:bg-slate-900/95 rounded-[2rem] shadow-2xl p-7 border border-white/40 dark:border-slate-700 backdrop-blur">
                                <div class="flex items-center justify-between mb-7">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('images/mote-logo.png') }}"
                                             alt="MOTE AI Logo"
                                             class="w-14 h-14 rounded-2xl object-cover shadow-sm"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                        <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white font-bold items-center justify-center shadow-sm hidden">
                                            M
                                        </div>

                                        <div>
                                            <p class="font-bold text-slate-900 dark:text-white text-lg">Meeting Notes</p>
                                            <p class="text-sm text-slate-500 dark:text-slate-400">Organized documentation</p>
                                        </div>
                                    </div>

                                    <div class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 text-xs font-semibold">
                                        Ready
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div class="h-3 bg-blue-100 dark:bg-blue-900/70 rounded-full w-full"></div>
                                    <div class="h-3 bg-blue-100 dark:bg-blue-900/70 rounded-full w-10/12"></div>
                                    <div class="h-3 bg-blue-100 dark:bg-blue-900/70 rounded-full w-8/12"></div>
                                </div>

                                <div class="mt-7 grid grid-cols-2 gap-3">
                                    <div class="p-5 rounded-2xl bg-blue-50 dark:bg-slate-800 border border-blue-100 dark:border-slate-700 hover:-translate-y-1 transition duration-300">
                                        <p class="text-xs text-blue-600 dark:text-blue-300 font-medium">Summary</p>
                                        <p class="font-bold text-slate-900 dark:text-white mt-1">Created</p>
                                    </div>

                                    <div class="p-5 rounded-2xl bg-sky-50 dark:bg-slate-800 border border-sky-100 dark:border-slate-700 hover:-translate-y-1 transition duration-300">
                                        <p class="text-xs text-sky-600 dark:text-sky-300 font-medium">Tasks</p>
                                        <p class="font-bold text-slate-900 dark:text-white mt-1">Tracked</p>
                                    </div>
                                </div>

                                <div class="mt-6 p-5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700">
                                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                        Notulensi tersimpan rapi dan siap dibagikan kepada peserta rapat.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm p-6 border border-blue-100 dark:border-slate-800 animate-fade-up delay-100 hover:-translate-y-1 hover:shadow-md transition duration-300">
                    <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">Fitur Utama</p>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-2">Kelola Notulensi</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-4 leading-relaxed">
                        Tambah, lihat, edit, dan hapus catatan rapat dalam satu dashboard.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm p-6 border border-blue-100 dark:border-slate-800 animate-fade-up delay-200 hover:-translate-y-1 hover:shadow-md transition duration-300">
                    <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">Penyusunan</p>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-2">Rapikan Catatan</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-4 leading-relaxed">
                        Catatan mentah yang berantakan disusun menjadi format notulensi yang lebih mudah dibaca.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm p-6 border border-blue-100 dark:border-slate-800 animate-fade-up delay-300 hover:-translate-y-1 hover:shadow-md transition duration-300">
                    <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">Tindak Lanjut</p>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-2">Action Items</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-4 leading-relaxed">
                        Setiap hasil rapat dapat dilengkapi dengan PIC, deadline, dan status pengerjaan.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl shadow-sm p-6 border border-blue-100 dark:border-slate-800 animate-fade-up delay-200">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">
                        Cara Kerja
                    </h3>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 mb-6">
                        Alur sederhana dari catatan mentah sampai tindak lanjut.
                    </p>

                    <div class="space-y-5">
                        <div class="flex gap-4 hover:translate-x-1 transition duration-300">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 flex items-center justify-center font-bold shrink-0">
                                1
                            </div>

                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">
                                    Tulis catatan rapat
                                </h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                    Masukkan catatan rapat, peserta, lokasi, tanggal, dan poin pembahasan utama.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 hover:translate-x-1 transition duration-300">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 flex items-center justify-center font-bold shrink-0">
                                2
                            </div>

                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">
                                    Susun hasil notulensi
                                </h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                    Sistem membantu menyusun catatan menjadi ringkasan, pembahasan, keputusan, dan tindak lanjut.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 hover:translate-x-1 transition duration-300">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 flex items-center justify-center font-bold shrink-0">
                                3
                            </div>

                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">
                                    Bagikan dan tindak lanjuti
                                </h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                    Gunakan action items dan follow-up message agar hasil rapat lebih mudah dijalankan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm p-6 border border-blue-100 dark:border-slate-800 animate-fade-up delay-300 hover:-translate-y-1 hover:shadow-md transition duration-300">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">
                        Status Project
                    </h3>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 mb-6">
                        Fitur yang sudah tersedia.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-700 dark:text-slate-300">Authentication</span>
                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 text-xs font-medium">Done</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-700 dark:text-slate-300">CRUD Notulensi</span>
                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 text-xs font-medium">Done</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-700 dark:text-slate-300">Action Items</span>
                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 text-xs font-medium">Done</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-700 dark:text-slate-300">API Integration</span>
                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 text-xs font-medium">Ready</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-700 dark:text-slate-300">Responsive UI</span>
                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 text-xs font-medium">Done</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm p-6 md:p-8 border border-blue-100 dark:border-slate-800 animate-fade-up delay-400 hover:shadow-md transition duration-300">
                <div class="flex flex-col md:flex-row md:items-center gap-6">
                    <div class="shrink-0">
                        <img src="{{ asset('images/chiquita.jpg') }}"
                             alt="Chiquita Angie"
                             class="w-28 h-28 rounded-3xl object-cover border-4 border-blue-100 dark:border-slate-700 shadow-sm hover:scale-105 transition duration-300"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                        <div class="w-28 h-28 rounded-3xl bg-blue-100 dark:bg-blue-900/60 text-blue-700 dark:text-blue-200 font-bold text-3xl items-center justify-center hidden">
                            CA
                        </div>
                    </div>

                    <div class="flex-1">
                        <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">
                            Created by
                        </p>

                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">
                            Chiquita Angie
                        </h3>

                        <p class="text-slate-500 dark:text-slate-400 mt-2">
                            MOTE AI dikembangkan sebagai aplikasi pengelola notulensi rapat berbasis Laravel.
                        </p>

                        <a href="https://www.linkedin.com/in/chiquita-angie-rahmadani-ca-790215329/"
                           target="_blank"
                           class="inline-flex items-center mt-4 px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 hover:-translate-y-0.5 transition duration-300">
                            Lihat LinkedIn
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>