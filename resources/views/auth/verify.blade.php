@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-envelope-open-text fa-4x text-primary mb-3"></i>
                        <h2 class="fw-bold mb-3">Check Your Email</h2>
                        <p class="text-muted mb-4">
                            We've sent a verification link to your email address. Please click the link to verify your account.
                        </p>
                    </div>

                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>A fresh verification link has been sent to your email address.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="mb-4">
                        <p class="text-muted small mb-3">Didn't receive the email?</p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="fas fa-redo me-2"></i>Resend Verification Email
                            </button>
                        </form>
                    </div>

                    <div class="border-top pt-4">
                        <p class="text-muted small mb-0">
                            Wrong email? <a href="{{ route('logout') }}" class="text-decoration-none">Sign out</a> and create a new account.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
