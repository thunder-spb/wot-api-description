<?php
Class Wot {
	public function __construct($region='RU', $lang='ru', $app_id=null, $cache=null) {
		switch ($region) {
			case 'EU': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.eu'; break; }
			case 'NA': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.com'; break; }
			case 'ASIA': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.asia'; break; }
			case 'KR': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.kr'; break; }
			default: { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.ru'; break; }
		}
		$this->app_id = $app_id;
		$this->lang = $lang;
		$this->cache = null;
	}

	public function setCacheType($type, $params) {
		switch ($type) {
			case 'memcache': { $this->cache = new WotMemCache($params['host'], $params['port']); break; }
			case 'apc': { $this->cache = new WotAPCCache(); break; }
			default: { $this->cache = null; }
		}
	}

	public function setRegion($region) {
		switch ($region) {
			case 'EU': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.eu'; break; }
			case 'NA': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.com'; break; }
			case 'ASIA': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.asia'; break; }
			case 'KR': { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.kr'; break; }
			default: { $this->region = 'RU'; $this->api_url = 'http://api.worldoftanks.ru'; break; }
		}
	}

	public function setLang($lang='ru') {
		$this->lang = $lang;
	}

	function getUser($request, $params, $fields=Array()) {
		$u = $this->api_url;
		switch ($request) {
				case 'info': { $u .= '/wot/account/info/?account_id='.$params; break; }
				case 'search': { $u .= '/wot/account/list/?search='.$params; break; }
				case 'vehicles': { $u .= '/wot/account/tanks/?account_id='.$params; break; }
				case 'ratings': { $u .= '/wot/account/ratings/?account_id='.$params; break; }
				//case 'stats': { $u .= '/wot/stats/accountbytime/?account_id='.$params.'&hours_ago='.$hours; break; }
		}
		$u .= '&application_id='.$this->app_id.'&fields='.implode(',', $fields).'&language='.$this->lang;
		if($this->cache) {
			$res = $this->cache->getCache(md5($u));
			if (!empty($res)) { return $res; }
			else {
				$json = file_get_contents($u);
				$obj = json_decode($json);
				switch ($obj->status) {
					case 'ok': { $this->cache->setCache(md5($u), $obj->data); return $obj->data; break; }
					default: { return $obj->error; }
				}
			}
		}
		else {
			$json = file_get_contents($u);
			$obj = json_decode($json);
			switch ($obj->status) {
				case 'ok': { return $obj->data; break; }
				default: { return $obj->error; }
			}
		}
	}


	function getClan($request, $params, $fields=Array()) {
		$u = $this->api_url.'/wot/clan/';
		switch ($request) {
			case 'info': { $u .= 'info/?clan_id='.$params; break; }
			case 'search': { $u .= 'list/?search='.$params; break; }
		}
		$u .= '&application_id='.$this->app_id.'&fields='.implode(',', $fields).'&language='.$this->lang;
		if($this->cache) {
			$res = $this->cache->getCache(md5($u));
			if (!empty($res)) { return $res; }
			else {
				$json = file_get_contents($u);
				$obj = json_decode($json);
				switch ($obj->status) {
					case 'ok': { $this->cache->setCache(md5($u), $obj->data); return $obj->data; break; }
					default: { return $obj->error; }
				}
			}
		}
		else {
			$json = file_get_contents($u);
			$obj = json_decode($json);
			switch ($obj->status) {
				case 'ok': { return $obj->data; break; }
				default: { return $obj->error; }
			}
		}
	}
	
	function getWiki($request, $params=false, $fields=Array()) {
		$u = $this->api_url;
		switch ($request) {
			case 'tanks': { $u .= '/wot/encyclopedia/tanks/?'; break; }
			case 'tankinfo': { $u .= '/wot/encyclopedia/tankinfo/?tank_id='.$params; break; }
			case 'tankengines': { $u .= '/wot/encyclopedia/tankengines/?module_id='.$params; break; }
			case 'tankguns': { $u .= '/wot/encyclopedia/tankguns/?module_id='.$params; break; }
			case 'tankradios': { $u .= '/wot/encyclopedia/tankradios/?module_id='.$params; break; }
			case 'tankchassis': { $u .= '/wot/encyclopedia/tankchassis/?module_id='.$params; break; }
			case 'tankturrets': { $u .= '/wot/encyclopedia/tankturrets/?module_id='.$params; break; }
			case 'achievements': { $u .= '/wot/encyclopedia/achievements/?'; break; }
		}
		$u .= '&application_id='.$this->app_id.'&fields='.implode(',', $fields).'&language='.$this->lang;
		if($this->cache) {
			$res = $this->cache->getCache(md5($u));
			if (!empty($res)) { return $res; }
			else {
				$json = file_get_contents($u);
				$obj = json_decode($json);
				switch ($obj->status) {
					case 'ok': { $this->cache->setCache(md5($u), $obj->data); return $obj->data; break; }
					default: { return $obj->error; }
				}
			}
		}
		else {
			$json = file_get_contents($u);
			$obj = json_decode($json);
			switch ($obj->status) {
				case 'ok': { return $obj->data; break; }
				default: { return $obj->error; }
			}
		}
	}
}

Class WotMemCache {
	public function __construct($url='127.0.0.1', $port=11211) {
		$this->m = new Memcache;
		$this->m->connect($url, $port) or die ("Could not connect to Memcache server");
	}

	public function getCache($hash) {
		return $this->m->get($hash);
	}

	public function setCache($hash, $value, $expire=7200) {
		return $this->m->set($hash, $value, MEMCACHE_COMPRESSED, $expire);
	}
}

Class WotAPCCache {
	public function getCache($hash) {
		return apc_fetch($hash);
	}
	
	public function setCache($hash, $value, $expire=7200) {
		return apc_store($hash, $value, $expire);
	}
}
?>