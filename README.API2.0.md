You can "thanks" me here: [http://api.wot-blackdeath.ru/en/donate/](api.wot-blackdeath.ru/en/donate/)

# World of Tanks unofficial API

On august 09 2013 WG released new version of World of Tanks Assistant app with new API 2.0, lets dig into it!

### API servers

API servers still the same:

    http://api.worldoftanks.ru
    http://api.worldoftanks.eu
    http://api.worldoftanks.com
    http://api.worldoftanks.asia
    http://api.worldoftanks.kr
    
I've found Vientamese cluster, but I didnot dig into it yet. It's address [portal-wot.go.vn](http://portal-wot.go.vn)

### Application ID's

Request links has changed and now for each cluster you should provide app ID, here is the list:

 * RU -- 171745d21f7f98fd8878771da1000a31
 * EU -- d0a293dc77667c9328783d489c8cef73
 * NA -- 16924c431c705523aae25b6f638c54dd
 * ASIA -- 39b4939f5f2460b3285bfa708e4b252c
 * KR -- ffea0f1c3c5f770db09357d94fe6abfb
 
I think from version to version these app_ID's will change.

### Player info

To get info on player:

    http://<CLUSTER_API_ADDRESS>/2.0/account/info/?application_id=<APP_ID>&account_id=<ACCOUNT_ID>
    
Example, info on player SerB on RU cluster:

    http://api.worldoftanks.ru/2.0/account/info/?application_id=171745d21f7f98fd8878771da1000a31&account_id=461
   
Response: https://gist.github.com/thunder-spb/6279345

### Multiple players info request

I've found that you can make request for multiple players, just provide second account_id separated by semicolon, like this:

    http://api.worldoftanks.ru/2.0/account/info/?application_id=171745d21f7f98fd8878771da1000a31&account_id=19213,461
    
You will get info on 2 players with IDs 461 and 19213

Response: https://gist.github.com/thunder-spb/6279611

You can you this where account_id field is used.

### Search player

To search player you should make a request to:

    http://<CLUSTER_API_ADDRESS>/2.0/account/list/?application_id=<APP_ID>&search=<PARTIAL_NICKNAME>
    
Example, searching all players, matching serb on RU cluster:

    http://api.worldoftanks.ru/2.0/account/list/?application_id=171745d21f7f98fd8878771da1000a31&search=serb

Response: https://gist.github.com/thunder-spb/6279415

### Player vehicles

To get all info on player vehicles make request to:

    http://<CLUSTER_API_ADDRESS>/2.0/account/tanks/?application_id=<APP_ID>&account_id=<ACCOUNT_ID>

Example:

    http://api.worldoftanks.ru/2.0/account/tanks/?application_id=171745d21f7f98fd8878771da1000a31&account_id=461

For now it returns all zeroes, maybe it a bug... But list of tanks is returned, but only tank ID's.

### Player stats slice

If you want to get changes from now to HOURS_AGO value you need to make following request:

    http://<CLUSTER_API_ADDRESS>/2.0/stats/accountbytime/?application_id=<APP_ID>&account_id=<ACCOUNT_ID>&hours_ago=<HOURS_AGO>

Example:

    http://api.worldoftanks.ru/2.0/stats/accountbytime/?application_id=171745d21f7f98fd8878771da1000a31&account_id=461&hours_ago=24
    
Response: https://gist.github.com/thunder-spb/6279533

### Player ratings

Just player ratings:

    http://<CLUSTER_API_ADDRESS>/2.0/account/tanks/?application_id=<APP_ID>&account_id=<ACCOUNT_ID>

Example:
    
    http://api.worldoftanks.ru/2.0/account/ratings/?application_id=171745d21f7f98fd8878771da1000a31&account_id=461
    
Response: https://gist.github.com/thunder-spb/6279635

## Clans
### Clan info

To get clan info you should make request to:

    http://<CLUSTER_API_ADDRESS>/2.0/clan/info//?application_id=<APP_ID>&clan_id=<CLAN_ID>

Example:

    http://api.worldoftanks.ru/2.0/clan/info/?application_id=171745d21f7f98fd8878771da1000a31&clan_id=1
    
Response: https://gist.github.com/thunder-spb/6279663

Ofcourse you can make request for multiple clans like in multiple players info.

### Clan search

It's easy:

    http://<CLUSTER_API_ADDRESS>/2.0/clan/info//?application_id=<APP_ID>&search=<PARTIAL_CLAN_NAME>

Example:

    http://api.worldoftanks.ru/2.0/clan/list/?application_id=171745d21f7f98fd8878771da1000a31&search=WG
    
Response: https://gist.github.com/thunder-spb/6279695

## Encyclopedia of Tanks

**All links will be for RU cluster, so you just need to change host and app_id.**

Tanks list:

    http://api.worldoftanks.ru/2.0/encyclopedia/tanks/?application_id=171745d21f7f98fd8878771da1000a31
    
Particular tank (tank_id can be founded in tanks list):

    http://api.worldoftanks.ru/2.0/encyclopedia/tankinfo/?application_id=171745d21f7f98fd8878771da1000a31&tank_id=2849

All Tanks engines:

    http://api.worldoftanks.ru/2.0/encyclopedia/tankengines/?application_id=171745d21f7f98fd8878771da1000a31
    
All Tanks guns:

    http://api.worldoftanks.ru/2.0/encyclopedia/tankguns/?application_id=171745d21f7f98fd8878771da1000a31
    
All Tanks radios:

    http://api.worldoftanks.ru/2.0/encyclopedia/tankradios/?application_id=171745d21f7f98fd8878771da1000a31
    
All Tanks suspensions:

    http://api.worldoftanks.ru/2.0/encyclopedia/tankchassis/?application_id=171745d21f7f98fd8878771da1000a31

All Tanks turrets:

    http://api.worldoftanks.ru/2.0/encyclopedia/tankturrets/?application_id=171745d21f7f98fd8878771da1000a31
    

### Global map

**At least in russian cluster these link were changed!**

Region 1 (Northern Europe)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/1/?ct=json

Region 2 (Mediterranean)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/2/?ct=json

Region 3 (West Africa)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/3/?ct=json

Region 4 (East Africa)
    
    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/4/?ct=json

Region 5 (Ural)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/5/?ct=json
    
Region 6 (Siberia and Far East)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/6/?ct=json
    
Region 7 (Asia)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/7/?ct=json
    
Region 11 (South Africa)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/11/?ct=json

**Existing, but not active for now (on russian cluster):**

Region 8 (East Coast USA)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/8/?ct=json

Region 9 (Atlantida)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/9/?ct=json

Region 10 (Canada and Alaska)

    http://cw.worldoftanks.ru/clanwars/maps/provinces/regions/10/?ct=json

## To get ClanWars info

    http://worldoftanks.ru/community/clans/%CLAN_ID%/battles/list/?id=js-battles-table
    
To make such request you need to setup some addditional options in request header (example for cURL):
````php
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Accept: application/json, text/javascript, text/html, */*',
                'X-Requested-With: XMLHttpRequest'
            )
        );
````

  
It's all for now. If you have any questions or suggestions, please ask!
