@extends('dashboard.layouts.app')

@section('content_header')

@if( isset($role) )
<section class="content-header">
      <h1>
        All Permissions For The Role :: <strong>{{ ucwords($role->name) }}</strong>
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
      
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title"><strong>{{ ucwords($role->name) }}</strong> - Permissions</h3>

      <div class="box-tools pull-right">
        @if( isset($thisRoleUsers) && count($thisRoleUsers) > 0 )
        <a href="javascript:void(0);" id="show_uList">Users associated this role ({{ count($thisRoleUsers) }})</a>
        @endif
      </div>

    </div>
    <div class="box-body">
      <div id="uList" style="display: none;">
        @if( isset($thisRoleUsers) && count($thisRoleUsers) > 0 )
          <label><strong>Users list showing below with this role</strong></label>
          <ol>
            @foreach($thisRoleUsers as $user)
              <li>
                {{ $user->first_name }}
              </li>
            @endforeach
          </ol>
          <hr/>
        @endif
      </div>
      <table class="table table-bordered table-hover table-striped ar-datatable">
        <thead>
          <tr>
            <th style="width: 20px;">SL</th>
            <th>Permissions</th>
            <th>Description</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        @if(isset($permissions))
          @php $sl = 1; @endphp
          @forelse($permissions as $perm)
            @if( $role->hasPermissionTo($perm->id) )
            <tr>
              <td>{{ $sl }}</td>
              <td>{{ $perm->name }}</td>
              <td>{{ $perm->description }}</td>
              <td>
                <a href="{{ route('del.permFrole', array('role_id' => $role->id, 'perm_id' => $perm->id)) }}" class="btn btn-xs btn-danger" onclick="return confirm('Sure To Delete The Permission From This Role ?');">Delete This Permission From - <strong>{{ ucwords($role->name) }}</strong></a>
              </td>
            </tr>
            @php $sl++; @endphp
            @endif
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
  $('#show_uList').on('click', function() { 
    $('#uList').slideToggle();
  } );
});
</script>
@endpush