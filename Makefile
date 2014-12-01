include $(TOPDIR)/rules.mk

PKG_NAME:=luci-app-wifidog
PKG_VERSION=1.0
PKG_RELEASE:=1

PKG_BUILD_DIR:=$(BUILD_DIR)/$(PKG_NAME)

include $(INCLUDE_DIR)/package.mk

define Package/luci-app-wifidog
	SECTION:=luci
	CATEGORY:=LuCI
	SUBMENU:=3. Applications
	DEPENDS:=+wifidog +lighttpd-mod-fastcgi +lighttpd-mod-rewrite +php5-fastcgi +php5-cli +php5-mod-ctype +php5-mod-pdo +php5-mod-pdo-sqlite +php5-mod-session +php5-mod-sqlite3 +php5-mod-tokenizer +zoneinfo-asia +zoneinfo-core
	TITLE:=wifidog configuration for LuCI
endef

define Package/luci-app-wifidog/description
	This package contains LuCI configuration pages for wifidog.
endef

define Build/Prepare
endef

define Build/Configure
endef

define Build/Compile
endef

define Package/luci-app-wifidog/install
	$(INSTALL_DIR) $(1)/etc/config
	$(INSTALL_DIR) $(1)/etc/lighttpd
	$(INSTALL_DIR) $(1)/etc/init.d
	$(INSTALL_DIR) $(1)/etc/uci-defaults
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci/model/cbi
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci/controller
	$(INSTALL_DIR) $(1)/www
	$(INSTALL_DIR) $(1)/www/wifidog
	$(INSTALL_DIR) $(1)/www/wifidog/assets
	$(INSTALL_DIR) $(1)/www/wifidog/assets/images
	$(INSTALL_DIR) $(1)/www/wifidog/Slim
	$(INSTALL_DIR) $(1)/www/wifidog/Slim/Exception
	$(INSTALL_DIR) $(1)/www/wifidog/Slim/Helper
	$(INSTALL_DIR) $(1)/www/wifidog/Slim/Http
	$(INSTALL_DIR) $(1)/www/wifidog/Slim/Middleware
	$(INSTALL_DIR) $(1)/www/wifidog/templates
	$(INSTALL_CONF) ./files/root/etc/config/wifidog $(1)/etc/config/
	$(INSTALL_CONF) ./files/root/etc/php.ini $(1)/etc/
	$(INSTALL_CONF) ./files/root/etc/lighttpd/lighttpd.conf $(1)/etc/lighttpd/
	$(INSTALL_BIN) ./files/root/etc/init.d/wifidog $(1)/etc/init.d/
	$(INSTALL_BIN) ./files/root/etc/uci-defaults/luci-wifidog $(1)/etc/uci-defaults/
	$(INSTALL_DATA) ./files/root/usr/lib/lua/luci/model/cbi/wifidog.lua $(1)/usr/lib/lua/luci/model/cbi/
	$(INSTALL_DATA) ./files/root/usr/lib/lua/luci/controller/wifidog.lua $(1)/usr/lib/lua/luci/controller/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/loader.gif $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/portal.css $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/portal.min.js $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/ratchicons.eot $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/ratchicons.svg $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/ratchicons.ttf $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/assets/ratchicons.woff $(1)/www/wifidog/assets/
	$(INSTALL_DATA) ./files/root/www/wifidog/index.php $(1)/www/wifidog/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Environment.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Exception/Pass.php $(1)/www/wifidog/Slim/Exception/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Exception/Stop.php $(1)/www/wifidog/Slim/Exception/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Helper/Set.php $(1)/www/wifidog/Slim/Helper/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Http/Cookies.php $(1)/www/wifidog/Slim/Http/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Http/Headers.php $(1)/www/wifidog/Slim/Http/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Http/Request.php $(1)/www/wifidog/Slim/Http/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Http/Response.php $(1)/www/wifidog/Slim/Http/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Http/Util.php $(1)/www/wifidog/Slim/Http/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Log.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/LogWriter.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Middleware/ContentTypes.php $(1)/www/wifidog/Slim/Middleware/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Middleware/Flash.php $(1)/www/wifidog/Slim/Middleware/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Middleware/MethodOverride.php $(1)/www/wifidog/Slim/Middleware/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Middleware/PrettyExceptions.php $(1)/www/wifidog/Slim/Middleware/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Middleware/SessionCookie.php $(1)/www/wifidog/Slim/Middleware/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Middleware.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Route.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Router.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/Slim.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/Slim/View.php $(1)/www/wifidog/Slim/
	$(INSTALL_DATA) ./files/root/www/wifidog/templates/701.html $(1)/www/wifidog/templates/
	$(INSTALL_DATA) ./files/root/www/wifidog/templates/show.php $(1)/www/wifidog/templates/
	$(INSTALL_DATA) ./files/root/www/wifidog/templates/touch.php $(1)/www/wifidog/templates/
endef

define Package/luci-app-wifidog/postinst
#!/bin/sh
[ -n "${IPKG_INSTROOT}" ] || {
	( . /etc/uci-defaults/luci-wifidog ) && rm -f /etc/uci-defaults/luci-wifidog
	chmod 755 /etc/init.d/wifidog >/dev/null 2>&1
	/etc/init.d/wifidog enable >/dev/null 2>&1
	exit 0
}
endef

$(eval $(call BuildPackage,luci-app-wifidog))
