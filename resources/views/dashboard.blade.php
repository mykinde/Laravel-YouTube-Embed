@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Welcome, {{ Auth::user()->name }}!</h3>
                </div>
                <div class="card-body">
                    <p class="lead">This is your personalized dashboard. Here you can find a quick overview and access important features of your account.</p>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('verified'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Your email has been successfully verified!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Conditional alert for unverified email --}}
                    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !Auth::user()->hasVerifiedEmail())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Your email address is not verified. Please check your email for a verification link, or <a href="{{ route('verification.notice') }}">click here to resend</a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        {{-- User Information Card --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5>Account Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                    {{-- Display roles if using Spatie package 
                    @if (Auth::user()->roles->isNotEmpty())
                        <p><strong>Roles:</strong>
                            @foreach (Auth::user()->roles as $role)
                                <span class="badge bg-secondary">{{ $role->name }}</span>
                            @endforeach
                        </p>
                    @endif
                  --}}  <hr>
                    <a href="#" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Change Password</a>
                </div>
            </div>
        </div>

        {{-- Quick Links / Actions Card --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#" class="text-decoration-none">View My Orders <span class="badge bg-primary rounded-pill float-end">3</span></a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="text-decoration-none">My Wishlist <span class="badge bg-primary rounded-pill float-end">5</span></a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="text-decoration-none">Manage My Posts <span class="badge bg-primary rounded-pill float-end">12</span></a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="text-decoration-none">Notifications <span class="badge bg-danger rounded-pill float-end">New!</span></a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="text-decoration-none">Support & Help</a>
                        </li>
                    </ul>
                    <hr>
                    {{-- Admin Dashboard Link (only for admins) --}}
                    @auth
                        @if (Auth::user()->is_admin) {{-- Using the simple is_admin flag --}}
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning mt-2 w-100">
                                <i class="bi bi-person-gear"></i> Go to Admin Dashboard
                            </a>
                        @endif
                        {{-- If using Spatie roles, you could do: --}}
                        {{-- @role('Admin|Super Admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning mt-2 w-100">
                                <i class="bi bi-person-gear"></i> Go to Admin Dashboard
                            </a>
                        @endrole --}}
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- You can add more rows and columns here for other dashboard sections --}}
    {{-- Example: Recent Activity --}}
    <div class="row justify-content-center">
        <div class="col-md-10 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5>Recent Activity</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">You placed a new order. <span class="float-end text-muted">2 hours ago</span></li>
                        <li class="list-group-item">Your post "My First Blog Post" was published. <span class="float-end text-muted">yesterday</span></li>
                        <li class="list-group-item">New item added to your wishlist. <span class="float-end text-muted">3 days ago</span></li>
                    </ul>
                    <hr>
                    <a href="#" class="btn btn-sm btn-outline-secondary">View All Activities</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection