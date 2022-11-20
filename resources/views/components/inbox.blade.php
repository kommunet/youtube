<div>
    <style>
	.dashedInput {
		background: white;
		border: 1px grey dashed;
		padding: 4px;
		font-family: arial;
		color:black
	}
	</style>
	<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
		<tbody>
			<tr>
				<td @if($tab == "inbox") style="font-weight:bold" @endif><a href="{{ route('inbox.received') }}">Inbox Messages</a></td>
				<td style="padding-left:8px;padding-right:8px">|</td>
				<td @if($tab == "sent") style="font-weight:bold" @endif><a href="{{ route('inbox.sent') }}">Sent Messages</a></td>
			</tr>
		</tbody>
	</table>
	@if($subtitle)
		<div class="tableSubTitle">{{ $subtitle }}</div>
	@endif
	{{ $slot }}
</div>