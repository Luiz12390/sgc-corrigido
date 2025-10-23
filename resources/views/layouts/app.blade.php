<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SGC-Chapecó')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')

    @livewireScripts
</head>
<body class="antialiased">

    <header class="main-header" x-data="{ openDropdown: '' }" @click.away="openDropdown = ''">
        <div class="header-left">
            <a href="{{ route('home') }}" class="logo">SGC-Chapecó</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>

                    <li class="nav-item-dropdown">
                        <a href="#" @click.prevent="openDropdown = (openDropdown === 'desafios' ? '' : 'desafios')" class="nav-link-dropdown-toggle {{ request()->routeIs('challenges.*') ? 'active' : '' }}">
                            <span>Desafios</span>
                            <svg :class="{ 'transform rotate-180': openDropdown === 'desafios' }" class="transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu" x-show="openDropdown === 'desafios'" style="display: none;">
                            <a href="{{ route('challenges.index', ['filter' => 'meus-desafios']) }}" class="nav-dropdown-item">Meus desafios</a>
                            <a href="{{ route('challenges.index', ['filter' => 'desafios-da-minha-empresa']) }}" class="nav-dropdown-item">Desafios da minha empresa</a>
                            <a href="{{ route('challenges.index') }}" class="nav-dropdown-item">Todos os Desafios</a>
                        </div>
                    </li>

                    <li class="nav-item-dropdown">
                        <a href="#" @click.prevent="openDropdown = (openDropdown === 'projetos' ? '' : 'projetos')" class="nav-link-dropdown-toggle {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                            <span>Projetos</span>
                            <svg :class="{ 'transform rotate-180': openDropdown === 'projetos' }" class="transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu" x-show="openDropdown === 'projetos'" style="display: none;">
                            <a href="{{ route('projects.index', ['filter' => 'meus-projetos']) }}" class="nav-dropdown-item">Meus projetos</a>
                            <a href="{{ route('projects.index', ['filter' => 'minha-empresa']) }}" class="nav-dropdown-item">Projetos da minha empresa</a>
                            <a href="{{ route('projects.index') }}" class="nav-dropdown-item">Todos os Projetos</a>
                        </div>
                    </li>

                    <li><a href="{{ route('organizations.index') }}" class="{{ request()->routeIs('organizations.*') ? 'active' : '' }}">Organizações</a></li>
                    <li><a href="{{ route('communities.index') }}" class="{{ request()->routeIs('communities.*') ? 'active' : '' }}">Comunidade</a></li>
                    <li class="nav-item-dropdown">
                        <a href="#" @click.prevent="openDropdown = (openDropdown === 'recursos' ? '' : 'recursos')" class="nav-link-dropdown-toggle {{ request()->routeIs('recursos.*') ? 'active' : '' }}">
                            <span>Recursos</span>
                            <svg :class="{ 'transform rotate-180': openDropdown === 'recursos' }" class="transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu" x-show="openDropdown === 'recursos'" style="display: none;">
                            <a href="{{ route('recursos.index', ['filter' => 'meus-recursos']) }}" class="nav-dropdown-item">Meus recursos</a>
                            <a href="{{ route('recursos.index') }}" class="nav-dropdown-item">Todos os Recursos</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="header-search cursor-pointer" @click="$dispatch('open-search-modal')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <span>Procurar...</span>
            </div>

            <div class="profile-dropdown">
                <div class="profile-trigger" @click.prevent="openDropdown = (openDropdown === 'perfil' ? '' : 'perfil')">
                    @auth
                        <img class="profile-pic" src="{{ auth()->user()->profile_photo_url }}" alt="Foto de {{ auth()->user()->name }}">
                    @else
                        <div class="profile-pic guest-avatar">?</div>
                    @endauth
                </div>
                <div class="dropdown-menu" x-show="openDropdown === 'perfil'" style="display: none;">
                    @auth
                        <div class="dropdown-header"><strong>{{ auth()->user()->name }}</strong><span>{{ auth()->user()->email }}</span></div>
                        <ul>
                            <li><a href="{{ route('profile.show', auth()->user()) }}">Meu Perfil</a></li>
                            <li><a href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                            <li><a href="{{ route('profile.security') }}">Senha e Segurança</a></li>
                        </ul>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">@csrf<button type="submit">Sair</button></form>
                    @else
                        <ul>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registar</a></li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @livewire('global-search-modal')

    @stack('scripts')

</body>
</html>
