<div class="moduleEntry">
    <table {{ $trim ? 'width=100% cellpadding=0 cellspacing=0 border=0' : '' }}>
        <tbody>
            <tr {{ $trim ? 'valign=top' : '' }}>
				@if($trim)
					<td>
						<a href="{{ route('watch', ['v' => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}"><img src="{{ route('get_still', ['video_id' => $video->video_id]) }}" class="moduleEntryThumb" height="90" width="120"></a>
					</td>
				@else
					<td>
						<table style="border-right: 1px dashed #999999;">
							<tbody>
								<tr>
									<td>
									</td>
									<td>
										<a href="{{ route('watch', ['v' => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}"><img src="{{ route('get_still', ['video_id' => $video->video_id, 'still_id' => 1]) }}" class="moduleFeaturedThumb" height="75" width="100"></a>
									</td>
									<td>
										<a href="{{ route('watch', ['v' => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}"><img src="{{ route('get_still', ['video_id' => $video->video_id, 'still_id' => 2]) }}" class="moduleFeaturedThumb" height="75" width="100"></a>
									</td>
									<td>
										<a href="{{ route('watch', ['v' => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}"><img src="{{ route('get_still', ['video_id' => $video->video_id, 'still_id' => 3]) }}" class="moduleFeaturedThumb" height="75" width="100"></a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				@endif
                <td width="10px">&nbsp;</td>
                <td width="100%">
                    <div class="moduleEntryTitle"><a href="{{ route('watch', ['v' => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}">{{ $video->title }}</a></div>
                    <div class="moduleEntryDescription">{{ $video->description }}</div>
                    <div class="moduleEntryTags">
                        Tags // @foreach($video->tags() as $key => $tag)
						<a href="{{ route('results', ['search' => $tag]) }}">{{ $tag }}</a>{{ ($key + 1 < count($video->tags())) ? " : " : "" }}
						@endforeach
                    </div>
                    <!--<div class="moduleEntryDetails">Channels // <a href="/web/20051210215356/http://www.youtube.com/channels_portal.php?c=13">People</a>
                    </div>-->
                    <div class="moduleEntryDetails">Added: {{ ($fulldates) ? $video->created_at->ytFormat("F j, Y") : $video->created_at->diffForHumans() }} by <a href="{{ route('profile', ['user' => $video->uploader]) }}">{{ $video->uploader }}</a></div>
                    <div class="moduleEntryDetails">Runtime: {{ $video->runtime() }} | Views: {{ $video->num_views }} | Comments: {{ $video->num_comments }}</div>
					@if($video->num_ratings)
						<nobr>
							<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(1, true) }}">
							<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(2, true) }}">
							<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(3, true) }}">
							<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(4, true) }}">
							<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(5, true) }}">
						</nobr>
						<span style="color:#666666; font-size:smaller; ">({{ $video->num_ratings }} ratings)</span>
					@endif
				</td>
            </tr>
        </tbody>
    </table>
</div>