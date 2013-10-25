<?php
class wotDefaultSettings {

	protected $_tbls = array(
			'clanlist' => 'cw_clans',
			'clanbattles' => 'cw_battles',
			'regions' => 'cw_regions',
			'i18n_regions' => 'cw_regions_i18n',
			'i18n_province' => 'cw_provinces_i18n',
			'i18n_maps' => 'cw_maps_i18n',
			'prov_info' => 'cw_provinces_info',
			'prov_server' => 'cw_provinces_server',
			'prov_primetime' => 'cw_provinces_primetime',
			'reg_prov' => 'cw_region_province',
		);
	protected $_battle_type_styles = array(
		'landing' => "background-image:url(http://wotapi.ru/images/battle_types.png);display:inline-block;width:16px;height:16px;background-position:-48px;",
		'for_province' => "background-image:url(http://wotapi.ru/images/battle_types.png);display:inline-block;width:16px;height:16px;background-position: -32px;",
		'meeting_engagement' => "background-image:url(http://wotapi.ru/images/battle_types.png);display:inline-block;width:16px;height:16px;background-position: 0px;"
	);
	protected $_allowed_settings = array(
		'type' => array(
			'html',
			'json',
		),
	);
	protected $_default_api_settings = array(
			'api' => array(
				'2.0' => array(
					'appid' => 'demo',
				),
			),
			'links' => array(
				'clanbattles' => '/%s/clan/battles/?application_id=%s&fields=provinces,started,time,type&clan_id=',
				'claninfo' => '/%s/clan/info/?application_id=%s&fields=abbreviation,clan_id,emblems,name&clan_id='
			),
		);
	protected $_cluster_settings = array(
			'ru' => array( 
				'servers' => array(
					'cw' => 'http://cw.worldoftanks.ru',
					'api' => 'http://api.worldoftanks.ru',
					'main' => 'http://worldoftanks.ru',
					),
				'api' => array(
					'2.0' => array(
							'appid' => 'YOUR_APP_ID',
						),
					),
				'default_language' => 'ru',
				'language' => array(
					'ru' => array (
						'title' => 'Russian',
						'map' => '/static/wgcw/js/i18n/ru_earth_map.js',
					),
				),

			),
			'eu' => array( 
				'servers' => array(
					'cw' => 'http://cw.worldoftanks.eu',
					'api' => 'http://api.worldoftanks.eu',
					'main' => 'http://worldoftanks.eu',
					),
				'default_language' => 'en',
				'language' => array(
					'en' => array (
						'title' => 'English (EU)',
						'map' => '/static/wgcw/js/i18n/en_earth_map.js',
					),
					'es' => array (
						'map' => '/static/wgcw/js/i18n/es_earth_map.js',
					),
					'pl' => array (
						'map' => '/static/wgcw/js/i18n/pl_earth_map.js',
					),
					'fr' => array (
						'map' => '/static/wgcw/js/i18n/fr_earth_map.js',
					),
					'de' => array (
						'map' => '/static/wgcw/js/i18n/de_earth_map.js',
					),
					'tr' => array (
						'map' => '/static/wgcw/js/i18n/tr_earth_map.js',
					),
					'cs' => array (
						'map' => '/static/wgcw/js/i18n/cs_earth_map.js',
					),
				),
			),
			'na' => array( 
				'servers' => array(
					'cw' => 'http://cw.worldoftanks.com',
					'api' => 'http://api.worldoftanks.com',
					'main' => 'http://worldoftanks.com',
					),
				'default_language' => 'en',
				'language' => array(
					'en' => array (
						'map' => '/static/wgcw/js/i18n/en_earth_map.js',
					),
				),
			),
			'sea' => array( 
				'servers' => array(
					'cw' => 'http://cw.worldoftanks.asia',
					'api' => 'http://api.worldoftanks.asia',
					'main' => 'http://worldoftanks.asia',
					),
				'default_language' => 'en',
				'language' => array(
					'en' => array (
						'map' => '/static/wgcw/js/i18n/en_earth_map.js',
					),
				),
			),
			'kr' => array( 
				'servers' => array(
					'cw' => 'http://cw.worldoftanks.kr',
					'api' => 'http://api.worldoftanks.kr',
					'main' => 'http://worldoftanks.kr',
					),
				'default_language' => 'ko',
				'language' => array(
					'ko' => array (
						'map' => '/static/wgcw/js/i18n/ko_earth_map.js',
					),
				),
			),
		);
	public function getUrl( $urltype,  $cluster = ru ) {
		$url = '';
		$cluster_settings = ( isset( $this->_cluster_settings[$cluster]['api']) ) ? $this->_cluster_settings[$cluster]['api'] : array();
		$new_settings = array_replace_recursive($this->_default_api_settings, array( 'api' => $cluster_settings) );
//		print_r( $new_settings );
		$url = sprintf( $this->_cluster_settings[$cluster]['servers']['api'].$new_settings['links'][$urltype], '2.0', $new_settings['api']['2.0']['appid'] );
		return $url;
	}
}
