<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <style>
        .logo-film {
            color: #e50914;
            font-weight: 900;
            letter-spacing: 4px;
            font-size: 18px;
        }

        .user-name {
            color: black;
            font-weight: 600;
        }

        .nav-link {
            font-weight: 600;
        }

        .nav-link:hover {
            color: black;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center">

                <!-- LOGO (remplace Laravel) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <span class="logo-film">FILM LIB</span>
                    </a>
                </div>

                <!-- LINKS -->
                <div class="hidden space-x-8 sm:flex sm:ml-10">

                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'text-red-600' : 'text-gray-600' }}">
                        Espace principal
                    </a>

                    <a href="{{ route('watched-movies.index') }}"
                       class="nav-link {{ request()->routeIs('watched-movies.*') ? 'text-red-600' : 'text-gray-600' }}">
                        Mes films
                    </a>

                    <a href="{{ route('recommendations.index') }}"
                       class="nav-link {{ request()->routeIs('recommendations.*') ? 'text-red-600' : 'text-gray-600' }}">
                        Recommandations
                    </a>

                    <a href="{{ route('search.index') }}"
                       class="nav-link {{ request()->routeIs('search.*') ? 'text-red-600' : 'text-gray-600' }}">
                        Explorer
                    </a>

                </div>
            </div>

            <!-- USER -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center px-3 py-2 text-sm bg-white rounded-md">

                            <span class="user-name">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="ml-2 h-4 w-4 text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"/>
                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('security')">
                            Sécurité
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Se déconnecter
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- MOBILE -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 text-gray-500 hover:text-black">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>
</nav>