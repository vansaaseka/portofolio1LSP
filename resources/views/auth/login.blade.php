<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/new.css') }}">
</head>

<body class="hold-transition login-page">
<div class="wrapper">
        <div class="logo">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            LO
        </div>
        @if (session('error'))
          <div class="alert alert-danger text-center">
            {{ session('error') }}
          </div>
        @endif
        @if (session('success'))
          <div class="alert alert-success text-center">
            {{ session('success') }}
          </div>
        @endif
        <form action="{{ url('/login77') }}" method="post">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button type="submit "class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a>do u have not account? <a href="{{ url('/register77') }}">Sign up</a></a>
        </div>
    </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>