(function (a) {
    a.fn.piroBox_ext = function (b) {
        b = jQuery.extend({piro_speed:700, bg_alpha:0.9, piro_scroll:true}, b);
        a.fn.piroFadeIn = function (i, x) {
            a(this).fadeIn(i, function () {
                if (jQuery.browser.msie) {
                    a(this).get(0).style.removeAttribute("filter")
                }
                if (x != undefined) {
                    x()
                }
            })
        };
        a.fn.piroFadeOut = function (i, x) {
            a(this).fadeOut(i, function () {
                if (jQuery.browser.msie) {
                    a(this).get(0).style.removeAttribute("filter")
                }
                if (x != undefined) {
                    x()
                }
            })
        };
        var D = a('a[class*="pirobox"]');
        var u = new Object();
        for (var C = 0; C < D.length; C++) {
            var f = a(D[C]);
            u["a." + f.attr("class").match(/^pirobox_gall\w*/)] = 0
        }
        var n = new Array();
        for (var z in u) {
            n.push(z)
        }
        for (var C = 0; C < n.length; C++) {
            a(n[C] + ":first").addClass("first");
            a(n[C] + ":last").addClass("last")
        }
        var k = a(D);
        a('a[class*="pirobox_gall"]').each(function (i) {
            this.rev = i + 0
        });
        var B = ('<div class="piro_overlay"></div><table class="piro_html"  cellpadding="0" cellspacing="0"><tr><td class="h_t_l"></td><td class="h_t_c" title="drag me!!"></td><td class="h_t_r"></td></tr><tr><td class="h_c_l"></td><td class="h_c_c"><div class="piro_loader" title="close"><span></span></div><div class="resize"><div class="nav_container"><a href="#prev" class="piro_prev" title="previous"></a><a href="#next" class="piro_next" title="next"></a><div class="piro_prev_fake">prev</div><div class="piro_next_fake">next</div><div class="piro_close" title="close"></div></div><div class="caption"></div><div class="description"></div><div class="div_reg"></div></div></td><td class="h_c_r"></td></tr><tr><td class="h_b_l"></td><td class="h_b_c"></td><td class="h_b_r"></td></tr></table>');
        a("body").append(B);
        var g = a(".piro_html"), v = a(".caption"), z = a(".description"), d = a(".piro_overlay"), j = a(".piro_next"), h = a(".piro_prev"), A = a(".piro_next_fake"), r = a(".piro_prev_fake"), t = a(".piro_close"), c = a(".div_reg"), p = a(".piro_loader"), q = a(".resize"), s = a(".btn_info");
        var m = 0.95;
        if (a.browser.msie) {
            g.draggable({handle:".h_t_c,.h_b_c,.div_reg img"})
        } else {
            g.draggable({handle:".h_t_c,.h_b_c,.div_reg img", opacity:0.8})
        }
        var l = a(window).height();
        var o = a(window).width();
        a(".nav_container").hide();
        g.css({left:((o / 2) - (250)) + "px", top:parseInt(a(document).scrollTop()) + (100)});
        a(g).add(v).add(d).hide();
        d.css({opacity:b.bg_alpha});
        a(h).add(j).bind("click", function (i) {
            a(".nav_container").hide();
            i.preventDefault();
            j.add(h).hide();
            var x = parseInt(a('a[class*="pirobox_gall"]').filter(".item").attr("rev"));
            var y = a(this).is(".piro_prev") ? a('a[class*="pirobox_gall"]').eq(x - 1) : a('a[class*="pirobox_gall"]').eq(x + 1);
            y.click()
        });
        a("html").bind("keyup", function (i) {
            if (i.keyCode == 27) {
                i.preventDefault();
                if (a(t).is(":visible")) {
                    w()
                }
            }
        });
        a("html").bind("keyup", function (i) {
            if (a(".item").is(".first")) {
            } else {
                if (i.keyCode == 37) {
                    i.preventDefault();
                    if (a(t).is(":visible")) {
                        h.click()
                    }
                }
            }
        });
        a("html").bind("keyup", function (i) {
            if (a(".item").is(".last")) {
            } else {
                if (i.keyCode == 39) {
                    i.preventDefault();
                    if (a(t).is(":visible")) {
                        j.click()
                    }
                }
            }
        });
        a(window).resize(function () {
            var y = a(window).height();
            var E = a(window).width();
            var x = g.height();
            var i = g.width();
            g.css({left:((E / 2) - (i / 2)) + "px", top:parseInt(a(document).scrollTop()) + (y - x) / 2})
        });
        function e() {
            a(window).scroll(function () {
                var y = a(window).height();
                var E = a(window).width();
                var x = g.height();
                var i = g.width();
                g.css({left:((E / 2) - (i / 2)) + "px", top:parseInt(a(document).scrollTop()) + (y - x) / 2})
            })
        }

        if (b.piro_scroll == true) {
            e()
        }
        a(k).each(function () {
            var i = a(this).children().attr("alt");
            var x = a(this).attr("title");
            var y = a(this).attr("rel").split("-");
            var E = a(this).attr("href");
            a(this).unbind();
            a(this).bind("click", function (G) {
                d.css({opacity:b.bg_alpha});
                G.preventDefault();
                j.add(h).hide().css("visibility", "hidden");
                a(k).filter(".item").removeClass("item");
                a(this).addClass("item");
                F();
                if (a(this).is(".first")) {
                    h.hide();
                    j.show();
                    r.show().css({opacity:0.5, visibility:"hidden"})
                } else {
                    j.add(h).show();
                    A.add(r).hide()
                }
                if (a(this).is(".last")) {
                    h.show();
                    A.show().css({opacity:0.5, visibility:"hidden"});
                    j.hide()
                }
                if (a(this).is(".pirobox")) {
                    j.add(h).hide()
                }
            });
            function F() {
                g.add(d).add(c).add(p).show();
                function G() {
                    if (y[1] == "full" && y[2] == "full") {
                        y[2] = a(window).height() - 70;
                        y[1] = a(window).width() - 55
                    }
                    var J = a(window).height();
                    var I = a(window).width();
                    t.hide();
                    c.add(q).animate({height:+(y[2]) + "px", width:+(y[1]) + "px"}, b.piro_speed).css("visibility", "visible");
                    g.animate({height:+(y[2]) + 20 + "px", width:+(y[1]) + 20 + "px", left:((I / 2) - ((y[1]) / 2 + 10)) + "px", top:parseInt(a(document).scrollTop()) + (J - y[2]) / 2 - 10}, b.piro_speed, function () {
                        j.add(h).css({height:"20px", width:"20px"});
                        j.add(h).add(r).add(A).css("visibility", "visible");
                        a(".nav_container").show();
                        t.show()
                    })
                }

                function H() {
                    var I = new Image();
                    I.onerror = function () {
                        v.html("");
                        z.html("");
                        I.src = SITEURL + "/assets/pirobox/js/error.jpg"
                    };
                    I.onload = function () {
                        v.add(s).hide();
                        var M = a(window).height();
                        var N = a(window).width();
                        var L = I.height;
                        var K = I.width;
                        if (L + 20 > M || K + 20 > N) {
                            var J = (K + 20) / N;
                            var O = (L + 20) / M;
                            if (O > J) {
                                K = Math.round(I.width * (m / O));
                                L = Math.round(I.height * (m / O))
                            } else {
                                K = Math.round(I.width * (m / J));
                                L = Math.round(I.height * (m / J))
                            }
                        } else {
                            L = I.height;
                            K = I.width
                        }
                        var M = a(window).height();
                        var N = a(window).width();
                        a(I).height(L).width(K).hide();
                        a(I).fadeOut(300, function () {
                        });
                        a(".div_reg img").remove();
                        a(".div_reg").html("");
                        c.append(I).show();
                        a(I).addClass("immagine");
                        c.add(q).animate({height:L + "px", width:K + "px"}, b.piro_speed);
                        g.animate({height:(L + 20) + "px", width:(K + 20) + "px", left:((N / 2) - ((K + 20) / 2)) + "px", top:parseInt(a(document).scrollTop()) + (M - L) / 2 - 20}, b.piro_speed, function () {
                            var P = q.width();
                            v.css({width:P + "px"});
                            p.hide();
                            a(I).fadeIn(300, function () {
                                t.add(s).show();
                                v.slideDown(200);
                                j.add(h).css({height:"20px", width:"20px"});
                                j.add(h).add(r).add(A).css("visibility", "visible");
                                a(".nav_container").show();
                                q.resize(function () {
                                    NimgW = I.width;
                                    NimgH = I.heigh;
                                    v.css({width:(NimgW) + "px"})
                                })
                            })
                        })
                    };
                    I.src = E;
                    p.click(function () {
                        I.src = "about:blank"
                    })
                }

                switch (y[0]) {
                    case"iframe":
                        c.html("").css("overflow", "hidden");
                        q.css("overflow", "hidden");
                        t.add(s).add(v).hide();
                        G();
                        c.piroFadeIn(300, function () {
                            c.append('<iframe id="my_frame" class="my_frame" src="' + E + '" frameborder="0" allowtransparency="true" scrolling="auto" align="top"></iframe>');
                            a(".my_frame").css({height:+(y[2]) + "px", width:+(y[1]) + "px"});
                            p.hide()
                        });
                        break;
                    case"content":
                        c.html("").css("overflow", "auto");
                        q.css("overflow", "auto");
                        a(".my_frame").remove();
                        t.add(s).add(v).hide();
                        G();
                        c.piroFadeIn(300, function () {
                            c.load(E);
                            p.hide()
                        });
                        break;
                    case"inline":
                        c.html("").css("overflow", "auto");
                        q.css("overflow", "auto");
                        a(".my_frame").remove();
                        t.add(s).add(v).hide();
                        G();
                        c.piroFadeIn(300, function () {
                            a(E).clone(true).appendTo(c).piroFadeIn(300);
                            p.hide()
                        });
                        break;
                    case"gallery":
                        c.css("overflow", "hidden");
                        q.css("overflow", "hidden");
                        a(".my_frame").remove();
                        t.add(s).add(v).hide();
                        if (i == "") {
                            v.html("")
                        } else {
                            v.html("<p>" + i + "</p>")
                        }
                        if (x == "") {
                            z.html("")
                        } else {
                            z.html("<p>" + x + "</p>")
                        }
                        H();
                        break;
                    case"single":
                        t.add(s).add(v).hide();
                        c.html("").css("overflow", "hidden");
                        q.css("overflow", "hidden");
                        a(".my_frame").remove();
                        if (x == "") {
                            z.html("")
                        } else {
                            z.html("<p>" + x + "</p>")
                        }
                        H();
                        break
                }
            }
        });
        a(".immagine").live("click", function () {
            v.slideToggle(200)
        });
        function w() {
            if (a(".piro_close").is(":visible")) {
                a(".my_frame").remove();
                g.add(c).add(q).stop();
                var i = g;
                if (a.browser.msie) {
                    i = c.add(d);
                    a(".div_reg img").remove()
                } else {
                    i = g.add(d)
                }
                i.piroFadeOut(200, function () {
                    c.html("");
                    p.add(v).add(s).hide();
                    a(".nav_container").hide();
                    d.add(g).hide().css("visibility", "visible")
                })
            }
        }

        t.add(p).add(d).bind("click", function (i) {
            i.preventDefault();
            w()
        })
    }
})(jQuery);