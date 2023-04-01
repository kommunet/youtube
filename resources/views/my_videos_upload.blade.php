<x-layout tab="upload">
	<div class="tableSubTitle">Video Upload (Step 1 of 2)</div>
	<div class="formTable">
		<form name="uploadForm" id="uploadForm" method="post" action="{{ route('my_videos_upload_2') }}" enctype="multipart/form-data" onsubmit="return UploadHandler();">
			<table style="" cellspacing="0" cellpadding="5" border="0" align="center">
				<tbody>
					<tr>
						<td align="right"><span class="label">* Title:</span></td>
						<td><input type="text" size="50" maxlength="64" name="title" value="{{ old('title') }}"></td>
					</tr>
					@error("title")
					<tr><td></td><td><span style="color:red">{{ $message }}</span></td></tr>
					@enderror
					<tr>
						<td width="85" align="right"><span class="label">* Description:</span></td>
						<td><textarea name="description" maxlength="500" cols="55" rows="3">{{ old('description') }}</textarea></td>
					</tr>
					@error("description")
					<tr><td></td><td><span style="color:red">{{ $message }}</span></td></tr>
					@enderror
					<tr>
						<td align="right"><span class="label">* Tags:</span></td>
						<td><input type="text" size="50" maxlength="255" name="tags" value="{{ old('tags') }}"></td>
					</tr>
					@error("tags")
					<tr><td></td><td><span style="color:red">{{ $message }}</span></td></tr>
					@enderror
					<tr>
						<td></td>
						<td><b>Enter one or more tags, separated by spaces.</b><br>Tags are simply keywords used to describe your video so they are easily searched and organized. For example, if you have a surfing video, you might tag it: surfing beach waves.</td>
						<div></div>
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
																	<input type="checkbox" name="channels[]" id="channel-{{ $item->id }}" value="{{ $item->id }}"> <label for="channel-{{ $item->id }}">{{ $item->title }}</label>
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
					@error("channels")
					<tr><td></td><td><span style="color:red">{{ $message }}</span></td></tr>
					@enderror
					<tr>
						<td></td>
						<td><b>Select between one to three channels that best describe your video.</b><br>It helps to use relevant channels so that others can find your video!</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h3>Do not upload copyrighted material.</h3>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" id="continue" name="continue" value="Continue ->"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</x-layout>