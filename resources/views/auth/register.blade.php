@extends('layouts.app_login')
@section('title','Register')

@section('content')

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="register-content">
    <div class="logo">
        <h1>Sistem Pendukung Keputusan Rekrutmen Pengurus HMTI</h1>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="register-box card rounded">
                                
                <form method="POST" class="register-form col-12" action="{{ route('doRegister') }}">
                    @csrf
                    <h3 class="register-head"><i class="fa fa-lg fa-fw fa-user"></i>REGISTER</h3>

                    <div class="form-group">
                        <label for="nim" class="col-form-label">{{ __('NIM') }}</label>

                        <div>
                            <input id="nim" type="number" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" placeholder="NIM"  required autocomplete="nim">

                            @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="col-form-label">{{ __('Nama') }}</label>

                        <div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="Nama" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Password" required autocomplete="new-password">
                            <p style="text-align: right; margin-bottom:-20px" class="text-danger">* Pasword harus minimal 8 karakter.</p>
                            <!-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class=" col-form-label">{{ __('Confirm Password') }}</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group btn-container">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        
                        <a class="btn btn-link offset-md-3" href="{{ route('login') }}">
                            {{ __('Sudah memiliki akun ?') }}</a>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
    @endsection