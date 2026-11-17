@extends('layouts.app', ['pageTitle' => 'Dashboard'])

@section('content')
    <div class="welcome-line">
        <div><h2>Overview</h2><p>A current look at the pets in your care.</p></div>
        <span class="date-chip">{{ now()->format('l, F j, Y') }}</span>
    </div>
    <div class="stats-grid">
        <article class="stat-card stat-total"><div class="stat-label">TOTAL REGISTERED PETS</div><div class="stat-value">{{ number_format($totalPets) }}</div><div class="stat-foot">Across all pet types</div><span class="stat-symbol">P</span></article>
        <article class="stat-card"><div class="stat-label">DOGS</div><div class="stat-value">{{ number_format($dogs) }}</div><div class="stat-foot">Registered dogs</div><span class="stat-symbol stat-dog">D</span></article>
        <article class="stat-card"><div class="stat-label">CATS</div><div class="stat-value">{{ number_format($cats) }}</div><div class="stat-foot">Registered cats</div><span class="stat-symbol stat-cat">C</span></article>
        <article class="stat-card"><div class="stat-label">OTHER PETS</div><div class="stat-value">{{ number_format($otherPets) }}</div><div class="stat-foot">Birds, rabbits, and more</div><span class="stat-symbol stat-other">O</span></article>
    </div>
    <section class="content-panel">
        <div class="panel-heading"><div><h2>Recently registered</h2><p>The latest additions to your records.</p></div><a class="text-link" href="{{ route('pets.index') }}">View all records <span aria-hidden="true">&gt;</span></a></div>
        @if ($recentPets->isEmpty())
            <div class="empty-state"><div class="empty-mark">P</div><h3>No pet records yet</h3><p>Add your first pet to begin building your registry.</p><a class="btn btn-primary" href="{{ route('pets.create') }}">Add a pet</a></div>
        @else
            <div class="table-responsive"><table class="table data-table align-middle mb-0">
                <thead><tr><th>Pet</th><th>Type</th><th>Owner</th><th>Date registered</th><th></th></tr></thead>
                <tbody>@foreach ($recentPets as $pet)
                    <tr><td><a class="pet-name" href="{{ route('pets.show', $pet) }}">{{ $pet->name }}</a><span class="cell-sub">{{ $pet->breed ?: 'Breed not specified' }}</span></td><td><span class="type-pill type-{{ strtolower($pet->type) }}">{{ $pet->type }}</span></td><td>{{ $pet->owner_name }}</td><td>{{ $pet->date_registered->format('M j, Y') }}</td><td class="text-end"><a class="row-action" href="{{ route('pets.show', $pet) }}" aria-label="View {{ $pet->name }}">View <span aria-hidden="true">&gt;</span></a></td></tr>
                @endforeach</tbody>
            </table></div>
        @endif
    </section>
@endsection