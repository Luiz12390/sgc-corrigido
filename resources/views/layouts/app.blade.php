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

    @vite(['resources/css/app.css'])
    @livewireStyles
    @stack('styles')

    @livewireScripts
    @vite(['resources/js/app.js'])

</head>
<body class="antialiased">

    <header class="main-header" x-data>
        <div class="header-left">
            <a href="{{ route('home') }}" class="logo">SGC-Chapecó</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>

                    <li class="nav-item-dropdown" x-data="{ open: false }" @click.outside="open = false">
                        <a href="#" @click.prevent="open = !open" class="nav-link-dropdown-toggle {{ request()->routeIs('challenges.*') ? 'active' : '' }}">
                            <span>Desafios</span>
                            <svg x-bind:style="open && { transform: 'rotate(180deg)' }" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu" x-show="open" style="display: none;">
                            <a href="{{ route('challenges.index') }}" class="nav-dropdown-item">Todos os Desafios</a>
                        </div>
                    </li>

                    <li class="nav-item-dropdown" x-data="{ open: false }" @click.outside="open = false">
                        <a href="#" @click.prevent="open = !open" class="nav-link-dropdown-toggle {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                            <span>Projetos</span>
                            <svg x-bind:style="open && { transform: 'rotate(180deg)' }" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu" x-show="open" style="display: none;">
                            <a href="{{ route('projects.index', ['filter' => 'meus-projetos']) }}" class="nav-dropdown-item">Meus projetos</a>
                            <a href="{{ route('projects.index') }}" class="nav-dropdown-item">Todos os Projetos</a>
                        </div>
                    </li>

                    <li><a href="{{ route('organizations.index') }}" class="{{ request()->routeIs('organizations.*') ? 'active' : '' }}">Organizações</a></li>
                    <li><a href="{{ route('communities.index') }}" class="{{ request()->routeIs('communities.*') ? 'active' : '' }}">Comunidade</a></li>
                    <li><a href="{{ route('recursos.index') }}" class="{{ request()->routeIs('resources.*') ? 'active' : '' }}">Recursos</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="header-search" @click="$dispatch('open-search-modal')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <span class="text-gray-500">Procurar...</span>
            </div>

            <div class="profile-dropdown" x-data="{ open: false }" @click.outside="open = false">
                <div class="profile-trigger" @click="open = !open">
                    @auth
                        <img id="profile-pic" class="profile-pic" src="{{ auth()->user()->profile_photo_url }}" alt="Foto de {{ auth()->user()->name }}">
                    @else
                        <div class="profile-pic guest-avatar">?</div>
                    @endauth
                </div>

                <div class="dropdown-menu" x-show="open" style="display: none;">
                    @auth
                        <div class="dropdown-header">
                            <strong>{{ auth()->user()->name }}</strong>
                            <span>{{ auth()->user()->email }}</span>
                        </div>
                        <ul>
                            <li><a href="{{ route('profile.show', auth()->user()) }}">Meu Perfil</a></li>
                            <li><a href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                        </ul>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit">Sair</button>
                        </form>
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
