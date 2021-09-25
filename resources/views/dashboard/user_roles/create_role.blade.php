@extends('dashboard.layouts.app')

@section('content_header')
@role('user-management')
<section class="content-header">
      <h1>
        
        {{$pageHeading}}
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
      
    </div>
    <div class="col-md-6">
    </div>
  </div>

  <!-- Default box -->
  <div class="box" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title">Role & Permissions</h3>

      <div class="box-tools pull-right">
        
      </div>
    </div>
    <div class="box-body">
      <form name="frmx" id="frmx" action="@if(isset($role)){{ route('updRole', array('role_id' => $role->id)) }}@else{{ route('addRole') }}@endif" method="POST">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Role Name : <em>*</em></label>
              <input type="text" name="name" class="form-control" placeholder="Role Name" value="@if(isset($role)){{ $role->name }}@endif">
            </div>
            <div class="form-group">
              <label>Description : </label>
              <textarea name="description" class="form-control" placeholder="Role Description..">@if(isset($role)){{ $role->description }}@endif</textarea>
            </div>
          </div>
          <div class="col-md-6">
            @if(isset($role))
            <input type="submit" class="btn btn-success" value="Save Changes" style="margin-top: 22px;">
            <a href="{{ route('allRoles') }}" class="btn btn-danger" style="margin-top: 22px;">Cancel</a>
            @else
            <input type="submit" class="btn btn-primary" value="Create Role" style="margin-top: 22px;">
            @endif
          </div>
        </div>
        <div class="row"><div class="col-md-12"><hr/></div></div>
        <div class="row">
          <div class="col-md-6">
            <h3><strong>All System Permissions</strong></h3>
            <input type="button" id="ckbAll" class="btn btn-sm btn-success" value="Check All">
            <input type="button" id="unckbAll" class="btn btn-sm btn-default" value="Uncheck All">
            <span id="ckb_perm_error"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <tr>
                @if(isset($permissions))
                  @php $i = 0; @endphp
                  @foreach($permissions as $perm)
                    @if( $i % 4 == 0 )
                      <tr></tr>
                    @endif
                    <td>
                      <input type="checkbox" name="permids[]" class="ckbs" value="{{ $perm->id }}" @if( isset($role) && $role->hasPermissionTo($perm->id) ) checked="checked" @endif>
                      <span>{{ $perm->name }}</span>
                    </td>
                  @php $i++; @endphp
                  @endforeach
                @endif
              </tr>
            </table>
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

    </section>
@endrole 
@endsection

@push('page_js')
<script type="text/javascript">
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      name: {
        required: true
      },
      "permids[]": {
        required: true
      }
    },
    messages: {

      name: {
        required: 'Please Enter Role Name.'
      },
      "permids[]": {
        required: 'Please select any permision.'
      }
    },
    errorPlacement: function(error, element) {
      if (element.attr("type") == "checkbox") { 
        $('#ckb_perm_error').html(error);
      } else {
        error.insertAfter(element); 
      }
    }
});
$( function() { 
  $('#ckbAll').on('click', function() { 
    $('.ckbs').prop('checked', true);
  } );
  $('#unckbAll').on('click', function() { 
    $('.ckbs').prop('checked', false);
  } );
} );
</script>
@endpush