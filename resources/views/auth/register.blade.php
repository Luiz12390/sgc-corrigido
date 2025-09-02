<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | SGC-Chapecó</title>
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

        nav a {
            text-decoration: none;
            color: var(--white-color); /* Links do menu são brancos */
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        /* Botão ativo (verde) */
        nav a.active {
            color: var(--white-color) !important;
            background-color: var(--primary-color);
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        nav a.active:hover {
            background-color: var(--white-color);
            color: var(--primary-color) !important;
        }

        /* Botão alternativo (branco) */
        .login-btn-nav {
            background-color: var(--white-color);
            color: var(--primary-color) !important;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .login-btn-nav:hover {
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

        .form-section {
            flex-basis: 60%;
            display: flex;
            justify-content: flex-start;
            padding-left: 5%;
        }

        .register-container {
            max-width: 420px;
            width: 100%;
        }

        .register-container h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 3rem;
            color: #222;
        }

        .form-group {
            margin-bottom: 1.5rem;
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

        .register-btn-form {
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
            margin-top: 1.5rem;
            margin-bottom: 2rem;
        }

        .register-btn-form:hover {
            background-color: #256e67;
        }

        .login-link {
            text-align: center;
            font-size: 1rem;
            color: var(--gray-text-color);
        }

        .login-link a {
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
                    <li><a href="{{ route('login') }}" class="login-btn-nav">Login</a></li>
                    <li><a href="{{ route('register') }}" class="active">Register</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="form-section">
                <div class="register-container">
                    <h1>Crie sua conta</h1>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="alert-danger" style="padding: 1rem; margin-bottom: 1.5rem; border-radius: 8px; background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7;">
                                <strong>Opa! Algo deu errado.</strong>
                                <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nome completo</label>
                            <input type="text" id="name" name="name" placeholder="Seu nome completo" value="{{ old('name') }}" required>

                            @error('name')
                                <div class="error-message" style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="seu@email.com" value="{{ old('email') }}" required>

                            @error('email')
                                <div class="error-message" style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" id="password" name="password" placeholder="Crie uma senha forte" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repita a senha" required>
                        </div>

                         <button type="submit" class="register-btn-form">Registrar</button>
                    </form>

                    <p class="login-link">Já tem uma conta? <a href="#">Faça login</a></p>
                </div>
            </section>

            <section class="info-section">
                <div class="info-content">
                    <div class="info-icon"></div>
                    <h2>JUNTE-SE À NOSSA COMUNIDADE!</h2>
                    <p>Ao criar sua conta, você se conecta ao ecossistema de inovação de Chapecó. Participe de projetos, troque ideias e colabore com empresas, universidades e talentos da região.</p>
                    <p>Faça parte da transformação. O futuro se constrói em rede.</p>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
