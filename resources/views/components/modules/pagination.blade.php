<!-- begin paging -->
@if ($paginator->hasPages())
<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">
	Browse Pages:
	@foreach($elements as $element)
		@foreach($element as $page => $url)
			<span style="{{ ($page == $paginator->currentPage()) ? 'color: #444; background-color: #FFFFFF;' : 'background-color: #CCC;' }} padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;">
				@if($page == $paginator->currentPage())
					{{ $page }}
				@else
					<a href="{{ $url }}">{{ $page }}</a>
				@endif
			</span>
		@endforeach
	@endforeach
</div>
@endif
<!-- end paging -->