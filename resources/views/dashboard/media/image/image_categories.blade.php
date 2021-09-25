@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
      <h1>
        All Tattoo Image Categories
        <!--small>it all starts here</small-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tattoo Image Categories</li>
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
      <a href="{{ route('media_img_cats_crte') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> 
      Create New Category</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title">All Tattoo Categories</h3>

      <div class="box-tools pull-right">
        
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-hover table-striped ar-datatable display nowrap" style="width: 100%;">
        <thead>
          <tr>
            <th style="width: 30px;">SL</th>
            <th style="width: 80px;">Action</th>
            <th style="width: 60px;">Status</th>
            <th>Name</th>
            <th>Created</th>
            <th>Modified</th>
          </tr>
        </thead>
        <tbody>
        @if(isset($allCats))
          @php $sl = 1; @endphp
          @forelse($allCats as $cat)
          <tr>
            <td>{{ $sl }}</td>
            <td>
              <a href="{{ route('media_img_cats_edt', array('id' => $cat->id)) }}"><i class="fa fa-pencil-square-o fa-2x base-green"></i></a>
              <a href="{{ route('media_img_cats_del', array('id' => $cat->id)) }}" onclick="return confirm('Sure To Delete This Category ?');"><i class="fa fa-trash-o fa-2x base-red"></i></a>
            </td>
            <td>
              @if($cat->status == '1')
                <a href="{{ route('acInac') }}?id={{ $cat->id }}&val=2&tab=image_category"> 
                  <i class="fa fa-check-circle-o base-green fa-2x" aria-hidden="true"></i> 
                </a>
              @endif
              @if($cat->status == '2')
                <a href="{{ route('acInac') }}?id={{ $cat->id }}&val=1&tab=image_category"> 
                  <i class="fa fa-ban base-red fa-2x" aria-hidden="true"></i>
                </a> 
              @endif
            </td>
            <td>
              {{ $cat->name }}
            </td>
            <td>{{ date('d-m-Y', strtotime($cat->created_at)) }}</td>
            <td>{{ date('d-m-Y', strtotime($cat->updated_at)) }}</td>
          </tr>
          @php $sl++; @endphp
          @empty
          @endforelse
        @endif
        </tbody>
      </table>
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
$(function() {
  $('.ar-datatable').DataTable({
    "columnDefs": [ {
      "targets": [ 1,2 ],
      "orderable": false
    } ]
  });
});
</script>
@endpush