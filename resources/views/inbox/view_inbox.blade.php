<x-layout tab="home">
	<x-slot name="actions"><x-actions.home tab="messages"/></x-slot>
	<x-inbox :tab="$tab">
		<table cellpadding="4" border="0" align="center" width="100%" bgcolor="#E5ECF9" style="border-collapse: collapse;border: 4px #E5ECF9 solid;">
			<tbody>
				<tr style="font-weight:bold">
					<td width="10">&nbsp;</td>
					<td width="90">From</td>
					<td>Subject</td>
					<td width="120">Sent</td>
				</tr>
				@if($messages->count())
					@foreach($messages as $item)
						<tr bgcolor="{{ ($item->is_read) ? '#E5E5E5' : '#FFFFFF' }}">
							<td align="center">
								<input type="checkbox">
							</td>
							<td>
								<a href="{{ route('profile', ['user' => $item->sentBy->username]) }}">{{ $item->sentBy->username }}</a>
							</td>
							<td>
								<a href="{{ route('inbox.view', ['mid' => $item->message_id]) }}">{{ $item->subject }}</a>
							</td>
							<td>{{ $item->created_at->ytFormat("F j, Y") }}</td>
						</tr>
					@endforeach
				@else
					<tr bgcolor="#FFFFFF">
						<td colspan="4" align="center" style="padding:8px">
							<b style="font-size: 14px;">There are no messages in this folder.</b>
						</td>
					</tr>
				@endif
				<tr style="font-weight:bold">
					@if($tab == "inbox")
					<td colspan="4">
						<button>Mark as Read</button> &nbsp; <button>Mark as Unread</button>
					</td>
					@endif
				</tr>
			</tbody>
		</table>
	</x-inbox>
</x-layout>