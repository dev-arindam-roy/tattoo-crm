@if( isset($ReusableContent) )
<select id="modalEleRC" class="form-control eleModalDD">
  <option value="0">-Select Reusable Content-</option>
  @foreach( $ReusableContent as $rc )
    <option value="{{ $rc->short_code }}">{{ ucfirst($rc->name) }}</option>
  @endforeach 
</select>
@endif

@if( isset($FrmBuilder) )
<select id="modalEleFRM" class="form-control eleModalDD">
  <option value="0">-Select Form Builders Form-</option>
  @foreach( $FrmBuilder as $frm )
    <option value="{{ $frm->frm_scode }}">{{ ucfirst($frm->frm_heading) }}</option>
  @endforeach 
</select>
@endif

@if( isset($imgGals) )
<select id="modalEleImgal" class="form-control eleModalDD">
  <option value="0">-Select Image Galleries-</option>
  @foreach( $imgGals as $gal )
    <option value="{{ $gal->short_code }}">{{ ucfirst($gal->name) }}</option>
  @endforeach 
</select>
@endif

@if( isset($links) && isset($heading) && isset($ele) && $ele == 'tab')
  @foreach( $links as $v )
  <tr>
    <td>
      <input type="checkbox" name="slugs[]" class="ckblinks" data="{{ $v->id }}" value="{{ $v->slug }}">
      {{ $v->name }}
    </td>
    <td>
      <input type="text" name="link_order[]" class="onlyNumber" id="ordbox_{{ $v->id }}" style="width: 35px;" disabled="disabled" value="0">
    </td>
    <td>{{ url( $v->slug ) }}</td>
  </tr>
  @endforeach
@endif



@if( isset($pboxreus) )
  @forelse($pboxreus as $v)
  <option value="{{ $v->id }}">{{ $v->name }}</option>
  @empty
  <option value="">-SELECT-</option>
  @endforelse
@endif