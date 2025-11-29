@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-2 ">
    <div class="row mb-4 p-3 border border-dark-subtle w-100">
        <div class="col">

         {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form action="{{ route('register') }}" method="POST" class="login-form">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">name</label>
                    <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="Password_Confirmation" class="form-label">Confirm_Password</label>
                    <input type="Password_Confirmation" class="form-control" id="password" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success rounded-pill">Register</button>
            </form>
    </div>
</div>
@endsection


