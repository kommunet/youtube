<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>YouTube - Broadcast Yourself.</title>
        <link rel="stylesheet" href="/styles.css" type="text/css">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="alternate" type="application/rss+xml" title="YouTube - Recently Added Videos [RSS]" href="/rss/global/recently_added.rss">
        <script language="javascript" type="text/javascript">
            onLoadFunctionList = new Array();

            function performOnLoadFunctions() {
                for (var i in onLoadFunctionList) {
                    onLoadFunctionList[i]();
                }
            }
        </script>
        <meta name="description" content="Share your videos with friends and family">
        <meta name="keywords" content="video,sharing,camera phone,video phone">
		<style>
		form {
		    margin-block-end: 1em;
		}
		</style>
    </head>
    <body onLoad="performOnLoadFunctions();">
        <table width="800" cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
                <td bgcolor="#FFFFFF" style="padding-bottom: 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr valign="top">
                            <td width="130" rowspan="2" style="padding: 0px 5px 5px 5px;">
                                <a href="/index.php">
                                    <img src="/img/logo_sm.gif" width="120" height="48" alt="YouTube" border="0" style="vertical-align: middle; ">
                                </a>
                            </td>
                            <td valign="top">
                                <table width="670" cellpadding="0" cellspacing="0" border="0">
                                    <tr valign="top">
                                        <td style="padding: 0px 5px 0px 5px; font-style: italic;">{{ env("YOUTUBE_SLOGAN") }}</td>
                                        <td align="right">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
													@if(Auth::check())
													<td>Hello, <a href="{{ route('profile', ['user' => Auth::user()->username]) }}">{{ Auth::user()->username }}</a>! <img src="/img/mail.gif" border="0"> (<a href="{{ route('inbox.received') }}">{{ Auth::user()->messages()->count() }}</a>)</td>
													<td style="padding: 0px 5px 0px 5px;">|</td>
													<td>
														<a href="{{ route('logout') }}">Log Out</a>
													</td>
													<td style="padding: 0px 5px 0px 5px;">|</td>
													<td style="padding-right: 5px;">
														<a href="help.php">Help</a>
													</td>
													@else
                                                    <td>
                                                        <a href="{{ route('signup') }}">
                                                            <strong>Sign Up</strong>
                                                        </a>
                                                    </td>
                                                    <td style="padding: 0px 5px 0px 5px;">|</td>
                                                    <td>
                                                        <a href="{{ route('login') }}">Log In</a>
                                                    </td>
                                                    <td style="padding: 0px 5px 0px 5px;">|</td>
                                                    <td style="padding-right: 5px;">
                                                        <a href="/help.php">Help</a>
                                                    </td>
													@endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr valign="bottom">
                            <td>
                                <!-- tab table -->
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <td>
                                        <table style="@if($tab == 'home') background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD; @else background-color: #BECEEE; @endif margin: 5px 2px 1px 0px;" cellpadding="0" cellspacing="0" border="0">
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
                                                <td style="padding: 0px 20px 5px 20px; font-size: 13px; font-weight: bold;">
                                                    <a href="/index.php">Home</a>
                                                </td>
                                                <td>
                                                    <img src="/img/pixel.gif" width="5" height="1">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="@if($tab == 'videos') background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD; @else background-color: #BECEEE; @endif margin: 5px 2px 1px 0px;" cellpadding="0" cellspacing="0" border="0">
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
                                                <td style="padding: 0px 20px 5px 20px; font-size: 13px; font-weight: bold;">
                                                    <a href="/browse.php">Videos</a>
                                                </td>
                                                <td>
                                                    <img src="/img/pixel.gif" width="5" height="1">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="@if($tab == 'channels') background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD; margin: 5px 2px 0px 0px; @else background-color: #BECEEE; margin: 5px 2px 1px 0px; @endif" cellpadding="0" cellspacing="0" border="0">
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
                                                <td style="padding: 0px 20px 5px 20px; font-size: 13px; font-weight: bold;">
                                                    <a href="/channels.php">Channels</a>
                                                </td>
                                                <td>
                                                    <img src="/img/pixel.gif" width="5" height="1">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="@if($tab == 'friends') background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD; @else background-color: #BECEEE; @endif margin: 5px 2px 1px 0px;" cellpadding="0" cellspacing="0" border="0">
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
                                                <td style="padding: 0px 20px 5px 20px; font-size: 13px; font-weight: bold;">
                                                    <a href="/my_friends.php">Friends</a>
                                                </td>
                                                <td>
                                                    <img src="/img/pixel.gif" width="5" height="1">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="@if($tab == 'upload') background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD; @else background-color: #BECEEE; @endif margin: 5px 2px 1px 0px;" cellpadding="0" cellspacing="0" border="0">
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
                                                <td style="padding: 0px 20px 5px 20px; font-size: 13px; font-weight: bold;">
                                                    <a href="/my_videos_upload.php">Upload</a>
                                                </td>
                                                <td>
                                                    <img src="/img/pixel.gif" width="5" height="1">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table align="center" width="800" bgcolor="#DDDDDD" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
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
                <td width="790" align="center" style="padding: 2px;">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="font-size: 10px;">&nbsp;</td>
							{{ $actions }}
							<td style="font-size: 10px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <img src="/img/pixel.gif" width="5" height="1">
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #FFFFFF">
                    <img src="/img/box_login_bl.gif" width="5" height="5">
                </td>
                <td style="border-bottom: 1px solid #BBBBBB">
                    <img src="/img/pixel.gif" width="1" height="5">
                </td>
                <td style="border-bottom: 1px solid #FFFFFF">
                    <img src="/img/box_login_br.gif" width="5" height="5">
                </td>
            </tr>
        </table>
        {{ $slot }}
        </td>
        </tr>
        </table>
        <table cellpadding="10" cellspacing="0" border="0" align="center">
            <tr>
                <td align="center" valign="center">
                    <span class="footer">
                        <a href="/whats_new.php">What's New</a>
                        <img src="/img/new.gif"> | <a href="/about.php">About Us</a> | <a href="/help.php">Help</a> | <a href="/developers">Developers</a> | <a href="/terms.php">Terms of Use</a> | <a href="/privacy.php">Privacy Policy</a>
                        <br>
                        <br> Copyright &copy; 2005 YouTube, LLC&#8482; | <a href="/rss/global/recently_added.rss">
                            <img src="/img/rss.gif" width="36" height="14" border="0" style="vertical-align: text-top;">
                        </a>
                    </span>
                </td>
            </tr>
        </table>
        <div id="sheet" style="position:fixed; top:0px; visibility:hidden; width:100%; text-align:center;">
            <table width="100%">
                <tr>
                    <td align="center">
                        <div id="sheetContent" style="filter:alpha(opacity=50); -moz-opacity:0.5; opacity:0.5; border: 1px solid black; background-color:#cccccc; width:40%; text-align:left;"></div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="tooltip"></div>
    </body>
</html>