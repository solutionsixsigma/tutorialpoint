@extends('layouts.userpanel.login')

@section('loginblock')
    <!---------------------------------- Content ----------------------------------------->

 <!--state overview start-->
    <form method="post" class="form-signin" name="loginFrm" id="loginFrm" action="{{route('login-auth')}}">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger" role="alert">{{Session::get('fail')}}</div>
        @endif
        @csrf
        <h2 class="form-signin-heading">sign in now</h2>
        <img src="{{ asset('vendors/img/logo-search.png')}}" class="img-fluid">
        <div class="login-wrap">
            <input type="email" class="form-control" placeholder="User ID" name="auth-email" id="auth-email" autofocus>
            @error('auth-email')<div class="alert alert-danger" role="alert"> {{$message}} </div>@enderror
            <input type="password" class="form-control" placeholder="Password" name="auth-password" id="auth-password">
            @error('auth-password')<div class="alert alert-danger" role="alert"> {{$message}} </div>@enderror
            <!---<label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>--->
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>

        </div>
      </form>
    <!----------------------------------- End Content ------------------------------------>
@endsection
