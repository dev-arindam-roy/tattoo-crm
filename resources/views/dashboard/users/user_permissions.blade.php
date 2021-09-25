@extends('dashboard.layouts.app')

@section('content_header')
@if(isset($user_data) && !empty($user_data))
<section class="content-header">
  <h1>
    Manage Permission For - <strong>{{ $user_data->first_name . ' ' . $user_data->last_name  }}</strong>
    <span>({{ $user_data->email_id }})</span>
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users_list') }}">Users List</a></li>
    <li class="active">Update User</li>
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
    @can('admin-view')
      <a href="{{ route('users_list') }}" class="btn btn-primary"><i class="fa fa-users" aria-hidden="true"></i> All Users</a>
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
          <h3 class="box-title">Update User Permissions</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="@if(isset($user_data) && !empty($user_data)){{ route('update_user_permission', array('utid' => $user_data->timestamp_id)) }}@endif" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-12">
                <h3>Select Permissions 
                  <a href="javascript:void(0);" id="allAccess" class="btn btn-success pull-right" style="margin-left:5px;">Grant All Privileges</a>
                  <a href="javascript:void(0);" id="rmAllAccess" class="btn btn-danger pull-right">Remove All Privileges</a>
                </h3>
                <table class="table table-bordered">
                    <thead style="background-color:#ccc;">
                        <tr>
                            <th style="width:40%;">Module Name</th>
                            <th style="width:40%;">Module Permissions</th>
                            <th style="width:20%">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($dashboardModules) && !empty($dashboardModules))
                            @foreach($dashboardModules as $module)
                                <tr>
                                    <th style="vertical-align:middle;">
                                      {{ $module->name }}
                                    </th>
                                    <td>
                                        @if(isset($module->modulePermissions) && !empty($module->modulePermissions))
                                            <ul>
                                                @foreach($module->modulePermissions as $permission)
                                                    <li style="list-style : none;">
                                                        <input type="checkbox" class="module_{{ $module->id }} all-privileges" 
                                                        name="permission_ids[]" value="{{ $permission->id }}"
                                                        @if(!empty($user_permissions) && in_array($permission->id , $user_permissions))
                                                        checked="checked" @endif>
                                                        &nbsp; {{ $permission->display_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                      <input type="checkbox" class="moduleAll" id="module_{{ $module->id }}"> Check All Permissions
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Permissions">
              </div>
            </div>
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
@endif
@endsection

@push('page_js')
<script>
$(function () { 
  $('.moduleAll').on('change', function() {
    if($(this).is(':checked')) {
      $('.' + $(this).attr('id')).attr('checked', 'checked');
      $('.' + $(this).attr('id')).prop('checked', true);
    } else {
      $('.' + $(this).attr('id')).removeAttr('checked');
      $('.' + $(this).attr('id')).prop('checked', false);
    }
  });
  $('#allAccess').on('click', function() {
    $('.all-privileges').attr('checked', 'checked');
    $('.moduleAll').attr('checked', 'checked');
    $('.all-privileges').prop('checked', true);
    $('.moduleAll').prop('checked', true);
  });
  $('#rmAllAccess').on('click', function() {
    $('.all-privileges').removeAttr('checked');
    $('.moduleAll').removeAttr('checked');
    $('.all-privileges').prop('checked', false);
    $('.moduleAll').prop('checked', false);
  });
});
</script>
@endpush