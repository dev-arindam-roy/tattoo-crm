@extends('dashboard.layouts.app')

@section('content_header')
<section class="content-header">
  <h1>
    Analytics and Scripts
    <!--small>it all starts here</small-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Analytics and Scripts</li>
  </ol>
</section>
@endsection

@section('content')
<section class="content">

  @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif

  
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
          Add Analytics and Scripts
          </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            @if(isset($anaScripts) && !empty($anaScripts))
              @foreach($anaScripts as $spt)
              <div class="ar-ana-box" id="scriptBox_{{ $spt->script_id }}">
                <div class="heading_box">{{ ucfirst($spt->script_name) }}</div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Analytics Name : <em>*</em></label>
                      <input type="text" name="script_name" id="script_name_{{ $spt->script_id }}" class="form-control" placeholder="Enter Analytics Name" value="{{ $spt->script_name }}">
                    </div>
                    <div class="form-group">
                      <label>Script Placement : <em>*</em></label>
                      <select name="script_placement" id="script_placement_{{ $spt->script_id }}" class="form-control">
                        <option value="">-Select Placement-</option>
                        <option value="before_head" @if($spt->script_placement == 'before_head') selected="selected" @endif>Just Before Close Hade Tag</option>
                        <option value="after_body" @if($spt->script_placement == 'after_body') selected="selected" @endif>Just After Body Tag</option>
                        <option value="before_body" @if($spt->script_placement == 'before_body') selected="selected" @endif>Just Before Close Body Tag</option>
                        {{--<option value="before_html" @if($spt->script_placement == 'before_html') selected="selected" @endif>Just Before Html Tag</option>--}}
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Status : </label>
                      <select name="status" id="status_{{ $spt->script_id }}" class="form-control">
                        <option value="1" @if($spt->status == '1') selected="selected" @endif>Active</option>
                        <option value="2" @if($spt->status == '2') selected="selected" @endif>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Script Code : <em>*</em></label>
                      <textarea name="script_code" id="script_code_{{ $spt->script_id }}" class="form-control" placeholder="Enter Analytics Script Code..." style="height: 183px;">{{ html_entity_decode($spt->script_code, ENT_QUOTES) }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div style="margin-top: 25px;">
                      <input type="button" id="{{ $spt->script_id }}" class="btn btn-success save_script" value="Save Script">
                      <input type="button" id="{{ $spt->script_id }}" class="btn btn-danger delete_script" value="Delete Script">
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
            <div class="row">
              <div class="col-md-12">
                <div id="contentDiv"></div>
              </div>
            </div>
            <div class="row" style="margin-top: 15px;">
              <div class="col-md-6">
                <button type="button" id="addScriptBtn" class="btn btn-primary"><i class="fa fa-plus"></i> Add Script Box</button>
              </div>
              <div class="col-md-6"></div>
            </div>
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
@endsection

@push('page_js')
<script type="text/javascript">
$( function() {
  $("#addScriptBtn").on('click', function() {
    $(this).attr('disabled', 'disabled');
    $.get("{{ route('ajax_layout') }}", function(data, status){
      if( status == 'success' ) {
        $("#contentDiv").append(data.html);
        $("#addScriptBtn").removeAttr('disabled');
      }
    });
  });
  $('body').on('click', '.save_script', function() {
    var ID = $(this).attr('id');
    var script_name = $.trim($('#script_name_'+ID).val());
    var script_placement = $.trim($('#script_placement_'+ID).val());
    var script_code = $.trim($('#script_code_'+ID).val());
    var status = $.trim($('#status_'+ID).val());
    var ckErr = 0;
    if( script_name == '' ) {
      $('#script_name_'+ID).parent('.form-group').addClass('has-error');
      ckErr++;
    } else {
      $('#script_name_'+ID).parent('.form-group').removeClass('has-error');
    }
    if( script_placement == '' ) {
      $('#script_placement_'+ID).parent('.form-group').addClass('has-error');
      ckErr++;
    } else {
      $('#script_placement_'+ID).parent('.form-group').removeClass('has-error');
    }
    if( script_code == '' ) {
      $('#script_code_'+ID).parent('.form-group').addClass('has-error');
      ckErr++;
    } else {
      $('#script_code_'+ID).parent('.form-group').removeClass('has-error');
    }

    if( ckErr == 0 ) {
      var token = "{{ csrf_token() }}";
      var DataString = {
        'script_id' : ID,
        'script_name' : script_name,
        'script_placement' : script_placement,
        'script_code' : script_code,
        'status' : status,
        '_token' : token
      };
      $.ajax({
        type : "POST",
        url : "{{ route('save_script') }}",
        data : DataString,
        cache : false,
        beforeSend : function() {
          $('#scriptBox_'+ID).block({ 
              message: '<h4>Please wait...</h4>', 
              css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
              } 
          });
        },
        success : function(ajxResp) {
          if( ajxResp == 'ok' ) {
           $('#scriptBox_'+ID).unblock();
           $('#scriptBox_'+ID).find('.delete_script_box').addClass('delete_script').removeClass('delete_script_box');
          }
        }
      });
    }
  });
  $('body').on('keyup', 'input[name="script_name"]', function() {
    if( $.trim($(this).val()) != '' ) {
      $(this).parent('.form-group').removeClass('has-error');
    }
  });
  $('body').on('keyup', 'textarea[name="script_code"]', function() {
    if( $.trim($(this).val()) != '' ) {
      $(this).parent('.form-group').removeClass('has-error');
    }
  });
  $('body').on('change', 'select[name="script_placement"]', function() {
    if( $.trim($(this).val()) != '' ) {
      $(this).parent('.form-group').removeClass('has-error');
    }
  });
  $('body').on('click', '.delete_script', function() {
    var ID = $(this).attr('id');
    var token = "{{ csrf_token() }}";
    if( ID != '' ) {
      swal({
        title: "Are you sure?",
        text: "Are you sure to delete this script",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type : "POST",
            url : "{{ route('delete_script') }}",
            data : {
              'script_id' : ID,
              '_token' : token
            },
            cache : false,
            beforeSend : function() {
              $('#scriptBox_'+ID).block({ 
                  message: '<h4>Please wait...</h4>', 
                  css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .5, 
                    color: '#fff' 
                  } 
              });
            }, 
            success : function(resp) {
              if( resp == 'ok' ) {
                $('#scriptBox_'+ID).unblock();
                $('#scriptBox_'+ID).remove();
                swal("Deleted!", "Script is deleted successfully", "success");
              }
            }
          });
        }
      });
    }
  });
  $('body').on('click', '.delete_script_box', function() {
    $('#scriptBox_'+$(this).attr('id')).remove();
  });
});
</script>
@endpush