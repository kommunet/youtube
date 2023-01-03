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
													<td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
														<b>
															<div style="font-size: 16px; color: #0c3768; margin-top:4px">My Account Overview</div>
															<b></b>
														</b>
														<span style="display:block;margin-top:8px"><b>User Name:</b> <a href="profile.php?user=genosmrpg7899">{{ Auth::user()->username }}</a></span>
														<span style="display:block;margin-top:4px"><b>Email:</b> {{ Auth::user()->email }}</span>
														<span style="display:block;margin-top:4px"><b>Videos watched:</b> {{ (Auth::user()->num_videos_watched) ? Auth::user()->num_videos_watched : 'None' }}</span>
														<table width="100%" cellpadding="0" cellspacing="1" border="0" style="margin-top: 18px;">
															<tbody>
																<tr>
																	<td align="center" valign="top">
																		<a href="#" style="font-size:16px;display:block">Videos: {{ Auth::user()->num_public_videos }}</a>
																		<span style="font-size: 11px;display:block">Views: {{ Auth::user()->num_video_views }}</span>
																		<span style="font-size: 11px;display:block">* Fans: 0</span>
																		</td>
																	<td align="center" valign="top">
																		<a href="#" style="font-size:16px;display:block">Favorites: {{ Auth::user()->num_favorites }}</a>
																	</td>
																	<td align="center" valign="top">
																		<a href="#" style="font-size:16px;display:block">Friends: {{ Auth::user()->num_friends }}</a>
																		<span style="font-size: 11px;display:block"><a href="#">Their Vids</a> (0)</span>
																		<span style="font-size: 11px;display:block"><a href="#">Their Favs</a> (0)</span>
																	</td>
																</tr>
															</tbody>
														</table>
														<span style="display:block;margin-top:8px;font-size:11px">* Number of users that added your videos as a favorite.</span>
													</td>
													<td style="border-right: 0px dashed #369; padding: 0px 10px 10px 10px; color: #444;" width="33%"><span style="display:block;margin-top:8px"><img src="/img/mail.gif" border="0"> You have <a href="my_messages.php">{{ Auth::user()->unreadMessages()->count() }} new messages.</a></span><span style="display:block;margin-top:8px"><b>ToDo List...</b></span><span style="display:block;margin-top:4px"><img src="/img/icon_todo.gif" style="vertical-align: text-bottom;padding-left: 2px;">
														<a href="my_friends_invite.php">Invite Your Friends</a></span>
														@if(!Auth::user()->hasModifiedProfile())
															<span style="display:block;margin-top:4px">
																<img src="/img/icon_todo.gif" style="vertical-align: text-bottom;padding-left: 2px;">
																<a href="my_profile.php">Update Your Profile</a>
															</span>
														@endif
														<br>
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
					<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeeee">
						<tbody>
							<tr>
								<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
								<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
								<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
							</tr>
							<tr>
								<td><img src="/img/pixel.gif" width="5" height="1"></td>
								<td width="170">
									<!--Begin Monthly Contest Information-->
									<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
										<div style="font-size: 12px; font-weight: bold; text-align: center;"><a href="/t/holiday_contest">Holiday Video Contest</a></div>
										<div style="color: #000000; font-size: 11px; font-weight: normal; text-align: center; padding-top: 3px;">Win an Xbox 360!</div>
										<!--<a href="watch?v=fRf7JbpMOBs&amp;search=holidaycontest"><img src="http://static.youtube.com/get_still.php?video_id=fRf7JbpMOBs" width="80" height="60" style="border: 5px solid #FFFFFF; margin-top: 10px;"></a>  -->
										<div style="text-align: center; padding-top: 3px; padding-bottom: 5px;"><img src="/img/x360_logo.gif" width="92" height="60"></div>
										<div style="font-size: 11px; font-weight: normal; text-align: center; padding-bottom: 3px; text-decoraton: underline; padding-top: 3px; background: #eeeeedd;"><a href="/t/holiday_contest">Enter Now</a> | <a href="/results.php?search=holidaycontest">View Entries</a></div>
									</div>
									<!--End Monthly Contest Information-->
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