# World of Tanks unofficial API


World of Tanks, popular MMO game about tanks from time around WWII, has some nice mobile application called [Wot Assistant](https://play.google.com/store/apps/details?id=ru.worldoftanks.mobile) (available also at [AppStore](http://itunes.apple.com/us/app/wot-assistant/id500174696?mt=8) and [MS Marketplace](http://www.windowsphone.com/en-us/apps/f02b42f1-a19b-4736-a31d-c4bff545cb83)). With simple packet sniffing you can guess how it retrieves players' statistics.

Surprisingly, mobile application uses quite simple API over HTTP which serves data in JSON, which is great help for people interested in creating own applications handling statistical data in game.

At this moment here is list of API features that has been discovered:
* searching players by names
* searching clans by names
* showing current player statistics
* showing current clan information
* showing player stats from given time
* showing player stats of particular property
* logging in (uses HTTPS)
* receiving notifications
* global map (clan wars)

Most of methods require appropriate API version, as well as token. So far every token I have found fits into every method.

    http://api.worldoftanks.ru/community/...
can be replaced with

    http://api.worldoftanks.ru/uc/...


## List of methods

### Searching players

    http://api.worldoftanks.ru/community/accounts/api/%API_VER%/?source_token=%TOKEN%&search=%NAME%&offset=%OFFSET%&limit=%LIMIT%

API version: 1.0, 1.1

Example:

    http://api.worldoftanks.ru/community/accounts/api/1.1/?source_token=WG-WoT_Assistant-1.3.2&search=bristol&offset=8&limit=3

Returns:

```json
{
  "status": "ok", 
  "status_code": "NO_ERROR", 
  "data": {
    "items": [
      {
        "clan": null, 
        "stats": {
          "wins": 0, 
          "exp": 0, 
          "battles": 0
        }, 
        "name": "Bristolboy", 
        "url": "/community/accounts/500886192-Bristolboy/", 
        "created_at": 1308943273.0, 
        "id": 500886192
      }, 
...
      {
        "clan": null, 
        "stats": {
          "wins": 1, 
          "exp": 65, 
          "battles": 1
        }, 
        "name": "bristolcity", 
        "url": "/community/accounts/504220640-bristolcity/", 
        "created_at": 1342381045.0, 
        "id": 504220640
      }
    ], 
    "offset": 8, 
    "filtered_count": 19
  }
}
```

Description:
* _data.items[].created_at_ contains UNIX timestamp of account creation
* _data.filtered_count_ shows number of accounts fitting searched name

Parameters:
* _NAME_ - name of searched players
* _OFFSET_ - offset
* _LIMIT_ - limit of shown players

### Showing player's stats

    http://api.worldoftanks.ru/community/accounts/%PLAYER_ID%/api/%API_VER%/?source_token=%TOKEN%

API version: 1.0, 1.1, 1.2, 1.3, 1.4, 1.5, 1.6, 1.7, 1.8, 1.9

Example:

    http://api.worldoftanks.ru/uc/accounts/500032519/api/1.9/?source_token=WG-WoT_Assistant-1.3.2

Returns:

```json
{
  "status": "ok", 
  "status_code": "NO_ERROR", 
  "data": {
    "achievements": {
      "medalCarius": 3, 
... 
      "lumberjack": 0, 
... 
      "medalKnispel": 3
    }, 
    "ratings": {
      "spotted": {
        "place": 453554, 
        "value": 1279
      }, 
      "dropped_ctf_points": {
        "place": 719367, 
        "value": 370
      }, 
      "battle_avg_xp": {
        "place": 4917, 
        "value": 696
      }, 
      "xp": {
        "place": 479876, 
        "value": 345250
      }, 
      "battles": {
        "place": 818353, 
        "value": 496
      }, 
      "damage_dealt": {
        "place": 422188, 
        "value": 524350
      }, 
      "ctf_points": {
        "place": 652538, 
        "value": 1230
      }, 
      "integrated_rating": {
        "place": 16310, 
        "value": 184
      }, 
      "battle_avg_performance": {
        "place": 17928, 
        "value": 56
      }, 
      "frags": {
        "place": 513289, 
        "value": 706
      }, 
      "battle_wins": {
        "place": 766043, 
        "value": 279
      }
    }, 
    "name": "Schperling", 
    "created_at": 1302624328.0, 
    "vehicles": [
      {
        "spotted": 0, 
        "localized_name": "Löwe", 
        "name": "Lowe", 
        "level": 8, 
        "damageDealt": 0, 
        "survivedBattles": 0, 
        "battle_count": 174, 
        "nation": "germany", 
        "image_url": "/static/2.1.2/encyclopedia/tankopedia/vehicle/small/germany-lowe.png", 
        "frags": 0, 
        "win_count": 82, 
        "class": "heavyTank"
      },  
      ... 
      {
        "spotted": 0, 
        "localized_name": "PzKpfw II", 
        "name": "PzII", 
        "level": 2, 
        "damageDealt": 0, 
        "survivedBattles": 0, 
        "battle_count": 1, 
        "nation": "germany", 
        "image_url": "/static/2.1.2/encyclopedia/tankopedia/vehicle/small/germany-pzii.png", 
        "frags": 0, 
        "win_count": 0, 
        "class": "lightTank"
      }
    ], 
    "updated_at": 1352997598.0, 
    "battles": {
      "spotted": 1279, 
      "hits_percents": 62, 
      "capture_points": 1230, 
      "damage_dealt": 524350, 
      "frags": 706, 
      "dropped_capture_points": 370
    }, 
    "summary": {
      "wins": 279, 
      "losses": 211, 
      "battles_count": 496, 
      "survived_battles": 137
    }, 
    "experience": {
      "xp": 345250, 
      "battle_avg_xp": 696, 
      "max_xp": 2464
    }, 
    "clan": {
      "member": {
        "since": 1300632431.0, 
        "role": "soldier"
      }, 
      "clan": {
        "abbreviation": "WG", 
        "color": "#4c9674", 
        "id": 500000001, 
        "emblems_urls": {
          "small": "/dcont/clans/emblems/clans_5/500000001/emblem_24x24.png", 
          "large": "/dcont/clans/emblems/clans_5/500000001/emblem_64x64.png", 
          "bw_tank": "/dcont/clans/emblems/clans_5/500000001/emblem_64x64_tank.png", 
          "medium": "/dcont/clans/emblems/clans_5/500000001/emblem_32x32.png"
        }, 
        "name": "Wargaming.net"
      }, 
      "clan_ext": {}
    }
  }
}
```

Description:
* Amount of information differs between API versions - depends on new medals or statistics added in particular game versions. In general, the higher API version, the more statistics.
* _data.vehicles[].localized_name_ contains localized name of vehicle. Local language is detected by Accept-Language HTTP header send by client (browser, application).
* _data.clan.member.role_ contains localized name of role in clan. Local language is detected by Accept-Language HTTP header send by client (browser, application).
* _data.updated_at_ contains UNIX timestamp of data update. At the moment player stats (via this API and on WoT website) aren't updated if player is in game but after he quits game client.
* _data.clan.member.since_ contains UNIX timestamp of player's join to the clan.
* _data.clan.clan.emblems_urls_ contains list of clan emblems used in game. They are not resized automatically by the server, clan leader uploads every size of emblem separately. _data.clan.clan.emblems_urls.bw_tank_ is used on tanks, rest of them are used in service records or website/forum profile.
* _data.battles.damage_dealt_ may differ from sum of _damageDealt_ of every tank in _data.vehicles_ (_data.vehicles[].damageDealt_ is updated after few hours).

### Showing player's stats from past

    http://http://dvstats.wargaming.net/userstats/2/stats/slice/?platform=android&server=ru&account_id=%PLAYER_ID%&hours_ago=24&hours_ago=168&hours_ago=336

Description:
* Gets stats up to 336 hours in past

### Showing particular part of stats from player:

    http://http://dvstats.wargaming.net/userstats/2/stats/?server=ru&platform=android&account_id=%PLAYER_ID%&from_date=2012-11-06T10%3A24%3A44&to_date=2012-11-20T10%3A24%3A44&interval=24&field=summary.battles_count&field=summary.wins&field=summary.survived_battles&field=experience.max_xp

Description:
* Dunno why but works only for some accounts, I guess it has something to do with dates

### Notifications

    http://http://dvstats.wargaming.net/notify/messages/?server=ru&device_platform=android&device_id=331929b195b91010&app_company=WG&app_product=WoT_Assistant&app_version=1.3.2&from_id=0


### Searching clans

    http://api.worldoftanks.ru/community/clans/api/%API_VER%/?source_token=%TOKEN%&search=%CLAN_NAME%&offset=0&limit=1

Optional: 
    &order_by=name

API version: 1.0, 1.1

Description:
* In version 1.0 added _data.items[].id_ showing ID of clan. Previously you had to parse url in _data.items[].clan_emblem_url_ to get clan ID.
* `&order_by=` gives possibility to sort by given value

### Showing clan's stats

    http://api.worldoftanks.ru/community/clans/%CLAN_ID%/api/%API_VER%/?source_token=%TOKEN%

API version: 1.0, 1.1


### Personal stats (after logging in via API)
    http://api.worldoftanks.ru/personal/api/%API_VER%/?source_token=%TOKEN%

API version: 1.0

### Login request

    https://worldoftanks.ru/auth/create/api/%API_VER%/?source_token=%TOKEN%
    https://worldoftanks.ru/utils/csrf/api/%API_VER%/?source_token=%TOKEN%

### Global map

Region 1 (Northern Europe)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/5/?ct=json

Region 2 (Mediterranean)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/4/?ct=json

Region 3 (West Africa)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/3/?ct=json

Region 4 (East Africa)
    
    http://worldoftanks.ru/uc/clanwars/provinces/regions/9/?ct=json

Region 5 (Ural)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/8/?ct=json
    
Region 6 (Siberia and Far East)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/7/?ct=json
    
Region 7 (Asia)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/6/?ct=json
    
Region 8 (East Coast USA)

    http://worldoftanks.ru/uc/clanwars/provinces/regions/2/?ct=json


To get ClanWars info

    http://worldoftanks.ru/uc/clans/%CLAN_ID%/battles/?type=table
    
## API versions

<table>
  <tr><th>Method</th><th>Accepted API version</th></tr>
  <tr><td>Searching players</td><td>1.0, 1.1</td></tr>
  <tr><td>Searching clans</td><td>1.0, 1.1</td></tr>
  <tr><td>Showing player stats</td><td>1.0, 1.1, 1.2, 1.3, 1.4, 1.5, 1.6, 1.7, 1.8, 1.9</td></tr>
  <tr><td>Personal info</td><td>1.0</td></tr>
  <tr><td>Logging in</td><td>1.0</td></tr>
</table>


## Tokens:
* WG-WoT_Assistant-1.1.2
* WG-WoT_Assistant-1.2.2
* WG-WoT_Assistant-1.3.2
* WG-WoT_Assistant-1.4
* Intellect_Soft-WoT_Mobile-site
* Intellect_Soft-WoT_Mobile
* WG-WoT_Assistant-test
* Intellect_Soft-WoT_Mobile-unofficial_stats
