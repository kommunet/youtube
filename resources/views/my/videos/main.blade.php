<x-layout tab="home">
	<x-slot name="actions"><x-actions.home tab="videos"/></x-slot>
	
	<div style="padding: 0px 5px 0px 5px;">
		<div style="padding-bottom: 15px;">
			<table align="center" cellpadding="0" cellspacing="0" border="0">
				<tbody>
					<tr>
						<td>
							<strong>Overview</strong>
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="#">Share</a>
						</td>
						<td style="padding: 0px 5px 0px 5px;">|</td>
						<td>
							<a href="/temp_uploader.php">Upload</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tbody>
				<tr valign="top">
					<td style="padding-right: 15px;">
						<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
							<tbody>
								<tr>
									<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
									<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
									<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
								</tr>
								<tr>
									<td><img src="/img/pixel.gif" width="5" height="1"></td>
									<td>
										{{-- Title bar --}}
										<x-modules.title-bar title="My Videos">
											{{-- Right of the title bar --}}
											<x-slot name="right">
												<div style="font-weight: bold; color: #444444; margin-right: 5px;">
													Videos {{ $videos->firstItem() ?? 0 }}-{{ $videos->lastItem() ?? 0 }} of {{ $videos->total() ?? 0 }}
												</div>
											</x-slot>
										</x-modules.title-bar>
										
										{{-- Body of the browse container --}}
										{{-- Video entry, set to trim entries to hide ratings on detailed view --}}
										<x-modules.video-entries :videos="$videos" type="v" trim="true" fulldates="true" edit="true"/>
										
										{{-- Pagination module, cannot use as component due to Blade limitations --}}
										{{ $videos->links("components.modules.pagination", ["user" => $user->username]) }}
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
					</td>
					<td width="180">
						<a href="#"><img src="/img/rss.gif" width="36" height="14" border="0" style="vertical-align: text-top;"></a> 
						<span style="font-size: 11px; margin-right: 3px;"><a href="#">Feed For User // {{ $user->username }}</a></span>
						<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">My Tags:</div>
						@foreach($tags as $tag)
						<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="results.php?search={{ $tag }}">{{ $tag }}</a></div>
						@endforeach
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</x-layout>