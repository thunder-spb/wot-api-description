# World of Tanks munin plugin

### Install

1. First you must place WotClass.php at any place, ex: /usr/local/lib/php
and check for munin user have access to them
2. Place file 'wot_' at munin plugins libdir (on Debian systems path like that: /usr/share/munin/plugins/
3. Edit wot_ file and put to $params variable your ids. You make search them here:
http://api.worldoftanks.ru/2.0/account/list/?application_id=171745d21f7f98fd8878771da1000a31&search=YOURNICKNAME
Put them (or many with ',' delimeter) to $params;
4. Make this file execuable 
# chmod +x wot_
6. Come to munin plugins folder (on Debian: cd /etc/munin/plugins/)
7. Create symlink to 'wot_' file.
Note! Wot plugin is woldcard. So you must create symlink name as params.
So you have this choise:
* spotted
* hits
* battle_avg_exp
* draws
* wins
* loses
* capture_points
* battles
* damage_dealt
* hits_percents
* damage_received
* shots
* xp
* frags
* survived_battles
* dropped_capture_points

So, emaple command to create graph of total battles (debian default path):

cd /etc/munin/plugins/
ln -s /usr/share/munin/plugins/wot_battles - for total battles counter graph

and/or

ln -s /usr/share/munin/plugins/wot_hits - for total hits graph

8. You may check them by run ./wot_battles and see valid values

