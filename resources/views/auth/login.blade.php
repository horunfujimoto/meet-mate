@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #FFCCCC;">{{ __('ログイン') }}</div>

                <div class="card-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('メールアドレス') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" :value="old('email')" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('パスワード') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">{{ __('パスワードを記憶する') }}</label>
                        </div>

                        <div class="d-flex justify-content-end">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none me-3" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れてしまった方はこちら') }}
                                </a>
                            @endif

                            <button type="submit" class="btn" style=" background-color: #FF6699; color: white; font-size: 1.2rem;">{{ __('ログイン') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection