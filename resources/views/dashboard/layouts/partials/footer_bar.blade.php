<footer class="main-footer">
	<div class="pull-right hidden-xs">
	  {{ Date('l, d F Y') }}
	</div>
	@php
	  $footText = "Copyright - ArindamDASH - Allright Reserved.";
	  if( function_exists( 'getGeneralSettings' ) ) {
	    $arrs = getGeneralSettings();
	    if( $arrs->site_footer_text != '' && $arrs->site_footer_text != null ) {
	    $footText = trim($arrs->site_footer_text);
	    }
	  }
	 @endphp
	<strong>{{ $footText }}</strong>
</footer>