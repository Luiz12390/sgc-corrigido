<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SGC-Chapecó')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

   <style>
        /* CSS Reset & Basic Setup */
        :root {
            --primary-color: #2D8A81;
            --white-color: #ffffff;
            --background-color: #f7f8fa;
            --card-background-color: #ffffff;
            --text-color: #333;
            --gray-text-color: #6c757d;
            --border-color: #e9ecef;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--background-color); color: var(--text-color); }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }

        /* ================== Header ================== */
        .main-header {
            background-color: var(--card-background-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-left { display: flex; align-items: center; gap: 2.5rem; }
        .logo { font-weight: 700; font-size: 1.25rem; display: flex; align-items: center; gap: 8px; }
        .logo::before { content: ''; display: inline-block; width: 22px; height: 22px; background-color: #000; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); }
        .main-nav ul { display: flex; list-style-type: none; gap: 2rem; align-items: center; }
        .main-nav a { font-weight: 500; color: var(--gray-text-color); transition: color 0.3s ease; }
        .main-nav a:hover, .main-nav a.active { color: var(--primary-color); }
        .header-right { display: flex; align-items: center; gap: 1.5rem; }
        .search-bar { display: flex; align-items: center; background-color: var(--background-color); padding: 0.5rem 1rem; border-radius: 8px; width: 250px; }
        .search-bar svg { width: 16px; height: 16px; stroke: var(--gray-text-color); }
        .search-bar input { border: none; background: none; outline: none; margin-left: 0.5rem; width: 100%; font-family: 'Poppins', sans-serif; }

        /* ================== Nav Dropdown ================== */
        .nav-item-dropdown { position: relative; }
        .nav-link-dropdown-toggle { display: flex; align-items: center; gap: 0.5rem; }
        .nav-link-dropdown-toggle svg { width: 12px; height: 12px; transition: transform 0.2s ease; }
        .nav-link-dropdown-toggle.dropdown-active svg { transform: rotate(180deg); }
        .nav-dropdown-menu { display: none; position: absolute; top: 150%; left: 50%; transform: translateX(-50%); background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); min-width: 240px; z-index: 1100; padding: 0.5rem; opacity: 0; visibility: hidden; transition: opacity 0.2s ease, top 0.2s ease, visibility 0.2s ease; }
        .nav-dropdown-menu.active { display: block; opacity: 1; visibility: visible; top: 140%; }
        .nav-dropdown-item { display: block; padding: 0.75rem 1rem; font-size: 0.9rem; border-radius: 6px; transition: background-color 0.2s ease; white-space: nowrap; }
        .nav-dropdown-item:hover { background-color: var(--background-color); color: var(--primary-color); }

        /* ================== Profile Dropdown ================== */
        .profile-dropdown { position: relative; cursor: pointer; }
        .profile-dropdown .profile-pic { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .dropdown-menu { display: none; position: absolute; top: 130%; right: 0; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); width: 240px; z-index: 1100; }
        .dropdown-menu.active { display: block; }
        .dropdown-header { padding: 1rem; border-bottom: 1px solid var(--border-color); }
        .dropdown-header strong { display: block; font-size: 0.95rem; }
        .dropdown-header span { font-size: 0.85rem; color: var(--gray-text-color); }
        .dropdown-menu ul { list-style: none; padding: 0.5rem 0; border-bottom: 1px solid var(--border-color); }
        .dropdown-menu li a { display: block; padding: 0.75rem 1rem; font-size: 0.9rem; transition: background-color 0.2s ease; }
        .dropdown-menu li a:hover { background-color: var(--background-color); }
        .logout-form { padding: 0.5rem; }
        .logout-form button { width: 100%; text-align: left; padding: 0.75rem 1rem; border: none; background: none; cursor: pointer; font-size: 0.9rem; font-family: 'Poppins', sans-serif; color: #e53e3e; font-weight: 500; transition: background-color 0.2s ease; border-radius: 5px; }
        .logout-form button:hover { background-color: #fff5f5; }

        /* ================== ESTILOS GERAIS DE CONTEÚDO ================== */
        .card { background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; box-shadow: var(--box-shadow); }
        .card-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; }
        .content-section-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; }

        /* ================== ESTILOS GERAIS DE PAGINAÇÃO ================== */
        .pagination { display: flex; justify-content: center; align-items: center; gap: 0.5rem; list-style: none; padding-left: 0; margin-top: 3rem; }
        .page-item .page-link { display: flex; align-items: center; justify-content: center; min-width: 40px; height: 40px; padding: 0 0.75rem; border-radius: 8px; border: 1px solid var(--border-color); background-color: var(--card-background-color); font-weight: 500; color: var(--gray-text-color); transition: all 0.3s ease; box-shadow: var(--box-shadow); line-height: 1; }
        .page-item .page-link:hover { border-color: var(--primary-color); color: var(--primary-color); }
        .page-item.active .page-link { background-color: var(--primary-color); color: var(--white-color); border-color: var(--primary-color); z-index: 3; }
        .page-item.disabled .page-link, .page-item.disabled span.page-link { color: #ccc; cursor: default; background-color: var(--background-color); border-color: var(--border-color); box-shadow: none; }
        .page-item:first-child .page-link, .page-item:last-child .page-link { padding: 0; font-size: 0; }
        .page-link[rel="prev"]::before, .page-link[rel="next"]::before { font-size: 1.2rem; font-weight: 600; }
        .page-link[rel="prev"]::before { content: '\003C'; }
        .page-link[rel="next"]::before { content: '\003E'; }
    </style>

    @stack('styles')
    @livewireStyles
</head>
<body>

    <header class="main-header">
        <div class="header-left">
            <div class="logo">SGC-Chapecó</div>
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li class="nav-item-dropdown">
                        <a href="{{ route('challenges.index') }}" class="nav-link-dropdown-toggle {{ request()->routeIs('challenges.index') ? 'active' : '' }}">
                            <span>Desafios</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu">
                            <a href="#" class="nav-dropdown-item">Meus desafios</a>
                            <a href="#" class="nav-dropdown-item">Desafios da minha empresa</a>
                            <a href="{{ route('challenges.index') }}" class="nav-dropdown-item">Todos os Desafios</a>
                        </div>
                    </li>
                    <li class="nav-item-dropdown">
                        <a href="{{ route('projects.index') }}" class="nav-link-dropdown-toggle {{ request()->routeIs('projects.index') ? 'active' : '' }}">
                            <span>Projetos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu">
                            <a href="#" class="nav-dropdown-item">Meus projetos</a>
                            <a href="#" class="nav-dropdown-item">Projetos da minha empresa</a>
                            <a href="{{ route('projects.index') }}" class="nav-dropdown-item">Todos os Projetos</a>
                        </div>
                    </li>
                    <li><a href="{{ route('communities.index') }}">Comunidade</a></li>
                    <li class="nav-item-dropdown">
                        <a href="{{ route('resources.index') }}" class="nav-link-dropdown-toggle {{ request()->routeIs('recursos.index') ? 'active' : '' }}">
                            <span>Recursos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <div class="nav-dropdown-menu">
                            <a href="#" class="nav-dropdown-item">Meus recursos publicados</a>
                            <a href="#" class="nav-dropdown-item">Grupos de recursos</a>
                            <a href="{{ route('resources.index') }}" class="nav-dropdown-item">Recursos Públicos</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <input type="text" placeholder="Search">
            </div>
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:24px; height:24px; color: var(--gray-text-color);"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg></a>
            <div class="profile-dropdown">
                <div class="profile-trigger">
                    <img src="https://i.pravatar.cc/150?u={{ auth()->id() ?? 'default' }}" alt="Foto do perfil" class="profile-pic">
                </div>
                <div class="dropdown-menu">
                    <div class="dropdown-header">
                        <strong>{{ auth()->user()->name ?? 'Visitante' }}</strong>
                        <span>{{ auth()->user()->email ?? '' }}</span>
                    </div>
                    <ul>
                        <li><a href="{{ route('profile') }}">Meu Perfil</a></li>
                        <li><a href="#">Configurações</a></li>
                    </ul>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navDropdowns = document.querySelectorAll('.nav-item-dropdown');
            navDropdowns.forEach(function(dropdown) {
                const toggle = dropdown.querySelector('.nav-link-dropdown-toggle');
                const menu = dropdown.querySelector('.nav-dropdown-menu');
                if(toggle && menu) {
                    toggle.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        closeAllNavDropdowns(menu);
                        menu.classList.toggle('active');
                        toggle.classList.toggle('dropdown-active');
                    });
                }
            });

            const profileTrigger = document.querySelector('.profile-trigger');
            const profileDropdownMenu = document.querySelector('.dropdown-menu');
            if (profileTrigger && profileDropdownMenu) {
                profileTrigger.addEventListener('click', function(event) {
                    event.stopPropagation();
                    closeAllNavDropdowns();
                    profileDropdownMenu.classList.toggle('active');
                });
            }

            function closeAllNavDropdowns(exceptMenu = null) {
                document.querySelectorAll('.nav-dropdown-menu.active').forEach(function(openMenu) {
                    if (openMenu !== exceptMenu) {
                        openMenu.classList.remove('active');
                        openMenu.previousElementSibling.classList.remove('dropdown-active');
                    }
                });
            }

            document.addEventListener('click', function() {
                closeAllNavDropdowns();
                if (profileDropdownMenu) {
                    profileDropdownMenu.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
