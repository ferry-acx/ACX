@extends('layouts.app')

@section('content')
<div class="login container-py">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login__grid">
                <div class="login__item">
                    <div class="login__title">
                        <img src="../images/desktop-logo.svg" alt="" width="200">
                        <h3 class="text-uppercase">Attendance System</h3>
                    </div>

                    <div class="login__image">
                        <img src="../images/desktop-person.png" alt="" width="450">
                    </div>

                    <div class="login__input">
                        <form action="{{ route('admin.check2') }}" method="post" autocomplete="off">
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if (Session::get('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                            @csrf

                            <div class="form-group row">
                                <div class="col">
                                    <input id="text" type="username"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        required autocomplete="username" autofocus placeholder="Username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary col">
                                        {{ __('Log In') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection