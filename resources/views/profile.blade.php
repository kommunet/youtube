<x-layout>
	<div style="padding: 0px 5px 0px 5px;">
		@if(session()->has("success"))
			<table width="100%" align="center" cellpadding="6" cellspacing="3" border="0" bgcolor="green" style="margin-bottom: 10px;">
				<tbody>
					<tr>
						<td align="center" bgcolor="#FFFFFF">
							<span style="font-weight: bold;color: green;">
							{{ session()->get("success") }}
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		@endif
		<div style="padding-bottom: 15px;">
			<table align="center" cellpadding="0" cellspacing="0" border="0">
				<tbody>
					<tr>
						<td>
							<strong>Profile</strong>
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="#">Public Videos</a> (0)
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="#">Private Videos</a> (0)
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="#">Favorites</a> (0)
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="#">Friends</a> (0)
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="#">Playlists</a> (0)
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tbody>
				<tr valign="top">
					<td width="595" style="padding-right: 15px;">
						<div style="border: 1px solid #CCCCCC; padding: 15px 15px 30px 15px;">
							<div style="font-size: 18px; font-weight: bold; color: #CC6633; margin-bottom: 2px;">Hello. I'm {{ $user->username }}.</div>
							<div style="font-size: 14px; font-weight: bold; color: #999999;">I have watched 0 videos!</div>
							<!-- Personal Information: -->
							<div class="profileLabel">Last Login:</div> {{ $user->last_login->diffForHumans() }} 
							<div class="profileLabel">Signed up:</div> {{ $user->created_at->diffForHumans() }}
							@if($user->profile->name) 				   <div class="profileLabel">Name:</div>                    {{ $user->profile->name }} 				    @endif
							@if($user->profile->age)                   <div class="profileLabel">Age:</div>                     {{ $user->profile->age }} 				    @endif
							@if($user->profile->gender)				   <div class="profileLabel">Gender:</div>                  {{ $user->profile->gender }} 				@endif
							@if($user->profile->relationship_status)   <div class="profileLabel">Relationship Status:</div>     {{ $user->profile->relationship_status }}   @endif
							@if($user->profile->about_me) 			   <div class="profileLabel">About Me:</div>      	        {!! nl2br(e($user->profile->about_me)) !!}  @endif
							@if($user->profile->personal_website)  	   <div class="profileLabel">Personal Website:</div>        <a href="{{ $user->profile->personal_website }}">
																																{{ $user->profile->personal_website }}</a>  @endif
							@if($user->profile->hometown)	 	       <div class="profileLabel">Hometown:</div>			    {{ $user->profile->hometown }} 		        @endif
							@if($user->profile->city) 	 	 		   <div class="profileLabel">Current City:</div> 	        {{ $user->profile->city }}				    @endif
							@if($user->profile->country) 			   <div class="profileLabel">Current Country:</div> 	    {{ $user->profile->country }} 		        @endif
							@if($user->profile->occupations)		   <div class="profileLabel">Occupations:</div> 		    {{ $user->profile->occupations }}		    @endif
							@if($user->profile->companies) 			   <div class="profileLabel">Companies:</div> 		        {{ $user->profile->companies }}		        @endif
							@if($user->profile->schools) 			   <div class="profileLabel">Schools:</div> 			    {{ $user->profile->schools }}               @endif
							@if($user->profile->interests_hobbies)     <div class="profileLabel">Interests & Hobbies:</div>     {{ $user->profile->interests_hobbies }}     @endif
							@if($user->profile->favorite_movies_shows) <div class="profileLabel">Favorite Movies & Shows:</div> {{ $user->profile->favorite_movies_shows }} @endif
							@if($user->profile->favorite_music) 	   <div class="profileLabel">Favorite Music:</div> 		    {{ $user->profile->favorite_music }}        @endif
							@if($user->profile->favorite_books)		   <div class="profileLabel">Favorite Books:</div> 		    {{ $user->profile->favorite_books }}        @endif
						</div>
					</td>
					<td width="180">
						<table width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#E5ECF9">
							<tbody>
								<tr>
									<td>
										<img src="img/box_login_tl.gif" width="5" height="5">
									</td>
									<td width="170">
										<img src="img/pixel.gif" width="1" height="5">
									</td>
									<td>
										<img src="img/box_login_tr.gif" width="5" height="5">
									</td>
								</tr>
								<tr>
									<td>
										<img src="img/pixel.gif" width="5" height="1">
									</td>
									<td align="center" style="padding: 5px;">
										<div style="padding: 5px; text-align: center;">
											<!--
											<div style="font-size: 14px; font-weight: bold; color: #003366;">Latest Video Added</div>
											<div style="padding-bottom: 10px;">
												<a href="watch.php?v=D76kXs1_P4I">
													<img src="get_still.php?video_id=D76kXs1_P4I" class="moduleFeaturedThumb" width="120" height="90">
												</a>
												<div class="moduleFeaturedTitle">
													<a href="watch.php?v=D76kXs1_P4I">Group Photo at West Beach</a>
												</div>
												<div class="moduleFeaturedDetails">Added: 2 months ago</div>
											</div>-->
											@if(Auth::check())
											<form method="post" action="#">
												@csrf
												<input type="submit" value="Add Me!">
											</form>
											@else
											<div style="padding-bottom: 10px;">
												<a href="signup.php">Sign up</a> or <a href="login.php">log in</a> to add {{ $user->username }} as a friend.
											</div>
											@endif
											<form method="post" action="{{ route('inbox.compose', ['user' => $user->username]) }}">
												@csrf
												<input type="submit" value="Send Message">
											</form>
											<form method="post" action="#">
												@csrf
												<input type="submit" value="Subscribe to {{ $user->username }}'s Videos">
											</form>
										</div>
									</td>
									<td>
										<img src="img/pixel.gif" width="5" height="1">
									</td>
								</tr>
								<tr>
									<td>
										<img src="img/box_login_bl.gif" width="5" height="5">
									</td>
									<td>
										<img src="img/pixel.gif" width="1" height="5">
									</td>
									<td>
										<img src="img/box_login_br.gif" width="5" height="5">
									</td>
								</tr>
							</tbody>
						</table>
						<x-online-users/>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</x-layout>