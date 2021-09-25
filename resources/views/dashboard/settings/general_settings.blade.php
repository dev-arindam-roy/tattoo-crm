@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    General Settings
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">General Settings</li>
  </ol>
</section>
@endsection

@section('content')
<section class="content">

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif
  
  <div class="row">
    <div class="col-md-8">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Website General Settings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="{{ route('sv_gen_sett') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="site_name">Website Name : <em>*</em></label>
              <input type="text" name="site_name" class="form-control" placeholder="Enter Website Name" value="@if(isset($settings) && !empty($settings)){{ $settings->site_name }}@endif">
            </div>
            <div class="form-group">
              <label for="site_tagline">Website Tagline : </label>
              <input type="text" name="site_tagline" class="form-control" placeholder="Enter Website Tagline" value="@if(isset($settings) && !empty($settings)){{ $settings->site_tagline }}@endif">
            </div>
            <div class="form-group">
              <label for="site_description">Website Details : </label>
              <textarea name="site_description" class="form-control" placeholder="Website Details...">@if(isset($settings) && !empty($settings)){{ $settings->site_description }}@endif</textarea>
            </div>
            {{--<div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="site_logo">Website Logo : </label>
                  <input type="file" name="site_logo" id="site_logo">
                  <span class="roy-vali-error" id="ar-site_logo-err"></span>
                </div>
              </div>
              <div class="col-md-6" style="text-align: right;">
                <div class="form-group">
                  @if(isset($settings) && !empty($settings) && $settings->site_logo != '' && $settings->site_logo != null)
                    @php
                    $logoURL = asset('public/uploads/site_logo/thumb/'.$settings->site_logo);
                    @endphp
                    <img src="{{ $logoURL }}" id="site_logo_preview" class="ar_img_preview" 
                    data="{{ $logoURL }}">
                  @else
                  <img src="{{ asset('public/images/no-image.png') }}" id="site_logo_preview" class="ar_img_preview" 
                  data="{{ asset('public/images/no-image.png') }}">
                  @endif
                  <i class="fa fa-times base-red libtn" id="site_logo_rm"></i>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="site_favicon">Website Favicon : </label>
                  <input type="file" name="site_favicon" id="site_favicon">
                  <span class="roy-vali-error" id="ar-site_favicon-err"></span>
                </div>
              </div>
              <div class="col-md-6" style="text-align: right;">
                <div class="form-group">
                  @if(isset($settings) && !empty($settings) && $settings->site_favicon != '' && $settings->site_favicon != null)
                    @php
                    $favURL = asset('public/uploads/site_favicon/24_24/'.$settings->site_favicon);
                    @endphp
                    <img src="{{ $favURL }}" id="site_favicon_preview" class="ar_fav_preview" 
                    data="{{ $favURL }}">
                  @else
                  <img src="{{ asset('public/images/no-image.png') }}" id="site_favicon_preview" class="ar_fav_preview" 
                  data="{{ asset('public/images/no-image.png') }}">
                  @endif
                   <i class="fa fa-times base-red libtn" id="site_favicon_rm"></i>
                </div>
              </div>
            </div>--}}
            
            <!--div class="form-group">
              <label for="display_per_page">Entry Display Per Page : </label>
              <select name="display_per_page" class="form-control">
                <option value="10" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '10') selected="selected" @endif>10 Entries/Page</option>
                <option value="15" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '15') selected="selected" @endif>15 Entries/Page</option>
                <option value="25" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '25') selected="selected" @endif>25 Entries/Page</option>
                <option value="50" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '50') selected="selected" @endif>50 Entries/Page</option>
                <option value="65" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '65') selected="selected" @endif>65 Entries/Page</option>
                <option value="75" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '75') selected="selected" @endif>75 Entries/Page</option>
                <option value="90" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '90') selected="selected" @endif>90 Entries/Page</option>
                <option value="100" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '100') selected="selected" @endif>100 Entries/Page</option>
                <option value="120" @if(isset($settings) && !empty($settings) && $settings->display_per_page == '120') selected="selected" @endif>120 Entries/Page</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date Format :</label>
                  <select name="date_format" class="form-control">
                    <option value="dd-mm-YY" @if(isset($settings) && !empty($settings) && $settings->date_format == 'dd-mm-YY') selected="selected" @endif>dd-mm-YY</option>
                    <option value="dd/mm/YY" @if(isset($settings) && !empty($settings) && $settings->date_format == 'dd/mm/YY') selected="selected" @endif>dd/mm/YY</option>
                    <option value="mm-dd-YY" @if(isset($settings) && !empty($settings) && $settings->date_format == 'mm-dd-YY') selected="selected" @endif>mm-dd-YY</option>
                    <option value="mm/dd/YY" @if(isset($settings) && !empty($settings) && $settings->date_format == 'mm/dd/YY') selected="selected" @endif>mm/dd/YY</option>
                    <option value="dd-mm-YY@h:i@A" @if(isset($settings) && !empty($settings) && $settings->date_format == 'dd-mm-YY@h:i@A') selected="selected" @endif>dd-mm-YY h:i A</option>
                    <option value="dd-mm-YY@H:i" @if(isset($settings) && !empty($settings) && $settings->date_format == 'dd-mm-YY@H:i') selected="selected" @endif>dd-mm-YY H:i</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Timezone :</label>
                  <select name="timezone_id" class="form-control select2" style="border-radius: 0px;">
                    @if(isset($tmzList) && !empty($tmzList))
                      <option value="0">-NONE-</option>
                      @foreach($tmzList as $tm)
                      <option value="{{ $tm->id }}" @if(isset($settings) && !empty($settings) && $settings->timezone_id == $tm->id) selected="selected" @endif>{{ $tm->name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div-->

            <div class="form-group">
              <label>Site Footer Text :</label>
              <input type="text" name="site_footer_text" class="form-control" placeholder="Enter Site Footer Text" value="@if(isset($settings) && !empty($settings)){{ $settings->site_footer_text }}@endif">
            </div>
            <div class="form-group" style="margin-top: 40px;">
              <input type="submit" class="btn btn-primary" value="Save Changes">
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
    <div class="col-md-4">
      
    </div>
  </div>
</section>
@endsection

@push('page_js')
<script type="text/javascript">
$.validator.addMethod('logosize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 2mb.');
$.validator.addMethod('favsize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 500kb.');
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      site_name: {
        required: true,
      },
      site_logo: {
        extension: "jpg|jpeg|png|gif|svg",
        logosize: 2000000,
      },
      site_favicon: {
        extension: "jpg|jpeg|png|gif|ico",
        favsize: 500000,
      },
      subscription_amount: {
        required: true
      }
    },
    messages: {

      site_name:{
        required: 'Please enter website name.',
      },
      site_logo: {
        extension: 'Please upload any image file.'
      },
      site_favicon: {
        extension: 'Please upload any image file or ico file.'
      },
      subscription_amount: {
        required: 'Please enter subscription amount.'
      }

    }
});
</script>
<script>
$(function(){
    
$('.libtn').hide();
$("#site_logo").change('click',function(){
    Ari_SITE_LOGO_Preview(this);
});
    
function Ari_SITE_LOGO_Preview(input_fileupload)
{
    if(input_fileupload.files && input_fileupload.files[0])
    {
        $('#site_logo_rm').show();
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
                    $('#site_logo_preview').attr('src', e.target.result);
                    $("#ar-site_logo-err").html('');
                }
                
                reader.readAsDataURL(input_fileupload.files[0]);
            }
            else
            {
                //alert('Upload .jpg,.png Image only');
                $("#ar-site_logo-err").html('Choose only jpg, png, gif image.');
            }
        }
        else
        {
            //alert('Upload Less Than 200KB Photo');
            $("#ar-site_logo-err").html('Choose less than 2mb image size.');
        }
    }
}

$('#site_logo_rm').on('click', function() {
  $('#site_logo_preview').attr('src', $('#site_logo_preview').attr('data'));
  $(this).hide();
  $("#ar-site_logo-err").html('');
  $('#site_logo').val('');
  $('#site_logo-error').hide();
});

$("#site_favicon").change('click',function(){
    Ari_FAVICON_Preview(this);
});
    
function Ari_FAVICON_Preview(input_fileupload)
{
    if(input_fileupload.files && input_fileupload.files[0])
    {
        $('#site_favicon_rm').show();
        var fs=input_fileupload.files[0].size;
        if(fs<=2000000)
        {
            var fileName=input_fileupload.files[0].name;
            var ext = fileName.split('.').pop().toLowerCase();
            if(ext=="jpg" || ext=="png" || ext=="jpeg" || ext=="gif" || ext=="ico")
            {
                var reader=new FileReader();
                reader.onload = function (e) 
                {
                    $('#site_favicon_preview').attr('src', e.target.result);
                    $("#ar-site_favicon-err").html('');
                }
                
                reader.readAsDataURL(input_fileupload.files[0]);
            }
            else
            {
                //alert('Upload .jpg,.png Image only');
                $("#ar-site_favicon-err").html('Choose only jpg, png, gif image.');
            }
        }
        else
        {
            //alert('Upload Less Than 200KB Photo');
            $("#ar-site_favicon-err").html('Choose less than 2mb image size.');
        }
    }
}

$('#site_favicon_rm').on('click', function() {
  $('#site_favicon_preview').attr('src', $('#site_favicon_preview').attr('data'));
  $(this).hide();
  $("#ar-site_favicon-err").html('');
  $('#site_favicon').val('');
  $('#site_favicon-error').hide();
});

});
</script> 
@endpush