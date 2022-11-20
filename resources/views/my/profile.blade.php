<x-layout tab="home">
	<x-slot name="actions"><x-actions type="home"/></x-slot>
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
	
	@foreach($errors->all() as $error)
		<table width="100%" align="center" cellpadding="6" cellspacing="3" border="0" bgcolor="red" style="margin-bottom: 10px;">
			<tbody>
				<tr>
					<td align="center" bgcolor="#FFFFFF">
						<span style="font-weight: bold;color: red;">
						{{ $error }}
						</span>
					</td>
				</tr>
			</tbody>
		</table>
	@endforeach
	<div class="tableSubTitle">Personal Info</div>
	<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;" width="800">
		<tbody>
			<tr>
				<td style="padding: 2px;">
					<form method="POST" name="my_profile_form" id="my_profile_form">
						@csrf
						<table cellpadding="0" cellspacing="0" border="0">
							<tbody>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Name: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="name" value="{{ $profile->name }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Birthday: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<select name="b_month">
											@foreach(range(1, 12) as $month)
												<option value="{{ $month }}" {{ (!($profile->birthday && $profile->birthday->month == $month)) ?: "selected" }}>{{ \Carbon\Carbon::createFromFormat("m", $month)->format("F") }}</option>
											@endforeach
										</select>
										<select name="b_day">
											@foreach(range(1, 31) as $day)
												<option value="{{ $day }}" {{ (!($profile->birthday && $profile->birthday->day == $day)) ?: "selected" }}>{{ $day }}</option>
											@endforeach
										</select>
										<select name="b_year">
											@foreach(range(\Carbon\Carbon::now()->format("Y"), 1910) as $year)
												<option value="{{ $year }}" {{ (!($profile->birthday && $profile->birthday->year == $year)) ?: "selected" }}>{{ $year }}</option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Show Age: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<select name="show_birthday">
											<option value="0" {{ $profile->age ?: 'selected' }}>Private</option>
											<option value="1" {{ !$profile->age ?: 'selected' }}>Public</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Gender: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<select name="gender">
											<option value="" {{ $profile->gender ?: 'selected' }}>Private</option>
											<option value="Male" {{ !($profile->gender == "Male") ?: 'selected' }}>Male</option>
											<option value="Female" {{ !($profile->gender == "Female") ?: 'selected' }}>Female</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Relationship Status: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<select name="relationship_status">
											<option value="" {{ $profile->relationship_status ?: 'selected' }}>Private</option>
											<option value="Single" {{ !($profile->relationship_status == "Single") ?: 'selected' }}>Single</option>
											<option value="Taken" {{ !($profile->relationship_status == "Taken") ?: 'selected' }}>Taken</option>
											<option value="Married" {{ !($profile->relationship_status == "Married") ?: 'selected' }}>Married</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>About Me: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<textarea style="width: 335px; height: 133px;" name="about_me" form="my_profile_form">{{ $profile->about_me }}</textarea>
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Personal Website: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="personal_website" value="{{ $profile->personal_website }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Hometown: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="hometown" value="{{ $profile->hometown }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Current City: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="city" value="{{ $profile->city }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Current Country: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<select name="country">
											<option value="" selected="">None</option>
											@foreach(Countries::getList("en") as $code => $country)
											<option value="{{ $code }}" {{ !($profile->country == $country) ?: 'selected' }}>{{ $country }}</option>
											@endforeach
										</select>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="tableSubTitle">Workplace &amp; Education</div>
		<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;" width="800">
			<tbody>
				<tr>
					<td style="padding: 2px;">
						<table cellpadding="0" cellspacing="0" border="0">
							<tbody>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Occupations: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="occupations" value="{{ $profile->occupations }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Companies: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="companies" value="{{ $profile->companies }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Schools: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="schools" value="{{ $profile->schools }}">
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="tableSubTitle">Interests</div>
		<table align="center" width="800" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
			<tbody>
				<tr>
					<td style="padding: 2px;">
						<table cellpadding="0" cellspacing="0" border="0">
							<tbody>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Interests &amp; Hobbies: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="interests_hobbies" value="{{ $profile->interests_hobbies }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Favorite Movies &amp; Shows: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="favorite_movies_shows" value="{{ $profile->favorite_movies_shows }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Favorite Music: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="favorite_music" value="{{ $profile->favorite_music }}">
									</td>
								</tr>
								<tr>
									<td align="right" style="padding: 0px 8px 8px 0px;">
										<strong>Favorite Books: </strong>
									</td>
									<td style="padding-bottom: 8px;">
										<input type="text" name="favorite_books" value="{{ $profile->favorite_books }}">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="submit" value="Save Changes">
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</x-layout>