<x-layout>
	<a align="right" href="my_videos.php"><< return to My Videos</a>
	<div class="tableSubTitle">Confirm Removal</div>
	<p>Are you sure you want to remove "{{ $video->title }}"? There is no means of recovering it after it has been removed.</p>
	<form method="post">
		<input type="submit" value="Remove Video">
		<input type="button" 
			   value="Cancel" 
			   onclick="window.history.back()" 
			   style="margin-left:8px">
	</form>
</x-layout>