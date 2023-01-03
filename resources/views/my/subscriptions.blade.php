<x-layout tab="home">
	<x-slot name="actions"><x-actions.home tab="subscriptions"/></x-slot>
	<table width="790" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
		<tbody>
			<tr>
				<td>
					<img src="/img/box_login_tl.gif" width="5" height="5">
				</td>
				<td>
					<img src="/img/pixel.gif" width="1" height="5">
				</td>
				<td>
					<img src="/img/box_login_tr.gif" width="5" height="5">
				</td>
			</tr>
			<tr>
				<td>
					<img src="/img/pixel.gif" width="5" height="1">
				</td>
				<td width="780">
					<x-modules.title-bar title="Subscription Center">
						<x-slot name="right">
							<div style="font-weight: bold; color: #444444; margin-right: 5px;">
								Subscriptions {{ $subscriptions->firstItem() ?? 0 }}-{{ $subscriptions->lastItem() ?? 0 }} of {{ $subscriptions->total() }}
							</div>
						</x-slot>
					</x-modules.title-bar>
					
					<x-modules.featured>
						<table width="770" cellpadding="0" cellspacing="0" border="0">
							<tbody>
								<tr valign="top">
									<td width="100%" align="center">
										<table width="770" cellpadding="0" cellspacing="0" border="0">
											<tbody>
												@if($subscriptions->count())
													@foreach($subscriptions as $count => $subscription)
														@if($count == 0) <tr valign="top"> @endif
														@if(($count) % 3 === 0) </tr><tr valign="top"> @endif
														<td width="33%">
															<table>
																<tbody>
																	<tr>
																		<td>
																			<a href="{{ route('profile', ['user' => $subscription->subscribed_to]) }}">
																				<img src="{{ route('get_still', ['video_id' => $subscription->user->latest_video]) }}" width="80" height="60" style="border: 5px solid #FFFFFF;">
																			</a>&nbsp;
																		</td>
																		<td valign="top">
																			<div style="font-size: 12px; font-weight: bold;">
																				<a href="{{ route('profile', ['user' => $subscription->subscribed_to]) }}">{{ $subscription->subscribed_to }}</a>
																			</div>
																			<div style="font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #666666; padding-top: 2px;">Subscribers: {{ $subscription->user->num_subscribers }} | Videos: {{ $subscription->user->num_public_videos }}</div>
																			<div style="padding-top: 5px;">
																				<form action="{{ route('my.subscriptions') }}">
																					<input type="hidden" name="remove_user" value="{{ $subscription->subscribed_to }}">
																					<input type="submit" value="Unsubscribe">
																				</form>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													@endforeach
												@else
													<tr style="padding-top:4px">
														<td>No subscriptions found. Look for some <a href="/channels.php">channels</a>!</td>
													</tr>
												@endif
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</x-modules.featured>
					{{ $subscriptions->links("components.modules.pagination") }}
				</td>
				<td>
					<img src="/img/pixel.gif" width="5" height="1">
				</td>
			</tr>
			<tr>
				<td>
					<img src="/img/box_login_bl.gif" width="5" height="5">
				</td>
				<td>
					<img src="/img/pixel.gif" width="1" height="5">
				</td>
				<td>
					<img src="/img/box_login_br.gif" width="5" height="5">
				</td>
			</tr>
		</tbody>
	</table>
</x-layout>