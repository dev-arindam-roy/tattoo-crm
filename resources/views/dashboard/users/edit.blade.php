@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    Edit User
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users_list') }}">Users List</a></li>
    <li class="active">Update User</li>
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
    @can('admin-view')
      <a href="{{ route('users_list') }}" class="btn btn-primary"><i class="fa fa-users" aria-hidden="true"></i> All Users</a>
    @endcan
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Update User</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="@if(isset($user_data) && !empty($user_data)){{ route('upd_user', array('utid' => $user_data->timestamp_id)) }}@endif" method="post" enctype="multipart/form-data">
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
                <input type="email" name="email_id" class="form-control" placeholder="Enter Email-Id" value="@if(isset($user_data) && !empty($user_data)){{ $user_data->email_id }}@endif">
                @if($errors->has('email_id'))
                <span class="roy-vali-error"><small>{{$errors->first('email_id')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Number : </label>
                <input type="text" name="contact_no" class="form-control onlyNumber" placeholder="Enter Contact Number" value="@if(isset($user_data) && !empty($user_data)){{ $user_data->contact_no }}@endif">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Address :</label>
                <textarea name="address" class="form-control" placeholder="Enter Address...">@if(isset($user_data) && !empty($user_data)){{ $user_data->address }}@endif</textarea>
              </div>
              <div class="form-group">
                <label>Gender :</label>
                <input type="radio" name="sex" value="Male" @if(isset($user_data) && !empty($user_data) && $user_data->sex != null && $user_data->sex == 'Male' && $user_data->sex != '') checked="checked" @else checked="checked" @endif> Male
                <input type="radio" name="sex" value="Female" @if(isset($user_data) && !empty($user_data) && $user_data->sex == 'Female') checked="checked" @endif> Female
              </div>
              <div class="form-group">
                <label>Status :</label>
                <input type="radio" name="status" value="1" @if(isset($user_data) && !empty($user_data) && $user_data->status == '1') checked="checked" @endif> Active
                <input type="radio" name="status" value="2" @if(isset($user_data) && !empty($user_data) && $user_data->status == '2') checked="checked" @endif> Inactive
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>User Image :</label>
                    <input type="file" name="image" id="user_image">
                    <span class="roy-vali-error" id="ar-user_image-err"></span>
                  </div>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <div class="form-group">
                    @if(isset($user_data) && !empty($user_data) && $user_data->image != '' && $user_data->image != null)
                      @php
                      $imageURL = asset('public/uploads/user_images/thumb/'.$user_data->image);
                      @endphp
                      <img src="{{ $imageURL }}" id="user_image_preview" class="ar_img_preview" data="{{ $imageURL }}">
                    @else
                      <img src="{{ asset('public/images/user-avatar.png') }}" id="user_image_preview" class="ar_img_preview" 
                      data="{{ asset('public/images/user-avatar.png') }}">
                    @endif
                    <i class="fa fa-times base-red libtn" id="user_image_rm"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create User">
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
$( function() {
  $("body").on('keypress', '.onlyNumber', function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  });
  $('#role_ids').select2({
    placeholder: "Select a Role(s)"
  });
});
$.validator.addMethod('logosize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 2mb.');
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      'role_ids[]': {
        required: true
      },
      first_name: {
        required: true,
        minlength: 3
      },
      last_name: {
        required: true,
        minlength: 2
      },
      email_id: {
        required: true,
        email: true
      },
      contact_no: {
        maxlength: 12,
        digits: true
        //number: true
      },
      status: {
        required: true
      },
      image: {
        extension: "jpg|jpeg|png|gif|svg",
        logosize: 2000000,
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
      image: {
        extension: 'Please upload any image file.'
      }
    }
});
$(function(){
    
$('.libtn').hide();
$("#user_image").change('click',function(){
    Ari_USER_IMAGE_Preview(this);
});
    
function Ari_USER_IMAGE_Preview(input_fileupload)
{
    if(input_fileupload.files && input_fileupload.files[0])
    {
        $('#user_image_rm').show();
        var fs=input_fileupload.files[0].size;
        if(fs<=2000000)
        {
            var fileName=input_fileupload.files[0].name;
            var ext = fileName.split('.').pop().toLowerCase();
            if(ext=="jpg" || ext=="png" || ext=="jpeg" || ext=="gif")
            {
                var reader=new FileReader();
                reader.onload = function (e) 
                {
                    $('#user_image_preview').attr('src', e.target.result);
                    $("#ar-user_image-err").html('');
                }
                
                reader.readAsDataURL(input_fileupload.files[0]);
            }
            else
            {
                //alert('Upload .jpg,.png Image only');
                $("#ar-user_image-err").html('Choose only jpg, png, gif image.');
            }
        }
        else
        {
            //alert('Upload Less Than 200KB Photo');
            $("#ar-user_image-err").html('Choose less than 2mb image size.');
        }
    }
}

$('#user_image_rm').on('click', function() {
  $('#user_image_preview').attr('src', $('#user_image_preview').attr('data'));
  $(this).hide();
  $("#ar-user_image-err").html('');
  $('#user_image').val('');
  $('#user_image-error').hide();
});
});
</script>
@endpush