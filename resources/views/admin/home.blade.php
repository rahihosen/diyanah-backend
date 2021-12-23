


<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166239490-1"></script>
    <script>window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-166239490-1');</script>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" name="viewport"/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="description" content="Fee Bootstrap Admin Theme with Webpack and Laravel-Mix"/>
    <meta name="keywords" content="bootstrap, admin theme, admin dashboard, jquery, webpack, laravel-mix, template, responsive"/>
    <meta name="author" content="siQuang - Simon Nguyen"/>
    <title>{{ trans('panel.site_title') }}</title>
    <!-- <link rel="icon" type="image/png" sizes="96x96" href="backassets/assets/img/favicon.png"> -->

    @include('backend.partials.header_link')
</head>
<body class="theme-default">
    <div class="grid-wrapper sidebar-bg bg1">
        <div id="theme-tab">
            <div class="theme-tab-item switch-theme bg-white" data-theme="theme-default" data-toggle="tooltip" title="Light"></div>
            <div class="theme-tab-item switch-theme bg-dark" data-theme="theme-dark" data-toggle="tooltip" title="Dark"></div>
        </div>

        <!-- left_sidebar start-->
        <div id="sidebar" class="sidebar">
            <div class="sidebar-content">
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">Sidebar</li>

                            @include('backend.partials.left_sidebar')

                        <li>
                            <span class="menu-text">
                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf

                                  <x-jet-dropdown-link href="{{ route('logout') }}"
                                              onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                                      {{ __('Log Out') }}
                                  </x-jet-dropdown-link>
                              </form>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- left_sidebar end-->

        <!-- nav_head start -->
        <div class="header">
            <div class="header-bar">
                @include('backend.partials.nav_header')

            </div>
        </div>

        <!-- nav_head end -->

        <!-- main body start -->
        <div class="main">
            <div class="row">
                <div class="col">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
{{--                            <a href="admin"><i class="ti-home"></i> Dashboard</a>--}}
                        </li>
                    </ol>
                </div>
            </div>
            @yield('content')
        </div>
        <!-- main body end -->


        @include('backend.partials.footer')

        <div id="preloader"></div>
            @include('backend.partials.right_sidebar')
        <div id="overlay"></div>
    </div>

    @include('backend.partials.footer_link')

    @include('admin.categories.script')
</body>
</html>


