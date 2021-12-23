<!DOCTYPE html>
<html class="theme-grocery needs-cover">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta name="google" content="notranslate" />
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <title>Diyanah</title>

    @include('frontend.partials.header_link')
</head>

<body class="">
<div id="fb-root"></div>
<div id="page">
    <div class="app catalog navOpen chaldal-theme" >
        <div class="mui"><div class="authDialogs" ></div></div>

            @include('frontend.partials.header')

        <div class="everythingElseWrapper" data-reactid=".lpyoxu003e.6">
            <div data-reactid=".lpyoxu003e.6.0"></div>
            <noscript data-reactid=".lpyoxu003e.6.1"></noscript>
            <section class="bodyTable" data-reactid=".lpyoxu003e.6.2">
                <div data-reactid=".lpyoxu003e.6.2.0">
                    <div class="landingPage2" data-reactid=".lpyoxu003e.6.2.0.0">

                        @yield('content')

                        <footer id="footer">
                            @include('frontend.partials.footer')
                        <footer>
                    </div>
                </div>
            </section>
        </div>
    </div>

        <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script>
        window.__reactAsyncStatePacket = {
            ".lpyoxu003e__0": {
                context: {
                    user: null,
                    jar: null,
                    shoppingCart: { Discount: null, Items: [], ProductVariantCouponMap: {}, Dynamics: null },
                    locale: ["en-US"],
                    query: { "": "undefined" },
                    pageHeader: { statusCode: 200 },
                    checkoutState: null,
                    isWebpSupported: false,
                    userAgent: "Mozilla/4.5 (compatible; HTTrack 3.0x; Windows 98)",
                    store: {
                        Id: 1,
                        Key: "chaldal",
                        Name: "Chaldal \ud83e\udd5a",
                        Title: "Online Grocery Shopping and Delivery in Bangladesh | Buy fresh food items, personal care, baby products and more",
                        Keywords:
                            "bangladesh online grocery, bangladesh bazaar, best bazaar, daily bazaar, daily shop, large shop, bd shop, shop, online store,  buy, sell, home shop, Meat, Oil, Chal, Free home delivery, Fresh vegetables, formalin free, free return, 0188-1234567",
                        Description: "Order grocery and food online with same-day home delivery. Save money, save time",
                        Hostname: ["chaldal.com", "www.chaldal.com", "shop.chaldal.com", "www.shop.chaldal.com", "localhost.chaldal.com"],
                        Image: "https://chaldn.com/asset/Egg.Grocery.Fabric/Egg.Grocery.Web1/1.5.0+DataCenter-Release-2338/Default/resources/images/egg.png?q=low&alpha=1",
                        FbPixelId: ["904455872904399"],
                        GaId: "UA-42216054-1",
                        ContactNumber: "0188-1234567",
                        ThemeColor: "#fdd670",
                    },
                    isFifteenMinuteDeliveryActive: false,
                    selectedMetropolitanAreaId: 1,
                    maybeGuestWarehouseId: null,
                },
                pathname: "/h3",
                showPhoneLoginDialog: false,
                showLoginDialog: false,
                showForgotPasswordDialog: false,
                isMobileMenuExpanded: false,
                showFbLoginEmailDialog: false,
                showRequestProductDialog: false,
                isContinueWithSite: true,
                hideCoreHeader: false,
                hideVerticalMenu: false,
                sequenceSeed: "web-163092766596521",
                theme: "default",
                offerCount: null,
                isChatVisibile: false,
                isProductOnScreen: false,
                isGeolocationPopupVisible: false,
                isIncentivePopupVisible: false,
            },
        };
        </script>
    </div>

    @include('frontend.partials.footer_link')
</body>
<!-- Mirrored from chaldal.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Sep 2021 11:28:18 GMT -->
</html>

