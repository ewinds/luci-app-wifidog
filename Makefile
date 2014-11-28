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
	DEPENDS:=+wifidog
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
	$(INSTALL_DIR) $(1)/etc/init.d
	$(INSTALL_DIR) $(1)/etc/uci-defaults
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci/model/cbi
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci/controller
	$(INSTALL_CONF) ./files/root/etc/config/wifidog $(1)/etc/config/
	$(INSTALL_BIN) ./files/root/etc/init.d/wifidog $(1)/etc/init.d/
	$(INSTALL_BIN) ./files/root/etc/uci-defaults/luci-wifidog $(1)/etc/uci-defaults/
	$(INSTALL_DATA) ./files/root/usr/lib/lua/luci/model/cbi/wifidog.lua $(1)/usr/lib/lua/luci/model/cbi/
	$(INSTALL_DATA) ./files/root/usr/lib/lua/luci/controller/wifidog.lua $(1)/usr/lib/lua/luci/controller/
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
