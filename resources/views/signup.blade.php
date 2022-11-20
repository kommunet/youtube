<x-layout>
	<div style="padding: 0px 5px 0px 5px;">
		<script>
			function formValidator() {
				/*
				var email = document.theForm.email;
				var username = document.theForm.username;
				var password_1 = document.theForm.password_1;
				var password_2 = document.theForm.password_2;
				*/
				var signup_button = document.theForm.signup_button;
				signup_button.disabled = 'true';
				signup_button.value = 'Please wait...';
			}
		</script>
		<div class="tableSubTitle">Sign Up</div> Please enter your account information below. All fields are required. <br>
		<br>
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<form method="post" name="theForm" id="theForm" name="theForm" id="theForm" onSubmit="return formValidator();" action="signup.php">
				@csrf
				<input type="hidden" name="field_command" value="signup_submit">
				<tr>
					<td width="200" align="right">
						<span class="label">Email Address:</span>
					</td>
					<td>
						<input type="text" size="30" maxlength="60" name="email" value="">
					</td>
				</tr>
				<tr>
					<td align="right">
						<span class="label">User Name:</span>
					</td>
					<td>
						<input type="text" size="20" maxlength="20" name="username" value="">
					</td>
				</tr>
				<tr>
					<td align="right">
						<span class="label">Password:</span>
					</td>
					<td>
						<input type="password" size="20" maxlength="20" name="password" value="">
					</td>
				</tr>
				<tr>
					<td align="right">
						<span class="label">Retype Password:</span>
					</td>
					<td>
						<input type="password" size="20" maxlength="20" name="password_confirmation" value="">
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="left">
						<input name="flag_weekly_tube" type="checkbox" checked>Sign me up for "The Weekly Tube" e-mail. <br />
						<span class="footer">Get the best YouTube videos delivered to you via e-mail each week.</span>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<br>- I certify I am over 13 years old. <br>- I agree to the <a href="terms.php" target="_blank">terms of use</a> and <a href="privacy.php" target="_blank">privacy policy</a>.
					</td>
				</tr>
				@if($errors->any())
					@foreach($errors->all() as $error)
						<tr>
							<td>&nbsp;</td>
							<td style="color:red">{{ $error }}</td>
						</tr>
					@endforeach
				@endif
				<tr>
					<td>&nbsp;</td>
					<td>
						<input name="signup_button" type="submit" value="Sign Up">
					</td>
				</tr>
			</form>
			<tr>
				<td>&nbsp;</td>
				<td>
					<br>Or, <a href="index.php">return to the homepage</a>.
				</td>
			</tr>
		</table>
	</div>
</x-layout>