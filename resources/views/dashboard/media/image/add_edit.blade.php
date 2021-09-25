@extends('dashboard.layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{ asset('public/assets/bs_multi_select/bootstrap-multiselect.css') }}">
<style type="text/css">
li.arimg_box {
  float: left;
  padding: 8px;
  list-style: none;
  text-align: center;
  color: #a3a375;
  font-weight: 600;
}
</style>
@endpush

@section('content_header')
<section class="content-header">
  <h1>
    @if( isset($imgInfo) )
      Edit Tattoo Image
    @else
      Add Tattoo Image
    @endif
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('media_all_imgs') }}">All Tattoo Images</a></li>
    <li>Tattoo Image Details</li>
  </ol>
</section>
@endsection

@section('content')
<section class="content">

  <form name="frm" id="frmx" action="@if( isset($imgInfo) ){{ route('media_img_Upd', array('id' => $imgInfo->id)) }}@else{{ route('media_img_upload') }}@endif" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <a href="{{ route('media_all_imgs') }}" class="btn btn-primary"> All Tattoo Images</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tattoo Image Information</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          @if( isset($imgInfo) )
          <div class="row">
             <div class="col-md-8">
              @php
              $image_path_org = 'public/uploads/files/media_images/'. $imgInfo->image;
              $image_path_thumb = 'public/uploads/files/media_images/thumb/'. $imgInfo->image;
              if( file_exists( $image_path_org ) ) {
                list($width_o, $height_o) = getimagesize( $image_path_org );
              }
              if( file_exists( $image_path_thumb ) ) {
                list($width_t, $height_t) = getimagesize( $image_path_thumb );
              }
              @endphp
              <table class="table table-bordered table-striped">
                <tr>
                  <th style="width: 200px;">Name : </th>
                  <td style="text-align: left;">{{ $imgInfo->name }}</td>
                </tr>
                <tr>
                  <th style="width: 200px;">Size : </th>
                  <td style="text-align: left;">{{ sizeFilter($imgInfo->size) }}</td>
                </tr>
                <tr>
                  <th style="width: 200px;">Extension : </th>
                  <td style="text-align: left;">{{ $imgInfo->extension }}</td>
                </tr>
                @if( file_exists($image_path_thumb) )
                <tr>
                  <th style="width: 200px;">Type : </th>
                  <td style="text-align: left;">{{ File::mimeType( 'public/uploads/files/media_images/thumb/'. $imgInfo->image ) }}</td>
                </tr>
                @endif
                @if( isset($width_o) && isset($height_o) )
                <tr>
                  <th style="width: 200px;">Orininal Dimensions : </th>
                  <td style="text-align: left;">{{ $width_o }} x {{ $height_o }}</td>
                </tr>
                @endif
                @if( isset($width_t) && isset($height_t) )
                <tr>
                  <th style="width: 200px;">Thumb Dimensions : </th>
                  <td style="text-align: left;">{{ $width_t }} x {{ $height_t }}</td>
                </tr>
                @endif
                <tr>
                  <th style="width: 200px;">Uploaded Date : </th>
                  <td style="text-align: left;">{{ date('d F, Y', strtotime( $imgInfo->created_at) ) }}</td>
                </tr>
                @if( $imgInfo->updated_at != null )
                <tr>
                  <th style="width: 200px;">Modified Date : </th>
                  <td style="text-align: left;">{{ date('d F, Y', strtotime( $imgInfo->updated_at) ) }}</td>
                </tr>
                @endif
                <tr>
                  <th style="width: 200px;">Uploaded By : </th>
                  <td style="text-align: left;">
                    @if( isset($imgInfo->userInfo) )
                    {{ $imgInfo->userInfo->first_name }} {{ $imgInfo->userInfo->last_name }}
                    @endif
                  </td>
                </tr>
              </table>
             </div>
             <div class="col-md-4">
               <div class="form-group">
                <img src="{{ asset('public/uploads/files/media_images/thumb/'. $imgInfo->image) }}" class="img-thumbnail">
               </div>
             </div>
          </div>
          <hr/>
          @else
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Upload Tattoo Image(s) : <em>*</em></label>
                <input type="file" name="images[]" multiple="multiple" accept="image/*" required="required">
              </div>
            </div>
          </div>
          @endif

          
          <div class="row">
             <div class="col-md-8">
              @if( isset($imgInfo) )
               <div class="form-group">
                 <label>Change Image : </label>
                 <input type="file" name="image" accept="image/*">
               </div>
              @endif
               <div class="form-group">
                <label>Name : <em>*</em></label>
                <input type="text" name="name" class="form-control" placeholder="Enter Image Name" value="@if( isset($imgInfo) ){{ $imgInfo->name }}@endif">
               </div>
               <div class="form-group">
                <label>Alt Text : <em>*</em></label>
                <input type="text" name="alt_title" class="form-control" placeholder="Enter Image Alt Text" value="@if( isset($imgInfo) ){{ $imgInfo->alt_title }}@endif">
               </div>
               <div class="form-group">
                <label>Title : <em>*</em></label>
                <input type="text" name="title" class="form-control" placeholder="Enter Image Title" value="@if( isset($imgInfo) ){{ $imgInfo->title }}@endif">
               </div>
               <div class="form-group">
                <label>Caption : </label>
                <textarea name="caption" class="form-control" style="height: 100px;" placeholder="Enter Image Caption">@if( isset($imgInfo) ){{ $imgInfo->caption }}@endif</textarea>
               </div>
               <div class="form-group">
                <label>Description : </label>
                <textarea name="description" class="form-control" style="height: 100px;" placeholder="Enter Image Details">@if( isset($imgInfo) ){{ $imgInfo->description }}@endif</textarea>
               </div>
               <div class="form-group">
                <label>Select Category :</label>
                <select name="image_category_id" id="image_category_id" class="form-control select2">
                  <option value="0">-SELECT CATEGORY-</option>
                  @if( isset($allImgCats) )
                    @foreach( $allImgCats as $ic )
                    <option value="{{ $ic->id }}" @if(isset($imgInfo) && isset($imgInfo->getCatSubcat) && !empty($imgInfo->getCatSubcat) && $imgInfo->getCatSubcat->image_category_id == $ic->id) selected="selected" @endif>{{ $ic->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save Details">
              </div>
             </div>
             <div class="col-md-4">
              <div class="form-group">
                <label>Status :</label>
                <select name="status" class="form-control">
                  <option value="1" @if( isset($imgInfo) && $imgInfo->status == '1') selected="selected" @endif>Active</option>
                  <option value="2" @if( isset($imgInfo) && $imgInfo->status == '2') selected="selected" @endif>Inactive</option>
                </select>
              </div>
             </div>
          </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </div>
  </div>

  </form>
</section>
@endsection

@push('page_js')
<script src="{{ asset('public/assets/bs_multi_select/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">
$('#frmx').validate({
  errorElement: 'span',
  errorClass : 'roy-vali-error',
  ignore: [],
  rules: {

    name: {
      required: true
    },
    alt_title: {
      required: true
    },
    title: {
      required: true
    }
  },
  messages: {

    name: {
      required: 'Please Enter Image Name.'
    },
    alt_title: {
      required: 'Please Enter Image Alt Title.'
    },
    title: {
      required: 'Please Enter Image Title.'
    }
  }
});
</script>
@endpush