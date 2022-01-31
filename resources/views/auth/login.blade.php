@extends('layouts.app_login')
@section('title','Login')

@section('content')

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    
    <img style="margin-top: 10px; height: 120px;width: auto;" src="{{asset('assets/images/logohmti.png')}}" alt="User Image">
    <div class="logo text-center">
        <h1>Sistem Pendukung Keputusan Rekrutmen Pengurus HMTI</h1>
    </div>

    <div class="login-box rounded">
        
        <form  method="post" class="login-form" action="{{ route('doLogin') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            
            <div class="form-group">
                <label class="control-label">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>
            <div class="form-group">
                <label class="control-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
            </div>
            {{-- <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div> --}}
                    

            <div class="form-group btn-container ">
                <button class="btn btn-primary btn-block"> {{ __('Login') }}
                </button>
                {{-- @if (Route::has('password.request'))
                    <a class="btn btn-link offset-md-2" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif --}}
                <a class="btn btn-link offset-md-2" href="{{ route('register') }}">
                    {{ __('Belum memiliki akun ?') }}
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
