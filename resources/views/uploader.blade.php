<x-layout tab="upload">
	@if($errors->any())
		@foreach($errors->all() as $error)
			<table width="100%" align="center" cellpadding="6" cellspacing="3" border="0" bgcolor="red" style="margin-bottom: 10px;">
				<tbody>
					<tr>
						<td align="center" bgcolor="#FFFFFF">
							<span style="font-weight: bold;color: red;">
							{{ $error }}
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		@endforeach
	@endif
	
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
				<x-modules.title-bar title="Temporary Video Uploader"/>
				
				{{-- Body of the browse container --}}
				<x-modules.featured>
					<form action="temp_process.php" id="upload" method="post" enctype="multipart/form-data">
						@csrf
						<table width="100%">
							<tbody>
								<tr>
									<td colspan="2">Note: This is a W.I.P. video uploader and is merely for functionality over accuracy.</td>
								</tr>
								<tr>
									<td>Video: </td>
									<td>
										<input type="file" name="video">
									</td>
								</tr>
								
								<tr>
									<td>Title: </td>
									<td>
										<input type="text" name="title" maxlength="100">
									</td>
								</tr>
								
								<tr>
									<td valign="top">Description: </td>
									<td>
										<textarea name="description" maxlength="2500" form="upload"></textarea>
									</td>
								</tr>
								
								<tr>
									<td>Tags (separate tags by spaces, REQUIRED): </td>
									<td>
										<input type="text" name="tags" maxlength="75">
									</td>
								</tr>
								
								<tr>
									<td colspan="2">
										<input type="submit" value="Upload Video">
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</x-modules.featured>
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