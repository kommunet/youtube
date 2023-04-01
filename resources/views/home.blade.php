<x-layout tab="home">
	<x-slot name="actions"><x-actions.home/></x-slot>
	
	<script type="text/javascript" src="/js/video_bar.js"></script>
	
	<script language="JavaScript">
	onLoadFunctionList.push(function() { @if($recently_viewed->count()) imagesInit_recently_viewed(); @endif @if(Auth::check() && $my_video_subscriptions->count()) imagesInit_my_video_subscriptions(); @endif} );

	@if($recently_viewed->count())
	function imagesInit_recently_viewed() {
		imageBrowsers['recently_viewed'] = new ImageBrowser(4, 1, "recently_viewed");
		
		@foreach($recently_viewed as $video)
		imageBrowsers['recently_viewed'].addImage(new ytImage("{{ route('get_still', ['video_id' => $video->video_id]) }}", 
											  "{{ route('watch', ['v' => $video->video_id]) }}",
											  "{{ $video->title }}", 
											  "{{ route('watch', ['v' => $video->video_id]) }}",
											  "{{ $video->last_viewed->diffForHumans() }}",
											  "",
											  false) );
		@endforeach
		imageBrowsers['recently_viewed'].initDisplay();
		imageBrowsers['recently_viewed'].showImages();
		images_loaded = true;
	}
	@endif
	
	@if(Auth::check() && $my_video_subscriptions->count())
	function imagesInit_my_video_subscriptions() {
		imageBrowsers['my_video_subscriptions'] = new ImageBrowser(4, 1, "my_video_subscriptions");
		
		@foreach($my_video_subscriptions as $video)
		imageBrowsers['my_video_subscriptions'].addImage(new ytImage("{{ route('get_still', ['video_id' => $video->video_id]) }}", 
											  "{{ route('watch', ['v' => $video->video_id]) }}",
											  "{{ $video->title }}", 
											  "{{ route('watch', ['v' => $video->video_id]) }}",
											  "{{ $video->created_at->diffForHumans() }}",
											  "",
											  false) );
		@endforeach
		imageBrowsers['my_video_subscriptions'].initDisplay();
		imageBrowsers['my_video_subscriptions'].showImages();
		images_loaded = true;
	}
	@endif



	</script>
	
	<x-search-bar/>
	
	<table width="790" align="center" cellpadding="0" cellspacing="0" border="0">
		<tbody>
			<tr valign="top">
				<td style="padding-right: 15px;">
					<table class="roundedTable" width="595" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EFEFEF">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="585">
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tbody>
											@if(Auth::check())
												<tr valign="top">
													<td width="33%" style="border-right: 1px dashed #CCCCCC; padding: 0px 10px 10px 10px; color: #444;">
														<b>
															<div style="font-size: 16px; color: #0c3768; margin-top:4px">Welcome, {{ Auth::user()->username }}</div>
															<b></b>
														</b>
														<table class="roundedTable" cellspacing="0" cellpadding="0" border="0" style="margin-top: 10px;">
															<tbody>
																<tr valign="top">
																	<td width="271">
																		<div>
																			<table height="28" width="271" background="/img/SmallGenericTab.jpg" cellspacing="0" cellpadding="0" border="0">
																				<tbody>
																					<tr>
																						<td>
																							<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">My Stats</span>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																		<div>
																			<table height="121" width="21" cellspacing="0" cellpadding="0">
																				<tbody>
																					<tr>
																						<td>
																							<table style="background-color: #FFFFFF; border: 1px solid #CCCCCC; border-top: none; padding: 10px;" width="271" height="121" cellspacing="0" cellpadding="0">
																								<tbody>
																									<tr valign="top">
																										<td>
																											<div style="padding-bottom: 5px;">
																												<a href="">My Videos</a> have been viewed {{ Auth::user()->num_video_views }} times
																											</div>
																											<div style="padding-bottom: 5px;">I have {{ Auth::user()->num_friends }} <a href="">Friends</a>
																											</div>
																											<div style="padding-bottom: 5px;">I've watched {{ Auth::user()->num_videos_watched }} videos</div>
																											<div>My Profile has been viewed {{ Auth::user()->num_profile_views }} times</div>
																										</td>
																									</tr>
																								</tbody>
																							</table>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
													<td style="border-right: 0px dashed #369; padding: 0px 10px 10px 10px; color: #444;" width="33%">
														<table class="roundedTable" cellspacing="0" cellpadding="0" border="0" style="margin-top: 32px;">
															<tbody>
																<tr valign="top">
																	<td width="271">
																		<div>
																			<table height="28" width="271" background="/img/SmallGenericTab.jpg" cellspacing="0" cellpadding="0" border="0">
																				<tbody>
																					<tr>
																						<td>
																							<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">My Inbox</span>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																		<div>
																			<table height="121" width="21" cellspacing="0" cellpadding="0">
																				<tbody>
																					<tr>
																						<td>
																							<table style="background-color: #FFFFFF; border: 1px solid #CCCCCC; border-top: none; padding: 10px;" width="271" height="121" cellspacing="0" cellpadding="0">
																								<tbody>
																									<tr valign="top">
																										<td>
																											<div style="padding-bottom: 5px;">
																												<img style="margin-right: 5px;" src="/img/home_mail_icon.gif">You have <a href="">{{ Auth::user()->unreadMessages()->count() }} new message</a>
																											</div>
																											<div style="padding-bottom: 35px;">You have <a href="">0 friend request</a>
																											</div>
																											<div>
																												<a style="font-weight: bold;" href="">Sign up for "The Weekly Tube" e-mail</a>
																												<br> The best YouTube videos delivered to you!
																											</div>
																										</td>
																									</tr>
																								</tbody>
																							</table>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											@else
												<tr valign="top">
													<td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
														<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><a href="browse.php">Watch</a></div>
														Instantly find and watch 1000's of fast streaming videos.
													</td>
													<td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
														<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><a href="my_videos_upload.php">Upload</a></div>
														Quickly upload and tag videos in almost any video format.
													</td>
													<td width="33%" style="padding: 0px 10px 10px 10px; color: #444;">
														<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><a href="my_friends_invite.php">Share</a></div>
														Easily share your videos with family, friends, or co-workers.
													</td>
												</tr>
											@endif
										</tbody>
									</table>
								</td>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
							</tr>
							<tr>
								<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
								<td><img src="/img/pixel.gif" width="1" height="5"></td>
								<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
							</tr>
						</tbody>
					</table>
					
					@if($recently_viewed->count())
					<table class="roundedTable" width="585" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="575">
									<div style="padding-left: 10px; padding-right: 10px;">
										<table width="571" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/MediumGenericTab.jpg">
											<tbody>
												<tr>
													<td width="380px">
														<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">Recently Viewed</span>
														<span style="font-size: 10px; color: #999999;"><span id="counter_recently_viewed">[1 - 4 of 12]</span>
														</span>
													</td>
													<td align="left">		
														<span style="font-size: 13px; color: #6D6D6D;"><span></span>
														</span>
													</td>
													<td align="right">	
														<span style="padding-right: 10px; padding-left: 10px;"><img src="/img/icon_todo.gif" border="0" width="23" height="14" style="padding-right: 5px; vertical-align: middle;">
														<a href="/browse.php?s=mp">More Recently Viewed..</a>
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div style="padding-left: 1px;">					
										<table width="21" height="121" cellpadding="0" cellspacing="0">
											<tr>
												<td><img src="/img/LeftTableArrowWhite.jpg" onclick="shiftLeft('recently_viewed')" width="21" height="121" border="0"></td>
												<td>
													<table width="548" height="121" style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
														<tr>
															<td>
															<div class="videobarthumbnail_block" id="div_recently_viewed_0">
																<center>
																	<div><a id="href_recently_viewed_0" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_0" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_recently_viewed_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_recently_viewed_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_0_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_1">
																<center>
																	<div><a id="href_recently_viewed_1" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_1" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_recently_viewed_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_recently_viewed_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_1_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_2">
																<center>
																	<div><a id="href_recently_viewed_2" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_2" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_recently_viewed_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_recently_viewed_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_2_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_3">
																<center>
																	<div><a id="href_recently_viewed_3" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_3" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_recently_viewed_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_recently_viewed_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_recently_viewed_3_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															</td>
														</tr>
													</table>
												</td>
												<td><img src="/img/RightTableArrowWhite.jpg" onclick="shiftRight('recently_viewed')" width="21" height="121" border="0"></td>
											</tr>
										</table>
									</div>
								</td>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
							</tr>
							<tr>
								<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
								<td><img src="/img/pixel.gif" width="1" height="5"></td>
								<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
							</tr>
						</tbody>
					</table>
					@endif
					
					@if(Auth::check() && $my_video_subscriptions->count())
					<table class="roundedTable" width="585" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="575">
									<div style="padding-left: 10px; padding-right: 10px;">
										<table width="571" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/MediumGenericTab.jpg">
											<tbody>
												<tr>
													<td width="380px">
														<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">My Video Subscriptions</span>
														<span style="font-size: 10px; color: #999999;"><span id="counter_my_video_subscriptions">[1 - 4 of 12]</span>
														</span>
													</td>
													<td align="left">		
														<span style="font-size: 13px; color: #6D6D6D;"><span></span>
														</span>
													</td>
													<td align="right">	
														<span style="padding-right: 10px; padding-left: 10px;"><img src="/img/icon_todo.gif" border="0" width="23" height="14" style="padding-right: 5px; vertical-align: middle;">
														<a href="/subscription_center">View All Subscriptions...</a>
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div style="padding-left: 1px;">					
										<table width="21" height="121" cellpadding="0" cellspacing="0">
											<tr>
												<td><img src="/img/LeftTableArrowWhite.jpg" onclick="shiftLeft('my_video_subscriptions')" width="21" height="121" border="0"></td>
												<td>
													<table width="548" height="121" style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
														<tr>
															<td>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_0">
																<center>
																	<div><a id="href_my_video_subscriptions_0" href=".."><img class="videobarthumbnail_gray" id="img_my_video_subscriptions_0" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_my_video_subscriptions_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_my_video_subscriptions_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_0_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_1">
																<center>
																	<div><a id="href_my_video_subscriptions_1" href=".."><img class="videobarthumbnail_gray" id="img_my_video_subscriptions_1" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_my_video_subscriptions_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_my_video_subscriptions_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_1_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_2">
																<center>
																	<div><a id="href_my_video_subscriptions_2" href=".."><img class="videobarthumbnail_gray" id="img_my_video_subscriptions_2" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_my_video_subscriptions_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_my_video_subscriptions_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_2_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_3">
																<center>
																	<div><a id="href_my_video_subscriptions_3" href=".."><img class="videobarthumbnail_gray" id="img_my_video_subscriptions_3" src="/img/pixel.gif" width="80" height="60"></a></div>
																	<div id="title1_my_video_subscriptions_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
																	<div id="title2_my_video_subscriptions_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															<div class="videobarthumbnail_block" id="div_my_video_subscriptions_3_alternate" style="display: none">
																<center>
																	<div><img src="/img/pixel.gif" width="80" height="60"></div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
																</center>
															</div>
															</td>
														</tr>
													</table>
												</td>
												<td><img src="/img/RightTableArrowWhite.jpg" onclick="shiftRight('my_video_subscriptions')" width="21" height="121" border="0"></td>
											</tr>
										</table>
									</div>
								</td>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
							</tr>
							<tr>
								<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
								<td><img src="/img/pixel.gif" width="1" height="5"></td>
								<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
							</tr>
						</tbody>
					</table>
					@endif
					<!-- begin recently featured -->
					<table class="roundedTable" width="595" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="585">
									<div class="sunkenTitleBar">
										<div class="sunkenTitle">
											<div style="float: right; padding: 1px 5px 0px 0px; font-size: 12px;"><a href="/browse.php">See More Videos</a></div>
											<span style="color:#444;">Today's Featured Videos...</span>
										</div>
									</div>
									<x-modules.video-entries :videos="$featured_videos" type="v" trim="true"/>
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
					<!-- end recently featured -->
				</td>
				<td width="180">
					@if(!Auth::check())
					<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffeebb">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="170">
									<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
										<!--Begin if not logged in Section-->
										<a href="signup.php">Sign up for your free account!</a>
										<div style="font-size: 11px; font-weight: 400; padding: 5px 5px 10px 5px; margin-top: 10px; background-color:#FFFFCC;">
											<a href="nano_contest.php"><strong>Nano a Day Giveaway Extended!</strong></a>
											<div style="text-align: left;">
												<br><br><img src="/img/nano_sm.jpg" width="40" height="88" align="right" hspace="5">We're giving away a 4GB iPod Nano <strong>every day through the end of the year</strong>!  Increase your chances of winning by:
												<ul>
													<li><a href="signup.php">Signing Up</a></li>
													<li><a href="signup_login.php?next=my_friends_invite.php">Inviting Your friends</a></li>
													<li><a href="signup_login.php?next=my_videos_upload.php">Uploading Videos</a></li>
												</ul>
												<div style="text-align: center;">View full <a href="nano_contest.php">contest details</a>.</div>
											</div>
										</div>
										<span style="font-size: 13px; padding-top: 4px;"><a href="nano_contest_winners.php">See all nano winners!</a></span>
									</div>
								</td>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
							</tr>
							<tr>
								<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
								<td><img src="/img/pixel.gif" width="1" height="5"></td>
								<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
							</tr>
						</tbody>
					</table>
					@endif
					<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="170">
									<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
										<div style="font-size: 13px; font-weight: bold; text-align: center; color: #444444; padding-bottom: 5px;"><img src="/img/gray_arrow.gif" width="14" height="14" broder="0" align="absmiddle">&nbsp;Explore New Features</div>
										<table style="background-color: #EAEAEA;" width="100%">
											<tbody>
												<tr>
													<td style="text-align: center;">
														<div style="padding-top: 5px;"><a href="/channels">Channels</a></div>
														<div style="font-size: 11px; font-weight: normal; padding-bottom: 8px;">Find the videos you want.</div>
														<div style="padding-top: 5px;"><a href="http://www.youtube.com/signup_login.php?next=subscription_center.php">Subscriptions</a></div>
														<div style="font-size: 11px; font-weight: normal; padding-bottom: 12px;">Subscribe to videos from your favorite users</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
							</tr>
							<tr>
								<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
								<td><img src="/img/pixel.gif" width="1" height="5"></td>
								<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
							</tr>
						</tbody>
					</table>
					<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="170">
									<!--Begin SimplyFired Contest Information-->
									<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
									<div style="color: #FFFFFF; font-size: 12px; font-weight: bold; text-align: center;">January Video Contest</div>
									<div style="color: #FFFFFF; font-size: 11px; font-weight: normal; text-align: center; padding-bottom: 5px;">Animator vs. YouTube</div>  
									<div style="color:#FFFFFF; font-size: 11px; font-weight: normal; text-align: center;">Sponsored by:</div> 
									<a href="//the.ki" target="_blank"><img src="/img/theki_logo_small.gif"></a>
									<div style="font-size: 11px; font-weight: normal; text-align: center; padding-bottom: 5px; text-decoraton: underline; background: #FFFFFF"><a href="/monthly_contest.php">Enter Now</a></div> 
									</div>
									<!--End SimplyFired Contest Information-->

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
					<div style="margin: 10px 0px 5px 0px; font-size: 12px; font-weight: bold; color: #333;">Recent Tags:</div>
					<div style="font-size: 13px; color: #333333;">
						@foreach($tags as $item)
						<a style="font-size:{{ $item->occurrences > 1 ? '17px' : '12px' }};" href="/results.php?search={{ $item->tag }}">{{ $item->tag }}</a> :
						@endforeach
						<div style="font-size: 14px; font-weight: bold; margin-top: 10px;">
							<a href="/tags.php">See More Tags</a>
						</div>
						<!--User Highlighted Here If Implemented-->
						<x-online-users limit="5"/>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</x-layout>