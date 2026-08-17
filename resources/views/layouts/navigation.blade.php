<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 shadow-sm transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/mote-logo.png') }}"
                         alt="MOTE AI Logo"
                         class="w-10 h-10 rounded-2xl object-cover shadow-sm">

                    <div>
                        <p class="font-bold text-slate-900 dark:text-white leading-none">
                            MOTE AI
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            Meeting Notes
                        </p>
                    </div>
                </a>

                <div class="hidden space-x-2 sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold transition
                       {{ request()->routeIs('dashboard')
                            ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('meetings.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold transition
                       {{ request()->routeIs('meetings.*')
                            ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">
                        Notulensi
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center gap-3">
                <button onclick="toggleDarkMode()"
                        type="button"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700 transition">
                    <span class="inline dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                    <span class="inline dark:hidden">Dark</span>
                    <span class="hidden dark:inline">Light</span>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 dark:text-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 focus:outline-none transition">
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden gap-2">
                <button onclick="toggleDarkMode()"
                        type="button"
                        class="inline-flex items-center gap-1 px-3 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700 transition">
                    <span class="inline dark:hidden">🌙 Dark</span>
                    <span class="hidden dark:inline">☀️ Light</span>
                </button>

                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': ! open }"
         class="hidden sm:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-t border-slate-200 dark:border-slate-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('dashboard')
                    ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200'
                    : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                Dashboard
            </a>

            <a href="{{ route('meetings.index') }}"
               class="block px-4 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('meetings.*')
                    ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200'
                    : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                Notulensi
            </a>
        </div>

        <div class="pt-4 pb-4 border-t border-slate-200 dark:border-slate-800">
            <div class="px-8">
                <div class="font-semibold text-base text-slate-800 dark:text-white">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-slate-500 dark:text-slate-400">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>