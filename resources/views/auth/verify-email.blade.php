@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="text-center mb-4">Verify Your Email Address</h2>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <p class="text-center">Before proceeding, please check your email for a verification link.</p>
    <p class="text-center">If you did not receive the email, click the button below to request another.</p>

    <form class="d-inline text-center" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Click here to request another</button>.
    </form>
</div>
@endsection