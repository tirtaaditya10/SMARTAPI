{if     $sys.prc.sys_tbl.sys_table_pk_type_id eq 20}    {assign "pk_type" 'num'}
{elseif $sys.prc.sys_tbl.sys_table_pk_type_id eq 30}    {assign "pk_type" 'char'}
{else}                                                  {assign "pk_type" 'serial'}{/if}

{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if $pk_type eq 'char' || $pk_type eq 'serial'} {assign $grid_0 3}
{else}                                          {assign $grid_0 2}{/if}

{if isset($hide) && $hide}  {assign "hide" 'display-none'}
{else}                      {assign "hide" ''}{/if}
{if $pk_type eq 'char' ||
    $pk_type eq 'num'  ||
    $sys.prc.sys_tbl.has.col_code}
	                        {assign "hide" ''}
{/if}

{if $sys.prc.sys_tbl.has.col_code}
	<div class="form-group">
		<label for="id" class="col-md-{$grid_0} control-label">{$lbl_id|default:'ID'} <span class="required">*</span> | {$lbl_cd|default:'Code'} <span class="required">*</span></label>
		<div class="col-md-3">
			<input id="act" name="act" value="{if $sys.rsp.dat.id}upd{else}add{/if}" type="hidden" />
            <div class="input-group">
			    {if $sys.rsp.dat.id}
					<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control" value="{$sys.rsp.dat.id}" readonly required />
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
			    {else}
                    {if $pk_type eq 'num'}
                            <input type="number" id="id_{$sys.req.rid}" name="id" class="form-control numeric unique" step="{$cfg.step|default:1}"
                                   {if isset($cfg.minlength)}data-minlength="{$cfg.minlength}"{/if}    {if isset($cfg.msg_minlength)}data-msg-minlength="{$cfg.msg_minlength}"{/if}
                                   {if isset($cfg.maxlength)}data-maxlength="{$cfg.maxlength}"{/if}    {if isset($cfg.msg_maxlength)}data-msg-maxlength="{$cfg.msg_maxlength}"{/if}
                                   required data-required="true"   data-msg-required="{$cfg.msg_required|default:'This Column is Mandatory'}"
                                   data-remote="{$sys.req.rid}"    data-msg-remote="{$cfg.msg_remote|default:'This value is already used'}"
                                   data-rule-unique="{if $sys.rsp.dat.id}true{else}false{/if}"
                            />
                            <span class="input-group-addon">U</span>
                    {elseif $pk_type eq 'char'}
                            <input type="text" id="id_{$sys.req.rid}" name="id" class="form-control unique" step="{$cfg.step|default:1}"
                                   {if isset($cfg.minlength)}data-minlength="{$cfg.minlength}"{/if}    {if isset($cfg.msg_minlength)}data-msg-minlength="{$cfg.msg_minlength}"{/if}
                                   {if isset($cfg.maxlength)}data-maxlength="{$cfg.maxlength}"{/if}    {if isset($cfg.msg_maxlength)}data-msg-maxlength="{$cfg.msg_maxlength}"{/if}
                                   required data-required="true"   data-msg-required="{$cfg.msg_required|default:'This Column is Mandatory'}"
                                   data-remote="{$sys.req.rid}"    data-msg-remote="{$cfg.msg_remote|default:'This value is already used'}"
                                   data-rule-unique="{if $sys.rsp.dat.id}true{else}false{/if}"
                            />
                            <span class="input-group-addon">U</span>
                    {elseif $pk_type eq 'serial'}
                            <input type="text" id="id_{$sys.req.rid}" name="id" class="form-control" readonly />
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                        <span class="help-block">Auto-Number</span>
                    {/if}
			    {/if}
            </div>
		</div>
		<div class="col-md-6">
			<div class="input-group">
				<input type="text" id="id_code_{$sys.req.rid}" name="id_code" class="form-control unique" value="{$sys.rsp.dat.id_code}"
						{if $sys.rsp.dat.id_code}
							required data-required="true" data-msg-required="This Column is Mandatory'"
						{/if}
					   data-rule-unique="{if $sys.rsp.dat.id_code}true{else}false{/if}"
					   data-remote="{$sys.req.rid}" data-msg-remote="This value is already used"
				/>
				<span class="input-group-addon">U</span>
			</div>
		</div>
	</div>
{else}
	<div class="form-group {$hide}">
		<label for="{$pkey|default:'id_'}{$sys.req.rid}" class="col-md-{$grid_0} control-label">{$label|default:'ID'} <span class="required">*</span></label>
		<div class="col-md-{$grid_1}">
			<input id="act" name="act" value="{if $sys.req.pid eq 'new'}add{else}upd{/if}" type="hidden" />
			{if $sys.req.pid neq 'new'}
				<div class="input-group">
					<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control" value="{$sys.rsp.dat.id}" readonly required />
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				</div>
			{else}
				{if $pk_type eq 'char'}
					<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control unique"
						required data-required="true" data-msg-required="{$cfg.msg_required|default:'This Column is Mandatory'}"
						{if isset($cfg.minlength)}data-minlength="{$cfg.minlength}"{/if}    {if isset($cfg.msg_minlength)}data-msg-minlength="{$cfg.msg_minlength}"{/if}
						{if isset($cfg.maxlength)}data-maxlength="{$cfg.maxlength}"{/if}    {if isset($cfg.msg_maxlength)}data-msg-maxlength="{$cfg.msg_maxlength}"{/if}
						data-remote="{$sys.bpm.tbl}"  data-msg-remote="{$cfg.msg_remote|default:'This value is already used'}"
						data-rule-unique="{if $sys.rsp.dat.id}true{else}false{/if}"
					/>
					{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
				{elseif $pk_type eq 'num'}
					<input type="number" id="id_{$sys.req.rid}" name="id" class="form-control numeric unique" data-source="{$sys.req.rid}" step="{$cfg.step|default:1}"
                        {if isset($cfg.minlength)}data-minlength="{$cfg.minlength}"{/if}    {if isset($cfg.msg_minlength)}data-msg-minlength="{$cfg.msg_minlength}"{/if}
                        {if isset($cfg.maxlength)}data-maxlength="{$cfg.maxlength}"{/if}    {if isset($cfg.msg_maxlength)}data-msg-maxlength="{$cfg.msg_maxlength}"{/if}
						required data-required="true"   data-msg-required="{$cfg.msg_required|default:'This Column is Mandatory'}"
						data-remote="{$sys.bpm.tbl}"    data-msg-remote="{$cfg.msg_remote|default:'This value is already used'}"
						data-rule-unique="{if $sys.rsp.dat.id}true{else}false{/if}"
					/>
				{elseif $pk_type eq 'serial'}
					<div class="input-group">
						<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control" readonly />
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					</div>
					<span class="help-block">Auto-Number</span>
				{/if}
			{/if}
		</div>
	</div>
{/if}
