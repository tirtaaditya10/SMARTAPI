<!-- #HEADER -->
<header id="header">
    <div id="logo-group">
        <!-- PLACE YOUR LOGO HERE -->
        <a href="{$sys.cfg.host}"><span id="logo"> <img src="asset/img/logo/home_top.png" alt="Wyeth CRM"> </span></a>
        <!-- END LOGO PLACEHOLDER -->
    </div>

    <!-- #TOGGLE LAYOUT BUTTONS -->
    <!-- pulled right: nav area -->
    <div class="pull-right">
        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->


        <!-- #MOBILE -->
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    <img src="{$sys.usr.media_avatar}" alt="{$sys.usr.aaa_account}" class="online" />
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="profile" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="logout" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="logout" title="Sign Out" data-action="userLogout" data-logout-msg="Thank you for your best work today"><i class="fa fa-sign-out"></i></a> </span>
        </div>
        <!-- end logout button -->

        <!-- search mobile button (this is hidden till mobile view port) -->
        <!--div id="search-mobile" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div-->
        <!-- end search mobile button -->

        <!-- #SEARCH -->
        <!-- input: search field -->
        <!--form action="#ajax/search.html" class="header-search pull-right">
            <input id="search-fld" type="text" name="param" placeholder="Find reports and more">
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
            <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
        </form-->
        <!-- end input: search field -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->

        <span id="activity" class="btn-header transparent pull-right activity-dropdown"> <i class="fa fa-user"></i> <b class="badge  bounceIn animated">0</b> </span>
        <div class="ajax-right-dropdown" style="display: none;">
            <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
            <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default active">
                    <input name="activity" id="/crm/tpl/ajax/full/ajax/notify/notifications.html" type="radio"> Best-Time
                </label>
            </div>

            <!-- notification content -->
            <div class="ajax-notifications custom-scroll"></div>
            <!-- end notification content -->

            <!-- footer: refresh area -->
            <span> Last updated on: 12/12/2013 9:43AM
                <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
                    <i class="fa fa-refresh"></i>
                </button>
            </span>
            <!-- end footer -->
        </div>

    </div>
    <!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->