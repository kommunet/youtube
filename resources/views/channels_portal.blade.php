<x-layout tab="channels">
	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; color: #666666; padding-top: 15px; padding-bottom: 15px;"><img src="/img/ChannelArrow.gif" align="absmiddle">&nbsp;<a href="/channels.php">Channels</a> // {{ $channel->title }}</div>
	<table width="790" cellspacing="0" cellpadding="0" border="0" align="center">
		<tbody>
			<tr valign="top">
				<td style="padding-right: 15px;">
					<!-- Begin Most Active Users in the Channel Section -->
					<div style="padding: 7px 0px 7px 0px;">
						<table width="595" cellspacing="0" cellpadding="0" border="0" bgcolor="#EEEEDD" align="center">
							<tbody>
								<tr>
									<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
									<td><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
								</tr>
								<tr>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
									<td width="585">
										<div style="padding: 2px 5px 8px 5px;">
											<div style="float: right; padding: 1px 5px 0px 0px;">&nbsp;</div>
											<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666;">Most Active Users in the Channel</div>
											<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody>
													<tr>
														@foreach($activeUsers as $user)
														<td style="text-align: center; width: 20%;" valign="top">
															<a href="{{ route('profile', ['user' => $user->username]) }}"><img src="{{ route('get_still', ['video_id' => $user->latest_video]) }}" style="border: 5px solid #FFFFFF; margin-top: 10px;" width="80" height="60"></a>
															<div class="moduleEntryDetails" style="padding-top:5px;"><a href="{{ route('profile', ['user' => $user->username]) }}">{{ $user->username }}</a> ({{ $user->num_public_videos }})</div>
														</td>
														@endforeach
													</tr>
												</tbody>
											</table>
										</div>
									</td>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
								</tr>
								<tr>
									<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
									<td><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- End Most Active Users in the Channel Section -->
					<!-- Begin Recently Added to Channel Section -->
					<div style="padding: 7px 0px 7px 0px;">
						<table width="595" cellspacing="0" cellpadding="0" border="0" bgcolor="#EEEEDD" align="center">
							<tbody>
								<tr>
									<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
									<td><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
								</tr>
								<tr>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
									<td width="585">
										<div style="padding: 2px 5px 8px 5px;">
											<div style="float: right; padding: 1px 5px 0px 0px;font-size: 12px; font-weight: bold;"><a href="{{ route('channels', ['c' => $channel->id]) }}">See More Videos</a></div>
											<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666;">Recently Added to {{ $channel->title }}</div>
											<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody>
													<tr>
														@foreach($recentVideos as $video)
														<td style="text-align: center; width: 20%;" valign="top">
															<a href="{{ route('watch', ['v' => $video->video_id]) }}"><img src="{{ route('get_still', ['video_id' => $video->video_id]) }}" style="border: 5px solid #FFFFFF; margin-top: 10px;" width="80" height="60">
															</a>
															<div class="moduleEntrySpecifics" style="padding-top:5px; font-weight: bold;"><a href="{{ route('watch', ['v' => $video->video_id]) }}"></a><a href="{{ route('watch', ['v' => $video->video_id]) }}">{{ $video->title }}</a></div>
															<div class="moduleEntrySpecifics">By: <a href="{{ route('profile', ['user' => $video->uploader]) }}">{{ $video->uploader }}</a></div>
															<div class="moduleEntrySpecifics">Runtime: {{ $video->runtime() }}</div>
															<div class="moduleEntrySpecifics">Views: {{ $video->num_views }}</div>
															<div class="moduleEntrySpecifics">Comments: {{ $video->num_comments }}</div>
															<!--Begin Rated Section-->
															<nobr>
																<img class="rating" src="{{ $video->star(1, true) }}">
																<img class="rating" src="{{ $video->star(2, true) }}">
																<img class="rating" src="{{ $video->star(3, true) }}">
																<img class="rating" src="{{ $video->star(4, true) }}">
																<img class="rating" src="{{ $video->star(5, true) }}">
															</nobr>
															<span class="rating">({{ $video->num_ratings }} ratings)</span>
															<!--End Rated Section-->
														</td>
														@endforeach
													</tr>
												</tbody>
											</table>
										</div>
									</td>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
								</tr>
								<tr>
									<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
									<td><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- End Recently Added to Channel Section -->
					<!-- Begin Top Watched in Channel Section -->
					<div style="padding: 7px 0px 7px 0px;">
						<table width="595" cellspacing="0" cellpadding="0" border="0" bgcolor="#EAE9EF" align="center">
							<tbody>
								<tr>
									<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
									<td><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
								</tr>
								<tr>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
									<td width="585">
										<div style="padding: 2px 5px 8px 5px;">
											<div style="float: right; padding: 1px 5px 0px 0px;font-size: 12px; font-weight: bold;"><a href="{{ route('channels', ['c' => $channel->id]) }}">See More Videos</a></div>
											<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666;">Top Watched Videos in {{ $channel->title }} Channel</div>
											<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
												<tbody>
													<tr>
														@foreach($topVideos as $video)
														<td style="text-align: center; width: 20%;" valign="top">
															<a href="{{ route('watch', ['v' => $video->video_id]) }}"><img src="{{ route('get_still', ['video_id' => $video->video_id]) }}" style="border: 5px solid #FFFFFF; margin-top: 10px;" width="80" height="60">
															</a>
															<div class="moduleEntrySpecifics" style="padding-top:5px; font-weight: bold;"><a href="{{ route('watch', ['v' => $video->video_id]) }}"></a><a href="{{ route('watch', ['v' => $video->video_id]) }}">{{ $video->title }}</a></div>
															<div class="moduleEntrySpecifics">By: <a href="{{ route('profile', ['user' => $video->uploader]) }}">{{ $video->uploader }}</a></div>
															<div class="moduleEntrySpecifics">Runtime: {{ $video->runtime() }}</div>
															<div class="moduleEntrySpecifics">Views: {{ $video->num_views }}</div>
															<div class="moduleEntrySpecifics">Comments: {{ $video->num_comments }}</div>
															<!--Begin Rated Section-->
															<nobr>
																<img class="rating" src="{{ $video->star(1, true) }}">
																<img class="rating" src="{{ $video->star(2, true) }}">
																<img class="rating" src="{{ $video->star(3, true) }}">
																<img class="rating" src="{{ $video->star(4, true) }}">
																<img class="rating" src="{{ $video->star(5, true) }}">
															</nobr>
															<span class="rating">({{ $video->num_ratings }} ratings)</span>
															<!--End Rated Section-->
														</td>
														@endforeach
													</tr>
												</tbody>
											</table>
										</div>
									</td>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
								</tr>
								<tr>
									<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
									<td><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- End Top Watched in Channel Section -->
				</td>
				<td width="180">
					<!--Begin Top Right Links Section-->
					@if(!Auth::check())
					<div style="font-size: 12px; font-weight: bold;"><a href="/signup">Sign up for your free account!</a></div>
					@endif
					<!--End Top Right Links Section-->
					<!--Begin Recent Tags Section-->
					<div style="margin: 10px 0px 5px 0px; font-size: 12px; font-weight: bold; color: #333;">Recent Tags for this Channel:</div>
					@foreach($recentTags as $item)
					<a href="{{ route('results', ['search' => $item->tag]) }}">{{ $item->tag }}</a>, 
					@endforeach
					<div style="font-size: 13px; color: #333333;">
						<div style="font-size: 14px; font-weight: bold; margin-top: 10px;"><a href="{{ route('tags') }}">See More Tags</a></div>
					</div>
					<!--End Recent Tags Section-->
				</td>
			</tr>
		</tbody>
	</table>
</x-layout>