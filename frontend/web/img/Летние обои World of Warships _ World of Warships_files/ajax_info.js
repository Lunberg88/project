function is_auth_user() {
    /* used in CMS content for tracking */
    return $.cookie('hlauth');
}

function get_lang() {
    return ($.cookie(wgsdk.vars.LANG_COOKIE_NAME)  ||
            wgsdk.vars.CURRENT_REQUEST_LANGUAGE ||
            wgsdk.vars.DEFAULT_LANGUAGE)
}


wgsdk.account_info = (function ($, base64) {
    var obj = function(cookie_name){
        cookie_name = cookie_name || wgsdk.vars.ACCOUNT_INFO_COOKIE_NAME;
        var data_from_cookie = null,
            data = $.cookie(cookie_name),
            instance = {},
            no_check_ajax_info_cookie_name = wgsdk.vars.NO_CHECK_AJAX_INFO_COOKIE_NAME;

        if (data) {
            data = data.replace(/\\"/g, "unique_tmp_str");
            data = data.replace(/"/g, "");
            data = data.replace(/unique_tmp_str/g, "\"");
            data = base64.decode(data);
            data_from_cookie = $.parseJSON(data);
        }

        instance.has_data = function () {
            if (data_from_cookie) {
                return true;
            }
            return false;
        };

        instance.get_by_key = function (key, default_value) {
            default_value = typeof default_value !== 'undefined' ? default_value : '';
            if (!data_from_cookie || !data_from_cookie[key]) {
                return default_value;
            }
            return data_from_cookie[key];
        };
        instance.get_spa_id = function () {
            return instance.get_by_key('spa_id') || 0;
        };
        instance.get_nickname = function () {
            return instance.get_by_key('nickname');
        };
        instance.is_staff = function () {
            return instance.get_by_key('is_staff', 0);
        };
        instance.get_game_ban = function () {
            return instance.get_by_key('game_ban');
        };
        instance.get_clan_ban = function () {
            return instance.get_by_key('clan_ban');
        };
        instance.get_unread_notification_count = function () {
            return instance.get_by_key('unread_notifications_count', 0);
        };
        instance.get_all_notification_count = function () {
            return instance.get_by_key('all_notifications_count', 0);
        };
        instance.is_kr_agreement_accepted = function() {
            return instance.get_by_key('is_kr_agreement_accepted', 0);
        };
        instance.set_extra_cookie_lifetime = function () {
            var date = new Date(),
                cookie_value = $.cookie(cookie_name),
                timeout;

            timeout = (wgsdk.vars.ACCOUNT_INFO_COOKIE_EXTRA_TIMEOUT_RATE
                       * wgsdk.vars.ACCOUNT_INFO_COOKIE_TIMEOUT_SECONDS * 1000);

            date.setTime(date.getTime() + timeout);

            $.removeCookie(cookie_name);
            var old_raw_value = $.cookie.raw;
            $.cookie.raw = true;
            $.cookie(cookie_name, cookie_value, {
                expires: date,
                path: '/',
                domain: wgsdk.vars.ACCOUNT_INFO_COOKIE_DOMAIN
            });
            $.cookie.raw = old_raw_value;
        };

        instance.set_no_check_ajax_info = function () {
            var date = new Date();
            timeout = (wgsdk.vars.ACCOUNT_INFO_COOKIE_EXTRA_TIMEOUT_RATE
                    * wgsdk.vars.ACCOUNT_INFO_COOKIE_TIMEOUT_SECONDS * 1000);

            date.setTime(date.getTime() + timeout);
            $.cookie(no_check_ajax_info_cookie_name, '1', {
                expires: date,
                path: '/',
                domain: wgsdk.vars.ACCOUNT_INFO_COOKIE_DOMAIN
            });
        };

        instance.get_no_check_ajax_info = function () {
            return $.cookie(no_check_ajax_info_cookie_name);
        };

        instance.update_cookie_from_server = function (callback) {
            if (wgsdk.vars.AJAX_ACCOUNT_INFO_REQUEST) {
                var intervalId = setInterval(function () {
                    if (!wgsdk.vars.AJAX_ACCOUNT_INFO_REQUEST) {
                        var account_info = wgsdk.account_info();
                        clearInterval(intervalId);
                        callback && callback(wgsdk.account_info());
                    }
                }, 300);
                return;
            }

            if (instance.get_no_check_ajax_info()) {
                return;
            }

            var start = new Date();
            wgsdk.vars.AJAX_ACCOUNT_INFO_REQUEST = $.ajax({
                url: wgsdk.vars.ACCOUNT_AJAX_INFO_URL,
                cache: false,
                type: "GET",
                data: {'referrer': '' + document.location.pathname},
                success: function () {
                    var end = new Date();

                    if (end.getTime() - start.getTime() > wgsdk.vars.GETTING_ACCOUNT_INFO_COOKIE_CRITICAL_TIME_MS) {
                        instance.set_extra_cookie_lifetime();
                    }
                    var account_info = wgsdk.account_info();
                    wgsdk.vars.AJAX_ACCOUNT_INFO_REQUEST = null;
                    callback && callback(account_info);
                },
                error: function(){
                    instance.set_no_check_ajax_info();
                }
            });
        };

        return instance;

    };
    return obj;
}(jQuery, wgsdk.base64));
