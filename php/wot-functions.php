<?
$p = Array(
	'RU' => Array(
		'url' => 'http://api.worldoftanks.ru',
		'app_id' => '171745d21f7f98fd8878771da1000a31'
	),
	'EU' => Array(
		'url' => 'http://api.worldoftanks.eu',
		'app_id' => 'd0a293dc77667c9328783d489c8cef73'
	),
	'NA' => Array(
		'url' => 'http://api.worldoftanks.com',
		'app_id' => '16924c431c705523aae25b6f638c54dd'
	),
	'ASIA' => Array(
		'url' => 'http://api.worldoftanks.asia',
		'app_id' => '39b4939f5f2460b3285bfa708e4b252c'
	),
	'KR' => Array(
		'url' => 'http://api.worldoftanks.kr',
		'app_id' => 'ffea0f1c3c5f770db09357d94fe6abfb'
	)
);

function getUser($request, $params, $cluster='RU', $hours=false) {
	global $p;
	$u = $p[$cluster]['url'];
	switch ($request) {
		case 'info': { $u .= '/2.0/account/info/?account_id='.$params; break; }
		case 'search': { $u .= '/2.0/account/list/?search='.$params; break; }
		case 'vehicles': { $u .= '/2.0/account/tanks/?account_id='.$params; break; }
		case 'ratings': { $u .= '/2.0/account/ratings/?account_id='.$params; break; }
		case 'stats': { $u .= '/2.0/stats/accountbytime/?account_id='.$params.'&hours_ago='.$hours; break; }
	}
	$u .= '&application_id='.$p[$cluster]['app_id'];
	$json = file_get_contents($u);
	$obj = json_decode($json);
	switch ($obj->status) {
		case 'ok': { return $obj->data; break; }
		default: { return $obj->error; }
	}
}

function getClan($request, $params, $cluster='RU') {
	global $p;
	$u = $p[$cluster]['url'].'/2.0/clan/';
	switch ($request) {
		case 'info': { $u .= 'info/?clan_id='.$params; break; }
		case 'search': { $u .= 'list/?search='.$params; break; }
	}
	$u .= '&application_id='.$p[$cluster]['app_id'];
	$json = file_get_contents($u);
	$obj = json_decode($json);
	switch ($obj->status) {
		case 'ok': { return $obj->data; break; }
		default: { return $obj->error; }
	}
}

function getWiki($request, $params=false, $cluster='RU', $hours=false) {
	global $p;
	$u = $p[$cluster]['url'];
	switch ($request) {
		case 'tanks': { $u .= '/2.0/encyclopedia/tanks/?'; break; }
		case 'tankinfo': { $u .= '/2.0/encyclopedia/tankinfo/?tank_id='.$params; break; }
		case 'tankengines': { $u .= '/2.0/encyclopedia/tankengines/?module_id='.$params; break; }
		case 'tankguns': { $u .= '/2.0/encyclopedia/tankguns/?module_id='.$params; break; }
		case 'tankradios': { $u .= '/2.0/encyclopedia/tankradios/?module_id='.$params; break; }
		case 'tankchassis': { $u .= '/2.0/encyclopedia/tankchassis/?module_id='.$params; break; }
		case 'tankturrets': { $u .= '/2.0/encyclopedia/tankturrets/?module_id='.$params; break; }
		case 'achievements': { $u .= '/2.0/encyclopedia/achievements/?'; break; }
	}
	$u .= '&application_id='.$p[$cluster]['app_id'];
	$json = file_get_contents($u);
	$obj = json_decode($json);
	switch ($obj->status) {
		case 'ok': { return $obj->data; break; }
		default: { return $obj->error; }
	}
	
	
	
}
?>