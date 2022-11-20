<x-layout tab="home">
	<x-slot name="actions"><x-actions type="home"/></x-slot>
	<x-inbox subtitle="Compose a Message">
		<table cellpadding="0" cellspacing="8" border="0" bgcolor="#E5ECF9" align="center" width="100%">
			<tbody>
				<tr>
					<td width="140"><a href="{{ route('profile', ['user' => $to->username]) }}">&lt;&lt; Return to profile</a></td>
					<td width="20">
						<img src="img/pixel.gif" width="1" height="5">
					</td>
					<td>
						<img src="img/box_login_tr.gif" width="5" height="5">
					</td>
				</tr>
				<tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td style="padding: 2px;font-weight:bold;text-align:right">From: </td>
					<td><a href="{{ route('profile', ['user' => $from->username]) }}">{{ Auth::user()->username }}</a></td>
				</tr><tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td style="padding: 2px;font-weight:bold;text-align:right">To: </td>
					<td><a href="{{ route('profile', ['user' => $to->username]) }}">{{ $to->username }}</a></td>
				</tr>
				
				<form method="POST" id="compose_form">
					@csrf
					<tr>
						<td width="140">
							<img src="img/pixel.gif" width="5" height="1">
						</td>
						<td style="padding: 2px;font-weight:bold;text-align:right">Subject: </td>
						<td><input type="text" name="subject" maxlength="50" size="50" class="dashedInput"></td>
					</tr>
					<tr>
						<td width="140">
							<img src="img/pixel.gif" width="5" height="1">
						</td>
						<td valign="top" style="padding: 2px;font-weight:bold;text-align:right">Message: </td>
						<td>
							<textarea style="width: 560px;height: 100px;overflow-y:auto" class="dashedInput" name="message" form="compose_form"></textarea>
						</td>
					</tr>
					@if($errors->any())
						@foreach($errors->all() as $error)
							<tr>
								<td width="140">
									<img src="img/pixel.gif" width="5" height="1">
								</td>
								<td></td>
								<td style="color:red">{{ $error }}</td>
							</tr>
						@endforeach
					@endif
					<tr>
						<td width="140">
							<img src="img/pixel.gif" width="5" height="1">
						</td>
						<td></td>
						<td><button style="margin-top:8px">Send Message</button></td>
					</tr>
				</form>
				<tr>
					<td>
						<img src="img/box_login_bl.gif" width="5" height="5">
					</td>
					<td>
						<img src="img/pixel.gif" width="1" height="5">
					</td>
					<td>
						<img src="img/box_login_br.gif" width="5" height="5">
					</td>
				</tr>
			</tbody>
		</table>
	</x-inbox>
</x-layout>