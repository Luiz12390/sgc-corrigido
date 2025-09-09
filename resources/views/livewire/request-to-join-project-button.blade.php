<div>
    @auth
        @php
            $isMember = auth()->user()->projects->contains($project);
        @endphp

        @if ($isMember)
            <button class="btn btn-success" disabled>Você faz parte do projeto</button>
        @elseif ($status === 'pendente')
            <button class="btn btn-secondary" disabled>Solicitação Pendente</button>
        @elseif ($status === 'recusado')
            <button class="btn btn-danger" disabled>Solicitação Recusada</button>
        @else
            <button class="btn btn-primary" wire:click="sendRequest" wire:loading.attr="disabled">
                Quero Participar
            </button>
        @endif
    @else
        <a href="{{ route('login') }}" class="btn btn-primary" wire:navigate>Entrar para Participar</a>
    @endguest
</div>