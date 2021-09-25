@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    Change My Password
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Reset Password</li>
  </ol>
</section>
@endsection

@section('content')
<section class="content">

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif

  
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Reset Password</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="{{ route('save_pwd') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Current Password : <em>*</em></label>
                <input type="text" name="current_password" class="form-control" placeholder="Enter Current Password">
              </div>
              <div class="form-group">
                <label>New Password : <em>*</em></label>
                <input type="text" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password">
              </div>
              <div class="form-group">
                <label>Confirm Password : <em>*</em></label>
                <input type="text" name="re_password" class="form-control" placeholder="Enter Confirm Password">
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Change Password">
          </div>
          </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </div>
  </div>

</section>
@endsection

@push('page_js')
<script type="text/javascript">
$('#frmx').validate({
    //onkeyup: false,
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      current_password: {
        required: true
      },
      new_password: {
        required: true,
        minlength: 6
      },
      re_password: {
        required: true,
        equalTo: "#new_password"
      }
    },
    messages: {

      current_password: {
        required: 'Please Enter Current Password.'
      },
      new_password: {
        required: 'Please New Enter Password.',
      },
      re_password: {
        required: 'Please Enter Confirm Password.',
        equalTo: 'Password Not Match, Check.'
      }
    }
});
</script>
@endpush