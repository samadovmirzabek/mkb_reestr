<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/assets/img/logomk.jpg">

    <title>MIKROKREDITBANK</title>
    @include('admin.partials.css')
</head>
<body >
    <div class="container" style="margin-top:100px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-12"> <img src="/assets/img/logomkb.jpg" class="senter" alt="Logo" width="250" height="70" 
                        style="display: block;
                        margin-left: auto;
                        margin-right: auto;
                        "/> 
                        </div>
                    </div>    
                    <div style="text-align: center;" class="card-header"><h4 style="color:Darkblue;font-family:verdana">KOMPYUTER TEXNIKALAR REESTRI.</h4></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row mb-3">
                                    <label for="email" class="col-md-3 col-form-label text-md-end"></label>

                                    <div class="col-md-6">
                                        <input id="email"  placeholder="Loginni kiriting!" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-3 col-form-label text-md-end"></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" placeholder="Parolni kiriting!" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Saqlab qolish') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary form-control"  style="color:yellow">
                                            {{ __('Kirish') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admin.partials.js')
@yield('script')
</body>
</html>
