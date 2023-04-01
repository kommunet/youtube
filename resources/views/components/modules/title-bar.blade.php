<div class="moduleTitleBar">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr valign="top">
			<td {{ ($center && $right) ? 'width=260' : '' }}>
				<div class="moduleTitle">{!! $title !!}</div>
			</td>
			
			@if($center && $right)
				<td width="260" align="center">
					{!! $center !!}
				</td>
			@endif
			
			<td {{ ($center && $right) ? 'width=260' : '' }} align="right">
				{!! $right !!}
			</td>
		</tr>
	</table>
</div>