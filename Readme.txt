Install JAVA JDK from:
https://www.oracle.com/technetwork/java/javase/downloads/jdk13-downloads-5672538.html
if you dont have already installed JAVA

Set JavaPath to System Variables:
Goto C:\Program Files\Java\ 

if you installed jdk-13_windows-x64_bin from above you should have a folder: "jdk-13" in there.
if its another version, write the folder name down...

1.Go to MyComputer properties
2.Click on the advanced tab
3.Click on environment variables

4.Click on the new tab of system variables
Name of Variable: JAVA_HOME
Value of Variable: C:\Program Files\Java\jdk-13  (path to your JDK from above)

5. Select Path Variable in SystemVariables and click on edit
now click on new and add: %JAVA_HOME%\bin

Restart Windows and open a cmd prompt and input: "java -version"
if everythings right you should see your Java Version info.




Run 1.setup_xampp to re-configure xampp paths (press 1 and wait...)
Run 2.start_xampp-control -> start Apache & MySql (need open ports 80 & 3306)
Run 3.start_gameserver


Copy "NeoLauncher.exe & neolauncher directory" from .\launcher\ into your TERA Gamefolder 
.\TERA\NeoLauncher.exe                      ->Launcher
.\TERA\neolauncher\neo_app_conf.json        ->Config
.\TERA\neolauncher\changelog.txt


Copy "Tl.exe" from .\launcher_tlexe\        ->Starter
For EU,NA           -> .\TERA\Client\       ->(not needed) files already exist!
For RU,KR,CH        -> .\TERA\
For SEA             -> .\TERA\TERA-CLIENT\


Open WebSite with Browser (defaut is "http://127.0.0.1/") and Register an Account as you like

Start Game...

DoubleClick "NeoLauncher.exe" choose client & language and login

If you're going to make your Server public
Replace the IP with your GameServerIP inside "web\htdocs\server\serverlist" (.xx)

and edit the following lines inside ".\TERA\neolauncher\neo_app_conf.json" to your serverlist files
"WebServerUrl": "http://127.0.0.1",
"ServerListDirectory": "/server/",
"ServerListFile": "serverlist",



for more launcher configuration info read the readme.txt in .\launcher\readme.txt