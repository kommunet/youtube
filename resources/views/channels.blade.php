<x-layout tab="channels">
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
				<x-modules.title-bar title="All Channels"/>
				
				{{-- Body of the browse container --}}
				{{-- Channel entries --}}
				<x-modules.channel-entries :channels="$channels"/>
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