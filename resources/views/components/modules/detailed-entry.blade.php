<div class="moduleEntry">
    <table {{ $trim ? 'width=100% cellpadding=0 cellspacing=0 border=0' : '' }}>
        <tbody>
            <tr {{ $trim ? 'valign=top' : '' }}>
				@if($trim)
					<td {{ ($edit) ? 'valign=top' : '' }}>
						<a href="{{ route('watch', ['v' => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}"><img src="{{ route('get_still', ['video_id' => $video->video_id]) }}" class="moduleEntryThumb" height="90" width="120"></a>
						@if($edit)
							<center>
								<br>
								<form method="get" action="my_videos_edit.php">
									<input type="hidden" value="{{ $video->video_id }}" name="video_id">
									<input type="submit" value="Edit Video">
								</form>
								<form method="get" action="my_videos_remove.php">
									<input type="hidden" value="{{ $video->video_id }}" name="video_id">
									<input type="submit" value="Remove Video">
								</form>
							</center>
						@endif
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
                    <div class="moduleEntryDetails">Added: {{ ($fulldates) ? YouTube::format($video->created_at, "F j, Y") : $video->created_at->diffForHumans() }} by <a href="{{ route('profile', ['user' => $video->uploader]) }}">{{ $video->uploader }}</a></div>
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
					
					@if($edit)
					<div style="border-bottom:1px dashed #999999;margin-top:10px;margin-bottom:10px;"></div>
					<div class="moduleFrameDetails"></div>
					<div class="moduleEntryDetails">File: {{ $video->file_name ? $video->file_name : "Unavailable" }}</div>
					<div class="moduleEntryDetails">Broadcast: <strong style="color:#CC0033;">Public Video</strong></div>
					<div class="moduleEntryDetails">Status: Live!</div>
					<input class="small" style="width: 300px;text-align: center;" readonly="true" value="https://www.youtube.com/watch?v={{ $video->video_id }}">
					<div class="moduleEntryDetails" style="margin-top:10px;font-size:10px!important;">Share this video with friends! Copy and paste the link above to an email or website.</div>
					@endif
				</td>
            </tr>
        </tbody>
    </table>
</div>