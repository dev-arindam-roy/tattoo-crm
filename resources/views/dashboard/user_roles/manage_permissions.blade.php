@extends('dashboard.layouts.app')

@push('page_css')
<style type="text/css">
.mt10 {
  margin-top: 5px;
}
</style>
@endpush


@section('content_header')
@if( isset($role) )
<section class="content-header">
  <h1>
    Manage Role Based Permisions
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('allRoles') }}">All Users Roles</a></li>
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
      <a href="{{ route('allRoles') }}" class="btn btn-primary"><i class="fa fa-shield" aria-hidden="true"></i> All Roles</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Permissions For Role :: [<strong>{{ ucwords( $role->name ) }}</strong>]</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          <form name="frm" id="frmx" action="{{ route('sveRlPerm', array('role_id' => $role->id)) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          @if( isset($permissions) )
            <div class="row">
              <div class="col-md-12">
                <input type="button" id="setAll" class="btn btn-primary btn-sm" value="Set All Privileges">
                <input type="button" id="rmvAll" class="btn btn-danger btn-sm" value="Remove All Privileges">
                <input type="submit" class="btn btn-success btn-sm pull-right" value="Save Permissions" disabled="disabled">
              </div>
            </div>
            <div class="row">
              @foreach($permissions as $perm)
              <div class="col-md-3 mt10">
                <input type="checkbox" name="permissions[]" class="ckbc" value="{{ $perm->id }}" @if( $role->hasPermissionTo( $perm->id ) ) checked="checked" @endif> 
                {{ ucwords($perm->name) }}
              </div>
              @endforeach
            </div>
            <div class="row" style="margin-top: 20px;">
              <div class="col-md-6">
                <input type="submit" class="btn btn-success btn-sm" value="Save Permissions" disabled="disabled">
              </div>
            </div>
          @endif
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
<script type="text/javascript">
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      role_name: {
        required: true
      }
    },
    messages: {

      role_name: {
        required: 'Please Enter Role Name.'
      }
    }
});
$( function() {
  $('#setAll').on('click', function() {
    $('.ckbc').prop('checked', true);
    $('input[type="submit"]').removeAttr('disabled'); 
  } );
  $('#rmvAll').on('click', function() {
    $('.ckbc').prop('checked', false);
    $('input[type="submit"]').attr('disabled', 'disabled'); 
  } );
  $('.ckbc').each( function() {
    if( $(this).is(':checked') ) {
      $('input[type="submit"]').removeAttr('disabled');
    }
  } );
  $('.ckbc').on('click', function() {
    var c= 0;
    $('.ckbc').each( function() {
      if( $(this).is(':checked') ) {
        c++;
      }
    } );
    if( c > 0 ) { 
      $('input[type="submit"]').removeAttr('disabled'); 
    } else {
      $('input[type="submit"]').attr('disabled', 'disabled'); 
    }
  } );
} );
</script>
@endpush