!(function (t) {
    var e = {};
    function n(o) {
        if (e[o]) return e[o].exports;
        var r = (e[o] = { i: o, l: !1, exports: {} });
        return t[o].call(r.exports, r, r.exports, n), (r.l = !0), r.exports;
    }
    (n.m = t),
        (n.c = e),
        (n.d = function (t, e, o) {
            n.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: o });
        }),
        (n.r = function (t) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 });
        }),
        (n.t = function (t, e) {
            if ((1 & e && (t = n(t)), 8 & e)) return t;
            if (4 & e && "object" == typeof t && t && t.__esModule) return t;
            var o = Object.create(null);
            if ((n.r(o), Object.defineProperty(o, "default", { enumerable: !0, value: t }), 2 & e && "string" != typeof t))
                for (var r in t)
                    n.d(
                        o,
                        r,
                        function (e) {
                            return t[e];
                        }.bind(null, r)
                    );
            return o;
        }),
        (n.n = function (t) {
            var e =
                t && t.__esModule
                    ? function () {
                          return t.default;
                      }
                    : function () {
                          return t;
                      };
            return n.d(e, "a", e), e;
        }),
        (n.o = function (t, e) {
            return Object.prototype.hasOwnProperty.call(t, e);
        }),
        (n.p = "/"),
        n((n.s = 274));
})({
    274: function (t, e, n) {
        t.exports = n(275);
    },
    275: function (t, e) {
        var n = {
            init: function () {
                var t, e;
                $(".init-datatable").DataTable(),
                    (t = $("#dt-addrows").DataTable()),
                    (e = 1),
                    $("#btn-addrow").on("click", function (n) {
                        n.preventDefault(), t.row.add([e + ".1", e + ".2", e + ".3", e + ".4", e + ".5"]).draw(!1), e++;
                    }),
                    $("#btn-addrow").click(),
                    (function () {
                        var t = $("#dt-event").DataTable();
                        $("#dt-event tbody").on("click", "tr", function () {
                            var e = t.row(this).data();
                            alert("You clicked on " + e[0] + "'s row");
                        });
                    })(),
                    $("#dt-multirowselection").DataTable(),
                    $("#dt-multirowselection tbody").on("click", "tr", function () {
                        $(this).toggleClass("selected");
                    }),
                    (function () {
                        var t = $("#dt-rowselection").DataTable();
                        $("#dt-rowselection tbody").on("click", "tr", function () {
                            $(this).hasClass("selected") ? $(this).removeClass("selected") : (t.$("tr.selected").removeClass("selected"), $(this).addClass("selected"));
                        }),
                            $(".btn-deleterow").click(function () {
                                t.row(".selected").remove().draw(!1);
                            });
                    })(),
                    (function () {
                        var t = $("#dt-forminputs").DataTable();
                        $(".btn-forminputs").click(function () {
                            var e = t.$("input, select").serialize();
                            return alert("The following data would have been submitted to the server: \n\n" + e.substr(0, 120) + "..."), !1;
                        });
                    })(),
                    (function () {
                        var t = $("#dt-showhidecolumn").DataTable({ scrollY: "200px", paging: !1 });
                        $(".toggle-column").change(function () {
                            var e = t.column($(this).attr("data-column"));
                            $(this).prop("checked") ? e.visible(!0) : e.visible(!1);
                        });
                    })();
            },
        };
        $(function () {
            n.init();
        });
    },
});
//# sourceMappingURL=tb_datatables.js.map
