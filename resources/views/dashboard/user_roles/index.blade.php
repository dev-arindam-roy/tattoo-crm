@extends('dashboard.layouts.app')

@section('content_header')
@role('user-management')
<section class="content-header">
      <h1>
        All Roles
        <!--small>it all starts here</small-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
@endrole     
@endsection

@section('content')
@role('user-management')
<section class="content">

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <!--<a href="{{ route('crtRole') }}" class="btn btn-primary">Add New Role</a>-->
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title">User Roles</h3>

      <div class="box-tools pull-right">
        
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-hover table-striped ar-datatable">
        <thead>
          <tr>
            <th style="width: 20px;">SL</th>
            <th>Role Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th style="width: 140px;">Action</th>
          </tr>
        </thead>
        <tbody>
        @if(isset($roles))
          @php $sl = 1; @endphp
          @forelse($roles as $rl)
          <tr>
            <td>{{ $sl }}</td>
            <td>
              <a href="{{ route('shw.role_Perm', array('role_id' => $rl->id)) }}">{{ ucwords( $rl->name ) }}</a>
            </td>
            <td>{{ $rl->description }}</td>
            <td>{{ date('d-m-Y', strtotime( $rl->created_at )) }}</td>
            <td>
              <!--<a href="{{ route('delRole', array('role_id' => $rl->id)) }}" class="btn btn-xs btn-danger" onclick="return confirm('Sure to delete this role ? All users associated with this role has lost the permissions.');">Delete</a>-->
              <a href="{{ route('mngRolePerm', array('role_id' => $rl->id)) }}" class="btn btn-xs btn-success">Edit & Manage</a>
            </td>
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
@endrole 
@endsection

@push('page_js')
<script type="text/javascript">
$(function() {
  $('.ar-datatable').DataTable({
    "columnDefs": [ {
      "targets": [ 0,4 ],
      "orderable": false
    } ]
  });
});
</script>
@endpush