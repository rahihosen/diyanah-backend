!(function (t) {
    var o = {};
    function e(n) {
        if (o[n]) return o[n].exports;
        var i = (o[n] = { i: n, l: !1, exports: {} });
        return t[n].call(i.exports, i, i.exports, e), (i.l = !0), i.exports;
    }
    (e.m = t),
        (e.c = o),
        (e.d = function (t, o, n) {
            e.o(t, o) || Object.defineProperty(t, o, { enumerable: !0, get: n });
        }),
        (e.r = function (t) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 });
        }),
        (e.t = function (t, o) {
            if ((1 & o && (t = e(t)), 8 & o)) return t;
            if (4 & o && "object" == typeof t && t && t.__esModule) return t;
            var n = Object.create(null);
            if ((e.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: t }), 2 & o && "string" != typeof t))
                for (var i in t)
                    e.d(
                        n,
                        i,
                        function (o) {
                            return t[o];
                        }.bind(null, i)
                    );
            return n;
        }),
        (e.n = function (t) {
            var o =
                t && t.__esModule
                    ? function () {
                          return t.default;
                      }
                    : function () {
                          return t;
                      };
            return e.d(o, "a", o), o;
        }),
        (e.o = function (t, o) {
            return Object.prototype.hasOwnProperty.call(t, o);
        }),
        (e.p = "/"),
        e((e.s = 272));
})({
    272: function (t, o, e) {
        t.exports = e(273);
    },
    273: function (t, o) {
        var e,
            n =
                ((e = function () {
                    var t,
                        o = 0;
                    $("#showsimple").click(function () {
                        toastr.success("Without any options", "Simple notification!");
                    }),
                        $("#showtoast").click(function () {
                            var e = $("#toastTypeGroup input:radio:checked").val(),
                                n = $("#message").val(),
                                i = $("#title").val() || "",
                                r = $("#showDuration"),
                                a = $("#hideDuration"),
                                s = $("#timeOut"),
                                l = $("#extendedTimeOut"),
                                c = $("#showEasing"),
                                u = $("#hideEasing"),
                                p = $("#showMethod"),
                                d = $("#hideMethod"),
                                f = o++;
                            (toastr.options = {
                                closeButton: $("#closeButton").prop("checked"),
                                debug: $("#debugInfo").prop("checked"),
                                progressBar: $("#progressBar").prop("checked"),
                                preventDuplicates: $("#preventDuplicates").prop("checked"),
                                positionClass: $("#positionGroup input:radio:checked").val() || "toast-top-right",
                                onclick: null,
                            }),
                                $("#addBehaviorOnToastClick").prop("checked") &&
                                    (toastr.options.onclick = function () {
                                        alert("You can perform some custom action after a toast goes away");
                                    }),
                                r.val().length && (toastr.options.showDuration = r.val()),
                                a.val().length && (toastr.options.hideDuration = a.val()),
                                s.val().length && (toastr.options.timeOut = s.val()),
                                l.val().length && (toastr.options.extendedTimeOut = l.val()),
                                c.val().length && (toastr.options.showEasing = c.val()),
                                u.val().length && (toastr.options.hideEasing = u.val()),
                                p.val().length && (toastr.options.showMethod = p.val()),
                                d.val().length && (toastr.options.hideMethod = d.val()),
                                n || (n = "Welcome to siQthemes. Toastr notification sample content."),
                                $("#toastrOptions").text("Command: toastr[" + e + ']("' + n + (i ? '", "' + i : "") + '")\n\ntoastr.options = ' + JSON.stringify(toastr.options, null, 2));
                            var h = toastr[e](n, i);
                            (t = h),
                                h.find("#okBtn").length &&
                                    h.delegate("#okBtn", "click", function () {
                                        alert("you clicked me. i was toast #" + f + ". goodbye!"), h.remove();
                                    }),
                                h.find("#surpriseBtn").length &&
                                    h.delegate("#surpriseBtn", "click", function () {
                                        alert("Surprise! you clicked me. i was toast #" + f + ". You could perform an action here.");
                                    });
                        }),
                        $("#clearlasttoast").click(function () {
                            toastr.clear(t);
                        }),
                        $("#cleartoasts").click(function () {
                            toastr.clear();
                        });
                }),
                {
                    init: function () {
                        e();
                    },
                });
        $(function () {
            n.init();
        });
    },
});
//# sourceMappingURL=ui_toastr.js.map
