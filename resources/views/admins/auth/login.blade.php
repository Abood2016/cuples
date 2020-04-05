<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>تسجيل دخول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  {{-- <link rel="stylesheet" href="../../dist/css/bootstrap-rtl.min.css"> --}}
  <!-- template rtl version -->
  {{-- <link rel="stylesheet" href="../../dist/css/custom-style.css"> --}}
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
      <b>تسجيل دخول</b>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">تسجيل  دخول</p>

      <form action="{{route('admin.login')}}" method="post">
        @csrf
        
          @if($errors->any())
            <div class="alert alert-danger" style="">
              <ul>
                @foreach($errors->all() as $error)
                  <li style="">{{ $error }} </li>
                @endforeach
              </ul>
            </div>
          @endif

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control text-right" placeholder="الإیمیل" value="{{ old('email') }}">
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>

    

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control text-right" placeholder="كلمة المرور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
      <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">دخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="login.html" class="text-center">هل لديك حساب ؟</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
