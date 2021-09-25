@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
      <h1>
        All Tattoo Images
        <!--small>it all starts here</small-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">All Tattoo Images</li>
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
      <a href="{{ route('media_img_add') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Tattoo Image</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <form action="" method="get">
      <div class="row">
        <div class="col-md-3">
          <select class="form-control select2" name="group_id">
            <option value="0">Categories</option>
            @if( isset($groups) )
              @foreach( $groups as $val )
              <option value="{{ $val->id }}" @if( isset($_GET['group_id']) && $_GET['group_id'] == $val->id ) selected="selected" @endif>{{ $val->name }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="col-md-5">
          <input type="text" name="src_txt" class="form-control" placeholder="Name or Alt Title or Title" value="@if( isset($_GET['src_txt']) ){{ $_GET['src_txt'] }}@endif">
        </div>
        <div class="col-md-2">
          <select class="form-control" name="status">
            <option value="0">Status</option>
            <option value="1" @if( isset($_GET['status']) && $_GET['status'] == '1' ) selected="selected" @endif>Active</option>
            <option value="2" @if( isset($_GET['status']) && $_GET['status'] == '2' ) selected="selected" @endif>Inactive</option>
          </select>
        </div>
        <div class="col-md-2" style="text-align: right;">
          <input type="submit" class="btn btn-primary" value="Find">
          <a href="{{ route('media_all_imgs') }}" class="btn btn-danger">Cancel</a>
        </div>
      </div>
      </form>
    </div>
    <div class="box-body">
      <form name="frmx4" action="{{ route('media_img_multidel') }}" method="post">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-3">
          <input type="submit" class="btn btn-xs btn-danger" value="Delete Selected" disabled="disabled" id="delAll" onclick="return confirm('Are You Sure To Delete Selected Tattoo Images ?');">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th><input type="checkbox" id="ckAll"></th>
                <th style="width: 100px;">Action</th>
                <th>Status</th>
                <th>Image</th>
                <th>Title</th>
                <th>Size</th>
                <th>Extension</th>
                <th>Category</th>
              </tr>
            </thead>
            <tbody>
            @if(isset($allImages))
              @php $sl = 1; @endphp
              @forelse($allImages as $img)
              <tr class="x">
                <td>
                {{ $sl }}
                <input type="checkbox" name="imgIds[]" value="{{ $img->id }}" class="ckbs">
                </td>
                <td>
                  <a href="{{ route('media_img_detl', array('id' => $img->id)) }}"><i class="fa fa-pencil-square-o fa-2x base-green"></i></a>
                  <a href="{{ route('media_img_del', array('id' => $img->id)) }}" onclick="return confirm('Sure To Delete This Image ?');"><i class="fa fa-trash-o fa-2x base-red"></i></a>
                </td>
                <td>
                  @if($img->status == '1')
                    <a href="{{ route('acInac') }}?id={{ $img->id }}&val=2&tab=image"> 
                      <i class="fa fa-check-circle-o base-green fa-2x" aria-hidden="true"></i> 
                    </a>
                  @endif
                  @if($img->status == '2')
                    <a href="{{ route('acInac') }}?id={{ $img->id }}&val=1&tab=image"> 
                      <i class="fa fa-ban base-red fa-2x" aria-hidden="true"></i>
                    </a> 
                  @endif
                </td>
                <td>
                  <img src="{{ asset('public/uploads/files/media_images/thumb/'. $img->image) }}" style="width: 60px;" class="img-thumbnail">
                </td>
                <td>{{ $img->title }}</td>
                <td>{{ round(($img->size / 1024), 2) }} KB</td>
                <td>{{ $img->extension }}</td>
                <td>
                  @if( isset($img->getCatSubcat) && !empty($img->getCatSubcat) )
                    @if( isset($img->getCatSubcat->categoryInfo) && !empty($img->getCatSubcat->categoryInfo) )
                      {{ $img->getCatSubcat->categoryInfo->name }}
                    @endif
                  @endif
                </td>
              </tr>
              @php $sl++; @endphp
              @empty
              <tr>
                <td colspan="8">No Records Found!</td>
              </tr>
              @endforelse
            @endif
            </tbody>
          </table>
        </div>
      </div>
      </form>
      <div class="pull-right"> 
      @if(isset($allImages) && !empty($allImages)) {{ $allImages->appends(request()->query())->links() }} @endif
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

    </section>
@endsection

@push('page_js')
<script type="text/javascript">
$( function() {
  $("#ckAll").on('click',function(){
    var isCK = $(this).is(':checked');
    if(isCK == true){
      $('.ckbs').prop('checked', true);
      $('#delAll').removeAttr('disabled');
    }
    if(isCK == false){
      $('.ckbs').prop('checked', false);
      $('#delAll').attr('disabled', 'disabled');
    }
    colMark();
    $('#delAll').val('Delete Selected');
  });
  $(".ckbs").on('click', function(){
    var c = 0;
    $(".ckbs").each(function(){
      colMark();
      if($(this).is(':checked')){
        c++;
      }
    });
    if(c == 0){
      $("#ckAll").prop('checked', false);
      $('#delAll').attr('disabled', 'disabled');
    }
    if(c > 0){
      $("#ckAll").prop('checked',true);
      $('#delAll').removeAttr('disabled');
    }
    $('#delAll').val('Delete Selected ('+c+')');
  });
} );
function colMark() {
  $( '.ckbs' ).each(function() {
    if($(this).is(':checked')) {
      $(this).parents('tr').css('background-color', '#ffe6e6');
    } else {
      $(this).parents('tr').removeAttr('style');
    }
  });
}
</script>
@endpush