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

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12" style="margin : 0 auto; text-align: center">
				<h1>Sistem Informasi PMW</h1>
				<h2>Universitas Negeri Surabaya</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<ul class="nav nav-tabs ">
					<li class=""><a data-toggle="tab" href="#login" aria-expanded="false">Login</a></li>
					<li class="active"><a data-toggle="tab" href="#daftar" aria-expanded="true">Daftar</a></li>
					<li class=""><a data-toggle="tab" href="#lupapass" aria-expanded="false">Reset Password</a></li>
				</ul>
				<div class="tab-content bg">
					<div id="login" class="tab-pane fade">
						<div class="panel-default login-panel panel">
							<div class="panel-body">
								<form id="formLogin" role="form" action="/pmw/login.php" method="post" autocomplete="off">
									<fieldset>
										<div class="form-group">
											<input required="" class="form-control nim" placeholder="NIM/NIP" name="id_unesa" type="text" autocomplete="on">
										</div>
										<div class="form-group">
											<input name="form" type="hidden" value="login">
											<input required="" class="form-control" placeholder="Password" name="password" type="password" value="">
										</div>
										<button type="submit" id="submit_button" class="btn btn-default">Login</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
					<div id="daftar" class="tab-pane fade active in">
						<div class="panel-default login-panel panel">
							<div class="panel-body">
								<form role="form" action="{{ route('loginz') }}" method="post">
									<fieldset>
										<div class="form-group">
											<input required="" class="form-control nim" placeholder="NIM/NIP" name="id_unesa" type="text" autofocus="" autocomplete="on">
										</div>
										<div class="form-group">
											<input required="" class="form-control" placeholder="Email" name="email" type="email" value="" autocomplete="on">
											<input name="form" type="hidden" value="daftar">
										</div>
										<button type="submit" class="btn btn-default">Daftar</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
					<div id="lupapass" class="tab-pane fade">
						<div class="panel-default login-panel panel">
							<div class="panel-body">
								<form role="form" action="/pmw/login.php" method="post">
									<fieldset>
										<div class="form-group">
											<input name="form" type="hidden" value="lupapass">
											<input required="" class="form-control" placeholder="Email" name="email" type="email" value="" autocomplete="on">
										</div>
										<!-- Change this to a button or input when using this as a form -->
										<button type="submit" class="btn btn-default">Kirim</button>
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