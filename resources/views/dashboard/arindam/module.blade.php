<form name="frm" action="{{ route('ari.module.save') }}" method="post">
{{ csrf_field() }}
<h3>Module</h3>
<input type="text" name="name" placeholder="module name" required>
<input type="submit" value="Add">
</form>