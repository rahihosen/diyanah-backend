!(function (o) {
    var e = {};
    function t(n) {
        if (e[n]) return e[n].exports;
        var l = (e[n] = { i: n, l: !1, exports: {} });
        return o[n].call(l.exports, l, l.exports, t), (l.l = !0), l.exports;
    }
    (t.m = o),
        (t.c = e),
        (t.d = function (o, e, n) {
            t.o(o, e) || Object.defineProperty(o, e, { enumerable: !0, get: n });
        }),
        (t.r = function (o) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(o, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(o, "__esModule", { value: !0 });
        }),
        (t.t = function (o, e) {
            if ((1 & e && (o = t(o)), 8 & e)) return o;
            if (4 & e && "object" == typeof o && o && o.__esModule) return o;
            var n = Object.create(null);
            if ((t.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: o }), 2 & e && "string" != typeof o))
                for (var l in o)
                    t.d(
                        n,
                        l,
                        function (e) {
                            return o[e];
                        }.bind(null, l)
                    );
            return n;
        }),
        (t.n = function (o) {
            var e =
                o && o.__esModule
                    ? function () {
                          return o.default;
                      }
                    : function () {
                          return o;
                      };
            return t.d(e, "a", e), e;
        }),
        (t.o = function (o, e) {
            return Object.prototype.hasOwnProperty.call(o, e);
        }),
        (t.p = "/"),
        t((t.s = 270));
})({
    270: function (o, e, t) {
        o.exports = t(271);
    },
    271: function (o, e) {
        var t = {
            init: function () {
                $("body").on("click", ".exampleColorModal", function () {
                    (color = $(this).attr("data-color")), $("#exampleColorModal").modal();
                }),
                    $("#exampleColorModal").on("show.bs.modal", function () {
                        $(this).addClass("modal-" + color),
                            $(this)
                                .find(".modal-title")
                                .text(color[0].toUpperCase() + color.substring(1) + " Modal");
                    }),
                    $("#exampleColorModal").on("hidden.bs.modal", function () {
                        $(this).removeClass("modal-" + color), $(this).find(".modal-title").text("Colored Modal");
                    }),
                    $("body").on("click", ".exampleModalSize", function () {
                        (size = $(this).attr("data-size")), $("#exampleModalSize").modal();
                    }),
                    $("#exampleModalSize").on("show.bs.modal", function () {
                        $(this)
                            .find(".modal-dialog")
                            .addClass("modal-" + size);
                    }),
                    $("#exampleModalSize").on("hidden.bs.modal", function () {
                        $(this)
                            .find(".modal-dialog")
                            .removeClass("modal-" + size);
                    }),
                    $("#exampleVarying").on("show.bs.modal", function (o) {
                        var e = $(o.relatedTarget).data("recipient"),
                            t = $(this);
                        t.find(".modal-title").text("New message to " + e), t.find(".modal-body input").val(e);
                    });
            },
        };
        $(function () {
            t.init();
        });
    },
});
//# sourceMappingURL=ui_modal.js.map
