<?php
/**
 * Class which provides functions to get data from the invofficial World of Tanks web api.
 *
 * @uses WotMemCache
 * @uses WotAPCCache
 * @package wot-api-description
 */
Class Wot
{
	/**
	 * @var string
	 */
	public $region;

	/**
	 * @var string
	 */
	public $app_id;

	/**
	 * @var string
	 */
	public $lang;

	/**
	 * @var string
	 */
	public $api_url;

	/**
	 * @var WotMemCache|WotAPCCache
	 */
	protected $_cache;

	/**
	 * @var int
	 */
	protected $_limit = 0;

	/**
	 * @param string $region
	 * @param string $lang
	 * @param string $app_id
	 */
	public function __construct($region = 'RU', $lang = 'ru', $app_id = null)
	{
		switch ($region) {
			case 'EU':
				$this->region = 'EU';
				$this->api_url = 'http://api.worldoftanks.eu';
				break;

			case 'NA':
				$this->region = 'NA';
				$this->api_url = 'http://api.worldoftanks.com';
				break;

			case 'ASIA':
				$this->region = 'ASIA';
				$this->api_url = 'http://api.worldoftanks.asia';
				break;

			case 'KR':
				$this->region = 'KR';
				$this->api_url = 'http://api.worldoftanks.kr';
				break;

			default:
				$this->region = 'RU';
				$this->api_url = 'http://api.worldoftanks.ru';
		}

		$this->app_id = $app_id;
		$this->lang = $lang;
		$this->_cache = null;
	}

	/**
	 * @param string $type "memcache" or "apc", otherwise cache mode will be null.
	 * @param array $params (optional) array('host', 'port'), only needed if Memcache will be used.
	 */
	public function setCacheType($type, $params = array())
	{
		switch ($type) {
			case 'memcache':
				$this->_cache = new WotMemCache($params['host'], $params['port']);
				break;

			case 'apc':
				$this->_cache = new WotAPCCache();
				break;

			default:
				$this->_cache = null;
		}
	}

	/**
	 * @param string $region
	 */
	public function setRegion($region)
	{
		switch ($region) {
			case 'EU':
				$this->region = 'EU';
				$this->api_url = 'http://api.worldoftanks.eu';
				break;

			case 'NA':
				$this->region = 'NA';
				$this->api_url = 'http://api.worldoftanks.com';
				break;

			case 'ASIA':
				$this->region = 'ASIA';
				$this->api_url = 'http://api.worldoftanks.asia';
				break;

			case 'KR':
				$this->region = 'KR';
				$this->api_url = 'http://api.worldoftanks.kr';
				break;

			default:
				$this->region = 'RU';
				$this->api_url = 'http://api.worldoftanks.ru';
		}
	}

	/**
	 * @param string $lang
	 */
	public function setLang($lang = 'ru')
	{
		$this->lang = $lang;
	}

	/**
	 * @param int $val
	 */
	public function setLimit($val)
	{
		$this->_limit = (int)$val;
	}

	/**
	 * @throws InvalidArgumentException
	 * @param string $request available values:<br>
	 *		"info",<br>
	 *		"search",<br>
	 *		"vehicles",<br>
	 *		"stats",<br>
	 *		"achievements"<br>
	 *		otherwise an InvalidArgumentException will be thrown.
	 * @param array $req_value depends on the request.
	 *		For parameter $request = "info",
	 *		the needed $req_value will be the account_id.
	 * @param array $fields
	 * @return string
	 * @link https://eu.wargaming.net/developers/api_reference/wot/account/list/
	 * @throws InvalidArgumentException
	 */
	public function getUser($request, $req_value, $fields = array(), $hours_ago = 2)
	{
		$u = $this->api_url;

		switch ($request) {
				case 'info':
					$u .= '/wot/account/info/?account_id='.$req_value;
					break;

				case 'search':
					$u .= '/wot/account/list/?search='.$req_value;
					break;

				case 'vehicles':
					$u .= '/wot/account/tanks/?account_id='.$req_value;
					break;

				case 'stats':
					$u .= '/wot/stats/accountbytime/?account_id='.$req_value.'&hours_ago='.$hours_ago;
					break;

				case 'achievements':
					$u .= '/wot/account/achievements/?account_id='.$req_value.'&hours_ago='.$hours_ago;
					break;

				default:
					throw new InvalidArgumentException('Invalid value for parameter $request given: '.$request);
		}

		$u .= '&application_id='.$this->app_id;

		if(!empty($fields)) {
			$u.= '&fields='.implode(',', $fields);
		}

		$u .= '&language='.$this->lang;

		if($request === 'search' && !empty($this->_limit)) {
			$u .= '&limit='.(int)$this->_limit;
		}

		return $this->_processRequest($u);
	}

	/**
	 * @param string $request available values:<br>
	 *		"info",<br>
	 *		"search",<br>
	 *		"members"<br>
	 *		otherwise an InvalidArgumentException will be thrown.
	 * @param string $search_value
	 * @param array $fields
	 * @return string
	 * @link https://eu.wargaming.net/developers/api_reference/wgn/clans/list/
	 * @throws InvalidArgumentException
	 */
	public function getClan($request, $search_value, $fields = array())
	{
		$u = $this->api_url.'/wgn/clans/';

		switch ($request) {
			case 'info':
				$u .= 'info/?clan_id='.$search_value;
				break;

			case 'search':
				$u .= 'list/?search='.$search_value;
				break;

			case 'members':
				$u .= 'membersinfo/?account_id='.$search_value;
				break;

			default:
				throw new InvalidArgumentException('Invalid value for parameter $request given: '.$request);
		}

		$u .= '&application_id='.$this->app_id.'&fields='.implode(',', $fields).'&language='.$this->lang;

		if($request === 'search' && !empty($this->_limit)) {
			$u .= '&limit='.(int)$this->_limit;
		}

		return $this->_processRequest($u);
	}

	/**
	 * @param string $request available values:<br>
	 *		"info",<br>
	 *		"buildings",<br>
	 *		"accountstats"<br>
	 *		otherwise an InvalidArgumentException will be thrown.
	 * @param string $search_value
	 * @param array $fields
	 * @return string
	 * @link https://eu.wargaming.net/developers/api_reference/wot/stronghold/info/
	 * @throws InvalidArgumentException
	 */

	public function getStronghold($request, $search_value, $fields = array())
	{
		$u = $this->api_url.'/wot/stronghold/';

		switch ($request) {
			case 'info':
				$u .= 'info/?clan_id='.$search_value;
				break;

			case 'buildings':
				$u .= 'buildings/?s';
				break;

			case 'accountstats':
				$u .= 'accountstats/?account_id='.$search_value;
				break;

			default:
				throw new InvalidArgumentException('Invalid value for parameter $request given: '.$request);
		}

		$u .= '&application_id='.$this->app_id.'&language='.$this->lang;

		if ($fields) { $u .= '&fields='.implode(',', $fields); }

		if($request === 'search' && !empty($this->_limit)) {
			$u .= '&limit='.(int)$this->_limit;
		}
		print_r($u);

		return $this->_processRequest($u);
	}

	/**
	 * @throws InvalidArgumentException
	 * @param string $request available values:<br>
	 *		"tanks",<br>
	 *		"tankinfo",<br>
	 *		"tankengines",<br>
	 *		"tankguns",<br>
	 *		"tankradios",<br>
	 *		"tankchassis",<br>
	 *		"tankturrets",<br>
	 *		"achievements"<br>
	 *		otherwise an InvalidArgumentException will be thrown.
	 * @param string $req_value
	 * @param array $fields
	 * @return string
	 * @link https://eu.wargaming.net/developers/api_reference/wot/encyclopedia/tanks/
	 * @throws InvalidArgumentException
	 */
	public function getWiki($request, $req_value, $fields = array())
	{
		$u = $this->api_url.'/wot/encyclopedia/';

		switch ($request) {
			case 'tanks':
				$u .= 'tanks/?';
				break;

			case 'tankinfo':
				$u .= 'tankinfo/?tank_id='.$req_value;
				break;

			case 'tankengines':
				$u .= 'tankengines/?module_id='.$req_value;
				break;

			case 'tankguns':
				$u .= 'tankguns/?module_id='.$req_value;
				break;

			case 'tankradios':
				$u .= 'tankradios/?module_id='.$req_value;
				break;

			case 'tankchassis':
				$u .= 'tankchassis/?module_id='.$req_value;
				break;

			case 'tankturrets':
				$u .= 'tankturrets/?module_id='.$req_value;
				break;

			case 'achievements':
				$u .= 'achievements/?';
				break;

			default:
				throw new InvalidArgumentException('Invalid value for parameter $request given: '.$request);
		}

		$u .= '&application_id='.$this->app_id.'&fields='.implode(',', $fields).'&language='.$this->lang;

		return $this->_processRequest($u);
	}

	/**
	 * @param string $request available values:<br>
	 *		"types",<br>
	 *		"dates",<br>
	 *		"accounts" <b>Notice:</b> $req_value must be an array of: array('type', 'account_id'),<br>
	 *		"neighbors" <b>Notice:</b> $req_value must be an array of: array('type', 'account_id', 'rank_field'),<br>
	 *		"top" <b>Notice:</b> $req_value must be an array of: array('type', 'rank_field'),<br>
	 *		otherwise an InvalidArgumentException will be thrown.
	 * @param string|array $req_value
	 * @param array $fields
	 * @param string $date Date in UNIX timestamp or ISO 8601 format. E.g.: 1376542800 or 2013-08-15T00:00:00
	 * @return string
	 * @link https://eu.wargaming.net/developers/api_reference/wot/ratings/types/
	 * @throws InvalidArgumentException
	 */
	public function getRatings($request, $req_value = '', $fields = array(), $date = 0)
	{
		$u = $this->api_url.'/wot/ratings/';

		switch ($request) {
			case 'types':
				$u .= 'types/?';
				break;

			case 'dates':
				$u .= 'dates/?type='.$req_value;
				break;

			case 'accounts':
				$u .= 'accounts/?type='.$req_value['type'];
				$u .= '&account_id='.$req_value['account_id'];

				if(!empty($date)) {
					$u .= 'date='.$date;
				}

				break;

			case 'neighbors':
				$u .= $request.'/?type='.$req_value['type'];
				$u .= '&rank_field='.$req_value['rank_field'];
				$u .= '&account_id='.$req_value['account_id'];

				if(!empty($date)) {
					$u .= '?date='.$date;
				}

				break;

			case 'top':
				$u .= $request.'/?type='.$req_value['type'];
				$u .= '&rank_field='.$req_value['rank_field'];

				if(!empty($date)) {
					$u .= '?date='.$date;
				}

				break;

			default:
				throw new InvalidArgumentException('Invalid value for parameter $request given: '.$request);
		}

		if(substr($u, -1, 1) !== '?') {
			$u .= '&';
		}

		$u .= 'application_id='.$this->app_id.'&fields='.implode(',', $fields).'&language='.$this->lang;

		return $this->_processRequest($u);
	}

	/**
	 * Handles the invoked request.
	 *
	 * When caching is active the data from the cache will be returned
	 * otherwise the api will be called.
	 */
	protected function _processRequest($u)
	{
		if($this->_cache) {
			$res = $this->_cache->getCache(md5($u));

			if (!empty($res)) {
				return $res;
			} else {
				$json = file_get_contents($u);
				$obj = json_decode($json);

				switch ($obj->status) {
					case 'ok':
						$this->_cache->setCache(md5($u), $obj->data);
						return $obj->data;

					default:
						return $obj->error;
				}
			}
		} else {
			$json = file_get_contents($u);
			$obj = json_decode($json);

			switch ($obj->status) {
				case 'ok':
					return $obj->data;

				default:
					return $obj->error;
			}
		}
	}
}

/**
 * Provides functions to store and get data from the webservers memcache service.
 *
 * @link http://php.net/manual/en/class.memcache.php
 */
Class WotMemCache
{
	/**
	 * @var Memcache
	 */
	protected $_m;

	/**
	 * @param string $url
	 * @param int $port
	 */
	public function __construct($url = '127.0.0.1', $port = 11211)
	{
		$this->_m = new Memcache;
		$this->_m->connect($url, $port) or die ('Could not connect to Memcache server');
	}

	/**
	 * @param string $hash
	 * @return string
	 */
	public function getCache($hash)
	{
		return $this->_m->get($hash);
	}

	/**
	 * @param string $hash
	 * @param mixed $value
	 * @param int $expire
	 * @return string
	 */
	public function setCache($hash, $value, $expire = 7200)
	{
		return $this->_m->set($hash, $value, MEMCACHE_COMPRESSED, $expire);
	}
}

/**
 * Provides functions to store and get data from the "Alternative PHP Cache" (APC).
 *
 * @link http://php.net/manual/en/book.apc.php
 */
Class WotAPCCache
{
	/**
	 * @param string $hash
	 * @return string
	 */
	public function getCache($hash)
	{
		return apc_fetch($hash);
	}

	/**
	 * @param string $hash
	 * @param mixed $value
	 * @param int $expire
	 * @return string
	 */
	public function setCache($hash, $value, $expire = 7200)
	{
		return apc_store($hash, $value, $expire);
	}
}
