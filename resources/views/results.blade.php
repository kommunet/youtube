<x-layout tab="home">
	<x-slot name="actions">
		<x-actions.home/>
	</x-slot>
	<x-search-bar/>
	<div style="color: #333; margin-bottom: 10px; padding-top: 10px"><b>Related Tags:</b>
		@foreach($tags as $tag)
		<a href="/results.php?search={{ $tag }}">{{ $tag }}</a>
		@endforeach
	</div>
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
				<x-modules.title-bar title="Search // {{ $search }}">
					{{-- Right of the title bar --}}
					<x-slot name="right">
						<div style="font-weight: bold; color: #444444; margin-right: 5px;">
							Videos {{ $videos->firstItem() ?? 0 }}-{{ $videos->lastItem() ?? 0 }} of {{ $videos->total() ?? 0 }}
						</div>
					</x-slot>
				</x-modules.title-bar>
				
				{{-- Body of the browse container --}}
				{{-- Video entry, set to trim entries to hide ratings on detailed view --}}
				<x-modules.video-entries :videos="$videos" type="v"/>
				
				{{-- Pagination module, cannot use as component due to Blade limitations --}}
				{{ $videos->links("components.modules.pagination", ["search" => $search]) }}
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