
<script src="{{ asset('public/assets/toastr/toastr.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/assets/jquery_validator/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/jquery_validator/additional-methods.min.js') }}"></script>
<script>
$(document).ready(function(){
	toastr.options.closeButton = true;
	toastr.options.progressBar = true;
	toastr.options.timeOut = 20000;
	toastr.options.extendedTimeOut = 5000;
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