@extends('layouts.app')

@section('content')
<div class="row" style="margin-top: 20px">
    <div class="col-lg-12" style="margin : 0 auto; text-align: center; color: #333333">
        <h2>Sistem Informasi PMW</h2>
        <h2 style="margin-top: 10px">Universitas Negeri Surabaya</h2>
    </div>
</div>
<div class="row" style="margin-top: 30px">
    <div class="col-md-6 col-md-offset-3">
        <ul class="nav nav-tabs " style="background-color: #FFFFFF; border-top-left-radius: 4px; border-top-right-radius: 4px; padding-left: 0;">
            <li class="active"><a data-toggle="tab" href="#login" aria-expanded="true">Login</a></li>
            <li class=""><a data-toggle="tab" href="#daftar" aria-expanded="false">Daftar</a></li>
            <li class=""><a data-toggle="tab" href="#lupapass" aria-expanded="false">Reset Password</a></li>
        </ul>
        <div class="tab-content bg">
            <div id="login" class="tab-pane fade active in">
                <div class="panel-default login-panel panel">
                    <div class="panel-body">
                        <form id="formLogin" role="form" action="{{ route('login') }}" method="post" autocomplete="off">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                    <label style="color: #111111">NIM/NIP</label>
                                    <input required="" class="form-control nim" placeholder="NIM/NIP" name="id" id="id" type="text" autocomplete="on" value="{{old('id')}}" required autofocus>
                                    @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label style="color: #111111">Password</label>
                                    <input name="form" type="hidden" value="login">
                                    <input required class="form-control" placeholder="Password" name="password" type="password" id="password">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <div class="checkbox">
                                            <label style="color: #111111">
                                        		<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    		</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-offset-3 col-lg-3">
                                        <button type="submit" id="submit_button" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div id="daftar" class="tab-pane fade">
                @if(Session::has('message'))
                    <p class="alert alert-notif">
                        {{ Session::get('message') }}
                    </p>
                @endif
                <div class="panel-default login-panel panel">
                    <div class="panel-body">
                        <form role="form" action="{{ route('register') }}" method="post">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                    <label style="color: #111111">NIM/NIP</label>
                                    <input class="form-control nim" placeholder="NIM/NIP" name="id" id="id" type="text" value="{{ old('id') }}" required autofocus autocomplete="on">
                                    @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label style="color: #111111">Email</label>
                                    <input class="form-control" placeholder="Email" name="email" type="email" value="{{ old('email') }}" required autocomplete="on">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-9 col-lg-3">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div id="lupapass" class="tab-pane fade">
                <div class="panel-default login-panel panel">
                    <div class="panel-body">
                        <form role="form" action="{{ route('reset.password') }}" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label style="color: #111111">Email</label>
                                    <input name="form" type="hidden" value="lupapass">
                                    <input required="" class="form-control" placeholder="Email" name="email" type="email" value="" autocomplete="on">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-9 col-lg-3">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/auth.js') }}"></script>

@endsection