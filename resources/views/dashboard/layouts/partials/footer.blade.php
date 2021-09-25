
<!-- jQuery 3 -->
<script src="{{ asset('public/assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('public/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('public/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('public/assets/bower_components/fastclick/lib/fastclick.js') }}"></script>

<script src="{{ asset('public/assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('public/assets/jquery.blockUI.js')}}"></script>
<script src="{{ asset('public/assets/sweet_alert/sweetalert.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('public/assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!--script src="{{ asset('public/assets/dist/js/demo.js') }}"></script-->

<script src="{{ asset('public/assets/toastr/toastr.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/assets/jquery_validator/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/jquery_validator/additional-methods.min.js') }}"></script>
<!--script type="text/javascript" src="{{ asset('public/assets/arindam_nav.js') }}"></script-->


<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('.select2').select2({
    	width: '100%'
    });
    //$('.ar-hide').fadeOut(6000);
    $('.ar-hide').hide();
    $('[data-toggle="tooltip"]').tooltip(); 
    $("body").on('keypress', '.onlyNumber', function(evt) {
    	var charCode = (evt.which) ? evt.which : event.keyCode;
    	if (charCode > 31 && (charCode < 48 || charCode > 57))
      		return false;
    	return true;
	  });
    $("body").on('keypress', '.onlyPHNO', function(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      if( charCode == 43 ) {
        return true;
      } else {
      if (charCode > 31 && (charCode < 48 || charCode > 57)) 
          return false;
      return true;
      }
    });
    $('body').on('click', '.ifdel', function() {
      var removeID = $(this).attr('id');
      var fromTable = $.trim( $(this).attr('data') );
      var cObj = $(this); 
      swal({
        title: "Are you sure To Delete This File ?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
          type : 'POST',
          url : "{{ route('ajxFileDel') }}",
          data : {
            'id' : removeID,
            'table_name' : fromTable,
            '_token' : "{{ csrf_token() }}"
          },
          beforeSend : function() {
            
          },
          success : function(rtns) {
            if( rtns == 'ok' ) {
              cObj.parent().remove();
              swal("Deleted!", "File Deleted Successfully.", "success");
            }
          }
        });
      }); 
    });  
  });
</script>
<script>
$(document).ready(function(){
	toastr.options.closeButton = true;
	toastr.options.progressBar = true;
	toastr.options.timeOut = 20000;
	toastr.options.extendedTimeOut = 5000;
  toastr.options.positionClass = "toast-container";
});
</script>  
@php
	$toastrMessage = '';
	if(Session::has('msg') && Session::get('msg') != '') {
		$toastrMessage = Session::get('msg');
	} 
@endphp
@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-success')
<script>
$(document).ready(function(){
	toastr.success('{{ $toastrMessage }}');
});
</script>
@endif
@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-danger')
<script>
$(document).ready(function(){
	toastr.error('{{ $toastrMessage }}');
});
</script>
@endif
@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-info')
<script>
$(document).ready(function(){
	toastr.info('{{ $toastrMessage }}');
});
</script>
@endif
@stack('page_js')
</body>
</html>
