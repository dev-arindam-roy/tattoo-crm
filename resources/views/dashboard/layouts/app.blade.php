@include('dashboard.layouts.partials.header')

<!-- Site wrapper -->
<div class="wrapper">

  
  @include('dashboard.layouts.partials.top_header')

  @include('dashboard.layouts.partials.left_sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    @yield('content_header')
    

    <!-- Main content -->
    @yield('content')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('dashboard.layouts.partials.footer_bar')

   <!--@include('dashboard.layouts.partials.right_sidebar')-->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('dashboard.layouts.partials.footer')