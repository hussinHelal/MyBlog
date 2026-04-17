@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-user me-2"></i> Profile
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-4 text-center col-md-4 mb-md-0">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode($user->name) }}"
                                 class="mb-3 rounded-circle"
                                 alt="Profile Picture"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            <h5 class="mt-2">{{ $user->name }}</h5>
                            <p class="text-muted small">{{ $user->email }}</p>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3 row">
                                <div class="col-sm-4"><strong>Name:</strong></div>
                                <div class="col-sm-8">{{ $user->name }}</div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-4"><strong>Email:</strong></div>
                                <div class="col-sm-8">{{ $user->email }}</div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-4"><strong>Member Since:</strong></div>
                                <div class="col-sm-8">{{ $user->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-4"><strong>Email Verified:</strong></div>
                                <div class="col-sm-8">
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Verified
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Not Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('settings') }}" class="btn btn-primary">
                        <i class="fas fa-cog me-2"></i>Edit Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
