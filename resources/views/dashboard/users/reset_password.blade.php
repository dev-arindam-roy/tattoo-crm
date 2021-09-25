@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    Reset Users Password
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users_list') }}">Users List</a></li>
    <li class="active">Reset User Password</li>
  </ol>
</section>
@endsection

@section('content')
<section class="content">

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <a href="{{ route('users_list') }}" class="btn btn-primary"><i class="fa fa-users" aria-hidden="true"></i> All Users</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Reset Password For The User - <b>@if(isset($user_data) && !empty($user_data)){{ ucfirst($user_data->first_name)." ".ucfirst($user_data->last_name) }}@endif</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="@if(isset($user_data) && !empty($user_data)){{ route('upd_pwd', array('utid' => $user_data->timestamp_id)) }}@endif" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Password : <em>*</em></label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Enter Password">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Confirm Password : <em>*</em></label>
                <input type="text" name="re_password" class="form-control" placeholder="Enter Confirm Password">
              </div>
            </div>
          </div>
          <div class="form-group">
            @if(isset($user_data) && !empty($user_data))
            <input type="submit" class="btn btn-primary" value="Update User">
            @endif
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

      password: {
        required: true,
        minlength: 6
      },
      re_password: {
        required: true,
        equalTo: "#password"
      }
    },
    messages: {

      password: {
        required: 'Please Enter Password.',
      },
      re_password: {
        required: 'Please Enter Confirm Password.',
        equalTo: 'Password Not Match, Check.'
      }
    }
});
</script>
@endpush