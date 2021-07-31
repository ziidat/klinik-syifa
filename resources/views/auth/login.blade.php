<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Klinik Syifa Medikana</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template') }}/dist/css/login.css">

<body>

<div class="container fade-in-form" id="container">
	
	<div class="form-container sign-in-container">
		<form name="form" method="get" action="/">
		<?php
          if(isset($_GET['pesan']) && ($_GET['pesan']== "gagal")){
            echo "<p><font color='red'>Email atau Password Salah!!!</font></p><hr>";
          }
        ?>
			<h1>Klinik Syifa Medikana</h1>
			<div class="social-container">
				
			</div>
			
			<input type="text" id="login" name="username" placeholder="Username" />
			<input type="password" name="password" id="password" placeholder="Password" />
			
			<button class="button button-hvr">LOGIN</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right" style=
            "background: url('{{ asset('img') }}/bglogin.png')" >
			</div>
		</div>
	</div>
	
</div>

<footer>
	<p class="fade-in-form">
		Created  by
		<a  target="_blank" href="#">KZR_PIKAI TEAM</a>
		
		
	</p>
</footer>
</body>
</html>