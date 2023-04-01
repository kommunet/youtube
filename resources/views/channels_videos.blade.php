<x-layout tab="channels">
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
				<x-modules.title-bar title="">
					<x-slot name="title">
						<a href='#'>All Channels</a> > {{ $channel->title }}
					</x-slot>
				</x-modules.title-bar>
				
				{{-- Body of the browse container --}}
				{{-- Video entry, set to trim entries to hide ratings on detailed view --}}
				<x-modules.video-entries :videos="$videos" type="b"/>
				
				{{-- Pagination module, cannot use as component due to Blade limitations --}}
				{{ $videos->links("components.modules.pagination") }}
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