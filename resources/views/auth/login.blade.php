<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Klinik Syifa Medikana</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('template') }}/dist/css/bootstrap.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('css')}}/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
    <form method="POST" action="{{ route('login') }}">
        @csrf
    <img class="mb-4" src="{{ asset('img') }}/logologin.png" alt="" width="200" height="200">
    <h1 class="h3 mb-3 fw-normal">Klinik Syifa Medikana</h1>

    <div class="form-floating">
      <input type="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput"  name="username" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="user">
      <label for="floatingInput">Username</label>
      @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" required autocomplete="current-password" placeholder="Password">
      <label for="floatingPassword">Password</label>
      @error('password')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Klinik Syifa Medikana 2021</p>
  </form>
</main>


    
  </body>
</html>
