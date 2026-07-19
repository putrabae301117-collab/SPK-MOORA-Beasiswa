<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/sekolah.png') }}" class="block h-12 w-auto">
                    </a>
                </div>

                <!-- Navigation Links
            Role = Admin untuk semua menu
            Guru = Periode,Kriteria,Sub Kriteria, Alternatif dan Penilaians
                -->

                <!-- admin saja -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-12 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user')">
                            {{ __('Mengelola User') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('periode.index') }}" :active="request()->routeIs('periode.*')">
                            {{ __('Periode') }}
                        </x-nav-link>
                    @endif

                    <!-- admin dan guru -->
                    @if (auth()->user()->isAdmin() || auth()->user()->isGuru())
                        <x-nav-link href="{{ route('kriteria.index') }}" :active="request()->routeIs('kriteria.*')">
                            {{ __('Kriteria') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('subkriteria.index') }}" :active="request()->routeIs('subkriteria.*')">
                            {{ __('Subkriteria') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('periode.index') }}" :active="request()->routeIs('periode.*')">
                            {{ __('Periode') }}
                        </x-nav-link>
                    @endif

                    <!-- Menu Periode -->

                    @if (session('selected_periode_id'))
                        <!-- Admin & Guru -->
                        @if (auth()->user()->isAdmin() || auth()->user()->isGuru())
                            <x-nav-link href="{{ route('periode.alternatif.index', session('selected_periode_id')) }}"
                                :active="request()->routeIs('alternatif.*')">
                                {{ __('Alternatif') }}
                            </x-nav-link>

                            <x-nav-link href="{{ route('periode.penilaian.index', session('selected_periode_id')) }}"
                                :active="request()->routeIs('penilaian.*')">
                                {{ __('Penilaian') }}
                            </x-nav-link>
                        @endif

                        <!-- Admin -->
                        @if (auth()->user()->isAdmin())
                            <x-nav-link href="{{ route('periode.perhitungan.index', session('selected_periode_id')) }}"
                                :active="request()->routeIs('perhitungan.*')">
                                {{ __('Perhitungan') }}
                            </x-nav-link>

                            <x-nav-link href="{{ route('periode.perhitungan.hasil', session('selected_periode_id')) }}"
                                :active="request()->routeIs('hasil.*')">
                                {{ __('Hasil Perhitungan') }}
                            </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Tampilkan info periode yang sedang aktif -->
                @if (session('selected_periode_id'))
                    <div class="me-4 px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full flex items-center">
                        <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">{{ session('selected_periode_nama', 'Periode Aktif') }}</span>
                    </div>
                @endif

                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('periode.index') }}" :active="request()->routeIs('periode.*')">
                {{ __('Periode') }}
            </x-responsive-nav-link>

            @if (session('selected_periode_id'))
                <x-responsive-nav-link href="{{ route('periode.alternatif.index', session('selected_periode_id')) }}"
                    :active="request()->routeIs('alternatif.*')">
                    {{ __('Alternatif') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('periode.penilaian.index', session('selected_periode_id')) }}"
                    :active="request()->routeIs('penilaian.*')">
                    {{ __('Penilaian') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('periode.perhitungan.index', session('selected_periode_id')) }}"
                    :active="request()->routeIs('perhitungan.*')">
                    {{ __('Perhitungan') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('periode.perhitungan.hasil', session('selected_periode_id')) }}"
                    :active="request()->routeIs('hasil.*')">
                    {{ __('Hasil Perhitungan') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Info Periode di Mobile -->
        @if (session('selected_periode_id'))
            <div class="pt-2 pb-3 border-t border-gray-200">
                <div class="px-4 py-2">
                    <div class="text-xs text-gray-500 mb-1">Periode Aktif:</div>
                    <div class="text-sm font-medium text-blue-600">
                        {{ session('selected_periode_nama', 'Periode Aktif') }}</div>
                </div>
            </div>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
