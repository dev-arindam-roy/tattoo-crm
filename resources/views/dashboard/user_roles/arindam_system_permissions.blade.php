@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
      <h1>
        All System Permissions
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
      <form name="frmx" id="frmx" action="@if(isset($editPermission)){{ route('sysPerm_Upd', array('id' => $editPermission->id)) }}@else{{ route('sysPerm_Add') }}@endif" method="POST">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Permission Name : <em>*</em></label>
              <input type="text" name="name" class="form-control" placeholder="Permission name" @if(isset($editPermission)) value="{{ $editPermission->name }}" readonly="readonly" @endif>
            </div>
            <div class="form-group">
              <label>Description : </label>
              <textarea name="description" class="form-control" placeholder="Permission description">@if(isset($editPermission)){{ $editPermission->description }}@endif</textarea>
            </div>
          </div>
          <div class="col-md-5">
            @if(isset($editPermission))
            <input type="submit" class="btn btn-success" value="Save Changes" style="margin-top: 22px;">
            <a href="{{ route('sysPerm') }}" class="btn btn-danger" style="margin-top: 22px;">Cancel</a>
            @else
            <input type="submit" class="btn btn-primary" value="Add Permission" style="margin-top: 22px;">
            @endif
          </div>
        </div>
      </form>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-hover table-striped ar-datatable">
        <thead>
          <tr>
            <th style="width: 20px;">SL</th>
            <th>Permission Name</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @if( isset($permissions) )
          @php $sl = 1; @endphp
          @foreach($permissions as $perm)
          <tr>
            <td>{{ $sl }}</td>
            <td><strong>{{ $perm->name }}</strong> <small>({{ $perm->id}})</small></td>
            <td>{{ $perm->description }}</td>
            <td>
              <a href="{{ route('sysPerm_Del', array('id' => $perm->id)) }}" class="btn  btn-xs btn-danger" onclick="return confirm('Sure To Delete This Permission ?');">Delete</a>
              <a href="{{ route('sysPerm_Edt', array('id' => $perm->id)) }}" class="btn btn-xs btn-warning">Edit</a>
            </td>
          </tr>
          @php $sl++; @endphp
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
$('#frmx').validate({
    errorElement: 'span',
    errorClass : 'roy-vali-error',
    rules: {

      name: {
        required: true
      }
    },
    messages: {

      name: {
        required: 'Please Enter Permission Name.'
      }
    }
});
</script>
@endpush