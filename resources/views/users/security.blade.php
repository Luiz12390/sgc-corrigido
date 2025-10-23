@extends('layouts.app')

@section('title', 'Senha e Segurança | SGC-Chapecó')

@push('styles')
<style>
    .page-container { max-width: 800px; margin: 0 auto; padding: 2.5rem; }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .card { background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem 2rem; box-shadow: var(--box-shadow); }
    .card header { margin-bottom: 1.5rem; }
    .card h2 { font-size: 1.25rem; font-weight: 600; }
    .card p { font-size: 0.9rem; color: var(--gray-text-color); margin-top: 0.25rem; max-width: 90%; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
    .btn-submit:hover { background-color: #256e67; }
    .btn-danger { background-color: #e53e3e; }
    .btn-danger:hover { background-color: #c53030; }
    .text-sm { font-size: 0.875rem; }
    .text-gray-600 { color: var(--gray-text-color); }
    .text-red-500 { color: #e53e3e; }
    .mt-1 { margin-top: 0.25rem; }
    .alert {padding: 1rem;border-radius: 8px;margin-bottom: 1.5rem;border: 1px solid transparent;}
    .alert-success {color: #0f5132;background-color: #d1e7dd;border-color: #badbcc;}
    .alert-danger { color: #842029; background-color: #f8d7da; border-color: #f5c2c7; padding: 0.75rem 1.25rem; margin-top: 0.75rem; border-radius: 8px; }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Senha e Segurança</h1>
    </div>

    <div class="card">
        <header>
            <h2>Atualizar Senha</h2>
            <p>Garanta que sua conta esteja usando uma senha longa e aleatória para se manter segura.</p>
        </header>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password">Senha Atual</label>
                <input id="current_password" name="current_password" type="password" required>
                @error('current_password') <div class="alert-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input id="password" name="password" type="password" required>
                @error('password') <div class="alert-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>
                @error('password_confirmation') <div class="alert-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-submit">Salvar</button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success" style="margin-top: 1.5rem;">
                    Senha salva com sucesso.
                </div>
            @endif
        </form>
    </div>

    <div class="card" style="margin-top: 2.5rem;">
        <header>
            <h2>Excluir Conta</h2>
            <p>Depois que sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Antes de excluir sua conta, por favor, baixe quaisquer dados ou informações que você deseja reter.</p>
        </header>

        <div x-data="{ confirmingUserDeletion: @if($errors->userDeletion->isNotEmpty()) true @else false @endif }">
            <button type="button" @click="confirmingUserDeletion = true" class="btn-submit btn-danger">
                Excluir Conta
            </button>

            <div x-show="confirmingUserDeletion"
                 class="fixed inset-0 bg-black bg-opacity-50 z-[1000] flex items-center justify-center p-4"
                 x-cloak>
                <div class="card w-full max-w-lg" @click.away="confirmingUserDeletion = false">
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <h2>Tem a certeza que quer excluir a sua conta?</h2>
                        <p>Por favor, insira sua senha para confirmar que você gostaria de excluir permanentemente sua conta.</p>

                        <div class="form-group" style="margin-top: 1.5rem;">
                            <label for="password_delete">Senha</label>
                            <input id="password_delete" name="password" type="password" required>
                            @error('password', 'userDeletion') <div class="alert-danger">{{ $message }}</div> @enderror
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                            <button type="button" class="btn-submit" style="background-color: var(--gray-text-color);" @click="confirmingUserDeletion = false">
                                Cancelar
                            </button>
                            <button type="submit" class="btn-submit btn-danger">
                                Excluir Conta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
