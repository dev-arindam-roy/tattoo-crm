@if( isset($randID) )
<div class="ar-ana-box" id="scriptBox_{{ $randID }}">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Analytics Name : <em>*</em></label>
				<input type="text" name="script_name" id="script_name_{{ $randID }}" class="form-control" placeholder="Enter Analytics Name">
			</div>
			<div class="form-group">
				<label>Script Placement : <em>*</em></label>
				<select name="script_placement" id="script_placement_{{ $randID }}" class="form-control">
					<option value="">-Select Placement-</option>
					<option value="before_head">Just Before Close Hade Tag</option>
					<option value="after_body">Just After Body Tag</option>
					<option value="before_body">Just Before Close Body Tag</option>
					<!--option value="before_html">Just Before Html Tag</option-->
				</select>
			</div>
			<div class="form-group">
				<label>Status : </label>
				<select name="status" id="status_{{ $randID }}" class="form-control">
					<option value="1">Active</option>
					<option value="2">Inactive</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Script Code : <em>*</em></label>
				<textarea name="script_code" id="script_code_{{ $randID }}" class="form-control" placeholder="Enter Analytics Script Code..." style="height: 183px;"></textarea>
			</div>
		</div>
		<div class="col-md-3">
			<div style="margin-top: 25px;">
				<input type="button" id="{{ $randID }}" class="btn btn-success save_script" value="Save Script">
				<input type="button" id="{{ $randID }}" class="btn btn-danger delete_script_box" value="Delete Script">
			</div>
		</div>
	</div>
</div>
@endif