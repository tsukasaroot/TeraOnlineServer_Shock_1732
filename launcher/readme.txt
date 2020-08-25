Neo Launcher V0.7.3
Build: Serenity

=============================================================================================
Launcher Installation:

1.
Copy NeoLauncher.exe from .\launcher\
For EU,NA,RU,KR,CH,SEA in your Gamefolder ->
.\TERA\NeoLauncher.exe                      ->Launcher      ->(launcher file)

Copy Tl.exe from .\launcher_tlexe\          ->Starter       ->(starter file)
For EU,NA           -> .\TERA\Client\       ->(not needed) files already exist!
For RU,KR,CH        -> .\TERA\
For SEA             -> .\TERA\TERA-CLIENT\



=============================================================================================
Launcher Configuration:
1. run NeoLauncher.exe
After first Run, Launcher creates 1 File in the .\neolauncher folder:
.\neo_app_conf.json

Now Close the Launcher and go to the Configuration file to edit some settings...
.\neolauncher\neo_app_conf.json
{
  "LauncherTitle": "{NeoLauncher}",             ->The Launcher Title
  "LauncherVersion": "0.7.3",                   ->The Launcher Version
  "LauncherBuild": "Serenity",                  ->The Launcher Build
  "Theme": "DARK",                              ->Choose between "dark" & "light"
  "PrimaryColor": "0x212121",                   ->Header & Button Background Color  ->in #HexColor
  "DarkPrimaryColor": "0x6A5ACD",               ->Titlebar Color on "dark" Theme    ->in #HexColor
  "LightPrimaryColor": "0x6A5ACD",              ->Titlebar Color on "light" Theme   ->in #HexColor
  "AccentColor": "0xFFF976",                    ->Items, MenüHover & Links Color    ->in #HexColor
  "TextColor": "0x6A5ACD",                      ->Title & MenüText Color            ->in #HexColor
  "LanguageID": 1,                              ->Don´t Touch !!!
  "UseAuth": true,                              ->"true" -> Use WebAuthorization (auth.php) or "false" -> Direct Login with given Username&Password
  "WebServerUrl": "http://www.p5yl0.de",        ->Webserver Url/Host to your Serverlist File
  "ServerListDirectory": "/server/",            ->Directory on Webserver to your Serverlist File
  "ServerListFile": "serverlist",               ->Name of the Serverlist File (name without extension .*)
  "CryptMode": "md5"                            ->CryptMode used on WebSite ("md5", "sha1", "bcrypt", "none")
}

additional:
CryptMode: 
-use "none" only local for security reasons, never send unencrypted passwords !!!
-do not use "brycpt"    -> PHP -> passwordhash() PHP_DEFAULT encryption not fully added.

UseAuth:
if set "false", game starts but check happens on Server Selection Screen, if wrong user&pass to the GameServer your login will fail!
if set "true" launcher checks for file at: "WebserverUrl\auth.php"


=============================================================================================
Web(Server) Installation & Configuration:

->(this are the serverlist files, they are needed else the game will not start!)
1. Copy files from: .\web\ folder
-to your WebServerRoot ->
.\server\serverlist.cn                  ->ServerlistFile    ->(CN Chinese)
.\server\serverlist.de                  ->ServerlistFile    ->(EU German)
.\server\serverlist.en                  ->ServerlistFile    ->(NA English)
.\server\serverlist.fr                  ->ServerlistFile    ->(EU French)
.\server\serverlist.jp                  ->ServerlistFile    ->(JP Japanese)
.\server\serverlist.kr                  ->ServerlistFile    ->(KR Korean)
.\server\serverlist.ru                  ->ServerlistFile    ->(RU Russian)
.\server\serverlist.zh                  ->ServerlistFile    ->(SEA Thai)
.\server\serverlist.uk                  ->ServerlistFile    ->(EU English)

.\auth.php                              ->AuthorizationFile ->(no edit needed!)
.\auth-config.php                       ->AuthConfigFile    ->(edit MySql config, when Launcher UseAuth=true)


2. Edit file -> .\auth-config.php
Fill out the SQL Information and Account Information part...
MySql Data and database settings, should be self explained with the comments...

Edit the following lines...
//SQL Information
$host['hostname'] = 'localhost'; // MySql Hostname
$host['user'] = 'root'; // Database Username
$host['password'] = 'password'; // Database Password
$host['database'] = 'dbname'; // Database Name

//Account Information
$database['table'] = 'your_accounts_table'; // Database [AccountTable]
$database['username'] = 'your_login_username'; // Database [AccountTable ->Username]
$database['password'] = 'your_login_password'; // Database [AccountTable -> Password]

$prefix = "pfx_";   ->(not used now! when you need add it to the table)


=============================================================================================
Config Serverlist / GameServer

1. Edit the Serverlist file which you need on the WebServer (look at Webserver Configuration 1.) ->
.\server\serverlist.??

Edit GameServer IP
<ip>127.0.0.1</ip>          -> Your GameServer IP
<port>11101</port>          -> Your Gameserver Port

Edit GameServer Name:
name raw_name="Tera - Serenity PvE"

Edit GameServer Info Text:
text="Standard PVE Test Server"

Save and Exit...



Ok, Now run the Launcher and Have Fun!



Tested and Working with EU, NA, RU, CH, KR, TH
Unknown: JP
