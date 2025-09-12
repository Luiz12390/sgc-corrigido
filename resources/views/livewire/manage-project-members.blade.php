<div>
    <div class="management-card card">
        <div class="management-card-header">
            <h2 class="card-title">Pedidos Pendentes ({{ $pendingRequests->count() }})</h2>
        </div>
        <div class="management-card-body">
            @forelse ($pendingRequests as $request)
                <div class="list-item">
                    <div class="user-info">
                        <img class="user-avatar" src="{{ $request->user->profile_photo_url }}" alt="{{ $request->user->name }}">
                        <div class="user-details">
                            <p class="user-name">{{ $request->user->name }}</p>
                            <p class="user-meta">{{ $request->user->title }}</p>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button wire:click="approveRequest({{ $request->id }})" class="btn-approve">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            <span>Aprovar</span>
                        </button>
                        <button wire:click="rejectRequest({{ $request->id }})" class="btn-reject">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            <span>Recusar</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                    <p>Não há pedidos pendentes no momento.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="management-card card">
        <div class="management-card-header">
            <h2 class="card-title">Membros Atuais ({{ $currentMembers->count() }})</h2>
        </div>
        <div class="management-card-body">
            @forelse ($currentMembers as $member)
                <div class="list-item">
                    <div class="user-info">
                        <img class="user-avatar" src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}">
                        <div class="user-details">
                            <p class="user-name">{{ $member->name }}</p>
                            <p class="user-meta">{{ $member->title }}</p>
                        </div>
                    </div>
                    <div>
                        <span class="text-sm font-semibold text-gray-600">{{ ucfirst($member->pivot->role) }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3 3 0 013 10.5V12a9 9 0 0118 0v-1.5a3 3 0 01-3-3m-12.15-2.433A9 9 0 0112 3.75v1.5a3 3 0 01-3 3m-3.75 2.155A5.986 5.986 0 003 10.5a3 3 0 01-3-3" /></svg>
                    <p>Este projeto ainda não tem membros.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
