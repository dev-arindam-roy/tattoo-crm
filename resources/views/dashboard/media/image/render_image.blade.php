@if( isset($allImages) )
<div style="max-height: 300px; overflow-y: auto;">
	@foreach( $allImages as $allImgs)
		<div class="col-md-3 col-sm-4">
			<div class="thumbnail lib-img-box" id="imgID_{{ $allImgs->id }}">
				<div class="img-fix-box">
					<img src="{{ asset('public/uploads/files/media_images/thumb/'. $allImgs->image) }}" alt="{{ $allImgs->alt_title }}" title="{{ $allImgs->title }}" id="img-{{ $allImgs->id }}" data-caption="{{ $allImgs->caption }}" data-description="{{ $allImgs->description }}">
				</div>
				<div class="caption">
					<span>{{ sizeFilter($allImgs->size) }}</span>
				</div>
			</div>
		</div>
	@endforeach 
</div>
<div class="row">
	<div class="col-md-12">
		{{ $allImages->appends(request()->query())->links() }}
	</div>
</div>
<!--{!! $allImages->render() !!}-->
@endif