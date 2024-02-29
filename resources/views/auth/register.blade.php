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
            -V34210
        </div>
        <form action="{{ url('/register77') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="name" id="userName" placeholder="Nama Lengkap">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="email" name="email" id="pwd" placeholder="Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-envelope"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-image"></span>
                <input type="file" name="foto" id="pwd" placeholder="Upload Foto">
            </div>
            <div class="row">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <!-- /.col -->
          </div>
            <button type="submit "class="btn mt-3">SignUp</button>
        </form>
        <div class="text-center fs-6">
            <a>Have account?</a><a href="{{ url('/') }}"> Login</a>
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