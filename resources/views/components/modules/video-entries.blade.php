@if($type == "b")
	<x-modules.featured>
		<table width="770" cellpadding="0" cellspacing="0" border="0">
			@foreach($videos as $count => $video)
				@if($count == 0) <tr valign="top"> @endif
				@if(($count) % 5 === 0) </tr><tr valign="top"> @endif
				
				<x-modules.basic-entry :video="$video"/>
			@endforeach
			</tr>
		</table>
	</x-modules.featured>
@elseif($type == "v")
	@foreach($videos as $video)
		<x-modules.detailed-entry :video="$video" :trim="$trim" :fulldates="$fulldates"/>
	@endforeach
@endif