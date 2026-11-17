@extends('layouts.app', ['pageTitle' => 'Add a pet'])

@section('content')
    <div class="welcome-line"><div><h2>New pet record</h2><p>Enter the pet and owner details below.</p></div></div>
    <section class="content-panel form-panel"><form action="{{ route('pets.store') }}" method="POST">@csrf @include('pets._form')</form></section>
@endsection