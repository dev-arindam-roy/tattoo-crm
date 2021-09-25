<form name="frm" action="{{ route('ari.permission.save') }}" method="post">
{{ csrf_field() }}
<h3>Permission</h3>
<select name="module_id" required>
    <option value="">Module</option>
    @foreach($module as $v)
        <option value="{{ $v->id }}">{{ $v->name }}</option>
    @endforeach
</select>
<input type="text" name="name" placeholder="permission name" required>
<input type="submit" value="Add">
</form>