<x-modules.featured>
	<table width="770" cellpadding="0" cellspacing="0" border="0">
		@foreach($channels->chunk(3) as $collect)
			<tr valign="top">
				@foreach ($collect as $item)
					<td width="33%">
						<table>
							<tbody>
								<tr>
									<td>
										<a href="{{ route('channels_portal', ['c' => $item->id]) }}"><img src="{{ route('get_still', ['video_id' => $item->latest_video_added]) }}" style="border: 5px solid #FFFFFF;" width="80" height="60"></a>&nbsp;
									</td>
									<td valign="top">
										<div style="font-size: 12px; font-weight: bold;"><a href="{{ route('channels_portal', ['c' => $item->id]) }}">{{ $item->title }}</a></div>
										<div style="font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #666666; padding-top: 2px;">
											<img src="img/ChannelStar.gif" width="12px" align="absmiddle">&nbsp;Today: {{ $item->updated_at->isSameDay() ? $item->num_videos_today : 0 }} | Total: {{ $item->num_videos_total }}
										</div>
										<!--
										<div style="font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #666666; padding-top: 2px;">
											<img src="img/pixel.gif" width="12px" align="absmiddle">&nbsp;Groups: TODO
										</div>-->
										<div style="padding-top: 5px;">{{ $item->description }}</div>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				@endforeach
			</tr>
		@endforeach
	</table>
</x-modules.featured>