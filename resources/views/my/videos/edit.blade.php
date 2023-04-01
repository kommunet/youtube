<x-layout>
	<script>
	function UploadHandler() {
		const form = document.getElementById('editForm');
		
		// TITLE
		if (form.elements['title'].value.length == 0 || form.elements['title'].value == null)
		{
			alert("You must enter a title!");
			form.elements['title'].focus();
			return false;
		}
		if (form.elements['title'].value.length > 64)
		{
			alert("Your title must be shorter than 64 characters!");
			form.elements['title'].focus();
			return false;
		}
		
		// DESCRIPTION
		if (form.elements['description'].value.length == 0 || form.elements['description'].value == null)
		{
			alert("You must enter a description!");
			form.elements['description'].focus();
			return false;
		}
		if (form.elements['description'].value.length > 10000)
		{
			alert("Your description must be shorter than 10,000 characters!");
			form.elements['description'].focus();
			return false;
		}
		
		// TAGS
		if (form.elements['tags'].value.length == 0 || form.elements['tags'].value == null)
		{
			alert("You must enter tags!");
			form.elements['tags'].focus();
			return false;
		}
		if (form.elements['tags'].value.length > 300)
		{
			alert("Your tags must be shorter than 300 characters!");
			form.elements['tags'].focus();
			return false;
		}
		const regex = /(?:[\w]+ ){2}[\w]+/; // three or more words
		if (regex.test(form.elements['tags'].value) == false)
		{
			alert("You must have at least three tags!");
			form.elements['tags'].focus();
			return false;
		}
		
		return true;
	}
	</script>
	<a align="right" href="my_videos.php"><< return to My Videos</a>
	<div class="tableSubTitle">Video Details</div>

	<div class="formTable">
		<form name="editForm" id="editForm" method="post" action="my_videos_edit.php?video_id={{ $video->video_id }}" enctype="multipart/form-data" onsubmit="return UploadHandler();">
			<table cellpadding="5" cellspacing="0" border="0" align="center">
				<tbody>
					<tr>
						<td align="right"><span class="label">Title:</span></td>
						<td><input type="text" size="50" maxlength="64" name="title" value="{{ $video->title }}"></td>
					</tr>
					<tr>
						<td align="right"><span class="label">Description:</span></td>
						<td><textarea name="description" maxlength="10000" cols="55" rows="3">{{ $video->description }}</textarea></td>
					</tr>
					<tr>
						<td width="100" valign="top" align="right"><span class="label">* Video Channels:</span></td>
						<td>
							<table cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										@foreach($channels->chunk(11) as $chunk)
											<td valign="top">
												<table cellspacing="0" cellpadding="0">
													<tbody>
														@foreach($chunk as $item)
															<tr>
																<td>
																	<input type="checkbox" name="channels[]" id="channel-{{ $item->id }}" value="{{ $item->id }}" {{ ($video->channels()->contains($item->id)) ? 'checked' : '' }}> <label for="channel-{{ $item->id }}">{{ $item->title }}</label>
																</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</td>
										@endforeach
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right"><span class="label">Tags:</span></td>
						<td><input type="text" size="50" maxlength="255" name="tags" value="{{ $video->tags }}"></td>
					</tr>
					<tr>
						<td></td>
						<td><b>Enter a list of three or more keywords, separated by spaces, describing your video.</b><br>It helps to use relevant keywords so that others can find your video!</td>
					</tr>
					<tr>
						<td colspan="2"><br></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" id="save" name="save" value="Save ->"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</x-layout>