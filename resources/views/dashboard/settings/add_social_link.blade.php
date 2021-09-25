@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    @if(isset($DataLink) && !empty($DataLink))
    Edit Social link
    @else
    Add New Social Link
    @endif
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    @if(isset($DataLink) && !empty($DataLink))
    <li class="active">Edit Social Link</li>
    @else
    <li class="active">Add Social Link</li>
    @endif
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
    @can('social-link-view')
      <a href="{{ route('social_links') }}" class="btn btn-primary"> All Social Links</a>
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
          <h3 class="box-title">
          @if(isset($DataLink) && !empty($DataLink))
          Edit Social Links
          @else
          Add Social Links
          @endif
          </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="@if(isset($DataLink) && !empty($DataLink)){{ route('upd_social_link', array('id' => $DataLink->id)) }}@else{{ route('sve_social_link') }}@endif" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Social Name : <em>*</em></label>
                <input type="text" name="name" class="form-control" placeholder="Enter Social Name" value="@if(isset($DataLink) && !empty($DataLink)){{ $DataLink->name }}@endif">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Order :</label>
                <input type="text" name="display_order" class="form-control onlyNumber" 
                value="@if(isset($DataLink)){{ $DataLink->display_order }}@endif">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Social Link : <em>*</em></label>
                <input type="url" name="link" class="form-control" placeholder="Enter Social Link" value="@if(isset($DataLink) && !empty($DataLink)){{ $DataLink->link }}@endif">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Social icon class : <em></em></label> <span><small>Just copy & paste icon class. ex: fa fa-whatsapp</small></span>
                <input type="text" name="icon_css_class" class="form-control" placeholder="Enter fontawesome icon class, Ex: fa fa-whatsapp" value="@if(isset($DataLink) && !empty($DataLink)){{ $DataLink->icon_css_class }}@endif">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" style="margin-top: 26px;">
                <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">Click here to get Social icon class</a>
              </div>
            </div>
          </div>
          <div class="form-group">
            @if(isset($DataLink) && !empty($DataLink))
            <input type="submit" class="btn btn-primary" value="Update Social Link">
            @else
            <input type="submit" class="btn btn-primary" value="Save Social Link">
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
$.validator.addMethod('logosize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 2mb.');
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      name: {
        required: true,
        minlength: 3
      },
      link: {
        required: true,
        url: true
      },
      display_order: {
        required: true,
        number: true
      },
      icon_css_class: {
        required: true
      }
    },
    messages: {

      name: {
        required: 'Please Enter Social Name.',
        
      },
      link: {
        required: 'Please Enter Social Link.',
        url: 'Please Enter Valid Link.'
      },
      icon_css_class: {
        required: 'Please Icon class.'
      },
      display_order: {
        required: 'Enter Order number.',
        number: 'Not Valid number.'
      }
    }
});
$(function(){
    
$('.libtn2').hide();
$("#social_icon").change('click',function(){
    Ari_SOCIAL_ICON_Preview(this);
});
    
function Ari_SOCIAL_ICON_Preview(input_fileupload)
{
    if(input_fileupload.files && input_fileupload.files[0])
    {
        $('#social_icon_rm').show();
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
                    $('#social_icon_preview').attr('src', e.target.result);
                    $("#ar-social_icon-err").html('');
                }
                
                reader.readAsDataURL(input_fileupload.files[0]);
            }
            else
            {
                //alert('Upload .jpg,.png Image only');
                $("#ar-social_icon-err").html('Choose only jpg, png, gif image.');
            }
        }
        else
        {
            //alert('Upload Less Than 200KB Photo');
            $("#ar-social_icon-err").html('Choose less than 2mb image size.');
        }
    }
}

$('#social_icon_rm').on('click', function() {
  $('#social_icon_preview').attr('src', $('#social_icon_preview').attr('data'));
  $(this).hide();
  $("#ar-social_icon-err").html('');
  $('#social_icon').val('');
  $('#social_icon-error').hide();
});

});
</script>
@endpush