<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">
    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as is -->
            <a href="javascript:" id="show-shortcut" data-action="toggleShortcut">
                <img src="{$sys.usr.media_avatar}" alt="me" class="online" />
                <span>{$sys.usr.aaa_account}</span>
                <i class="fa fa-angle-down"></i>
            </a>
        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

    To make this navigation dynamic please make sure to link the node
    (the reference to the nav > ul) after page load. Or the navigation
    will not initialize.
    -->
    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->
        <ul>
            <li class="hidden">
                <a href="home/splash" title="Splash"><i class="fa fa-lg fa-fw fa-home"></i><span class="menu-item-parent">Splash</span></a>
            </li>
            {foreach $sys.rsp.menu.tree as $k=>$A}
                <li>
                    <a href="{$A.sys_url}" id="M_{$A.id}" class="{$A.sys_class}" {if $A.sys_header}title="{$A.sys_header}-{$A.sys_url}"{/if}>
                        {if $A.sys_icon}{if preg_match("/^(fa|glyph).*/", $A.sys_icon)}<i class="{$A.sys_icon}"></i>{else}<i class="material-icons">{$A.sys_icon}</i>{/if}{/if}
                        {if isset($A.sub) && $A.sub}<span class="menu-item-parent"> {$A.sys_process}</span>{else} {$A.sys_process}{/if}
                    </a>
                    {if isset($A.sub) && $A.sub}
                        <ul>{foreach $A.sub as $l=>$B}
                                <li><a href="{$B.sys_url}" id="M_{$B.id}" class="{$B.sys_class}" {if $B.sys_header}title="{$B.sys_header}"{/if}>
                                        {if $B.sys_icon}{if preg_match("/^(fa|glyph).*/", $B.sys_icon)}<i class="{$B.sys_icon}"></i>{else}<i class="material-icons">{$B.sys_icon}</i>{/if}{/if}
                                        {if isset($B.sub) && $B.sub}<span class="menu-item-parent"> {$B.sys_process}</span>{else} {$B.sys_process}{/if}
                                    </a>
                                    {if isset($B.sub) && $B.sub}
                                        <ul>{foreach $B.sub as $m=>$C}
                                                <li><a href="{$C.sys_url}" id="M_{$C.id}" class="{$C.sys_class}" {if $C.sys_header}title="{$C.sys_header}"{/if}>
                                                        {if $C.sys_icon}{if preg_match("/^(fa|glyph).*/", $C.sys_icon)}<i class="{$C.sys_icon}"></i>{else}<i class="material-icons">{$C.sys_icon}</i>{/if}{/if}
                                                        {if isset($C.sub) && $C.sub}<span class="menu-item-parent"> {$C.sys_process}</span>{else} {$C.sys_process}{/if}
                                                    </a>
                                                    {if isset($C.sub) && $C.sub}
                                                        <ul>{foreach $C.sub as $n=>$D}
                                                                <li><a href="{$D.sys_url}" id="M_{$D.id}" class="{$D.sys_class}" {if $D.sys_header}title="{$D.sys_header}"{/if}>
                                                                        {if $D.sys_icon}{if preg_match("/^(fa|glyph)*/", $D.sys_icon)}<i class="{$D.sys_icon}"></i>{else}<i class="material-icons">{$D.sys_icon}</i>{/if}{/if}
                                                                        {if isset($D.sub) && $D.sub}<span class="menu-item-parent"> {$D.sys_process}</span>{else} {$D.sys_process}{/if}
                                                                    </a>
                                                                    {if isset($D.sub) && $D.sub}
                                                                        <ul>{foreach $D.sub as $o=>$E}
                                                                                <li><a href="{$E.sys_url}" id="M_{$E.id}" class="{$E.sys_class}" {if $E.sys_header}title="{$E.sys_header}"{/if}>
                                                                                        {if $E.sys_icon}{if preg_match("/^(fa|glyph)*/", $E.sys_icon)}<i class="{$E.sys_icon}"></i>{else}<i class="material-icons">{$E.sys_icon}</i>{/if}{/if}
                                                                                        {if isset($E.sub) && $E.sub}<span class="menu-item-parent"> {$E.sys_process}</span>{else} {$E.sys_process}{/if}
                                                                                    </a>
                                                                                    {if isset($E.sub) && $E.sub}
                                                                                        <ul>
                                                                                            {foreach $E.sub as $p=>$F}
                                                                                                <li><a href="{$F.sys_url}" id="M_{$F.id}" class="{$F.sys_class}" {if $F.sys_header}title="{$F.sys_header}"{/if}>
                                                                                                        {if $F.sys_icon}{if preg_match("/^(fa|glyph)*/", $F.sys_icon)}<i class="{$F.sys_icon}"></i>{else}<i class="material-icons">{$F.sys_icon}</i>{/if}{/if}
                                                                                                        {if isset($F.sub) && $F.sub}<span class="menu-item-parent"> {$F.sys_process}</span>{else} {$F.sys_process}{/if}
                                                                                                    </a>
                                                                                                </li>
                                                                                            {/foreach}
                                                                                        </ul>
                                                                                    {/if}
                                                                                </li>
                                                                            {/foreach}
                                                                        </ul>
                                                                    {/if}
                                                                </li>
                                                            {/foreach}
                                                        </ul>
                                                    {/if}
                                                </li>
                                            {/foreach}
                                        </ul>
                                    {/if}
                                </li>
                            {/foreach}
                        </ul>
                    {/if}
                </li>
            {/foreach}
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu" style="bottom:0px;"><i class="fa fa-arrow-circle-left hit"></i></span>
</aside>
<!-- END NAVIGATION -->