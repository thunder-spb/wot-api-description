<?php
include 'WotClass.php';
$wot = new Wot('RU', 'ru', '9fd2a424400aa541a994056eddeb2438');		// region, language, your <app_id_here>
//$wot->setCacheType('memcache', $params=Array('host'=>'unix:///var/run/memcached/memcached.sock', 'port'=>0));	// You can set Memcache aggregator.
//$wot->setCacheType('apc', $params=Array());	// Or APC, if php5-apc has been installed

//$wot->setRegion('NA', '<app_id_here>');	// You may change used region anytime. Make sure - you may have specific app_id on each Region
//$wot->setLang('es');	// And change answer language a anytime too

$fields = Array(); // Make a full request only for develop. Select only usable fields in production for less request size

//print_r($wot->getUser('info', '6440135', $fields));
//print_r($wot->getUser('info', '6440135', $fields));			// Ex.: $fields = Array('accound_id', 'created_at', 'nickname', 'updated_at');
//print_r($wot->getUser('search', 'Upgrade', $fields));			// Ex.: $fields = Array('nickname', 'id');
//print_r($wot->getUser('vehicles', '6440135', $fields));		// Ex.: $fields = Array('mark_of_mastery', 'tank_id', 'achievements.medal_dumitru', 'statistics');
//print_r($wot->getUser('ratings', '6440135', $fields));		// Ex.: $fields = Array('battle_avg_performance', 'battle_avg_xp.place', ... and etc. See full responce for select fields
//print_r($wot->getClan('info', '40265', $fields));
//print_r($wot->getClan('search', 'Radio Record', $fields));
//print_r($wot->getWiki('tanks', null, $fields));
//print_r($wot->getWiki('tankinfo', 2849, $fields));
//print_r($wot->getWiki('tankengines', null, $fields));
//print_r($wot->getWiki('tankengines', 2373, $fields));
//print_r($wot->getWiki('tankguns', null, $fields));
//print_r($wot->getWiki('tankradios', null, $fields));
//print_r($wot->getWiki('tankturrets', null, $fields));
//print_r($wot->getWiki('achievements', null, $fields));
?>