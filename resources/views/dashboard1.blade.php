@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-4">Welcome, {{ Auth::user()->name }}!</h1>
    <p class="lead">You are successfully logged in to your custom authenticated application.</p>
    <hr class="my-4">
    <p>This is your personalized dashboard.</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn More</a>
</div>
@endsection