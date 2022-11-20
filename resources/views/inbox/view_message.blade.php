<x-layout tab="home">
	<x-slot name="actions"><x-actions type="home"/></x-slot>
	<x-inbox :tab="$tab">
		<table cellpadding="0" cellspacing="8" border="0" bgcolor="#E5ECF9" align="center" width="100%">
			<tbody>
				<tr>
					<td width="140"><a href="#">&lt;&lt; Prev</a><span style="margin-left:8px;margin-right:8px">|</span><a href="#">Next &gt;&gt;</a></td>
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
					<td style="padding: 2px;font-weight:bold;text-align:right">
					{{ ($from->id !== Auth::user()->id) ? 'From:' : 'To:' }}										
					</td>
					<td>
						@if($from->id !== Auth::user()->id)
							<a href="{{ route('profile', ['user' => $from->username]) }}">{{ $from->username }}</a>
						@else
							<a href="{{ route('profile', ['user' => $to->username]) }}">{{ $to->username }}</a>
						@endif
					</td>
				</tr>
				<tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td style="padding: 2px;font-weight:bold;text-align:right"></td>
					<td><a href="#">Videos</a> (0) | <a href="#">Favorites</a>
						(0) |
						<a href="#">Friends</a> (0)
					</td>
				</tr>
				<tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td style="padding: 2px;font-weight:bold;text-align:right">Sent: </td>
					<td>{{ $message->created_at->format("F j, Y, h:i a") }}</td>
				</tr>
				<tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td style="padding: 2px;font-weight:bold;text-align:right">Subject: </td>
					<td>{{ $message->subject }}</td>
				</tr>
				<tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td style="padding: 2px;font-weight:bold;text-align:right" valign="top">Message: </td>
					<td>
						<textarea style="width: 560px;height: 100px" class="dashedInput" disabled>{{ $message->message }}</textarea>
					</td>
				</tr>
				<tr>
					<td width="140">
						<img src="img/pixel.gif" width="5" height="1">
					</td>
					<td></td>
					<td><button style="margin-top:8px">Delete</button></td>
				</tr>
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