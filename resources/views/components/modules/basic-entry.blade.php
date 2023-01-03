<td width="20%" align="center">
	<a href="{{ route("watch", ["v" => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}"><img src="{{ route('get_still', ['video_id' => $video->video_id]) }}" width="120" height="90" class="moduleFeaturedThumb"></a>
	<div class="moduleFeaturedTitle"><a href="{{ route("watch", ["v" => $video->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}">{{ $video->title }}</a></div>
	<div class="moduleFeaturedDetails">
		Added: {{ $video->created_at->diffForHumans() }}<br>
		by <a href="{{ route('profile', ['user' => $video->uploader]) }}">{{ $video->uploader }}</a>
	</div>
	<div class="moduleFeaturedDetails">
		Runtime: {{ $video->runtime() }}<br>
		Views: {{ $video->num_views }} | Comments: {{ $video->num_comments }}
	</div>
	@if($video->num_ratings)
		<nobr>
			<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(1, true) }}">
			<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(2, true) }}">
			<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(3, true) }}">
			<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(4, true) }}">
			<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star(5, true) }}">
		</nobr>
	@endif
</td>