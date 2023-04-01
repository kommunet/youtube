<x-layout tab="videos" :title="$video->title">
	<x-slot name="actions"><x-actions.videos/></x-slot>
	<script>
	function CheckLogin()
	{
		@if(Auth::check())
			return true;
		@else
			window.location="login.php";
			return false;
		@endif
	}


	function getFormVars(form) 
	{	var formVars = new Array();
		for (var i = 0; i < form.elements.length; i++)
		{
			var formElement = form.elements[i];
			formVars[formElement.name] = formElement.value;
		}
		return urlEncodeDict(formVars);
	}



	
	function blockUser(form) 
	{
		if (!confirm("Are you sure you want to block this user?"))
			return true;

		postUrl("link_servlet", getFormVars(form), true, execOnSuccess(function (xmlHttpRequest) { 
				response_str = xmlHttpRequest.responseText;
				if(response_str == "SUCCESS") {
					form.block_button.value = "User blocked"
				} else {
					alert ("An error occured while blocking the user.");
					form.block_button.value = "Block this user"
					form.block_button.disabled = false;
				}
			}));	
		form.block_button.disabled = true
		form.block_button.value = "Please wait.."
	}
	function unblockUser(form) 
	{
		if (!confirm("Are you sure you want to unblock this user?"))
			return true;

		postUrl("link_servlet", getFormVars(form), true, execOnSuccess(function (xmlHttpRequest) { 
				response_str = xmlHttpRequest.responseText;
				if(response_str == "SUCCESS") {
					form.unblock_button.value = "User unblocked"
				} else {
					alert ("An error occured while unblocking the user.");
					form.unblock_button.value = "Unblock this user"
					form.unblock_button.disabled = false;
				}
			}));	
		
		form.unblock_button.disabled = true
		form.unblock_button.value = "Please wait.."
	}


	function showCommentReplyForm(form_id, reply_parent_id, is_main_comment_form) {
		if(!CheckLogin()) 
			return false;
		printCommentReplyForm(form_id, reply_parent_id, is_main_comment_form);
	}
	function printCommentReplyForm(form_id, reply_parent_id, is_main_comment_form) {

		var div_id = "div_" + form_id;
		var reply_id = "reply_" + form_id;
		var reply_comment_form = "comment_form" + form_id;
		
		if (is_main_comment_form)
			discard_visible="style='display: none'";
		else
			discard_visible="";
		
		var innerHTMLContent = '\
		<div style="padding-bottom: 5px; font-weight: bold; color: #444; display: none;">Comment on this video:</div>\
		<form name="' + reply_comment_form + '" id="' + reply_comment_form + '" method="post" action="comment_servlet" >\
			@csrf\
			<input type="hidden" name="video_id" value="{{ $video->video_id }}">\
			<input type="hidden" name="add_comment" value="">\
			<input type="hidden" name="form_id" value="' + reply_comment_form + '">\
			<input type="hidden" name="reply_parent_id" value="' + reply_parent_id + '">\
			<textarea tabindex="2" name="comment" cols="55" rows="3"></textarea>\
			<br>\
			Attach a video:\
			<select name="field_reference_video">\
				<option value="">- Your Videos -</option>\
				@if(Auth::check())
					@foreach(Auth::user()->videos()->where("id", "!=", $video->id)->get() as $item) <option value="{{ $item->video_id }}">{{ $item->title }}</option>\ @endforeach
				@endif
				<option value="">- Your Favorite Videos -</option>\
			</select>\
			<input type="button" name="add_comment_button" \
								value="Post Comment" \
								onclick="postThreadedComment(\'' + reply_comment_form + '\');">\
			<input type="button" name="discard_comment_button"\
								value="Discard" ' + discard_visible + '\
								onclick="hideCommentReplyForm(\'' + form_id + '\',false);">\
		</form></div>';
		if(!is_main_comment_form) {
			toggleVisibility(reply_id, false);
		}
		toggleVisibility(div_id, true);
		setInnerHTML(div_id, innerHTMLContent);
	}



	function addFavorite()
	{
		getUrl("/favorites?video_id={{ $video->video_id }}&action_add_favorite=1", true, execOnSuccess(function() { alert("This video has been added to your favorites."); }));
	}

	function openFull()
	{
	  var fs = window.open( "/watch_fullscreen?video_id={{ $video->video_id }}&l=12&fs=1&title=" + "Jesus Hitting Isaac in the Face" ,
			   "FullScreenVideo", "toolbar=no,width=" + screen.availWidth  + ",height=" + screen.availHeight 
			 + ",status=no,resizable=yes,fullscreen=yes,scrollbars=no");
	  fs.focus();
	}

	</script>
	<script type="text/javascript" src="/flashobject.js"></script>
	<script type="text/javascript" src="/js/components.js"></script>
	<script type="text/javascript" src="/js/AJAX.js"></script>
	<script type="text/javascript" src="/js/ui.js"></script>
	<script type="text/javascript" src="/js/comments.js"></script>

	<script language="javascript" type="text/javascript">
	function dropdown_jumpto(x)
	{
		if (document.share_dropdown.jumpmenu.value != "null")
		{
			document.location.href = x;
		}
	}
	
	onLoadFunctionList.push(function() { printCommentReplyForm('main_comment', '', true) } );
	side_imgs_loaded = false;
	</script>
	
	<x-search-bar/>
	<table width="790" align="center" cellpadding="0" cellspacing="0" border="0">
		<tbody>
			<tr valign="top">
				<td width="510" style="padding-right: 15px;">
					<div style="font-size: 16px; font-weight: bold; color: #333333; padding-left: 22px;">{{ $video->title }}</div>
					<div style="text-align: center; padding-bottom: 8px;">
						<div id="flashcontent">
							<div style="padding: 20px; font-size:14px; font-weight: bold;"> Hello, you either have JavaScript turned off or an old version of Macromedia's Flash Player, <a href="//www.macromedia.com/go/getflashplayer/">click here</a> to get the latest flash player. </div>
						</div>
					</div>
					<script type="text/javascript">
						// <![CDATA[
						
						var fo = new FlashObject("/player.swf?video_id={{ $video->video_id }}&l={{ ceil($video->runtime) }}", "player", "470", "390", 7, "#FFFFFF");
						fo.write("flashcontent");
						
						// ]]>
					</script>
					<div style="font-size: 12px; font-weight: bold; text-align: center; padding-bottom: 10px;">
						<a href="/signup_login.php?&amp;next=watch.php&amp;r=c&amp;v={{ $video->video_id }}">Post Comments</a> &nbsp;&nbsp;//&nbsp;&nbsp; <a href="/signup_login.php?&amp;next=watch.php&amp;r=a&amp;v={{ $video->video_id }}">Add to Favorites</a> &nbsp;&nbsp;//&nbsp;&nbsp; <a href="/signup_login.php?&amp;next=watch.php&amp;r=o&amp;v={{ $video->video_id }}">Flag This Video</a>
					</div>
					@if(Auth::check() && Auth::user()->isModerator())
					<div style="font-size: 12px; font-weight: bold; text-align: center; padding-bottom: 10px;">
						<span style="color:grey">Moderation Tools: &nbsp;&nbsp;</span> 
						<a href="/admin_feature.php?video_id={{ $video->video_id }}" style="color:red">{{ $video->isFeatured() ? 'Refeature' : 'Feature' }}</a> &nbsp;&nbsp;//&nbsp;&nbsp; 
						@if($video->isFeatured())
							<a href="/admin_unfeature.php?video_id={{ $video->video_id }}" style="color:red">Unfeature</a> &nbsp;&nbsp;//&nbsp;&nbsp; 
						@endif
						<a href="/admin_remove.php?video_id={{ $video->video_id }}" style="color:red">Remove Video</a>
					</div>
					@endif
					<table width="400" cellpadding="0" cellspacing="0" border="0" align="center">
						<tbody>
							<tr>
								<td style="padding-bottom: 15px;">
									@if($video->num_ratings)
										<div style="float:left; margin-left:5em; padding-right: 18px;">
											<span>Average ({{ $video->num_ratings }} votes)</span>
											<br>
											<nobr>
												@for ($i = 0; $i < 5; $i++)
												<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="{{ $video->star($i + 1) }}">
												@endfor
											</nobr>
										</div>
									@endif
									<div id="ratingDiv" style="{{ $video->num_ratings ? 'float:right' : 'text-align:center' }}; margin-right:5em;">
										<span id="ratingMessage">{{ $video->num_ratings ? 'Rate this video!' : 'Be the first to rate this video!' }}</span>
										@if(Auth::check())
										<form style="display:none;" name="ratingForm" action="/rating" method="POST">
											@csrf
											<input type="hidden" name="action_add_rating" value="1" />
											<input type="hidden" name="rating_count" value="{{ $video->num_ratings }}">
											<input type="hidden" name="video_id" value="{{ $video->video_id }}">
											<input type="hidden" name="user_id" value="{{ Auth::user()->username }}">
											<input type="hidden" name="rating" id="rating" value="">
										</form>
										<script language="javascript">
											ratingComponent = new UTRating('ratingDiv', 5, 'ratingComponent', 'ratingForm');
											ratingComponent.starCount={{ $user_rating }}
													onLoadFunctionList.push(function() { ratingComponent.drawStars({{ $user_rating }}, true); });
										</script>
										@endif
										<br>
										@if(!Auth::check())<a href="/signup.php" style="text-decoration:none;" title="Please sign up and login to rate this video.">@endif
										
										<nobr>
											@for ($i = 0; $i < 5; $i++)
												@if(Auth::check())<a href="#" onclick="ratingComponent.setStars({{ $i + 1 }}); return false;" onmouseover="ratingComponent.showStars({{ $i + 1 }});" onmouseout="ratingComponent.clearStars();" style="text-decoration:none">@endif
												
												<img id="star_{{$i+1}}" style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="/img/star_bg.gif">
												
												@if(Auth::check())</a>@endif
											@endfor
										</nobr>
										
										@if(!Auth::check())</a>@endif
									</div>
									<!-- <br clear="all" /></div> -->
								</td>
							</tr>
						</tbody>
					</table>
					<table width="485" cellpadding="0" cellspacing="0" border="0" align="center">
						<tbody>
							<tr>
								<td>
									<div class="watchDescription">{!! nl2br(e($video->description)) !!}</div>
									<div style="font-size: 11px; padding-bottom: 18px;"> Added on {{ YouTube::format($video->created_at, "F j, Y, g:i a") }}  by <a href="/profile.php?user={{ $uploader->username }}">{{ $uploader->username }}</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="485" cellpadding="0" cellspacing="0" border="0" align="center">
						<tbody>
							<tr valign="top">
								<td width="245" style="border-right: 1px dotted #AAAAAA; padding-right: 5px;">
									<div style="font-weight: bold; color:#003399; padding-bottom: 7px;">Video Details //</div>
									<div style="font-size: 11px; padding-bottom: 10px;"> Runtime: {{ $video->runtime() }} | Views: {{ $video->num_views }} | <a href="#comment">Comments</a>: {{ $video->num_comments }} </div>
									<div style="padding-bottom: 10px;">
										<span style="background-color: #FFFFAA; padding: 2px;">Tags:</span>&nbsp; 
										@foreach($video->tags() as $key => $tag)
										<a href="#">{{ $tag }}</a>{{ ($key + 1 < count($video->tags())) ? ", " : "" }}
										@endforeach
									</div>
									<div style="padding-bottom: 10px;">
										@if($channels->count())
											<span style="background-color: #FFFFAA; padding: 2px;">Channels:</span>
											@foreach($channels as $key => $channel)
												<a href="channels_portal?c={{ $channel->id }}">{{ $channel->title }}</a>{{ ($key + 1 < $channels->count()) ? ", " : "" }}
											@endforeach
										@endif
									</div>
									<div style="font-size: 11px; padding-bottom: 10px;">
										@if($video->misc->date_recorded) Recorded: {{ $video->misc->date_recorded }} @endif
										<br>
										@if($video->getLocation()) Location: <a href="{{ $video->getLocation()->url }}" target="_blank">{{ $video->getLocation()->text }}</a> @endif
									</div>
								</td>
								<td width="240" style="padding-left: 10px;">
									<div style="font-weight: bold; font-size: 12px; color:#003399; padding-bottom: 7px;">User Details //</div>
									<div style="font-size: 11px; padding-bottom: 10px;">
										<a href="/profile_videos.php?user={{ $uploader->username }}">Videos</a>: {{ $uploader->num_public_videos }} | <a href="/profile_favorites.php?user={{ $uploader->username }}">Favorites</a>: {{ $uploader->num_favorites }} | <a href="/profile_friends.php?user={{ $uploader->username }}">Friends</a>: {{ $uploader->num_friends }}
									</div>
									<div style="padding-bottom: 10px;">
										<span style="background-color: #FFFFAA; padding: 2px;">User Name:</span>&nbsp; <a href="/profile.php?user={{ $uploader->username }}">{{ $uploader->username }}</a>
									</div>
									<div style="padding-bottom: 5px;">
										<img src="/img/SubscribeIcon.gif" align="absmiddle">&nbsp; <a href="{{ ($is_subscribed) ? route('my.subscriptions', ['remove_user' => $uploader->username]) : route('my.subscriptions', ['add_user' => $uploader->username]) }}">{!! ($is_subscribed) ? 'unsubscribe</a> from' : 'subscribe</a> to' !!} {{ $uploader->username }}'s videos
									</div>
									<div style="padding-bottom: 10px;">
										@if($uploader->online())
											<div style="padding-bottom: 10px;">
												<img src="/img/Little_Man.gif" width="15" height="20" align="absmiddle">&nbsp;I am online now!
											</div>
										@else
											<div style="padding-bottom: 10px;">I was on the site {{ $uploader->last_online->diffForHumans() }}. </div>
										@endif
										<div style="font-weight: bold; padding-bottom: 10px;">
											<a href="{{ route('inbox.compose', ['user' => $video->uploader]) }}">Send Me a Private Message!</a>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<!-- watchTable -->
					<table width="485" cellpadding="0" cellspacing="0" border="0" align="center" style="table-layout: fixed;">
						<tbody>
							<tr>
								<td>
									<form name="linkForm" id="linkForm">
										<table width="485" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
											<tbody>
												<tr>
													<td width="33%">
														<div align="left" style="font-weight: bold; font-size: 12px; color:#003399; padding-bottom: 7px;"> Share Details // &nbsp; <a href="/sharing.php">Help?</a>
														</div>
													</td>
													<td width="67%">&nbsp;</td>
												</tr>
												<tr>
													<td valign="top">
														<span style="background-color: #FFFFAA; padding: 2px;">Video URL (Permalink):</span>
														<font style="color: #000000;">&nbsp;&nbsp;</font>
													</td>
													<td valign="top">
														<input name="video_link" type="text" onclick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" value="http://www.youtube.com/?v={{ $video->video_id }}" style="width: 300px;" readonly="true">
														<div style="font-size: 11px;">(E-mail or link it) <br>
															<br>
														</div>
													</td>
												</tr>
												<tr>
													<td valign="top">
														<span style="background-color: #FFFFAA; padding: 2px;">Embeddable Player:</span>
													</td>
													<td valign="top">
														<input name="video_play" type="text" onclick="javascript:document.linkForm.video_play.focus();document.linkForm.video_play.select();" value="<object width=&quot;425&quot; height=&quot;350&quot;><param name=&quot;movie&quot; value=&quot;http://www.youtube.com/v/{{ $video->video_id }}&quot;></param><embed src=&quot;http://www.youtube.com/v/{{ $video->video_id }}&quot; type=&quot;application/x-shockwave-flash&quot; width=&quot;425&quot; height=&quot;350&quot;></embed></object>" style="width: 300px;" readonly="true">
														<div style="font-size: 11px;">(Put this video on your website. Works on Friendster, eBay, Blogger, MySpace!) <br>
															<br>
														</div>
													</td>
												</tr>
												<tr></tr>
												<tr>
													<td colspan="2" valign="top">
														<br>
														@if($sites_linking->count())
															<span style="background-color: #FFFFAA; padding: 2px;">Sites linking to this video:</span>
															@foreach($sites_linking as $link)
																<div style="font-size: 11px; padding-bottom: 7px;"></div> » <b>{{ $link->clicks }} clicks from </b>
																<a href="{{ $link->referer }}" target="_top">{{ $link->referer }}</a>
																<br>
															@endforeach
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<a name="comment"></a>
					<div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comment on this video:</div>
					<div id="div_main_comment">
						<div style="padding-bottom: 5px; font-weight: bold; color: #444; display: none;">Comment on this video:</div>
					</div>
					<br>
					<table width="495">
						<tbody>
							<tr>
								<td>
									<table class="commentsTitle" width="100%">
										<tbody>
											<tr>
												<td>Comments ({{ $video->num_comments }}): </td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									@foreach($comments as $comment)
										<a name="{{ $comment->comment_id }}">
											<table class="parentSection" id="comment_{{ $comment->comment_id }}" width="100%" style="margin-left: 0px">
												<tbody>
													<tr valign="top">
														@if($comment->reference_video)
															<td>
																<a href="{{ route('watch', ['v' => $comment->reference_video]) }}">
																	<img src="{{ route('get_still', ['video_id' => $comment->reference_video]) }}" class="commentsThumb" width="60" height="45">
																</a>
																<div class="commentSpecifics">
																	<a href="{{ route('watch', ['v' => $comment->reference_video]) }}">Related Video</a>
																</div>
															</td>
														@endif
														<td> {{ $comment->body }} <div class="userStats">
																<a href="{{ route('profile', ['user' => $comment->commenter]) }}">{{ $comment->commenter }}</a> // <a href="#">Videos</a> ({{ $comment->commenter()->num_public_videos }}) | <a href="#">Favorites</a> ({{ $comment->commenter()->num_favorites }}) | <a href="#">Friends</a> ({{ $comment->commenter()->num_friends }}) - ({{ $comment->created_at->diffForHumans() }})
															</div>
															<div class="userStats" id="container_comment_form_id_{{ $comment->comment_id }}" style="display: none"></div>
															<div class="userStats" id="reply_comment_form_id_{{ $comment->comment_id }}"> (<a href="javascript:showCommentReplyForm('comment_form_id_{{ $comment->comment_id }}', '{{ $comment->comment_id }}', false);">Reply to this</a>) &nbsp; (<a href="javascript:showCommentReplyForm('comment_form_id_{{ $comment->comment_id }}', '', false);">Create new thread</a>) &nbsp; </div>
															<div id="div_comment_form_id_{{ $comment->comment_id }}"></div>
														</td>
													</tr>
												</tbody>
											</table>
										</a>
										@foreach($comment->replies() as $reply)
											<a name="{{ $reply->comment_id }}">
												<table class="childrenSection" id="comment_{{ $reply->comment_id }}" width="100%" style="margin-left: 20px">
													<tbody>
														<tr valign="top">
															@if($reply->reference_video)
																<td>
																	<a href="{{ route('watch', ['v' => $reply->reference_video]) }}">
																		<img src="{{ route('get_still', ['video_id' => $reply->reference_video]) }}" class="commentsThumb" width="60" height="45">
																	</a>
																	<div class="commentSpecifics">
																		<a href="{{ route('watch', ['v' => $reply->reference_video]) }}">Related Video</a>
																	</div>
																</td>
															@endif
															<td> {{ $reply->body }} <div class="userStats">
																	<a href="{{ route('profile', ['user' => $reply->commenter]) }}">{{ $reply->commenter }}</a> // <a href="#">Videos</a> ({{ $reply->commenter()->num_public_videos }}) | <a href="#">Favorites</a> ({{ $reply->commenter()->num_favorites }}) | <a href="#">Friends</a> ({{ $reply->commenter()->num_friends }}) - ({{ $reply->created_at->diffForHumans() }})
																</div>
																<div class="userStats" id="container_comment_form_id_{{ $reply->comment_id }}" style="display: none"></div>
																<div class="userStats" id="reply_comment_form_id_{{ $reply->comment_id }}"> (<a href="javascript:showCommentReplyForm('comment_form_id_{{ $reply->comment_id }}', '{{ $reply->comment_id }}', false);">Reply to this</a>) &nbsp; (<a href="javascript:showCommentReplyForm('comment_form_id_{{ $reply->comment_id }}', '{{ $comment->comment_id }}', false);">Reply to parent</a>) &nbsp; (<a href="javascript:showCommentReplyForm('comment_form_id_{{ $reply->comment_id }}', '', false);">Create new thread</a>) &nbsp; </div>
																<div id="div_comment_form_id_{{ $reply->comment_id }}"></div>
															</td>
														</tr>
													</tbody>
												</table>
											</a>
										@endforeach
									@endforeach
								</td>
							</tr>
						</tbody>
					</table>
					<a name="flag"></a>
					<table width="495" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFEEBB" style="margin-top: 10px;">
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
								<td width="485" style="padding: 5px 5px 10px 5px; text-align: center;">
									<div style="font-size: 14px; padding-bottom: 5px;"> Please help keep this site <strong>FUN</strong>, <strong>CLEAN</strong>, and <strong>REAL</strong>. </div>
									<div style="font-size: 12px;"> Flag this video:&nbsp; <a href="/flag_video?v={{ $video->video_id }}&amp;flag=F">Feature This!</a> &nbsp; <a href="/flag_video?v={{ $video->video_id }}&amp;flag=I">Inappropriate</a>
									</div>
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
				</td>
				<td width="280">
					<div style="padding-bottom: 10px;">
						<table width="280" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEEE">
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
									<td width="270" style="padding: 5px 0px 5px 0px;">
										<table width="270" cellpadding="0" cellspacing="0" border="0">
											<tbody>
												<tr>
													<td align="center">
														<img src="/img/no_prev.gif" width="60" height="45" style="border: 5px solid #FFFFFF;">
														<div style="font-size: 10px; font-weight: bold; padding-top: 3px;">&lt; PREV</div>
													</td>
													<td align="center">
														<img src="{{ route('get_still', ['video_id' => $video->video_id]) }}" width="80" height="60" style="border: 5px solid #FFFFFF;">
														<div style="font-size: 10px; font-weight: bold; padding-top: 3px;">NOW PLAYING</div>
													</td>
													
													@if($next)
													<td align="center">
														<a href="{{ route('watch', ['v' => $next]) }}">
															<img src="{{ route('get_still', ['video_id' => $next]) }}" width="60" height="45" style="border: 5px solid #FFFFFF;">
														</a>
														<div style="font-size: 10px; font-weight: bold; padding-top: 3px;">
															<a href="{{ route('watch', ['v' => $next]) }}">NEXT &gt;</a>
														</div>
													</td>
													@endif
												</tr>
											</tbody>
										</table>
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
					</div>
					<table width="280" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
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
								<td width="270">
									<div class="moduleTitleBar">
										<table width="270" cellpadding="0" cellspacing="0" border="0">
											<tbody>
												<tr valign="top">
													<td>
														<div class="moduleFrameBarTitle">Related Videos ({{ $related->count() }} of {{ $related->total() }})</div>
													</td>
													@if($related->count() > 4)
													<td align="right">
														<div style="font-size: 11px; margin-right: 5px;">
															<a href="/results.php?related=Scary%20car%20commercial%20ghost" target="_parent">See All Results</a>
														</div>
													</td>
													@endif
												</tr>
											</tbody>
										</table>
									</div>
									<div id="side_results" name="side_results">
										@foreach($related as $item)
											<div class="moduleFrameEntry{{ $item->id == $video->id ? 'Selected' : '' }}">
												<table width="235" cellpadding="0" cellspacing="0" border="0">
													<tbody>
														<tr valign="top">
															<td width="90">
																<a href="{{ route('watch', ['v' => $item->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}" class="bold" target="_parent">
																	<img src="{{ route('get_still', ['video_id' => $item->video_id]) }}" class="moduleEntryThumb" width="80" height="60">
																</a>
															</td>
															<td>
																<div class="moduleFrameTitle">
																	<a href="{{ route('watch', ['v' => $item->video_id]) }}{{ request()->has('search') ? '&search='.request()->get('search') : '' }}" target="_parent">{{ $item->title }}</a>
																</div>
																<div class="moduleFrameDetails"> by <a href="/profile?user={{ $item->uploader }}" target="_parent">{{ $item->uploader }}</a>
																</div>
																<div class="moduleFrameDetails"> Runtime: {{ $item->runtime() }} <br> Views: {{ $item->num_views }} <br> Comments: {{ $item->num_comments }} </div>
																@if($item->id == $video->id)
																	<div style="font-size: 10px; font-weight:bold; color: #CC6600; padding: 3px 6px; background-color:#FFCC66;">
																		<nobr>&lt;&lt;&lt; NOW PLAYING!</nobr>
																	</div>
																@endif
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										@endforeach
										
										@if($related->total() > 4)
										<div class="moduleFrameEntry">
											<table width="235" cellpadding="0" cellspacing="0" border="0">
												<tbody>
													<tr align="center" valign="top">
														<td>
															<a href="/results.php?related=Scary%20car%20commercial%20ghost">See All Results</a>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										@endif
									</div>
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
					@if($tags->count())
						<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">Related Tags:</div>
						@foreach($tags as $tag)
							<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="/results.php?search={{ $tag }}">{{ $tag }}</a>
							</div>
						@endforeach
					@endif
					<!--
					<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">Playlists:</div>
					<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="view_play_list?p=538CA579D23B5B29">jessica</a>
					</div>
					<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="view_play_list?p=FA4678CBDD151012">walawalawonkey</a>
					</div>
					<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="view_play_list?p=66DC51FE2B3B0414">paborito</a>
					</div>
					<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="view_play_list?p=5A1412AC16CA34AF">Scaring Things</a>
					</div>
					<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="view_play_list?p=8E33F255C2C969C7">Robyn's List</a>
					</div>-->
				</td>
			</tr>
		</tbody>
	</table>
</x-layout>