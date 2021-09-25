@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
      <h1>
        All Social Links
        <!--small>it all starts here</small-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Social Links</li>
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
    @can('social-link-create')
      <a href="{{ route('add_social_link') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Link</a>
    @endcan
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title">Social Links List</h3>

      <div class="box-tools pull-right">
        
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-hover table-striped ar-datatable">
        <thead>
          <tr>
            <th>SL</th>
            <th>Action</th>
            <th>Status</th>
            <th>Logo</th>
            <th>Name</th>
            <th>Link</th>
            <th>Order</th>
          </tr>
        </thead>
        <tbody>
        @if(isset($socialLinks))
          @php $sl = 1; @endphp
          @forelse($socialLinks as $slnk)
          <tr>
            <td>{{ $sl }}</td>
            <td>
            @can('social-link-edit')
              <a href="{{ route('edit_social_link', array('id' => $slnk->id)) }}"><i class="fa fa-pencil-square-o base-green fa-2x"></i></a>
            @endcan
            @can('social-link-delete')
              <a href="{{ route('del_social_link', array('id' => $slnk->id)) }}" onclick="return confirm('Sure To Delete This User ?');"><i class="fa fa-2x fa-trash-o base-red"></i></a>
            @endcan
            </td>
            <td>
            @can('social-link-edit')
              @if($slnk->status == '1')
                <a href="{{ route('acInac') }}?id={{ $slnk->id }}&val=2&tab=social_links"> 
                  <i class="fa fa-check-circle-o base-green fa-2x" aria-hidden="true"></i> 
                </a>
              @endif
              @if($slnk->status == '2')
                <a href="{{ route('acInac') }}?id={{ $slnk->id }}&val=1&tab=social_links"> 
                  <i class="fa fa-ban base-red fa-2x" aria-hidden="true"></i>
                </a> 
              @endif
            @endcan
            </td>
            <td>
              <span><i class="{{ $slnk->icon_css_class }} fa-2x"></i></span>
            </td>
            <td>{{ ucfirst($slnk->name) }}</td>
            <td><a href="{{ $slnk->link }}" target="_blank">{{ $slnk->link }}</a></td>
            <td>{{ $slnk->display_order }}</td>
          </tr>
          @php $sl++; @endphp
          @empty
          <tr>
            <td colspan="7">No Users Found!</td>
          </tr>
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
    "order": [[ 6, "asc" ]],
    "columnDefs": [ {
      "targets": [ 3 ],
      "orderable": false
    } ]
  });
});
</script>
@endpush