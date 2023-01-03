<x-layout tab="home">
	<x-slot name="actions"><x-actions.home/></x-slot>
	
	<div class="tableSubTitle">Tags</div>
	<div style="font-size: 14px; font-weight: bold; color: #666666; margin-bottom: 10px;">Latest Tags //</div>
	<div style="margin-bottom: 20px;">
		@foreach($recent_tags as $item)
		<a style="font-size: {{ ($item->occurrences > 1) ? '17px;' : '12px;' }}" href="{{ route('results', ['search' => $item->tag]) }}">{{ $item->tag }}</a> :
		@endforeach
	</div>
	<div style="font-size: 16px; font-weight: bold; color: #666666; margin-bottom: 10px;">Most Popular Tags //</div>
	@foreach($popular_tags as $item)
	<a style="font-size: @if($item->occurrences > 3) 28px @endif @if($item->occurrences == 2) 20px @endif @if($item->occurrences == 1) 14px @endif" href="{{ route('results', ['search' => $item->tag]) }}">{{ $item->tag }}</a> :
	@endforeach
</x-layout>