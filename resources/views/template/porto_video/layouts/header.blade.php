<header id="header" class="header-transparent header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0 bg-dark box-shadow-none">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo py-2">
                            <a href="/">
                                <img alt="Porto" width="250" height="auto" src="{{Helper::getThemeAssets()}}img/logo_disporapar_white.svg">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    @include('template.porto_video.partials.menu')
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="header-nav-features header-nav-features-light header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                            <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                <a href="#" class="header-nav-features-toggle text-decoration-none" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
                                <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed" id="headerTopSearchDropdown">
                                    <form role="search" action='{{route("binshopsblog.search", app()->getLocale())}}' 
                                        method="get">
                                        <div class="simple-search input-group">
                                            <input class="form-control text-1" id="headerSearch" name="s" type="search" value="" placeholder="Search...">
                                            <button class="btn" type="submit">
                                                <i class="fas fa-search header-nav-top-icon"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>