@php
$siteName = "ArindamDASH";
$footText = "Copyright - ArindamDASH - Allright Reserved.";
$faviconURL = asset('public/images/favicon.png');
$logo = "";
if( function_exists( 'getGeneralSettings' ) ) {
  $arrs = getGeneralSettings();
  if( $arrs->site_name != '' && $arrs->site_name != null ) {
  $siteName = trim($arrs->site_name);
  }
  if( $arrs->site_favicon != '' && $arrs->site_favicon != null ) {
  $faviconURL = asset('public/uploads/site_favicon/24_24/'.$arrs->site_favicon);
  }
  if( $arrs->site_logo != '' && $arrs->site_logo != null ) {
  $logo = asset('public/uploads/site_logo/thumb/'.$arrs->site_logo);
  }
  if( $arrs->site_footer_text != '' && $arrs->site_footer_text != null ) {
  $footText = trim($arrs->site_footer_text);
  }
}
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $siteName }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="{{ $faviconURL }}" type="image/gif" sizes="16x16">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/assets/plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('public/assets/ar_style.css') }}">

  <style type="text/css">
  html, body {
  width:100%;
  height:100%;
  margin:0;
  padding:0;
  border:0;
  outline:0;
  vertical-align:baseline;
  background:transparent;
  background-position: center;
  background-repeat: no-repeat;
  background-image: url("{{ asset('public/images/bg.jpg') }}");
}
.login-overlay {
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.1); 
}
.login-box {
  position: absolute; 
  top: 0px; 
  left: 35%;
  z-index: 9999; 
  background-color:#fff;
  border-radius: 4px;
  box-shadow: 0px 0px 4px #fff;
}
</style>
</head>
<body>
<div class="login-overlay"></div>
<div class="login-box">
  <div class="login-logo" style="margin-top:20px;">
    @if( $logo != '' )
    <img src="{{ $logo }}">
    @endif
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if(Session::has('msg'))
    <div class="alert alert-danger" style="text-align: center; padding: 4px;">{{ Session::get('msg') }}</div>
    @endif
    <p class="login-box-msg">
    <span style="font-size: 18px;"><strong>{{ $siteName }}</strong></span><br/>@if( isset($name) )Hi, {{ $name }}@endif - Reset Your Password</p>

    <form name="frm" id="frmx" action="{{ route('post_reset_pwd', array('token' => $token)) }}" method="post" autocomplete="off">
    {{ csrf_field() }}
      
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="New Password" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Re-enter Password" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
    <div style="text-align:center">
      <br/><a href="{{ route('dashboard_login') }}">Administrator Login</a><br>
    </div>

  </div>
  <!-- /.login-box-body -->
  <p style="text-align: center; margin-top: 20px;"><span style="font-weight: 600;">{{ $footText }}</span></p>
</div>
<div id="particles-js"></div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('public/assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/assets/plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/assets/jquery_validator/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/jquery_validator/additional-methods.min.js') }}"></script>

<!-- scripts -->

<script>
$(function () {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' /* optional */
  });
});
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      password: {
        required: true,
        minlength: 6
      },
      repassword: {
        equalTo: "#password"
      }
    },
    messages: {

      password: {
        required: 'Please enter password.'
      },
      repassword: {
        equalTo: "Confirm Password Not Match."
      }
    }
});
</script>
</body>
</html>
