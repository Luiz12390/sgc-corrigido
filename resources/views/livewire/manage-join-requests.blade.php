<div>
    <style>
        .management-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .management-card-header {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .management-card-body {
            padding: 20px;
        }
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .list-item:last-child {
            border-bottom: none;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .user-details {
            display: flex;
            flex-direction: column;
        }
        .user-name {
            font-weight: bold;
            margin-bottom: 4px;
        }
        .user-meta {
            font-size: 0.875rem;
            color: #6b7280; /* cinza */
        }
        .action-buttons button {
            margin-left: 10px;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.875rem;
            cursor: pointer;
        }
        .btn-approve {
            background-color: #10b981; /* verde */
            color: white;
            border: none;
        }
        .btn-reject {
            background-color: #ef4444; /* vermelho */
            color: white;
            border: none;
        }
        .btn-approve:hover { background-color: #059669; }
        .btn-reject:hover { background-color: #dc2626; }
    </style>
    <div class="management-card">
        <div class="management-card-header">
            <h2>Pedidos Pendentes ({{ $pendingRequests->count() }})</h2>
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
            <h2>Membros Atuais ({{ $currentMembers->count() }})</h2>
        </div>
        <div class="management-card-body">
            @forelse ($currentMembers as $member)
                <div class="list-item">
                    <div class="user-info">
                        <img class="user-avatar" src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}">
                        <div class="user-details">
                            <p class="user-name">{{ $member->name }}</p>
                            <p class="user-meta">Membro desde {{ $member->pivot->created_at->format('d/m/Y') }} | Role: {{ ucfirst($member->pivot->role) }}</p>
                        </div>
                    </div>
                    {{-- Aqui você pode adicionar um botão para remover o membro no futuro --}}
                </div>
            @empty
                 <p class="text-gray-500">Ainda não há membros nesta organização.</p>
            @endforelse
        </div>
    </div>
</div>
