@extends('layout.master')
@section('content')
<div class="container">
    <form action="/login" method="POST">
        @csrf
        <h1>LOGIN</h1>
            <div class="mb-3">
                <label for="InputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail1" name='email' aria-describedby="emailHelp">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="InputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="InputPassword1" name='password'>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('login.google') }}">
                <button type="button" class="btn border border-secondary btn-google">
                    <i class="fa fa-google mr-2"></i>or Sign with Google
                </button>
            </a>
        </form>
</div>
@endsection
