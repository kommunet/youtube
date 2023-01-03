<td style="font-size: 10px;">&nbsp;</td>
@foreach($sorts as $key => $sort)
	@if($key > 0) <td style="padding: 0px 10px 0px 10px;">|</td> @endif
	<td {{ ($sort->value == $selected) ? 'style=font-weight:bold' : '' }}>
		<a href="{{ route('browse', ['s' => $sort]) }}">{{ $sort->title() }}</a>
	</td>
@endforeach
<td style="font-size: 10px;">&nbsp;</td>