<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0">
        <div class="header-container container-fluid px-lg-4">
            <div class="header-row">
                <div class="header-column header-column-border-right flex-grow-0">
                    <div class="header-row pe-4">
                        <div class="header-logo">
                            <a href="{{ route("/") }}">
                                <img alt="Porto" 
                                    width="250" 
                                    height="auto" 
                                    data-sticky-width="200" 
                                    data-sticky-height="auto" 
                                    src="{{Helper::getThemeAssets()}}img/logo_disporapar_black.svg">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-nav header-nav-links justify-content-center">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse header-mobile-border-top">
                                    @include('template.porto_video.partials.menu')
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-column header-column-border-left flex-grow-0 justify-content-center">
                    <div class="header-row ps-4 justify-content-end">
                        <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean m-0">
                            <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-instagram"></i></a></li>
                            <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-phone"></i></a></li>
                        </ul>
                        <button class="btn header-btn-collapse-nav ms-0 ms-sm-3" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>