@extends('layouts.app', ['pageTitle' => 'Edit pet'])

@section('content')
    <div class="welcome-line"><div><h2>Edit {{ $pet->name }}</h2><p>Update this pet and owner record.</p></div></div>
    <section class="content-panel form-panel"><form action="{{ route('pets.update', $pet) }}" method="POST">@csrf @method('PUT') @include('pets._form', ['editing' => true])</form></section>
@endsection