@extends('dashboard.layouts.app')

@push('page_css')
<style type="text/css">
li.arimg_box {
  float: left;
  padding: 8px;
  list-style: none;
  text-align: center;
  color: #a3a375;
  font-weight: 600;
}
.thumbnail {
  margin-bottom:2px;
}
.ibox {
  text-align: left;
  color: #a3a375;
  font-weight: 600;
  margin-bottom:10px;
}
.ibox span {
  margin-left: 6px;
}
</style>
@endpush

@section('content_header')
<section class="content-header">
  <h1>
    @if(isset($imgcat))
    Edit Tattoo Category
    @else
    Add Tattoo Category
    @endif
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('media_all_img_cats') }}">All Tattoo Categories</a></li>
  </ol>
</section>
@endsection

@section('content')

<form name="frm" id="frmx" action="@if(isset($imgcat)){{ route('media_img_cats_upd', array('id' => $imgcat->id)) }}@else{{ route('media_img_cats_save') }}@endif" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

<section class="content">

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <a href="{{ route('media_all_img_cats') }}" class="btn btn-primary"> All Tattoo Categories</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">@if(isset($imgcat)) Edit Tattoo Image Category @else Add Tattoo Image Category @endif</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Tattoo Image Category : <em>*</em></label>
                <input type="text" name="name" id="catName" class="form-control" placeholder="Enter Tattoo Image Category Name" value="@if( isset($imgcat) ){{ $imgcat->name }}@endif">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Tattoo Short Description : </label>
                <textarea name="description" class="form-control">@if( isset($imgcat) ){{ $imgcat->description }}@endif</textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2" style="margin-top: 26px;">
              @if( isset($imgcat) )
              <input type="submit" class="btn btn-primary" value="Save Changes" style="width: 100%;">
              @else
              <input type="submit" class="btn btn-primary" value="Create Category" style="width: 100%;">
              @endif
            </div>

            <div class="col-md-4"></div>

            <div class="col-md-2">
              <div class="form-group">
                <label>Status : </label>
                <select name="status" class="form-control">
                  <option value="1" @if( isset($imgcat) && $imgcat->status == '1' ) selected="selected" @endif>Active</option>
                  <option value="2" @if( isset($imgcat) && $imgcat->status == '2' ) selected="selected" @endif>Inactive</option>
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label>Display Order : </label>
                <input type="text" name="display_order" class="form-control onlyNumber" @if( isset($imgcat) ) value="{{ $imgcat->display_order }}" @else value="0" @endif>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </div>
  </div>

</section>

</form>

@endsection

@push('page_js')
<script src="{{ asset('public/assets/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$('#frmx').validate({
  errorElement: 'span',
  errorClass : 'roy-vali-error',
  ignore: [],
  normalizer: function( value ) {
    return $.trim( value );
  },
  rules: {

    name: {
      required: true,
      minlength: 3
    }
  },
  messages: {

    name: {
      required: 'Please Enter Tattoo Category Name.'
    }
  },
  errorPlacement: function(error, element) {
    element.parent('.form-group').addClass('has-error');
    if (element.attr("data-error-container")) { 
      error.appendTo(element.attr("data-error-container"));
    } else {
      error.insertAfter(element); 
    }
  },
  success: function(label) {
    label.closest('.form-group').removeClass('has-error');
  }
});
</script>
@endpush