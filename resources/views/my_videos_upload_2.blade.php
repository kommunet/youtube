<x-layout tab="upload">
	<div class="tableSubTitle">Video Upload (Step 2 of 2)</div>
	<div class="formTable">
		<form name="uploadForm" id="uploadForm" method="POST" action="{{ route('my_videos_upload_post') }}" enctype="multipart/form-data">
			<input type="hidden" name="title" value="{{ request()->title }}" hidden>
			<input type="hidden" name="description" value="{{ request()->description }}">
			<input type="hidden" name="tags" value="{{ request()->tags }}">
			@foreach(request()->channels as $c)
				<input type="hidden" name="channels[]" value="{{ $c }}">
			@endforeach
			<table cellpadding="5" cellspacing="0" border="0" align="center">
				<tr>
					<td align="right" valign="top"><span class="label">File:</span></td>
					<td style="background-color:#FEFFE0; padding:8px;">
						<input type="file" name="file" id="file" style="color:black" accept="video/*" required="">
						<div class="formHighlightText"><b>Max file size: 100 MB. No copyrighted or obscene material.</b><br>After uploading, you can edit or remove this video at anytime under the "My Videos" link on the top of the page.</div>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<h3>PLEASE BE PATIENT, THIS MAY TAKE SEVERAL MINUTES.<br>ONCE COMPLETED, YOU WILL SEE A CONFIRMATION MESSAGE.</h3>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" id="upload" name="upload" value="Upload Video"></td>
				</tr>
			</table>
		</form>
	</div>
</x-layout>