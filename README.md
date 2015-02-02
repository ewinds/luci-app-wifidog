# luci-app-wifidog
This package contains LuCI configuration pages for wifidog.

## Features
1. Luci configuration page for wifidog
2. Bulit-in local authentication server with lighttp and php5
3. Sync with remote server

## Install
1. Git clone this respository in your `package` directory.
2. `make menuconfig` and select luci-app-wifidog in LUCI category and save.
3. `make luci-app-wifidog/compile` with a single package. 
