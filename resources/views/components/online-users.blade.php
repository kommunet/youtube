<div>
    <div style="padding-top: 15px;">
        <table width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEDD">
            <tbody>
                <tr>
                    <td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
                    <td><img src="/img/pixel.gif" width="1" height="5"></td>
                    <td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
                </tr>
                <tr>
                    <td><img src="/img/pixel.gif" width="5" height="1"></td>
                    <td width="170">
                        <div style="padding: 2px 5px 10px 5px;">
                            <div style="font-size: 14px; font-weight: bold; margin-bottom: 8px; color: #666633;">{{ ($users->count() == 1) ? "Last user online" : "Last " . $users->count() . " users online..." }}</div>
                            @foreach($users as $user)
								<div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;"><a href="{{ route('profile', ['user' => $user->username]) }}">{{ $user->username }}</a></div>
								<div style="font-size: 12px; margin-bottom: 8px; padding-bottom: 10px; border-bottom: 1px dashed #CCCC66;"><a href="#"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> (<a href="#">{{ $user->num_public_videos }}</a>)
									| <a href="#"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> (<a href="#">0</a>)
									| <a href="#"><img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> (<a href="#">0</a>)
								</div>
							@endforeach
                            <div style="font-weight: bold; margin-bottom: 5px;">Icon Key:</div>
                            <div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Videos</div>
                            <div style="margin-bottom: 4px;"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Favorites</div>
                            <img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Friends
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
</div>