<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title></title>
</head>

<body style="background-color: #EEEEEE">
<div class="container">
<!-- <div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				<center><img src="{{asset('img/logounesa.png')}}" width="60%"/></center>
			</div>
		</div> -->
    <div class="row" style="margin-top: 50px">
        <div class="col-lg-12" style="margin : 0 auto; text-align: center; color: #333333">
            <h1>Sistem Informasi PMW</h1>
            <h2>Universitas Negeri Surabaya</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="nav nav-tabs "
                style="background-color: #FFFFFF; border-top-left-radius: 7px; border-top-right-radius: 7px">
                <li class="active"><a data-toggle="tab" href="#login" aria-expanded="true">Login</a></li>
                <li class=""><a data-toggle="tab" href="#daftar" aria-expanded="false">Daftar</a></li>
                <li class=""><a data-toggle="tab" href="#lupapass" aria-expanded="false">Reset Password</a></li>
            </ul>
            <div class="tab-content bg">
                {{-- Login Form --}}
                <div id="login" class="tab-pane fade active in">
                    <div class="panel-default login-panel panel">
                        <div class="panel-body">
                            <form id="formLogin" role="form" action="/pmw/login.php" method="post" autocomplete="off">
                                <fieldset>
                                    <div class="form-group">
                                        <label>NIM/NIP</label>
                                        <input required="" class="form-control nim" placeholder="NIM/NIP"
                                               name="id_unesa" type="text" autocomplete="on">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="form" type="hidden" value="login">
                                        <input required="" class="form-control" placeholder="Password" name="password"
                                               type="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-2">
                                            <button type="submit" id="submit_button" class="btn btn-primary">Login
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Daftar Form --}}
                <div id="daftar" class="tab-pane fade">
                    <div class="panel-default login-panel panel">
                        <div class="panel-body">
                            <form role="form" action="{{ route('loginz') }}" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label>NIM/NIP</label>
                                        <input required="" class="form-control nim" placeholder="NIM/NIP"
                                               name="id_unesa" type="text" autofocus="" autocomplete="on">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input required="" class="form-control" placeholder="Email" name="email"
                                               type="email" value="" autocomplete="on">
                                        <input name="form" type="hidden" value="daftar">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Reset Password --}}
                <div id="lupapass" class="tab-pane fade">
                    <div class="panel-default login-panel panel">
                        <div class="panel-body">
                            <form role="form" action="/pmw/login.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="form" type="hidden" value="lupapass">
                                        <input required="" class="form-control" placeholder="Email" name="email"
                                               type="email" value="" autocomplete="on">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>

</html>