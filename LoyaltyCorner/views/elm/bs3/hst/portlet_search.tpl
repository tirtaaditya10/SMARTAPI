<div class="well no-padding divFSearch" style="display:none">
    <section class="padding-10">
        <form id="sForm_{$sys.req.rid}" method="post" action="#{$sys.req.rid}" data-target="#{$sys.uix.pct}" class="form-horizontal sForm" novalidate>
            <header><h3><i class="fa fa-search"></i> Search Parameters</h3></header>
            <input type="hidden" name="n" value="1"/>
            <input type="hidden" name="p" value="{$sys.req.p|default:1}"/>
            <input type="hidden" name="s" value="{$sys.req.s}"/>
            <input type="hidden" name="f" value="{$sys.req.f}"/>
            <fieldset>
                <div class="row no-margin">
                {foreach from=$sys.rsp.ref key=k item=v}
                    {if isset($v.elm_type) && $v.elm_type eq 'hidden'}
                        <input type="hidden" name="{$v.col_fid}" value="{$v.sp_def}"/>
                    {elseif $v.elm_type eq 'free_search'}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-3-md control-label">{$v.elm_label}</label>
                                <input type="text" class="form-control" name="q" value="{$v.sp_def}" placeholder="{$v.elm_label}">
                            </div>
                        </div>
                    {elseif $v.elm_placement eq 'lst' or $v.elm_placement eq 'both'}
                        {if $v.elm_type eq 'select' or
                            $v.elm_type eq 'select_group' or
                            $v.elm_type eq 'select_multiple' or
                            $v.elm_type eq 'select_tree' or
                            $v.elm_type eq 'select_self'}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{$v.elm_label}</label>
                                    {include file="{$sys.uix.elm}/frm/bs-hrz/fs_select.tpl" rff=$v}
                                </div>
                            </div>
                        {elseif $v.elm_type eq 'date_range'}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col col-md-4 control-label">{$v.elm_label}</label>
                                    <div class="col col-md-4">
                                        <div class="input-group">
                                            <input class="form-control hasDatepicker" id="from" placeholder="From" type="text" />
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <div class="input-group">
                                            <input class="form-control hasDatepicker" id="to" placeholder="Select a date" type="text">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/if}
                    {/if}
                {/foreach}
                </div>
            </fieldset>
            <div class="form-actions" style="margin-left:0; margin-right:0">
                <div class="row">
                    <div class="col-md-6">
                        {if $sys.usr.is_admin && $sys.prc.sys_tbl.has.col_active && isset($sys.rsp.ref.is_active)}
                            {include file="{$sys.uix.elm}/frm/bs-hrz/fs_is_active.tpl"}
                        {/if}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rows / Page</label>
                            <div class="col-md-7">
                                <select name="l" class="form-control input-sm">
                                    <option value="">#Data / Page</option>
                                    {foreach from=$sys.nav.row item=r}
                                        <option value="{$r}" {if $sys.req.l eq $r}selected{/if}>{$r}</option>
                                    {/foreach}
                                    {if $sys.req.l gte 1000}
                                        <option value="{$sys.req.l}" selected>ALL</option>{/if}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <button class="btn txt-color-green" type="submit">Search <i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>