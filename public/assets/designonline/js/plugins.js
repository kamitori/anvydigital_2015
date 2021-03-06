/*!
 *
 * foundation.js
 */
var libFuncName = null;
if ("undefined" == typeof jQuery && "undefined" == typeof Zepto && "function" == typeof $) libFuncName = $;
else if ("function" == typeof jQuery) libFuncName = jQuery;
else {
    if ("function" != typeof Zepto) throw new TypeError;
    libFuncName = Zepto
}! function (a, b) {
    "use strict";
    Array.prototype.filter || (Array.prototype.filter = function (a) {
        if (null == this) throw new TypeError;
        var b = Object(this),
            c = b.length >>> 0;
        if ("function" == typeof a) {
            for (var d = [], e = arguments[1], f = 0; c > f; f++)
                if (f in b) {
                    var g = b[f];
                    a && a.call(e, g, f, b) && d.push(g)
                }
            return d
        }
    }), Function.prototype.bind || (Function.prototype.bind = function (a) {
        if ("function" != typeof this) throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
        var b = Array.prototype.slice.call(arguments, 1),
            c = this,
            d = function () {},
            e = function () {
                return c.apply(this instanceof d && a ? this : a, b.concat(Array.prototype.slice.call(arguments)))
            };
        return d.prototype = this.prototype, e.prototype = new d, e
    }), Array.prototype.indexOf || (Array.prototype.indexOf = function (a) {
        if (null == this) throw new TypeError;
        var b = Object(this),
            c = b.length >>> 0;
        if (0 === c) return -1;
        var d = 0;
        if (arguments.length > 1 && (d = Number(arguments[1]), d != d ? d = 0 : 0 != d && 1 / 0 != d && d != -1 / 0 && (d = (d > 0 || -1) * Math.floor(Math.abs(d)))), d >= c) return -1;
        for (var e = d >= 0 ? d : Math.max(c - Math.abs(d), 0); c > e; e++)
            if (e in b && b[e] === a) return e;
        return -1
    }), a.fn.stop = a.fn.stop || function () {
        return this
    }, b.Foundation = {
        name: "Foundation",
        version: "4.1.5",
        cache: {},
        init: function (b, c, d, e, f, g) {
            var h, i = [b, d, e, f],
                j = [],
                g = g || !1;
            if (g && (this.nc = g), this.rtl = /rtl/i.test(a("html").attr("dir")), this.scope = b || this.scope, c && "string" == typeof c) {
                if (/off/i.test(c)) return this.off();
                if (h = c.split(" "), h.length > 0)
                    for (var k = h.length - 1; k >= 0; k--) j.push(this.init_lib(h[k], i))
            } else
                for (var l in this.libs) j.push(this.init_lib(l, i));
            return "function" == typeof c && i.unshift(c), this.response_obj(j, i)
        },
        response_obj: function (a, b) {
            for (var c = 0, d = b.length; d > c; c++)
                if ("function" == typeof b[c]) return b[c]({
                    errors: a.filter(function (a) {
                        return "string" == typeof a ? a : void 0
                    })
                });
            return a
        },
        init_lib: function (a, b) {
            return this.trap(function () {
                return this.libs.hasOwnProperty(a) ? (this.patch(this.libs[a]), this.libs[a].init.apply(this.libs[a], b)) : void 0
            }.bind(this), a)
        },
        trap: function (a, b) {
            if (!this.nc) try {
                return a()
            } catch (c) {
                return this.error({
                    name: b,
                    message: "could not be initialized",
                    more: c.name + " " + c.message
                })
            }
            return a()
        },
        patch: function (a) {
            this.fix_outer(a), a.scope = this.scope, a.rtl = this.rtl
        },
        inherit: function (a, b) {
            for (var c = b.split(" "), d = c.length - 1; d >= 0; d--) this.lib_methods.hasOwnProperty(c[d]) && (this.libs[a.name][c[d]] = this.lib_methods[c[d]])
        },
        random_str: function (a) {
            var b = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz".split("");
            a || (a = Math.floor(Math.random() * b.length));
            for (var c = "", d = 0; a > d; d++) c += b[Math.floor(Math.random() * b.length)];
            return c
        },
        libs: {},
        lib_methods: {
            set_data: function (a, b) {
                var c = [this.name, +new Date, Foundation.random_str(5)].join("-");
                return Foundation.cache[c] = b, a.attr("data-" + this.name + "-id", c), b
            },
            get_data: function (a) {
                return Foundation.cache[a.attr("data-" + this.name + "-id")]
            },
            remove_data: function (b) {
                b ? (delete Foundation.cache[b.attr("data-" + this.name + "-id")], b.attr("data-" + this.name + "-id", "")) : a("[data-" + this.name + "-id]").each(function () {
                    delete Foundation.cache[a(this).attr("data-" + this.name + "-id")], a(this).attr("data-" + this.name + "-id", "")
                })
            },
            throttle: function (a, b) {
                var c = null;
                return function () {
                    var d = this,
                        e = arguments;
                    clearTimeout(c), c = setTimeout(function () {
                        a.apply(d, e)
                    }, b)
                }
            },
            data_options: function (b) {
                function c(a) {
                    return !isNaN(a - 0) && null !== a && "" !== a && a !== !1 && a !== !0
                }

                function d(b) {
                    return "string" == typeof b ? a.trim(b) : b
                }
                var e, f, g = {},
                    h = (b.attr("data-options") || ":").split(";"),
                    i = h.length;
                for (e = i - 1; e >= 0; e--) f = h[e].split(":"), /true/i.test(f[1]) && (f[1] = !0), /false/i.test(f[1]) && (f[1] = !1), c(f[1]) && (f[1] = parseInt(f[1], 10)), 2 === f.length && f[0].length > 0 && (g[d(f[0])] = d(f[1]));
                return g
            },
            delay: function (a, b) {
                return setTimeout(a, b)
            },
            scrollTo: function (c, d, e) {
                if (!(0 > e)) {
                    var f = d - a(b).scrollTop(),
                        g = 10 * (f / e);
                    this.scrollToTimerCache = setTimeout(function () {
                        isNaN(parseInt(g, 10)) || (b.scrollTo(0, a(b).scrollTop() + g), this.scrollTo(c, d, e - 10))
                    }.bind(this), 10)
                }
            },
            scrollLeft: function (a) {
                return a.length ? "scrollLeft" in a[0] ? a[0].scrollLeft : a[0].pageXOffset : void 0
            },
            empty: function (a) {
                if (a.length && a.length > 0) return !1;
                if (a.length && 0 === a.length) return !0;
                for (var b in a)
                    if (hasOwnProperty.call(a, b)) return !1;
                return !0
            }
        },
        fix_outer: function (a) {
            a.outerHeight = function (a, b) {
                return "function" == typeof Zepto ? a.height() : "undefined" != typeof b ? a.outerHeight(b) : a.outerHeight()
            }, a.outerWidth = function (a) {
                return "function" == typeof Zepto ? a.width() : "undefined" != typeof bool ? a.outerWidth(bool) : a.outerWidth()
            }
        },
        error: function (a) {
            return a.name + " " + a.message + "; " + a.more
        },
        off: function () {
            return a(this.scope).off(".fndtn"), a(b).off(".fndtn"), !0
        },
        zj: function () {
            try {
                return Zepto
            } catch (a) {
                return jQuery
            }
        }()
    }, a.fn.foundation = function () {
        var a = Array.prototype.slice.call(arguments, 0);
        return this.each(function () {
            return Foundation.init.apply(Foundation, [this].concat(a)), this
        })
    }
}(libFuncName, this, this.document),

/*!
 *
 * jquery.imageslaoded.min.js
 */
function (a, b) {
    var c = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    a.fn.imagesLoaded = function (d) {
        function e() {
            var b = a(m),
                c = a(n);
            i && (n.length ? i.reject(k, b, c) : i.resolve(k)), a.isFunction(d) && d.call(h, k, b, c)
        }

        function f(a) {
            g(a.target, "error" === a.type)
        }

        function g(b, d) {
            b.src === c || -1 !== a.inArray(b, l) || (l.push(b), d ? n.push(b) : m.push(b), a.data(b, "imagesLoaded", {
                isBroken: d,
                src: b.src
            }), j && i.notifyWith(a(b), [d, k, a(m), a(n)]), k.length === l.length && (setTimeout(e), k.unbind(".imagesLoaded", f)))
        }
        var h = this,
            i = a.isFunction(a.Deferred) ? a.Deferred() : 0,
            j = a.isFunction(i.notify),
            k = h.find("img").add(h.filter("img")),
            l = [],
            m = [],
            n = [];
        return a.isPlainObject(d) && a.each(d, function (a, b) {
            "callback" === a ? d = b : i && i[a](b)
        }), k.length ? k.bind("load.imagesLoaded error.imagesLoaded", f).each(function (d, e) {
            var f = e.src,
                h = a.data(e, "imagesLoaded");
            h && h.src === f ? g(e, h.isBroken) : e.complete && e.naturalWidth !== b ? g(e, 0 === e.naturalWidth || 0 === e.naturalHeight) : (e.readyState || e.complete) && (e.src = c, e.src = f)
        }) : e(), i ? i.promise(h) : h
    }
}(jQuery),
/*!
 *
 * jquery.natural-res.js
 */
function (a) {
    for (var b, c = ["Width", "Height"]; b = c.pop();)! function (b, c) {
        a.fn[b] = b in new Image ? function () {
            if( this.length )
                return this[0][b];
        } : function () {
            var a, b, d = this[0];
            return "img" === d.tagName.toLowerCase() && (a = new Image, a.src = d.src, b = a[c]), b
        }
    }("natural" + b, b.toLowerCase())
}(jQuery),
/*!

	Zoom v1.7.8 - 2013-07-30
	Enlarge images on click or mouseover.
	(c) 2013 Jack Moore - http://www.jacklmoore.com/zoom
	license: http://www.opensource.org/licenses/mit-license.php

*/
function (a) {
    var b = {
        url: !1,
        callback: !1,
        target: !1,
        duration: 120,
        on: "mouseover",
        onZoomIn: !1,
        onZoomOut: !1
    };
    a.zoom = function (b, c, d) {
        var e, f, g, h, i, j = a(b).css("position");
        return a(b).css({
            position: /(absolute|fixed)/.test(j) ? j : "relative",
            overflow: "hidden"
        }), d.style.width = d.style.height = "", a(d).addClass("zoomImg").css({
            position: "absolute",
            top: 0,
            left: 0,
            opacity: 0,
            width: d.width,
            height: d.height,
            border: "none",
            maxWidth: "none"
        }).appendTo(b), {
            init: function () {
                e = a(b).outerWidth(), f = a(b).outerHeight(), g = (d.width - e) / a(c).outerWidth(), h = (d.height - f) / a(c).outerHeight(), i = a(c).offset()
            },
            move: function (a) {
                var b = a.pageX - i.left,
                    c = a.pageY - i.top;
                c = Math.max(Math.min(c, f), 0), b = Math.max(Math.min(b, e), 0), d.style.left = b * -g + "px", d.style.top = c * -h + "px"
            }
        }
    }, a.fn.zoom = function (c) {
        return this.each(function () {
            var d, e = a.extend({}, b, c || {}),
                f = e.target || this,
                g = this,
                h = document.createElement("img"),
                i = a(h),
                j = "mousemove.zoom",
                k = !1;
            (e.url || (d = a(g).find("img"), d[0] && (e.url = d.data("src") || d.attr("src")), e.url)) && (h.onload = function () {
                function b(b) {
                    d.init(), d.move(b), i.stop().fadeTo(a.support.opacity ? e.duration : 0, 1, a.isFunction(e.onZoomIn) ? e.onZoomIn.call(h) : !1)
                }

                function c() {
                    i.stop().fadeTo(e.duration, 0, a.isFunction(e.onZoomOut) ? e.onZoomOut.call(h) : !1)
                }
                var d = a.zoom(f, g, h);
                "grab" === e.on ? a(g).on("mousedown.zoom", function (e) {
                    1 === e.which && (a(document).one("mouseup.zoom", function () {
                        c(), a(document).off(j, d.move)
                    }), b(e), a(document).on(j, d.move), e.preventDefault())
                }) : "click" === e.on ? a(g).on("click.zoom", function (e) {
                    return k ? void 0 : (k = !0, b(e), a(document).on(j, d.move), a(document).one("click.zoom", function () {
                        c(), k = !1, a(document).off(j, d.move)
                    }), !1)
                }) : "toggle" === e.on ? a(g).on("click.zoom", function (a) {
                    k ? c() : b(a), k = !k
                }) : (d.init(), a(g).on("mouseenter.zoom", b).on("mouseleave.zoom", c).on(j, d.move)), a.isFunction(e.callback) && e.callback.call(h)
            }, h.src = e.url, a(g).one("zoom.destroy", function () {
                a(g).off(".zoom"), i.remove()
            }))
        })
    }, a.fn.zoom.defaults = b
}(window.jQuery), "function" != typeof Object.create && (Object.create = function (a) {
    function b() {}
    return b.prototype = a, new b
}),
function (a, b, c, d) {
    var e = {
        init: function (b, c) {
            var d = this;
            d.$elem = a(c), d.options = a.extend({}, a.fn.owlCarousel.options, d.$elem.data(), b), d.userOptions = b, d.loadContent()
        },
        loadContent: function () {
            function b(a) {
                if ("function" == typeof c.options.jsonSuccess) c.options.jsonSuccess.apply(this, [a]);
                else {
                    var b = "";
                    for (var d in a.owl) b += a.owl[d].item;
                    c.$elem.html(b)
                }
                c.logIn()
            }
            var c = this;
            if ("function" == typeof c.options.beforeInit && c.options.beforeInit.apply(this, [c.$elem]), "string" == typeof c.options.jsonPath) {
                var d = c.options.jsonPath;
                a.getJSON(d, b)
            } else c.logIn()
        },
        logIn: function () {
            var a = this;
            a.$elem.data("owl-originalStyles", a.$elem.attr("style")).data("owl-originalClasses", a.$elem.attr("class")), a.$elem.css({
                opacity: 0
            }), a.orignalItems = a.options.items, a.checkBrowser(), a.wrapperWidth = 0, a.checkVisible, a.setVars()
        },
        setVars: function () {
            var a = this;
            return 0 === a.$elem.children().length ? !1 : (a.baseClass(), a.eventTypes(), a.$userItems = a.$elem.children(), a.itemsAmount = a.$userItems.length, a.wrapItems(), a.$owlItems = a.$elem.find(".owl-item"), a.$owlWrapper = a.$elem.find(".owl-wrapper"), a.playDirection = "next", a.prevItem = 0, a.prevArr = [0], a.currentItem = 0, a.customEvents(), a.onStartup(), void 0)
        },
        onStartup: function () {
            var a = this;
            a.updateItems(), a.calculateAll(), a.buildControls(), a.updateControls(), a.response(), a.moveEvents(), a.stopOnHover(), a.owlStatus(), a.options.transitionStyle !== !1 && a.transitionTypes(a.options.transitionStyle), a.options.autoPlay === !0 && (a.options.autoPlay = 5e3), a.play(), a.$elem.find(".owl-wrapper").css("display", "block"), a.$elem.is(":visible") ? a.$elem.css("opacity", 1) : a.watchVisibility(), a.onstartup = !1, a.eachMoveUpdate(), "function" == typeof a.options.afterInit && a.options.afterInit.apply(this, [a.$elem])
        },
        eachMoveUpdate: function () {
            var a = this;
            a.options.lazyLoad === !0 && a.lazyLoad(), a.options.autoHeight === !0 && a.autoHeight(), a.onVisibleItems(), "function" == typeof a.options.afterAction && a.options.afterAction.apply(this, [a.$elem])
        },
        updateVars: function () {
            var a = this;
            "function" == typeof a.options.beforeUpdate && a.options.beforeUpdate.apply(this, [a.$elem]), a.watchVisibility(), a.updateItems(), a.calculateAll(), a.updatePosition(), a.updateControls(), a.eachMoveUpdate(), "function" == typeof a.options.afterUpdate && a.options.afterUpdate.apply(this, [a.$elem])
        },
        reload: function () {
            var a = this;
            setTimeout(function () {
                a.updateVars()
            }, 0)
        },
        watchVisibility: function () {
            var a = this;
            return a.$elem.is(":visible") !== !1 ? !1 : (a.$elem.css({
                opacity: 0
            }), clearInterval(a.autoPlayInterval), clearInterval(a.checkVisible), a.checkVisible = setInterval(function () {
                a.$elem.is(":visible") && (a.reload(), a.$elem.animate({
                    opacity: 1
                }, 200), clearInterval(a.checkVisible))
            }, 500), void 0)
        },
        wrapItems: function () {
            var a = this;
            a.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>'), a.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">'), a.wrapperOuter = a.$elem.find(".owl-wrapper-outer"), a.$elem.css("display", "block")
        },
        baseClass: function () {
            var a = this,
                b = a.$elem.hasClass(a.options.baseClass),
                c = a.$elem.hasClass(a.options.theme);
            b || a.$elem.addClass(a.options.baseClass), c || a.$elem.addClass(a.options.theme)
        },
        updateItems: function () {
            var b = this;
            if (b.options.responsive === !1) return !1;
            if (b.options.singleItem === !0) return b.options.items = b.orignalItems = 1, b.options.itemsCustom = !1, b.options.itemsDesktop = !1, b.options.itemsDesktopSmall = !1, b.options.itemsTablet = !1, b.options.itemsTabletSmall = !1, b.options.itemsMobile = !1, !1;
            var c = a(b.options.responsiveBaseWidth).width();
            if (c > (b.options.itemsDesktop[0] || b.orignalItems) && (b.options.items = b.orignalItems), "undefined" != typeof b.options.itemsCustom && b.options.itemsCustom !== !1) {
                b.options.itemsCustom.sort(function (a, b) {
                    return a[0] - b[0]
                });
                for (var d in b.options.itemsCustom) "undefined" != typeof b.options.itemsCustom[d] && b.options.itemsCustom[d][0] <= c && (b.options.items = b.options.itemsCustom[d][1])
            } else c <= b.options.itemsDesktop[0] && b.options.itemsDesktop !== !1 && (b.options.items = b.options.itemsDesktop[1]), c <= b.options.itemsDesktopSmall[0] && b.options.itemsDesktopSmall !== !1 && (b.options.items = b.options.itemsDesktopSmall[1]), c <= b.options.itemsTablet[0] && b.options.itemsTablet !== !1 && (b.options.items = b.options.itemsTablet[1]), c <= b.options.itemsTabletSmall[0] && b.options.itemsTabletSmall !== !1 && (b.options.items = b.options.itemsTabletSmall[1]), c <= b.options.itemsMobile[0] && b.options.itemsMobile !== !1 && (b.options.items = b.options.itemsMobile[1]);
            b.options.items > b.itemsAmount && b.options.itemsScaleUp === !0 && (b.options.items = b.itemsAmount)
        },
        response: function () {
            var c, d = this;
            if (d.options.responsive !== !0) return !1;
            var e = a(b).width();
            d.resizer = function () {
                a(b).width() !== e && (d.options.autoPlay !== !1 && clearInterval(d.autoPlayInterval), clearTimeout(c), c = setTimeout(function () {
                    e = a(b).width(), d.updateVars()
                }, d.options.responsiveRefreshRate))
            }, a(b).resize(d.resizer)
        },
        updatePosition: function () {
            var a = this;
            a.jumpTo(a.currentItem), a.options.autoPlay !== !1 && a.checkAp()
        },
        appendItemsSizes: function () {
            var b = this,
                c = 0,
                d = b.itemsAmount - b.options.items;
            b.$owlItems.each(function (e) {
                var f = a(this);
                f.css({
                    width: b.itemWidth
                }).data("owl-item", Number(e)), (0 === e % b.options.items || e === d) && (e > d || (c += 1)), f.data("owl-roundPages", c)
            })
        },
        appendWrapperSizes: function () {
            var a = this,
                b = 0,
                b = a.$owlItems.length * a.itemWidth;
            a.$owlWrapper.css({
                width: 2 * b,
                left: 0
            }), a.appendItemsSizes()
        },
        calculateAll: function () {
            var a = this;
            a.calculateWidth(), a.appendWrapperSizes(), a.loops(), a.max()
        },
        calculateWidth: function () {
            var a = this;
            a.itemWidth = Math.round(a.$elem.width() / a.options.items)
        },
        max: function () {
            var a = this,
                b = -1 * (a.itemsAmount * a.itemWidth - a.options.items * a.itemWidth);
            return a.options.items > a.itemsAmount ? (a.maximumItem = 0, b = 0, a.maximumPixels = 0) : (a.maximumItem = a.itemsAmount - a.options.items, a.maximumPixels = b), b
        },
        min: function () {
            return 0
        },
        loops: function () {
            var b = this;
            b.positionsInArray = [0], b.pagesInArray = [];
            for (var c = 0, d = 0, e = 0; e < b.itemsAmount; e++)
                if (d += b.itemWidth, b.positionsInArray.push(-d), b.options.scrollPerPage === !0) {
                    var f = a(b.$owlItems[e]),
                        g = f.data("owl-roundPages");
                    g !== c && (b.pagesInArray[c] = b.positionsInArray[e], c = g)
                }
        },
        buildControls: function () {
            var b = this;
            (b.options.navigation === !0 || b.options.pagination === !0) && (b.owlControls = a('<div class="owl-controls"/>').toggleClass("clickable", !b.browser.isTouch).appendTo(b.$elem)), b.options.pagination === !0 && b.buildPagination(), b.options.navigation === !0 && b.buildButtons()
        },
        buildButtons: function () {
            var b = this,
                c = a('<div class="owl-buttons"/>');
            b.owlControls.append(c), b.buttonPrev = a("<div/>", {
                "class": "owl-prev",
                html: b.options.navigationText[0] || ""
            }), b.buttonNext = a("<div/>", {
                "class": "owl-next",
                html: b.options.navigationText[1] || ""
            }), c.append(b.buttonPrev).append(b.buttonNext), c.on("touchstart.owlControls mousedown.owlControls", 'div[class^="owl"]', function (a) {
                a.preventDefault()
            }), c.on("touchend.owlControls mouseup.owlControls", 'div[class^="owl"]', function (c) {
                c.preventDefault(), a(this).hasClass("owl-next") ? b.next() : b.prev()
            })
        },
        buildPagination: function () {
            var b = this;
            b.paginationWrapper = a('<div class="owl-pagination"/>'), b.owlControls.append(b.paginationWrapper), b.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (c) {
                c.preventDefault(), Number(a(this).data("owl-page")) !== b.currentItem && b.goTo(Number(a(this).data("owl-page")), !0)
            })
        },
        updatePagination: function () {
            var b = this;
            if (b.options.pagination === !1) return !1;
            b.paginationWrapper.html("");
            for (var c = 0, d = b.itemsAmount - b.itemsAmount % b.options.items, e = 0; e < b.itemsAmount; e++)
                if (0 === e % b.options.items) {
                    if (c += 1, d === e) var f = b.itemsAmount - b.options.items;
                    var g = a("<div/>", {
                            "class": "owl-page"
                        }),
                        h = a("<span></span>", {
                            text: b.options.paginationNumbers === !0 ? c : "",
                            "class": b.options.paginationNumbers === !0 ? "owl-numbers" : ""
                        });
                    g.append(h), g.data("owl-page", d === e ? f : e), g.data("owl-roundPages", c), b.paginationWrapper.append(g)
                }
            b.checkPagination()
        },
        checkPagination: function () {
            var b = this;
            return b.options.pagination === !1 ? !1 : (b.paginationWrapper.find(".owl-page").each(function () {
                a(this).data("owl-roundPages") === a(b.$owlItems[b.currentItem]).data("owl-roundPages") && (b.paginationWrapper.find(".owl-page").removeClass("active"), a(this).addClass("active"))
            }), void 0)
        },
        checkNavigation: function () {
            var a = this;
            return a.options.navigation === !1 ? !1 : (a.options.rewindNav === !1 && (0 === a.currentItem && 0 === a.maximumItem ? (a.buttonPrev.addClass("disabled"), a.buttonNext.addClass("disabled")) : 0 === a.currentItem && 0 !== a.maximumItem ? (a.buttonPrev.addClass("disabled"), a.buttonNext.removeClass("disabled")) : a.currentItem === a.maximumItem ? (a.buttonPrev.removeClass("disabled"), a.buttonNext.addClass("disabled")) : 0 !== a.currentItem && a.currentItem !== a.maximumItem && (a.buttonPrev.removeClass("disabled"), a.buttonNext.removeClass("disabled"))), void 0)
        },
        updateControls: function () {
            var a = this;
            a.updatePagination(), a.checkNavigation(), a.owlControls && (a.options.items >= a.itemsAmount ? a.owlControls.hide() : a.owlControls.show())
        },
        destroyControls: function () {
            var a = this;
            a.owlControls && a.owlControls.remove()
        },
        next: function (a) {
            var b = this;
            if (b.isTransition) return !1;
            if (b.currentItem += b.options.scrollPerPage === !0 ? b.options.items : 1, b.currentItem > b.maximumItem + (1 == b.options.scrollPerPage ? b.options.items - 1 : 0)) {
                if (b.options.rewindNav !== !0) return b.currentItem = b.maximumItem, !1;
                b.currentItem = 0, a = "rewind"
            }
            b.goTo(b.currentItem, a)
        },
        prev: function (a) {
            var b = this;
            if (b.isTransition) return !1;
            if (b.options.scrollPerPage === !0 && b.currentItem > 0 && b.currentItem < b.options.items ? b.currentItem = 0 : b.currentItem -= b.options.scrollPerPage === !0 ? b.options.items : 1, b.currentItem < 0) {
                if (b.options.rewindNav !== !0) return b.currentItem = 0, !1;
                b.currentItem = b.maximumItem, a = "rewind"
            }
            b.goTo(b.currentItem, a)
        },
        goTo: function (a, b, c) {
            var d = this;
            if (d.isTransition) return !1;
            if ("function" == typeof d.options.beforeMove && d.options.beforeMove.apply(this, [d.$elem]), a >= d.maximumItem ? a = d.maximumItem : 0 >= a && (a = 0), d.currentItem = d.owl.currentItem = a, d.options.transitionStyle !== !1 && "drag" !== c && 1 === d.options.items && d.browser.support3d === !0) return d.swapSpeed(0), d.browser.support3d === !0 ? d.transition3d(d.positionsInArray[a]) : d.css2slide(d.positionsInArray[a], 1), d.afterGo(), d.singleItemTransition(), !1;
            var e = d.positionsInArray[a];
            d.browser.support3d === !0 ? (d.isCss3Finish = !1, b === !0 ? (d.swapSpeed("paginationSpeed"), setTimeout(function () {
                d.isCss3Finish = !0
            }, d.options.paginationSpeed)) : "rewind" === b ? (d.swapSpeed(d.options.rewindSpeed), setTimeout(function () {
                d.isCss3Finish = !0
            }, d.options.rewindSpeed)) : (d.swapSpeed("slideSpeed"), setTimeout(function () {
                d.isCss3Finish = !0
            }, d.options.slideSpeed)), d.transition3d(e)) : b === !0 ? d.css2slide(e, d.options.paginationSpeed) : "rewind" === b ? d.css2slide(e, d.options.rewindSpeed) : d.css2slide(e, d.options.slideSpeed), d.afterGo()
        },
        jumpTo: function (a) {
            var b = this;
            "function" == typeof b.options.beforeMove && b.options.beforeMove.apply(this, [b.$elem]), a >= b.maximumItem || -1 === a ? a = b.maximumItem : 0 >= a && (a = 0), b.swapSpeed(0), b.browser.support3d === !0 ? b.transition3d(b.positionsInArray[a]) : b.css2slide(b.positionsInArray[a], 1), b.currentItem = b.owl.currentItem = a, b.afterGo()
        },
        afterGo: function () {
            var a = this;
            a.prevArr.push(a.currentItem), a.prevItem = a.owl.prevItem = a.prevArr[a.prevArr.length - 2], a.prevArr.shift(0), a.prevItem !== a.currentItem && (a.checkPagination(), a.checkNavigation(), a.eachMoveUpdate(), a.options.autoPlay !== !1 && a.checkAp()), "function" == typeof a.options.afterMove && a.prevItem !== a.currentItem && a.options.afterMove.apply(this, [a.$elem])
        },
        stop: function () {
            var a = this;
            a.apStatus = "stop", clearInterval(a.autoPlayInterval)
        },
        checkAp: function () {
            var a = this;
            "stop" !== a.apStatus && a.play()
        },
        play: function () {
            var a = this;
            return a.apStatus = "play", a.options.autoPlay === !1 ? !1 : (clearInterval(a.autoPlayInterval), a.autoPlayInterval = setInterval(function () {
                a.next(!0)
            }, a.options.autoPlay), void 0)
        },
        swapSpeed: function (a) {
            var b = this;
            "slideSpeed" === a ? b.$owlWrapper.css(b.addCssSpeed(b.options.slideSpeed)) : "paginationSpeed" === a ? b.$owlWrapper.css(b.addCssSpeed(b.options.paginationSpeed)) : "string" != typeof a && b.$owlWrapper.css(b.addCssSpeed(a))
        },
        addCssSpeed: function (a) {
            return {
                "-webkit-transition": "all " + a + "ms ease",
                "-moz-transition": "all " + a + "ms ease",
                "-o-transition": "all " + a + "ms ease",
                transition: "all " + a + "ms ease"
            }
        },
        removeTransition: function () {
            return {
                "-webkit-transition": "",
                "-moz-transition": "",
                "-o-transition": "",
                transition: ""
            }
        },
        doTranslate: function (a) {
            return {
                "-webkit-transform": "translate3d(" + a + "px, 0px, 0px)",
                "-moz-transform": "translate3d(" + a + "px, 0px, 0px)",
                "-o-transform": "translate3d(" + a + "px, 0px, 0px)",
                "-ms-transform": "translate3d(" + a + "px, 0px, 0px)",
                transform: "translate3d(" + a + "px, 0px,0px)"
            }
        },
        transition3d: function (a) {
            var b = this;
            b.$owlWrapper.css(b.doTranslate(a))
        },
        css2move: function (a) {
            var b = this;
            b.$owlWrapper.css({
                left: a
            })
        },
        css2slide: function (a, b) {
            var c = this;
            c.isCssFinish = !1, c.$owlWrapper.stop(!0, !0).animate({
                left: a
            }, {
                duration: b || c.options.slideSpeed,
                complete: function () {
                    c.isCssFinish = !0
                }
            })
        },
        checkBrowser: function () {
            var a = this,
                d = "translate3d(0px, 0px, 0px)",
                e = c.createElement("div");
            e.style.cssText = "  -moz-transform:" + d + "; -ms-transform:" + d + "; -o-transform:" + d + "; -webkit-transform:" + d + "; transform:" + d;
            var f = /translate3d\(0px, 0px, 0px\)/g,
                g = e.style.cssText.match(f),
                h = null !== g && 1 === g.length,
                i = "ontouchstart" in b || navigator.msMaxTouchPoints;
            a.browser = {
                support3d: h,
                isTouch: i
            }
        },
        moveEvents: function () {
            var a = this;
            (a.options.mouseDrag !== !1 || a.options.touchDrag !== !1) && (a.gestures(), a.disabledEvents())
        },
        eventTypes: function () {
            var a = this,
                b = ["s", "e", "x"];
            a.ev_types = {}, a.options.mouseDrag === !0 && a.options.touchDrag === !0 ? b = ["touchstart.owl mousedown.owl", "touchmove.owl mousemove.owl", "touchend.owl touchcancel.owl mouseup.owl"] : a.options.mouseDrag === !1 && a.options.touchDrag === !0 ? b = ["touchstart.owl", "touchmove.owl", "touchend.owl touchcancel.owl"] : a.options.mouseDrag === !0 && a.options.touchDrag === !1 && (b = ["mousedown.owl", "mousemove.owl", "mouseup.owl"]), a.ev_types.start = b[0], a.ev_types.move = b[1], a.ev_types.end = b[2]
        },
        disabledEvents: function () {
            var b = this;
            b.$elem.on("dragstart.owl", function (a) {
                a.preventDefault()
            }), b.$elem.on("mousedown.disableTextSelect", function (b) {
                return a(b.target).is("input, textarea, select, option")
            })
        },
        gestures: function () {
            function e(a) {
                return a.touches ? {
                    x: a.touches[0].pageX,
                    y: a.touches[0].pageY
                } : a.pageX !== d ? {
                    x: a.pageX,
                    y: a.pageY
                } : {
                    x: a.clientX,
                    y: a.clientY
                }
            }

            function f(b) {
                "on" === b ? (a(c).on(j.ev_types.move, h), a(c).on(j.ev_types.end, i)) : "off" === b && (a(c).off(j.ev_types.move), a(c).off(j.ev_types.end))
            }

            function g(c) {
                var c = c.originalEvent || c || b.event;
                if (3 === c.which) return !1;
                if (!(j.itemsAmount <= j.options.items)) {
                    if (j.isCssFinish === !1 && !j.options.dragBeforeAnimFinish) return !1;
                    if (j.isCss3Finish === !1 && !j.options.dragBeforeAnimFinish) return !1;
                    j.options.autoPlay !== !1 && clearInterval(j.autoPlayInterval), j.browser.isTouch === !0 || j.$owlWrapper.hasClass("grabbing") || j.$owlWrapper.addClass("grabbing"), j.newPosX = 0, j.newRelativeX = 0, a(this).css(j.removeTransition());
                    var d = a(this).position();
                    k.relativePos = d.left, k.offsetX = e(c).x - d.left, k.offsetY = e(c).y - d.top, f("on"), k.sliding = !1, k.targetElement = c.target || c.srcElement
                }
            }

            function h(d) {
                var d = d.originalEvent || d || b.event;
                j.newPosX = e(d).x - k.offsetX, j.newPosY = e(d).y - k.offsetY, j.newRelativeX = j.newPosX - k.relativePos, "function" == typeof j.options.startDragging && k.dragging !== !0 && 0 !== j.newRelativeX && (k.dragging = !0, j.options.startDragging.apply(j, [j.$elem])), (j.newRelativeX > 8 || j.newRelativeX < -8 && j.browser.isTouch === !0) && (d.preventDefault ? d.preventDefault() : d.returnValue = !1, k.sliding = !0), (j.newPosY > 10 || j.newPosY < -10) && k.sliding === !1 && a(c).off("touchmove.owl");
                var f = function () {
                        return j.newRelativeX / 5
                    },
                    g = function () {
                        return j.maximumPixels + j.newRelativeX / 5
                    };
                j.newPosX = Math.max(Math.min(j.newPosX, f()), g()), j.browser.support3d === !0 ? j.transition3d(j.newPosX) : j.css2move(j.newPosX)
            }

            function i(c) {
                var c = c.originalEvent || c || b.event;
                if (c.target = c.target || c.srcElement, k.dragging = !1, j.browser.isTouch !== !0 && j.$owlWrapper.removeClass("grabbing"), j.dragDirection = j.owl.dragDirection = j.newRelativeX < 0 ? "left" : "right", 0 !== j.newRelativeX) {
                    var d = j.getNewPosition();
                    if (j.goTo(d, !1, "drag"), k.targetElement === c.target && j.browser.isTouch !== !0) {
                        a(c.target).on("click.disable", function (b) {
                            b.stopImmediatePropagation(), b.stopPropagation(), b.preventDefault(), a(c.target).off("click.disable")
                        });
                        var e = a._data(c.target, "events").click,
                            g = e.pop();
                        e.splice(0, 0, g)
                    }
                }
                f("off")
            }
            var j = this,
                k = {
                    offsetX: 0,
                    offsetY: 0,
                    baseElWidth: 0,
                    relativePos: 0,
                    position: null,
                    minSwipe: null,
                    maxSwipe: null,
                    sliding: null,
                    dargging: null,
                    targetElement: null
                };
            j.isCssFinish = !0, j.$elem.on(j.ev_types.start, ".owl-wrapper", g)
        },
        getNewPosition: function () {
            var a, b = this;
            return a = b.closestItem(), a > b.maximumItem ? (b.currentItem = b.maximumItem, a = b.maximumItem) : b.newPosX >= 0 && (a = 0, b.currentItem = 0), a
        },
        closestItem: function () {
            var b = this,
                c = b.options.scrollPerPage === !0 ? b.pagesInArray : b.positionsInArray,
                d = b.newPosX,
                e = null;
            return a.each(c, function (f, g) {
                d - b.itemWidth / 20 > c[f + 1] && d - b.itemWidth / 20 < g && "left" === b.moveDirection() ? (e = g, b.currentItem = b.options.scrollPerPage === !0 ? a.inArray(e, b.positionsInArray) : f) : d + b.itemWidth / 20 < g && d + b.itemWidth / 20 > (c[f + 1] || c[f] - b.itemWidth) && "right" === b.moveDirection() && (b.options.scrollPerPage === !0 ? (e = c[f + 1] || c[c.length - 1], b.currentItem = a.inArray(e, b.positionsInArray)) : (e = c[f + 1], b.currentItem = f + 1))
            }), b.currentItem
        },
        moveDirection: function () {
            var a, b = this;
            return b.newRelativeX < 0 ? (a = "right", b.playDirection = "next") : (a = "left", b.playDirection = "prev"), a
        },
        customEvents: function () {
            var a = this;
            a.$elem.on("owl.next", function () {
                a.next()
            }), a.$elem.on("owl.prev", function () {
                a.prev()
            }), a.$elem.on("owl.play", function (b, c) {
                a.options.autoPlay = c, a.play(), a.hoverStatus = "play"
            }), a.$elem.on("owl.stop", function () {
                a.stop(), a.hoverStatus = "stop"
            }), a.$elem.on("owl.goTo", function (b, c) {
                a.goTo(c)
            }), a.$elem.on("owl.jumpTo", function (b, c) {
                a.jumpTo(c)
            })
        },
        stopOnHover: function () {
            var a = this;
            a.options.stopOnHover === !0 && a.browser.isTouch !== !0 && a.options.autoPlay !== !1 && (a.$elem.on("mouseover", function () {
                a.stop()
            }), a.$elem.on("mouseout", function () {
                "stop" !== a.hoverStatus && a.play()
            }))
        },
        lazyLoad: function () {
            var b = this;
            if (b.options.lazyLoad === !1) return !1;
            for (var c = 0; c < b.itemsAmount; c++) {
                var e = a(b.$owlItems[c]);
                if ("loaded" !== e.data("owl-loaded")) {
                    var f, g = e.data("owl-item"),
                        h = e.find(".lazyOwl");
                    "string" == typeof h.data("src") ? (e.data("owl-loaded") === d && (h.hide(), e.addClass("loading").data("owl-loaded", "checked")), f = b.options.lazyFollow === !0 ? g >= b.currentItem : !0, f && g < b.currentItem + b.options.items && h.length && b.lazyPreload(e, h)) : e.data("owl-loaded", "loaded")
                }
            }
        },
        lazyPreload: function (a, b) {
            function c() {
                f += 1, e.completeImg(b.get(0)) || g === !0 ? d() : 100 >= f ? setTimeout(c, 100) : d()
            }

            function d() {
                a.data("owl-loaded", "loaded").removeClass("loading"), b.removeAttr("data-src"), "fade" === e.options.lazyEffect ? b.fadeIn(400) : b.show(), "function" == typeof e.options.afterLazyLoad && e.options.afterLazyLoad.apply(this, [e.$elem])
            }
            var e = this,
                f = 0;
            if ("DIV" === b.prop("tagName")) {
                b.css("background-image", "url(" + b.data("src") + ")");
                var g = !0
            } else b[0].src = b.data("src");
            c()
        },
        autoHeight: function () {
            function b() {
                g += 1, e.completeImg(f.get(0)) ? c() : 100 >= g ? setTimeout(b, 100) : e.wrapperOuter.css("height", "")
            }

            function c() {
                var b = a(e.$owlItems[e.currentItem]).height();
                e.wrapperOuter.css("height", b + "px"), e.wrapperOuter.hasClass("autoHeight") || setTimeout(function () {
                    e.wrapperOuter.addClass("autoHeight")
                }, 0)
            }
            var e = this,
                f = a(e.$owlItems[e.currentItem]).find("img");
            if (f.get(0) !== d) {
                var g = 0;
                b()
            } else c()
        },
        completeImg: function (a) {
            return a.complete ? "undefined" != typeof a.naturalWidth && 0 == a.naturalWidth ? !1 : !0 : !1
        },
        onVisibleItems: function () {
            var b = this;
            b.options.addClassActive === !0 && b.$owlItems.removeClass("active"), b.visibleItems = [];
            for (var c = b.currentItem; c < b.currentItem + b.options.items; c++) b.visibleItems.push(c), b.options.addClassActive === !0 && a(b.$owlItems[c]).addClass("active");
            b.owl.visibleItems = b.visibleItems
        },
        transitionTypes: function (a) {
            var b = this;
            b.outClass = "owl-" + a + "-out", b.inClass = "owl-" + a + "-in"
        },
        singleItemTransition: function () {
            function a(a) {
                return {
                    position: "relative",
                    left: a + "px"
                }
            }
            var b = this;
            b.isTransition = !0;
            var c = b.outClass,
                d = b.inClass,
                e = b.$owlItems.eq(b.currentItem),
                f = b.$owlItems.eq(b.prevItem),
                g = Math.abs(b.positionsInArray[b.currentItem]) + b.positionsInArray[b.prevItem],
                h = Math.abs(b.positionsInArray[b.currentItem]) + b.itemWidth / 2;
            b.$owlWrapper.addClass("owl-origin").css({
                "-webkit-transform-origin": h + "px",
                "-moz-perspective-origin": h + "px",
                "perspective-origin": h + "px"
            });
            var i = "webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend";
            f.css(a(g, 10)).addClass(c).on(i, function () {
                b.endPrev = !0, f.off(i), b.clearTransStyle(f, c)
            }), e.addClass(d).on(i, function () {
                b.endCurrent = !0, e.off(i), b.clearTransStyle(e, d)
            })
        },
        clearTransStyle: function (a, b) {
            var c = this;
            a.css({
                position: "",
                left: ""
            }).removeClass(b), c.endPrev && c.endCurrent && (c.$owlWrapper.removeClass("owl-origin"), c.endPrev = !1, c.endCurrent = !1, c.isTransition = !1)
        },
        owlStatus: function () {
            var a = this;
            a.owl = {
                userOptions: a.userOptions,
                baseElement: a.$elem,
                userItems: a.$userItems,
                owlItems: a.$owlItems,
                currentItem: a.currentItem,
                prevItem: a.prevItem,
                visibleItems: a.visibleItems,
                isTouch: a.browser.isTouch,
                browser: a.browser,
                dragDirection: a.dragDirection
            }
        },
        clearEvents: function () {
            var d = this;
            d.$elem.off(".owl owl mousedown.disableTextSelect"), a(c).off(".owl owl"), a(b).off("resize", d.resizer)
        },
        unWrap: function () {
            var a = this;
            0 !== a.$elem.children().length && (a.$owlWrapper.unwrap(), a.$userItems.unwrap().unwrap(), a.owlControls && a.owlControls.remove()), a.clearEvents(), a.$elem.attr("style", a.$elem.data("owl-originalStyles") || "").attr("class", a.$elem.data("owl-originalClasses"))
        },
        destroy: function () {
            var a = this;
            a.stop(), clearInterval(a.checkVisible), a.unWrap(), a.$elem.removeData()
        },
        reinit: function (b) {
            var c = this,
                d = a.extend({}, c.userOptions, b);
            c.unWrap(), c.init(d, c.$elem)
        },
        addItem: function (a, b) {
            var c, e = this;
            return a ? 0 === e.$elem.children().length ? (e.$elem.append(a), e.setVars(), !1) : (e.unWrap(), c = b === d || -1 === b ? -1 : b, c >= e.$userItems.length || -1 === c ? e.$userItems.eq(-1).after(a) : e.$userItems.eq(c).before(a), e.setVars(), void 0) : !1
        },
        removeItem: function (a) {
            var b, c = this;
            return 0 === c.$elem.children().length ? !1 : (b = a === d || -1 === a ? -1 : a, c.unWrap(), c.$userItems.eq(b).remove(), c.setVars(), void 0)
        }
    };
    a.fn.owlCarousel = function (b) {
        return this.each(function () {
            if (a(this).data("owl-init") === !0) return !1;
            a(this).data("owl-init", !0);
            var c = Object.create(e);
            c.init(b, this), a.data(this, "owlCarousel", c)
        })
    }, a.fn.owlCarousel.options = {
        items: 5,
        itemsCustom: !1,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 2],
        itemsTabletSmall: !1,
        itemsMobile: [479, 1],
        singleItem: !1,
        itemsScaleUp: !1,
        slideSpeed: 200,
        paginationSpeed: 800,
        rewindSpeed: 1e3,
        autoPlay: !1,
        stopOnHover: !1,
        navigation: !1,
        navigationText: ["prev", "next"],
        rewindNav: !0,
        scrollPerPage: !1,
        pagination: !0,
        paginationNumbers: !1,
        responsive: !0,
        responsiveRefreshRate: 200,
        responsiveBaseWidth: b,
        baseClass: "owl-carousel",
        theme: "owl-theme",
        lazyLoad: !1,
        lazyFollow: !0,
        lazyEffect: "fade",
        autoHeight: !1,
        jsonPath: !1,
        jsonSuccess: !1,
        dragBeforeAnimFinish: !0,
        mouseDrag: !0,
        touchDrag: !0,
        addClassActive: !1,
        transitionStyle: !1,
        beforeUpdate: !1,
        afterUpdate: !1,
        beforeInit: !1,
        afterInit: !1,
        beforeMove: !1,
        afterMove: !1,
        afterAction: !1,
        startDragging: !1,
        afterLazyLoad: !1
    }
}(jQuery, window, document),
/*!
 *
 * responsive-tables.js
 */
$(document).ready(function () {
    function a(a) {
        a.wrap("<div class='table-wrapper' />");
        var b = a.clone();
        b.find("td:not(:first-child), th:not(:first-child)").css("display", "none"), b.removeClass("responsive"), a.closest(".table-wrapper").append(b), b.wrap("<div class='pinned' />"), a.wrap("<div class='scrollable' />"), c(a, b)
    }

    function b(a) {
        a.closest(".table-wrapper").find(".pinned").remove(), a.unwrap(), a.unwrap()
    }

    function c(a, b) {
        var c = a.find("tr"),
            d = b.find("tr"),
            e = [];
        c.each(function (a) {
            var b = $(this),
                c = b.find("th, td");
            c.each(function () {
                var b = $(this).outerHeight(!0);
                e[a] = e[a] || 0, b > e[a] && (e[a] = b)
            })
        }), d.each(function (a) {
            $(this).height(e[a])
        })
    }
    var d = !1,
        e = function () {
            return $(window).width() < 767 && !d ? (d = !0, $("table.responsive").each(function (b, c) {
                a($(c))
            }), !0) : (d && $(window).width() > 767 && (d = !1, $("table.responsive").each(function (a, c) {
                b($(c))
            })), void 0)
        };
    $(window).load(e), $(window).on("redraw", function () {
        d = !1, e()
    }), $(window).on("resize", e)
}),
/*!
 *
 * Spin.js
 * Copyright (c) 2011-2013 Felix Gnass
 * Licensed under the MIT license
 */
function (a, b) {
    "object" == typeof exports ? module.exports = b() : "function" == typeof define && define.amd ? define(b) : a.Spinner = b()
}(this, function () {
    "use strict";

    function a(a, b) {
        var c, d = document.createElement(a || "div");
        for (c in b) d[c] = b[c];
        return d
    }

    function b(a) {
        for (var b = 1, c = arguments.length; c > b; b++) a.appendChild(arguments[b]);
        return a
    }

    function c(a, b, c, d) {
        var e = ["opacity", b, ~~ (100 * a), c, d].join("-"),
            f = .01 + 100 * (c / d),
            g = Math.max(1 - (1 - a) / b * (100 - f), a),
            h = k.substring(0, k.indexOf("Animation")).toLowerCase(),
            i = h && "-" + h + "-" || "";
        return m[e] || (n.insertRule("@" + i + "keyframes " + e + "{" + "0%{opacity:" + g + "}" + f + "%{opacity:" + a + "}" + (f + .01) + "%{opacity:1}" + (f + b) % 100 + "%{opacity:" + a + "}" + "100%{opacity:" + g + "}" + "}", n.cssRules.length), m[e] = 1), e
    }

    function d(a, b) {
        var c, d, e = a.style;
        for (b = b.charAt(0).toUpperCase() + b.slice(1), d = 0; d < l.length; d++)
            if (c = l[d] + b, void 0 !== e[c]) return c;
        return void 0 !== e[b] ? b : void 0
    }

    function e(a, b) {
        for (var c in b) a.style[d(a, c) || c] = b[c];
        return a
    }

    function f(a) {
        for (var b = 1; b < arguments.length; b++) {
            var c = arguments[b];
            for (var d in c) void 0 === a[d] && (a[d] = c[d])
        }
        return a
    }

    function g(a) {
        for (var b = {
            x: a.offsetLeft,
            y: a.offsetTop
        }; a = a.offsetParent;) b.x += a.offsetLeft, b.y += a.offsetTop;
        return b
    }

    function h(a, b) {
        return "string" == typeof a ? a : a[b % a.length]
    }

    function i(a) {
        return "undefined" == typeof this ? new i(a) : (this.opts = f(a || {}, i.defaults, o), void 0)
    }

    function j() {
        function c(b, c) {
            return a("<" + b + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', c)
        }
        n.addRule(".spin-vml", "behavior:url(#default#VML)"), i.prototype.lines = function (a, d) {
            function f() {
                return e(c("group", {
                    coordsize: k + " " + k,
                    coordorigin: -j + " " + -j
                }), {
                    width: k,
                    height: k
                })
            }

            function g(a, g, i) {
                b(m, b(e(f(), {
                    rotation: 360 / d.lines * a + "deg",
                    left: ~~g
                }), b(e(c("roundrect", {
                    arcsize: d.corners
                }), {
                    width: j,
                    height: d.width,
                    left: d.radius,
                    top: -d.width >> 1,
                    filter: i
                }), c("fill", {
                    color: h(d.color, a),
                    opacity: d.opacity
                }), c("stroke", {
                    opacity: 0
                }))))
            }
            var i, j = d.length + d.width,
                k = 2 * j,
                l = 2 * -(d.width + d.length) + "px",
                m = e(f(), {
                    position: "absolute",
                    top: l,
                    left: l
                });
            if (d.shadow)
                for (i = 1; i <= d.lines; i++) g(i, -2, "progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");
            for (i = 1; i <= d.lines; i++) g(i);
            return b(a, m)
        }, i.prototype.opacity = function (a, b, c, d) {
            var e = a.firstChild;
            d = d.shadow && d.lines || 0, e && b + d < e.childNodes.length && (e = e.childNodes[b + d], e = e && e.firstChild, e = e && e.firstChild, e && (e.opacity = c))
        }
    }
    var k, l = ["webkit", "Moz", "ms", "O"],
        m = {},
        n = function () {
            var c = a("style", {
                type: "text/css"
            });
            return b(document.getElementsByTagName("head")[0], c), c.sheet || c.styleSheet
        }(),
        o = {
            lines: 12,
            length: 7,
            width: 5,
            radius: 10,
            rotate: 0,
            corners: 1,
            color: "#000",
            direction: 1,
            speed: 1,
            trail: 100,
            opacity: .25,
            fps: 20,
            zIndex: 2e9,
            className: "spinner",
            top: "auto",
            left: "auto",
            position: "relative"
        };
    i.defaults = {}, f(i.prototype, {
        spin: function (b) {
            this.stop();
            var c, d, f = this,
                h = f.opts,
                i = f.el = e(a(0, {
                    className: h.className
                }), {
                    position: h.position,
                    width: 0,
                    zIndex: h.zIndex
                }),
                j = h.radius + h.length + h.width;
            if (b && (b.insertBefore(i, b.firstChild || null), d = g(b), c = g(i), e(i, {
                left: ("auto" == h.left ? d.x - c.x + (b.offsetWidth >> 1) : parseInt(h.left, 10) + j) + "px",
                top: ("auto" == h.top ? d.y - c.y + (b.offsetHeight >> 1) : parseInt(h.top, 10) + j) + "px"
            })), i.setAttribute("role", "progressbar"), f.lines(i, f.opts), !k) {
                var l, m = 0,
                    n = (h.lines - 1) * (1 - h.direction) / 2,
                    o = h.fps,
                    p = o / h.speed,
                    q = (1 - h.opacity) / (p * h.trail / 100),
                    r = p / h.lines;
                ! function s() {
                    m++;
                    for (var a = 0; a < h.lines; a++) l = Math.max(1 - (m + (h.lines - a) * r) % p * q, h.opacity), f.opacity(i, a * h.direction + n, l, h);
                    f.timeout = f.el && setTimeout(s, ~~ (1e3 / o))
                }()
            }
            return f
        },
        stop: function () {
            var a = this.el;
            return a && (clearTimeout(this.timeout), a.parentNode && a.parentNode.removeChild(a), this.el = void 0), this
        },
        lines: function (d, f) {
            function g(b, c) {
                return e(a(), {
                    position: "absolute",
                    width: f.length + f.width + "px",
                    height: f.width + "px",
                    background: b,
                    boxShadow: c,
                    transformOrigin: "left",
                    transform: "rotate(" + ~~(360 / f.lines * j + f.rotate) + "deg) translate(" + f.radius + "px" + ",0)",
                    borderRadius: (f.corners * f.width >> 1) + "px"
                })
            }
            for (var i, j = 0, l = (f.lines - 1) * (1 - f.direction) / 2; j < f.lines; j++) i = e(a(), {
                position: "absolute",
                top: 1 + ~(f.width / 2) + "px",
                transform: f.hwaccel ? "translate3d(0,0,0)" : "",
                opacity: f.opacity,
                animation: k && c(f.opacity, f.trail, l + j * f.direction, f.lines) + " " + 1 / f.speed + "s linear infinite"
            }), f.shadow && b(i, e(g("#000", "0 0 4px #000"), {
                top: "2px"
            })), b(d, b(i, g(h(f.color, j), "0 0 1px rgba(0,0,0,.1)")));
            return d
        },
        opacity: function (a, b, c) {
            b < a.childNodes.length && (a.childNodes[b].style.opacity = c)
        }
    });
    var p = e(a("group"), {
        behavior: "url(#default#VML)"
    });
    return !d(p, "transform") && p.adj ? j() : k = d(p, "animation"), i
}),
function (a) {
    if ("object" == typeof exports) a(require("jquery"), require("spin"));
    else if ("function" == typeof define && define.amd) define(["jquery", "spin"], a);
    else {
        if (!window.Spinner) throw new Error("Spin.js not present");
        a(window.jQuery, window.Spinner)
    }
}(function (a, b) {
    a.fn.spin = function (c, d) {
        return this.each(function () {
            var e = a(this),
                f = e.data();
            f.spinner && (f.spinner.stop(), delete f.spinner), c !== !1 && (c = a.extend({
                color: d || e.css("color")
            }, a.fn.spin.presets[c] || c), f.spinner = new b(c).spin(this))
        })
    }, a.fn.spin.presets = {
        tiny: {
            lines: 8,
            length: 2,
            width: 2,
            radius: 3
        },
        small: {
            lines: 8,
            length: 4,
            width: 3,
            radius: 5
        },
        large: {
            lines: 10,
            length: 8,
            width: 4,
            radius: 8
        }
    }
});