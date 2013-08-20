You can "thanks" me here: [http://api.wot-blackdeath.ru/en/donate/](api.wot-blackdeath.ru/en/donate/)

# World of Tanks unofficial API

On august 09 2013 WG released new version of World of Tanks Assistant app with new API 2.0, lets dig into it!

API servers still the same:

    http://api.worldoftanks.ru
    http://api.worldoftanks.eu
    http://api.worldoftanks.com
    http://api.worldoftanks.asia
    http://api.worldoftanks.kr
    
I've found Vientamese cluster, but I didnot dig into it yet. It's address [portal-wot.go.vn](http://portal-wot.go.vn)

Request links has changed and now for each cluster you should provide app ID, here is the list:

 * RU -- 171745d21f7f98fd8878771da1000a31
 * EU -- d0a293dc77667c9328783d489c8cef73
 * NA -- 16924c431c705523aae25b6f638c54dd
 * ASIA -- 39b4939f5f2460b3285bfa708e4b252c
 * KR -- ffea0f1c3c5f770db09357d94fe6abfb
 
I think from version to version these app_ID's will change.

To get info on player:

    http://<CLUSTER_API_ADDRESS>/2.0/account/info/?application_id=<APP_ID>&account_id=<ACCOUNT_ID>
    
Example, player thunderspb on RU cluster info:

   http://api.worldoftanks.ru/2.0/account/info/?application_id=171745d21f7f98fd8878771da1000a31&account_id=19213
   
Response: https://gist.github.com/thunder-spb/6279345
