<div>
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary" wire:navigate>Entrar para Solicitar</a>
    @else
        @php
            $isMember = auth()->user()->organizations->contains($organization);
        @endphp

        @if ($isMember)
            <button class="btn btn-success" disabled>Você é um membro</button>
        @elseif ($status === 'pendente')
            <button class="btn btn-secondary" disabled>Solicitação Pendente</button>
        @elseif ($status === 'recusado')
            <button class="btn btn-danger" disabled>Solicitação Recusada</button>
        @else
            <button class="btn btn-primary" wire:click="sendRequest" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="sendRequest">Solicitar Entrada</span>
                <span wire:loading wire:target="sendRequest">A enviar...</span>
            </button>
        @endif
    @endguest
</div>
