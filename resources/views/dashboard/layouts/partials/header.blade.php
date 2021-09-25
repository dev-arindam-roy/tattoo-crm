@php
$siteName = "ArindamDASH";
$faviconURL = asset('public/images/favicon.png');
if( function_exists( 'getGeneralSettings' ) ) {
  $arrs = getGeneralSettings();
  if( $arrs->site_name != '' && $arrs->site_name != null ) {
  $siteName = trim($arrs->site_name);
  }
  if( $arrs->site_favicon != '' && $arrs->site_favicon != null ) {
  $faviconURL = asset('public/uploads/site_favicon/24_24/'.$arrs->site_favicon);
  }
}
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Developed By : Arindam Roy  -->
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
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/select2/dist/css/select2.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/sweet_alert/sweetalert.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/assets/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/toastr/toastr.min.css') }}" />

  <link rel="stylesheet" href="{{ asset('public/assets/ar_style.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">
  .btn-box-tool {
    display: none;
  }
  .toast {
      opacity: 1 !important;
  }
  #toast-container > div {
      opacity: 1 !important; 
  }
  .toast-container {
    position:absolute;
    top:95px;
    right:15px;
    height:auto;
  }
  </style>
  @stack('page_css')
</head>
<body class="hold-transition skin-blue sidebar-mini">