@extends('layouts.app')

@section('title', 'Eventos e Comunidades | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE COMUNIDADE */

    /* Sub-Header da Página (Breadcrumbs e Ações) */
    .page-subheader {
        background-color: var(--card-background-color);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 2.5rem; /* Padding horizontal para alinhar com o header principal */
    }
    .subheader-content {
        /* Ajustado para ocupar 100% da largura */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .breadcrumbs {
        font-size: 1rem;
        font-weight: 500;
        color: var(--gray-text-color);
    }
    .breadcrumbs a {
        color: var(--primary-color);
        font-weight: 500;
    }
    .btn-primary-header {
        background-color: var(--primary-color);
        color: var(--white-color);
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
        white-space: nowrap;
    }
    .btn-primary-header:hover {
        background-color: #256e67;
    }

    /* Container Principal do Conteúdo */
    .page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem;
    }
    .page-section { margin-bottom: 3rem; }
    .page-section h2 { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; }

    /* Estilos do Calendário e Comunidades (sem alteração) */
    .calendar-container { display: flex; gap: 2.5rem; justify-content: center; flex-wrap: wrap; }
    .calendar-month { width: 320px; }
    .month-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; font-weight: 600; font-size: 1rem; }
    .month-nav { background: none; border: none; cursor: pointer; padding: 0.5rem; color: var(--gray-text-color); }
    .month-nav:hover { color: var(--primary-color); }
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem; text-align: center; }
    .calendar-grid span { font-size: 0.85rem; padding: 0.5rem 0; }
    .weekday { font-weight: 500; color: var(--gray-text-color); }
    .day { font-weight: 500; cursor: pointer; border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; margin: 0 auto; transition: background-color 0.2s ease, color 0.2s ease; }
    .day:hover { background-color: var(--background-color); }
    .day.other-month { color: #ccc; cursor: default; }
    .day.active { background-color: var(--primary-color); color: var(--white-color); }
    .day.today { border: 1px solid var(--primary-color); }
    .communities-list { display: flex; flex-direction: column; gap: 1.5rem; }
    .community-card { display: flex; gap: 1.5rem; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; align-items: center; }
    .card-text { flex-grow: 1; }
    .card-text h3 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; }
    .card-text p { font-size: 0.95rem; line-height: 1.6; color: var(--gray-text-color); margin-bottom: 1rem; }
    .btn-join { background-color: var(--background-color); border: 1px solid var(--border-color); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: background-color 0.3s ease, color 0.3s ease; }
    .btn-join:hover { background-color: var(--primary-color); color: var(--white-color); border-color: var(--primary-color); }
    .card-image { width: 200px; height: 120px; object-fit: cover; border-radius: 8px; flex-shrink: 0; }
</style>
@endpush

@section('content')
    <div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('communities.index') }}">Comunidade</a> / <span>Eventos e Grupos</span>
            </nav>
            <div class="page-actions">
                <a href="#" class="btn-primary-header">Criar Nova Comunidade</a>
            </div>
        </div>
    </div>

    <div class="page-container">
        <section class="page-section">
            <h2>Próximos Eventos</h2>
            <div class="card">
                <div class="calendar-container">
                    @php
                        function renderCalendar($date) {
                            $month = $date->month;
                            $year = $date->year;
                            $today = \Carbon\Carbon::today();
                            $firstDayOfMonth = \Carbon\Carbon::create($year, $month, 1);
                            $daysInMonth = $firstDayOfMonth->daysInMonth;
                            $startDayOfWeek = $firstDayOfMonth->dayOfWeek;

                            echo '<div class="calendar-month">';
                            echo '<div class="month-header">';
                            echo '<button class="month-nav">&lt;</button>';
                            echo '<span>' . ucfirst($firstDayOfMonth->translatedFormat('F Y')) . '</span>';
                            echo '<button class="month-nav">&gt;</button>';
                            echo '</div>';
                            echo '<div class="calendar-grid">';

                            $weekdays = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];
                            foreach ($weekdays as $weekday) { echo '<span class="weekday">' . $weekday . '</span>'; }
                            for ($i = 0; $i < $startDayOfWeek; $i++) { echo '<span class="day other-month"></span>'; }
                            for ($day = 1; $day <= $daysInMonth; $day++) {
                                $currentDayDate = \Carbon\Carbon::create($year, $month, $day);
                                $classes = 'day';
                                if ($currentDayDate->isSameDay($today)) { $classes .= ' today'; }
                                echo '<span class="' . $classes . '">' . $day . '</span>';
                            }
                            echo '</div></div>';
                        }
                        renderCalendar(\Carbon\Carbon::now());
                        renderCalendar(\Carbon\Carbon::now()->startOfMonth()->addMonth());
                    @endphp
                </div>
            </div>
        </section>

        <section class="page-section">
            <h2>Comunidades Ativas</h2>
            <div class="communities-list">
                @forelse ($communities as $community)
                    <div class="community-card">
                        <div class="card-text">
                            <h3>{{ $community->name }}</h3>
                            <p>{{ $community->description }}</p>
                            <a href="#" class="btn-join">Entrar</a>
                        </div>
                        <img src="{{ $community->cover_image_path }}" alt="Imagem da comunidade {{ $community->name }}" class="card-image">
                    </div>
                @empty
                    <div class="card">
                        <p>Nenhuma comunidade ativa no momento.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
