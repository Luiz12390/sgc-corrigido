<div>
    <div class="management-card mb-8">
        <div class="management-card-header">
            <h2 class="text-2xl font-semibold mb-4">Pedidos Pendentes ({{ $pendingRequests->count() }})</h2>
        </div>
        <div class="management-card-body">
            @forelse ($pendingRequests as $request)
                <div class="list-item">
                    <div class="user-info">
                        <img class="user-avatar" src="{{ $request->user->profile_photo_url }}" alt="{{ $request->user->name }}">
                        <div class="user-details">
                            <p class="user-name">{{ $request->user->name }}</p>
                            <p class="user-meta">Pedido em {{ $request->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button wire:click="approveRequest({{ $request->id }})" class="btn-approve">Aprovar</button>
                        <button wire:click="rejectRequest({{ $request->id }})" class="btn-reject">Recusar</button>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Não há pedidos pendentes no momento.</p>
            @endforelse
        </div>
    </div>

    <div class="management-card">
        <div class="management-card-header">
            <h2 class="text-2xl font-semibold mb-4">Membros Atuais ({{ $currentMembers->count() }})</h2>
        </div>
        <div class="management-card-body">
            @forelse ($currentMembers as $member)
                <div class="list-item">
                    <div class="user-info">
                        <img class="user-avatar" src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}">
                        <div class="user-details">
                            <p class="user-name">{{ $member->name }}</p>
                            <p class="user-meta">Membro desde {{ $member->pivot->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Este projeto ainda não tem membros.</p>
            @endforelse
        </div>
    </div>
</div>