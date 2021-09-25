@extends('dashboard.layouts.app')


@section('content_header')
<section class="content-header">
  <h1>
    Add Edit Vendor
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Vendor Management</li>
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
      <a href="{{ route('vendor_list') }}" class="btn btn-primary"><i class="fa fa-users" aria-hidden="true"></i> All Vendors</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Create Vendor</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="@if(isset($user_data)){{ route('vendor_update', array('user_timestamp_id' => $user_data->timestamp_id)) }}@else{{ route('vendor_save') }}@endif" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name : <em>*</em></label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="@if(isset($user_data) && !empty($user_data)){{ $user_data->first_name }}@endif">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name : <em>*</em></label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="@if(isset($user_data) && !empty($user_data)){{ $user_data->last_name }}@endif">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email-id : <em>*</em></label>
                <input type="email" name="email_id" class="form-control" placeholder="Enter Email-Id" value="@if(isset($user_data) && !empty($user_data) && strpos($user_data->email_id, '@') !== false){{ $user_data->email_id }}@endif" autocomplete="off">
                @if($errors->has('email_id'))
                <span class="roy-vali-error"><small>{{$errors->first('email_id')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Number : </label>
                <input type="text" name="contact_no" class="form-control onlyNumber" placeholder="Enter Contact Number" autocomplete="off" value="@if(isset($user_data) && !empty($user_data)){{ $user_data->contact_no }}@endif">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save Vendor">
              </div>
            </div>
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
function AutoGeneratePassword() 
{
  var length = 8,
      charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
      retVal = "";
  for (var i = 0, n = charset.length; i < length; ++i) {
      retVal += charset.charAt(Math.floor(Math.random() * n));
  }
  return retVal;
}
$( function() {
  $("body").on('keypress', '.onlyNumber', function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  });
  $('#pwdToggle').on('click', function() {
    if($('#pwd').attr('type') == 'password') {
      $('#pwd').attr('type', 'text');
      $(this).find('.fa').addClass('fa-eye-slash').removeClass('fa-eye');
    } else {
      $('#pwd').attr('type', 'password');
      $(this).find('.fa').addClass('fa-eye').removeClass('fa-eye-slash');
    }
  });
  $('#autoPWD').on('click', function() {
    $('#pwd').val(AutoGeneratePassword());
  });
  $('#role_ids').select2({
    placeholder: "Select a Role(s)"
  });
});
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      'role_ids[]': {
        required: true
      },
      first_name: {
        required: true,
        minlength: 2
      },
      last_name: {
        required: true,
        minlength: 2
      },
      contact_no: {
        required: true,
        maxlength: 12,
        digits: true
        //number: true
      }
    },
    messages: {

      'role_ids[]': {
        required: 'Please Select Role.'
      },
      first_name: {
        required: 'Please Enter First Name.'
      },
      last_name: {
        required: 'Please Enter Last Name.'
      },
      email_id: {
        required: 'Please Enter Email-id.',
        email: 'Please Enter Valid Email-id.'
      },
      contact_no: {
        required: 'Please Enter Contact Number.'
      }

    },
    errorPlacement: function(error, element) {
      element.parent('.form-group').addClass('has-error');
      if (element.attr("data-error-container")) { 
        error.appendTo(element.attr("data-error-container"));
      } else if (element.hasClass('select2')) {
        error.insertAfter(element.next('span'));
      } else {
        error.insertAfter(element); 
      }
    }
});
$(function () { 
  $('.moduleAll').on('change', function() {
    if($(this).is(':checked')) {
      $('.' + $(this).attr('id')).attr('checked', 'checked');
      $('.' + $(this).attr('id')).prop('checked', true);
    } else {
      $('.' + $(this).attr('id')).removeAttr('checked');
      $('.' + $(this).attr('id')).prop('checked', false);
    }
  });
  $('#allAccess').on('click', function() {
    $('.all-privileges').attr('checked', 'checked');
    $('.moduleAll').attr('checked', 'checked');
    $('.all-privileges').prop('checked', true);
    $('.moduleAll').prop('checked', true);
  });
  $('#rmAllAccess').on('click', function() {
    $('.all-privileges').removeAttr('checked');
    $('.moduleAll').removeAttr('checked');
    $('.all-privileges').prop('checked', false);
    $('.moduleAll').prop('checked', false);
  });
});
</script>
@endpush