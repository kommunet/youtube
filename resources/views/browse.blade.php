<x-layout tab="videos">
	<x-slot name="actions">
		<x-actions.videos :selected="$sort->value"/>
	</x-slot>
	<x-search-bar/>
	<table width="790" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
		<tr>
			<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
			<td><img src="img/pixel.gif" width="1" height="5"></td>
			<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
		</tr>
		<tr>
			<td><img src="img/pixel.gif" width="5" height="1"></td>
			<td width="780">
			
				{{-- Title bar --}}
				<x-modules.title-bar :title="$sort->title()">
					{{-- Center of the title bar --}}
					<x-slot name="center">
						<div style="font-weight: normal; font-size: 11px; color: #444444">
							@if($sort->hasAggregation())
								<div style="font-weight: normal; font-size: 11px; color: #444444">
									@foreach($list["aggregations"] as $key => $item)
									<{{ ($aggregation == $item) ? "strong" : "a href=" . route("browse", ["s" => $sort->value, "f" => $view->value, "page" => $videos->currentPage(), "t" => $item->value]) }}>{{ $item->title() }}</{{ ($aggregation == $item) ? "strong" : "a" }}>{{ ($key + 1 < count($list['aggregations'])) ? " | " : "" }}
									@endforeach
							</div>
							@else
								<div style="float: center; padding: 1px 5px 0px 0px; font-size: 12px;">
									@foreach($list["views"] as $key => $item)
									<{{ ($view == $item) ? "strong" : "a href=" . route("browse", ["s" => $sort->value, "f" => $item->value, "page" => $videos->currentPage(), "t" => $aggregation->value]) }}>{{ $item->title() }}</{{ ($view == $item) ? "strong" : "a" }}>{{ ($key + 1 < count($list['views'])) ? " | " : "" }}
									@endforeach
								</div>
							@endif
						</div>
					</x-slot>
					
					{{-- Right of the title bar --}}
					<x-slot name="right">
						<div style="font-weight: bold; color: #444444; margin-right: 5px;">
							Videos {{ $videos->firstItem() ?? 0 }}-{{ $videos->lastItem() ?? 0 }} of {{ $videos->total() ?? 0 }}
						</div>
					</x-slot>
				</x-modules.title-bar>
				
				{{-- Body of the browse container --}}
				{{-- Video entry, set to trim entries to hide ratings on detailed view --}}
				<x-modules.video-entries :videos="$videos" :type="$view->value"/>
				
				{{-- Pagination module, cannot use as component due to Blade limitations --}}
				{{ $videos->links("components.modules.pagination", ["s" => $sort, "f" => $view, "t" => "t"]) }}
			</td>
			<td><img src="img/pixel.gif" width="5" height="1"></td>
		</tr>
		<tr>
			<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
			<td><img src="img/pixel.gif" width="1" height="5"></td>
			<td><img src="img/box_login_br.gif" width="5" height="5"></td>
		</tr>
	</table>
</x-layout>