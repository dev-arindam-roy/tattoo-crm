@extends('dashboard.layouts.app')

@section('content_header')

@if(isset($user))
<section class="content-header">
      <h1>
        All Permissions For User :: <strong>{{ $user->first_name.' '.$user->last_name }} <small>({{ $user->email_id }})</small></strong>
        <!--small>it all starts here</small-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
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
      <a href="{{ route('users_list') }}" class="btn btn-primary">All Users</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title"><strong>All System Permissions</strong></h3>

      <div class="box-tools pull-right">
      <span><mark>You can add & delete any specific permission for this user</mark></span>        
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-sm">
        <thead style="background: #dbdbdb;">
          <tr>
            <th>Permission</th>
            <th>Description</th>
            <th>Add/Delete</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($permissions))
            @foreach($permissions as $perm)
            <tr>
              <td><strong>{{ $perm->name }}</strong></td>
              <td>{{ $perm->description }}</td>
              <td>
                @if($user->hasPermissionTo($perm->id))
                <a href="{{ route('usr.dirt.perm') }}?user={{ $user->id }}&permission={{ $perm->id }}&action=off"><i class="fa fa-2x fa-check base-green" aria-hidden="true"></i></a>
                @else
                <a href="{{ route('usr.dirt.perm') }}?user={{ $user->id }}&permission={{ $perm->id }}&action=on"><i class="fa fa-2x fa-ban base-red" aria-hidden="true"></i></a>
                @endif
              </td>
            </tr>
            @endforeach
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
@endif

@endsection

@push('page_js')
<script type="text/javascript">
$(function() {
  $('.ar-datatable').DataTable({
    "columnDefs": [ {
      "targets": [ 3 ],
      "orderable": false
    } ]
  });
});
</script>
@endpush