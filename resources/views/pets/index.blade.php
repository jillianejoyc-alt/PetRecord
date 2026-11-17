@extends('layouts.app', ['pageTitle' => 'Pet records'])

@section('content')
    <div class="welcome-line"><div><h2>All pets</h2><p>Search and manage registered pets and their owners.</p></div><a href="{{ route('pets.create') }}" class="btn btn-primary">Add a pet <span aria-hidden="true">+</span></a></div>
    <section class="content-panel">
        <form class="search-form" action="{{ route('pets.index') }}" method="GET" role="search">
            <label class="visually-hidden" for="pet-search">Search by pet or owner</label>
            <input id="pet-search" class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Search by pet or owner">
            <button class="btn btn-outline-primary" type="submit">Search</button>
            @if ($search !== '') <a class="clear-search" href="{{ route('pets.index') }}">Clear</a> @endif
        </form>
        @if ($pets->isEmpty())
            <div class="empty-state compact-empty"><div class="empty-mark">P</div><h3>{{ $search !== '' ? 'No matching pets' : 'No pet records yet' }}</h3><p>{{ $search !== '' ? 'Try another pet name or owner name.' : 'Your registered pets will appear here.' }}</p>@if ($search === '') <a class="btn btn-primary" href="{{ route('pets.create') }}">Add a pet</a> @endif</div>
        @else
            <div class="table-responsive"><table class="table data-table align-middle mb-0">
                <thead><tr><th>Pet</th><th>Type</th><th>Age / Gender</th><th>Owner</th><th>Contact</th><th>Date registered</th><th></th></tr></thead>
                <tbody>@foreach ($pets as $pet)
                    <tr><td><a class="pet-name" href="{{ route('pets.show', $pet) }}">{{ $pet->name }}</a><span class="cell-sub">{{ $pet->breed ?: 'Breed not specified' }} - #{{ $pet->id }}</span></td><td><span class="type-pill type-{{ strtolower($pet->type) }}">{{ $pet->type }}</span></td><td>{{ $pet->age }} {{ $pet->age === 1 ? 'year' : 'years' }}<span class="cell-sub">{{ $pet->gender }}</span></td><td>{{ $pet->owner_name }}</td><td>{{ $pet->contact_number }}</td><td>{{ $pet->date_registered->format('M j, Y') }}</td><td class="text-end"><a class="row-action" href="{{ route('pets.show', $pet) }}" aria-label="View {{ $pet->name }}">View <span aria-hidden="true">&gt;</span></a></td></tr>
                @endforeach</tbody>
            </table></div>
            @if ($pets->hasPages()) <div class="pagination-wrap">{{ $pets->links() }}</div> @endif
        @endif
    </section>
@endsection