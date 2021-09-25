@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    My Profile
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Update Profile</li>
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
          <h3 class="box-title">Update My Information</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="{{ route('upd_profile') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>My Role :</label>
                @php
                  $roles = '';
                  if( isset(Auth::user()->roles) ){
                    foreach( Auth::user()->roles as $rl ) {
                      $roles .= ucfirst( $rl->name ).',';
                    }
                  }
                @endphp
                <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="{{ rtrim($roles,',') }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name : <em>*</em></label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{ Auth::user()->first_name }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name : <em>*</em></label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{ Auth::user()->last_name }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email-id : <em>*</em></label>
                <input type="email" name="email_id" class="form-control" placeholder="Enter Email-Id" value="{{ Auth::user()->email_id }}">
                @if($errors->has('email_id'))
                <span class="roy-vali-error"><small>{{$errors->first('email_id')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Number : </label>
                <input type="text" name="contact_no" class="form-control onlyNumber" placeholder="Enter Contact Number" value="{{ Auth::user()->contact_no }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Address :</label>
                <textarea name="address" class="form-control" placeholder="Enter Address...">{{ Auth::user()->address }}</textarea>
              </div>
              <div class="form-group">
                <label>Gender :</label>
                <input type="radio" name="sex" value="Male" @if(Auth::user()->sex != '' && Auth::user()->sex != null) @if(Auth::user()->sex == 'Male') checked="checked" @endif @else checked="checked" @endif> Male
                <input type="radio" name="sex" value="Female" @if(Auth::user()->sex == 'Female') checked="checked" @endif> Female
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
                    @if(Auth::user()->image != '' && Auth::user()->image != null)
                      @php
                      $imageURL = asset('public/uploads/user_images/thumb/'.Auth::user()->image);
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
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Save Changes">
          </div>
          </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{ route('cng_pwd') }}"><i class="fa fa-key" aria-hidden="true"></i> Change Your Password ?</a>
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
});
$.validator.addMethod('logosize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 2mb.');
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      role_id: {
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
      image: {
        extension: "jpg|jpeg|png|gif|svg",
        logosize: 2000000,
      }
    },
    messages: {

      role_id: {
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
$(function() {
    
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