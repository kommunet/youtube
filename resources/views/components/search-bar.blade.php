<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
    <tbody>
        <tr>
            <form name="searchForm" id="searchForm" method="GET" action="results.php">
				<td style="padding-right: 5px;">
					<input tabindex="1" type="text" value="{{ request()->get('search') }}" name="search" maxlength="128" style="color:#ff3333; font-size: 12px; width: 300px;">
				</td>
				<td>
					<input type="submit" name="search_videos" value="Search Videos">
					<input type="submit" name="search_users" value="Search Users">
				</td>
			</form>
        </tr>
    </tbody>
</table>