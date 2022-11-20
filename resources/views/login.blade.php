<x-layout>
	<div style="padding: 0px 5px 0px 5px;">
		<div class="tableSubTitle">Log In</div>
		<table width="790" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
				<td style="padding-right: 15px;" width="510">
					<span class="highlight">What is YouTube?</span> YouTube is a way to get your videos to the people who matter to you. With YouTube you can: <ul>
						<li> Show off your favorite videos to the world
						<li> Blog the videos you take with your digital camera or cell phone
						<li> Securely and privately show videos to your friends and family around the world
						<li> ... and much, much more!
					</ul>
					<br>
					<span class="highlight">
						<a href="signup.php">Sign up now</a> and open a free account. </span>
					<br>
					<br>
					<br> To learn more about our service, please see our <a href="help.php">Help</a> section. <br>
					<br>
					<br>
				</td>
				<td width="280">
					<table width="280" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#E5ECF9">
						<tr>
							<td>
								<img src="img/box_login_tl.gif" width="5" height="5">
							</td>
							<td width="100%">
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
							<td align="center">
								<table width="100%" cellpadding="5" cellspacing="0" border="0">
									<form method="post" name="loginForm" id="loginForm" action="login.php">
										@csrf
										<input type="hidden" name="field_command" value="login_submit">
										<tr>
											<td align="center" colspan="2">
												<div style="font-size: 14px; font-weight: bold; color:#003366; margin-bottom: 5px;">YouTube Log In</div>
											</td>
										</tr>
										<tr>
											<td align="right">
												<span class="label">User Name:</span>
											</td>
											<td>
												<input tabindex="1" type="text" size="20" name="username" value="">
											</td>
										</tr>
										<tr>
											<td align="right">
												<span class="label">Password:</span>
											</td>
											<td>
												<input tabindex="2" type="password" size="20" name="password">
											</td>
										</tr>
										@if($errors->any())
											@foreach($errors->all() as $error)
												<tr>
													<td align="right">
														<span class="label">&nbsp;</span>
													</td>
													<td>
														<span style="color:red">{{ $error }}</span>
													</td>
												</tr>
											@endforeach
										@endif
										<tr>
											<td align="right">
												<span class="label">&nbsp;</span>
											</td>
											<td>
												<input type="submit" value="Log In">
											</td>
										</tr>
										<tr>
											<td align="center" colspan="2">
												<a href="forgot.php">Forgot your password?</a>
												<br>
												<br>
											</td>
										</tr>
									</form>
									<script language="javascript">
										onLoadFunctionList.push(function() {
											document.loginForm.field_login_username.focus();
										});
									</script>
								</table>
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
					</table>
				</td>
			</tr>
		</table>
	</div>
</x-layout>