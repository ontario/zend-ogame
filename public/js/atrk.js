(function () {
    var _atrk = {iu: "https://d5nxst8fruw4z.cloudfront.net/atrk.gif?", ver: "20121002", opts: {atrk_acct: "", domain: "", dynamic: false}, fired: function () {
        if (typeof window._atrk_fired === 'undefined') {
            window._atrk_fired = false;
        }
        return window._atrk_fired;
    }, params: {frame_height: function () {
        return _atrk.frame("innerHeight", "clientHeight");
    }, frame_width: function () {
        return _atrk.frame("innerWidth", "clientWidth");
    }, iframe: function () {
        try {
            return window != window.top ? 1 : 0;
        } catch (a) {
            return 0;
        }
    }, title: function () {
        return this.ue(document ? document.title : "");
    }, time: function () {
        var i = new Date;
        return i.getTime() + "&time_zone_offset=" + i.getTimezoneOffset();
    }, screen_params: function () {
        try {
            return screen.width + "x" + screen.height + "x" + screen.colorDepth;
        } catch (a) {
        }
        return"";
    }, java_enabled: function () {
        if (navigator && typeof navigator.javaEnabled !== "undefined") {
            return navigator.javaEnabled() ? "1" : "0";
        }
        return"";
    }, cookie_enabled: function () {
        if (navigator && typeof navigator.cookieEnabled !== "undefined") {
            return navigator.cookieEnabled ? "1" : "0";
        }
        return"";
    }, ref_url: function () {
        return typeof document.referrer === "string" ? _atrk.ue(document.referrer) : "";
    }, host_url: function () {
        return typeof window.location.href === "string" ? _atrk.ue(window.location.href) : "";
    }, random_number: function () {
        return Math.round(Math.random() * 21474836747);
    }, sess_cookie: function () {
        return _atrk.gc("__asc", _atrk.user_cookie_v, "sess_cookie", 30 * 60);
    }, user_cookie: function () {
        return _atrk.gc("__auc", _atrk.user_cookie_v, "user_cookie", 366 * 24 * 60 * 60);
    }, dynamic: function () {
        return this.opts.dynamic.toString()
    }, domain: function () {
        return typeof this.opts.domain === "string" ? this.opts.domain : "";
    }, account: function () {
        return typeof this.opts.atrk_acct === "string" ? this.opts.atrk_acct : "";
    }, jsv: function () {
        return this.ver;
    }}, frame: function (i, c) {
        if (typeof window[i] !== "undefined") {
            return window[i];
        } else if (typeof window.document[c] !== "undefined") {
            return window.document[c];
        } else {
            try {
                return window.document.getElementsByTagName("body")[0][c];
            } catch (a) {
                return"-";
            }
        }
    }, r: function () {
        return((1 + Math.random()) * 65536 | 0).toString(16).substring(1);
    }, muc: function () {
        return this.r() + this.r() + (new Date).getTime().toString(16) + this.r() + this.r();
    }, gc: function (a, b, c, d) {
        var e = "", f = 0;
        try {
            e = this.gbc(a);
        } catch (g) {
        }
        if (e == null || e.length == 0) {
            e = b;
            f = 1;
        }
        this.sbc(a, e, d);
        return e + "&" + c + "_flag=" + f;
    }, ue: function (a) {
        try {
            return encodeURIComponent(a);
        } catch (b) {
            return escape(a);
        }
    }, gbc: function (a) {
        var b = document.cookie, c = a + "=", d = b.indexOf("; " + c), e;
        if (d == -1) {
            d = b.indexOf(c);
            if (d != 0)return null;
        } else {
            d += 2;
        }
        e = b.indexOf(";", d);
        if (e == -1) {
            e = b.length;
        }
        return this.ue(b.substring(d + c.length, e));
    }, sbc: function (a, b, c) {
        var d = new Date, e = this.dom(), f = "/";
        d.setTime(d.getTime() + c * 1e3);
        document.cookie = a + "=" + escape(b) + (c ? "; expires=" + d.toGMTString() : "") + (e && e.length > 0 ? "; domain=." + e : "") + "; path=/";
    }, dom: function () {
        if (typeof this.opts.domain === "string") {
            return this.opts.domain;
        } else {
            var h = window.location.host;
            return h.substr(0, 4) == "www." ? h.substr(4) : h;
        }
    }, gen_url: function () {
        try {
            var self = this;
            return this.iu + this.map(this.params,function (k, v) {
                return k + "=" + v.call(self);
            }).join("&");
        } catch (e) {
            return this.iu;
        }
    }, map: function (a, f) {
        var acc = [];
        for (var i in a) {
            if (a.hasOwnProperty(i)) {
                acc.push(f.call(this, i, a[i]))
            }
        }
        return acc;
    }, user_cookie_v: "", fire: function (opts) {
        this.user_cookie_v = this.muc();
        this.map(opts, function (k, v) {
            this.opts[k] = v;
        });
        if (this.fired()) {
            return;
        }
        window._atrk_fired = true;
        var a = new Image(1, 1);
        a.alt = "alexametrics";
        a.src = this.gen_url();
    }};
    window.atrk = function () {
        _atrk.fire(_atrk_opts);
    };
    if (typeof _atrk_opts !== "undefined" && typeof _atrk_opts.dynamic !== "undefined" && _atrk_opts.dynamic) {
        atrk();
    }
})();
