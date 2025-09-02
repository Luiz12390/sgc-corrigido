<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SGC-Chapecó</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Reset & Basic Setup */
        :root {
            --primary-color: #2D8A81;
            --white-color: #ffffff;
            --background-color: #fdfdfd;
            --text-color: #333;
            --gray-text-color: #6c757d;
            --input-border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-image: url('/images/triangles.png');
            background-repeat: no-repeat;
            background-size: contain;
            background-position: right top;
            z-index: -1;
        }

        .page-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 3rem;
            width: 100%;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* ================== Header ================== */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 2rem;
        }

        .logo {
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 24px;
            background-color: #000;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        }

        nav ul {
            display: flex;
            list-style-type: none;
            gap: 2rem;
            align-items: center;
        }

        /* --- CORREÇÃO NA COR DOS LINKS DO MENU --- */
        nav a {
            text-decoration: none;
            color: var(--white-color); /* Cor cinza padrão para os links */
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        nav a.active {
            color: var(--white-color) !important;
            background-color: var(--primary-color);
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        a.active:hover {
            background-color: var(--white-color);
            color: var(--primary-color) !important;
        }

        .register-btn {
            background-color: var(--white-color);
            color: var(--primary-color) !important;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .register-btn:hover {
            background-color: var(--primary-color);
            color: var(--white-color) !important;
        }

        /* ================== Main Content ================== */
        main {
            display: flex;
            width: 100%;
            flex-grow: 1;
            align-items: center;
            padding-bottom: 2rem;
        }

        /* --- AJUSTE PARA MAIS ESPAÇO NO MEIO --- */
        .form-section {
            flex-basis: 60%; /* Define a largura base */
            display: flex;
            justify-content: flex-start; /* Alinha o conteúdo à esquerda */
            padding-left: 5%; /* Adiciona um espaçamento da borda da página */
        }

        .login-container {
            max-width: 420px;
            width: 100%;
        }

        .login-container h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 3.5rem;
            color: #222;
        }

        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--gray-text-color);
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--input-border-color);
            background-color: #f9f9f9;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(45, 138, 129, 0.2);
        }

        .form-group input::placeholder {
            color: #bbb;
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 0.9rem;
            color: var(--gray-text-color);
            text-decoration: none;
            margin-top: -1rem;
            margin-bottom: 3rem;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            border: none;
            background-color: var(--primary-color);
            color: var(--white-color);
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 3.5rem;
        }

        .login-btn:hover {
            background-color: #256e67;
        }

        .signup-link {
            text-align: center;
            font-size: 1rem;
            color: var(--gray-text-color);
        }

        .signup-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .info-section {
            flex-basis: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--white-color);
            padding: 3rem 4rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .info-content {
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        .info-content .icon {
            margin-bottom: 2rem;
            display: flex;
            justify-content: flex-start;
        }

        .info-content .icon svg {
            width: 40px;
            height: 40px;
        }

        .info-content h2 {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .info-content p {
            font-size: 1rem;
            line-height: 1.7;
            opacity: 0.95;
        }

        .info-content p:last-child {
            margin-top: 1rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .info-icon::before {
            content: "💡";
            font-size: 20px;
        }

    </style>
</head>
<body>

    <div class="page-container">
        <header>
            <div class="logo">SGC-Chapecó</div>
            <nav>
                <ul>
                    <li><a href="{{ route('login') }}" class="active">Login</a></li>
                    <li><a href="{{ route('register') }}" class="register-btn">Register</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="form-section">
                <div class="login-container">
                    <h1>Bem-vindo de volta</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if (session('status'))
                            <div class="alert-success" style="padding: 1rem; margin-bottom: 1rem; border-radius: 8px; background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc;">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>

                            @error('email')
                                <div class="error-message" style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" id="password" name="password" placeholder="Senha" required>

                            @error('password')
                                <div class="error-message" style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <a href="#" class="forgot-password">Esqueceu a senha?</a>

                        <button type="submit" class="login-btn">Login</button>
                    </form>

                    <p class="signup-link">Não tem uma conta? <a href="#">Cadastre-se</a></p>
                </div>
            </section>

            <section class="info-section">
                <div class="info-content">
                <div class="info-icon"></div>
                    <h2>INOVAÇÃO QUE CONECTA!</h2>
                    <p>Bem-vindo ao SGC-Chapecó, um <strong>Sistema de Gestão do Conhecimento</strong> que promove a inovação aberta e fortalece a colaboração entre <strong>incubadoras, universidades e empresas.</strong></p>
                    <p>Aqui, você encontra um <strong>ambiente dinâmico</strong> para troca de ideias, desenvolvimento de projetos e <strong>geração de valor</strong> para o ecossistema de inovação.</p>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
