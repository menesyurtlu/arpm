@extends('layout')

@section('content')
    <div class="login-form-wrapper">
        <form class="login-form" method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" value="test@example.com" name="email" class="form-control" id="emailInput" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" value="123456" name="password" class="form-control" id="passwordInput" placeholder="******">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-full" type="submit">Login</button>
            </div>
        </form>
    </div>
@endsection
