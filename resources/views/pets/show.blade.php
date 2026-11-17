@extends('layouts.app', ['pageTitle' => $pet->name])

@section('content')
    <div class="welcome-line detail-heading">
        <div><a class="back-link" href="{{ route('pets.index') }}">&lt; All pet records</a><h2>{{ $pet->name }}</h2><p>Pet record #{{ $pet->id }} - Registered {{ $pet->date_registered->format('F j, Y') }}</p></div>
        <div class="heading-actions"><a class="btn btn-outline-primary" href="{{ route('pets.edit', $pet) }}">Edit record</a><form action="{{ route('pets.destroy', $pet) }}" method="POST" data-confirm="Delete {{ $pet->name }}'s record? This cannot be undone.">@csrf @method('DELETE')<button class="btn btn-outline-danger" type="submit">Delete</button></form></div>
    </div>
    <div class="detail-grid">
        <section class="content-panel detail-panel"><div class="panel-heading"><div><h2>Pet information</h2><p>Animal profile details.</p></div><span class="type-pill type-{{ strtolower($pet->type) }}">{{ $pet->type }}</span></div>
            <dl class="detail-list"><div><dt>Pet name</dt><dd>{{ $pet->name }}</dd></div><div><dt>Pet ID</dt><dd>#{{ $pet->id }}</dd></div><div><dt>Breed</dt><dd>{{ $pet->breed ?: 'Not specified' }}</dd></div><div><dt>Age</dt><dd>{{ $pet->age }} {{ $pet->age === 1 ? 'year' : 'years' }}</dd></div><div><dt>Gender</dt><dd>{{ $pet->gender }}</dd></div><div><dt>Date registered</dt><dd>{{ $pet->date_registered->format('F j, Y') }}</dd></div></dl>
        </section>
        <section class="content-panel detail-panel"><div class="panel-heading"><div><h2>Owner information</h2><p>Primary contact details.</p></div></div>
            <dl class="detail-list"><div><dt>Owner name</dt><dd>{{ $pet->owner_name }}</dd></div><div><dt>Contact number</dt><dd><a href="tel:{{ $pet->contact_number }}">{{ $pet->contact_number }}</a></dd></div><div class="address-row"><dt>Address</dt><dd>{{ $pet->address }}</dd></div></dl>
        </section>
    </div>
@endsection